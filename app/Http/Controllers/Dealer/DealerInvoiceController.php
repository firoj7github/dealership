<?php

namespace App\Http\Controllers\Dealer;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\DueOrder;
use App\Models\Inventory;
use App\Models\Invoice;
use App\Models\LeadMessage;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Exception;
use Yajra\DataTables\DataTables;


class DealerInvoiceController extends Controller
{
    public function InvoiceCreate()
    {
        $users = User::where('role', 2)->get();
        return view('admin.invoice.create-invoice', compact('users'));
    }

    public function Show(Request $request)
    {
        $bannerIds = $request->input('banner_ids', []);
        $sliderIds = $request->input('slider_ids', []);
        $inventoryIds = $request->input('inventory_ids', []);

        // Store the IDs in the session
        Session::put('invoice_data', [
            'banner_ids' => $bannerIds,
            'slider_ids' => $sliderIds,
            'inventory_ids' => $inventoryIds,
        ]);
        $userInfo = [];

        if (!empty($bannerIds)) {
            $id = $bannerIds[0];
            // Invoice::whereIn("banner_id", $bannerIds)->get()
            $userInfo[] = Banner::with('user')->where('id', $id)->first();
        } elseif (!empty($sliderIds)) {
            $id = $sliderIds[0];
            $userInfo[] = Slide::with('user')->where('id', $id)->first();
        } elseif (!empty($inventoryIds)) {
            $id = $inventoryIds[0];
            $userInfo[] = Inventory::with('user')->where('id', $id)->first();
        }
        // return $userInfo;

        return view('dealer.invoice.show-invoice', compact('userInfo'));
    }

    public function InvoiceList($id)
    {

        $user = User::find($id);
        $inventories = Inventory::where(['user_id' => $id, 'package' => 1])->get();
        $banners = Banner::where(['user_id' => $id, 'status' => 1])->get();

        return view('admin.dealer.invoice_list', compact('inventories', 'user', 'banners'));
    }



    public function store(Request $request, $type)
    {
        try {
            $selectedData = $request->ListingSelectedData;

            $package = $request->packagePlan;
            $existingInvoices = Invoice::whereIn("{$type}_id", $selectedData)->get();
            $existingDataIds =  $existingInvoices->pluck("{$type}_id")->toArray();

            $newData = array_diff($selectedData, $existingDataIds);


            if(!empty($newData)){
                $price = $this->getPriceBasedOnType($type);
                $this->insertCustomStore($newData, $type, $package, $price);
                return response()->json(['status' => 'success', 'message' => 'New invoices created']);

            }else{
                return response()->json(['status' => 'error', 'message' => 'All data already checked']);
            }








        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function getPriceBasedOnType($type)
    {
        // Adjust the logic to determine the price based on the type
        switch ($type) {
            case 'inventory':
                return '20';
            case 'banner':
                return '100';
                // Add more cases as needed
            default:
                return '200';
        }
    }

    private function insertCustomStore($ids, $type, $package, $price)
    {
        $column = "{$type}_id"; // Assuming the column name follows the pattern "{$type}_id"
        $invoicesToInsert = [];

        foreach ($ids as $id) {
            $invoicesToInsert[] = [
                $column => $id,
                'price' => $price,
                'package' => $package,
                'user_id' => Auth::id(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Invoice::insert($invoicesToInsert);
    }

    // private function generateCustomId()
    // {
    //     $timestamp = now()->format('YmdHis');
    //     return $timestamp;
    // }


    private function freeInventory($request){
        $ids = $request->ListingSelectedData;
        $changePlan = Inventory::whereIn('id', $ids)->get();

        foreach ($changePlan as $inventory) {
            // Assuming there's a relationship between Inventory and Package
         $change= Inventory::where('id', $inventory->id)->first();


        // $change->update([
        //         'package' => 0,
        //         'payment_date' => null,
        //         'active_till' => null,
        //         'featured_till' => null
        //     ]);
        $change->package=0;
        $change->payment_date=null;
        $change->active_till=null;
        $change->featured_till=null;
        $change->save();
        }
        return response()->json([
            'status'=>'success'
        ]);
    }

    public function inventoryStore(Request $request)

    {

        if($request->packagePlan == 1){

            return $this->store($request, 'inventory');
        }
        elseif($request->packagePlan == 0){

            return $this->freeInventory($request);
        }
    }

    public function bannerStore(Request $request)
    {
        return $this->store($request, 'banner');
    }
    public function sliderStore(Request $request)
    {
        return $this->store($request, 'slider');
    }


    private function invoiceCustom($request)
    {

        try {

            $bannerIds = $request->invoiceData['banner_ids'] ?? '';
            $sliderIds = $request->invoiceData['slider_ids'] ?? '';
            $inventoryIds = $request->invoiceData['inventory_ids'] ?? '';
            $newInvoice = new DueOrder();
            if (!empty($bannerIds)) {
                $newInvoice->banner_id = implode(",", $bannerIds);
                $update_invoice = Invoice::where('user_id',Auth::id())->whereIn('banner_id',$bannerIds)->get();
                foreach($update_invoice as $update)
                {
                    $update->status = 1;
                    $update->save();
                }

            }
            if (!empty($sliderIds)) {
                $newInvoice->slider_id = implode(",", $sliderIds);
                $update_invoice = Invoice::where('user_id',Auth::id())->whereIn('slider_id',$sliderIds)->get();
                foreach($update_invoice as $update)
                {
                    $update->status = 1;
                    $update->save();
                }
            }
            if (!empty($inventoryIds)) {
                $newInvoice->inventory_id = implode(",", $inventoryIds);
                $update_invoice = Invoice::where('user_id',Auth::id())->whereIn('inventory_id',$inventoryIds)->get();
                foreach($update_invoice as $update)
                {
                    $update->status = 1;
                    $update->save();
                }
            }

            $newInvoice->user_id = $request->user_id;
            $newInvoice->subtotal = $request->subtotal;
            $newInvoice->total = $request->total;
            $newInvoice->discount = $request->discount;
            $newInvoice->save();
            $newInvoice->get_invoice_id();

            Log::info('inventory status update  successful');
            return response()->json(['status' => 'success']);

        } catch (Exception $e) {
            Log::error('Error in DueOrder creation: ' . $e->getMessage() . ' Trace: ' . $e->getTraceAsString());
            return response()->json(['error' => $e->getMessage()], 500);
        }


    }

    public function dealerInvoiceNewStore(Request $request)
    {

        $res = $this->invoiceCustom($request);
        if($res == true)
        {
            return response()->json(['status' => 'success']);
        }


    }

    private function invoiceCustomPdfService($id)
    {

            $products = DueOrder::with('user')->where('id', $id)->first();
            // $dataToCompact = [
            //     'products' => $products,
            //     'inventory' => !empty($products->inventory_id) ? explode(',', $products->inventory_id) : null,
            //     'banner' => !empty($products->banner_id) ? explode(',', $products->banner_id) : null,
            //     'slider' => !empty($products->slider_id) ? explode(',', $products->slider_id) : null,
            // ];

            $dataToCompact = [
                'products' => $products,
                'inventory' => !empty($products->inventory_id) ? Inventory::whereIn('id',explode(',', $products->inventory_id))->select('stock','year','make','model','trim')->get() : null,
                'banner' => !empty($products->banner_id) ? Banner::whereIn('id',explode(',', $products->banner_id))->get() : null,
                'slider' => !empty($products->slider_id) ? Slide::whereIn('id',explode(',', $products->slider_id))->get() : null,
            ];

            // Remove null values from the array
            $dataToCompact = array_filter($dataToCompact, function ($value) {
                return !is_null($value);
            });
            return $dataToCompact;



    }


    public function dealerInvoicePdf($id)
    {

        try
        {
           $dataToCompact = $this->invoiceCustomPdfService($id);
            Log::info('PDF generation successful', $dataToCompact);
            $pdf = PDF::loadView('admin.pdf.invoice_download', $dataToCompact);
            // return response()->streamDownload(function () use ($pdf) {
            //     echo $pdf->output();
            // }, 'invoice_' . rand(1234, 9999) . '.pdf');
            return $pdf->stream('invoice_' . rand(1234, 9999) . '.pdf');

        }catch(Exception $e)
        {
            Log::error('PDF generation failed: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }


    }


    public function invoiceEmail($id)
    {
    //     $dataToCompact = $this->invoiceCustomPdfService($id);
    //     // $email = $dataToCompact['products']->user->email;
    //     $pdf = PDF::loadView('admin.pdf.invoice_download', $dataToCompact);
    // //    Mail::to('vgcbcytjbq@897666.cloudwaysapps.com')->send(new EmailLeadSMS($data));

    //      Mail::to('vgcbcytjbq@897666.cloudwaysapps.com')->send(new invoicePdfSend($pdf));
       return redirect()->back()->with('message','Message sent successfully!');

    }


    public function deleteCart(Request $request)
    {

        Invoice::where('inventory_id', $request->id)->delete();
        Invoice::where('banner_id', $request->id)->delete();
        Invoice::where('slider_id', $request->id)->delete();
        return response()->json(['status' => 'success', 'message' => 'List Remove successfully']);
    }


    // {{-- @foreach ($invoicesTwo as $invoice)


    //     <tr>

    //         <td class="fs-6">
    //             {{ $loop->iteration }}
    //         </td>
    //         <td style="font-size:10px; font-weight:bold; opacity:97%">
    //             {{ $invoice->invoice_id }}
    //         </td>
    //         @php
    //             $inventory = explode(',', $invoice->inventory_id);
    //         @endphp
    //         <td style="font-size:10px; font-weight:bold; opacity:97%">
    //             @if (!empty($inventory))
    //                 {{ count($inventory) }}
    //             @else
    //                 null
    //             @endif
    //         </td>
    //         @php
    //             $banner = explode(',', $invoice->banner_id);
    //         @endphp
    //         <td style="font-size:10px; font-weight:bold; opacity:97%">
    //             @if (is_array($banner) && !empty($banner))
    //                 {{ count(array_filter($banner)) }}
    //             @else
    //                 null
    //             @endif
    //         </td>
    //         @php
    //             $slider = explode(',', $invoice->slider_id);
    //         @endphp
    //         <td style="font-size:10px; font-weight:bold; opacity:97%">
    //             @if (is_array($slider) && !empty($slider))
    //                 {{ count(array_filter($slider)) }}
    //             @else
    //                 null
    //             @endif
    //         </td>

    //         <td>
    //             {{ $invoice->total }}
    //         </td>

    //         <td style="font-size:10px; font-weight:bold; opacity:97%">
    //             <select class="form-control status {{ $invoice->status == 1 ? 'bg-success' : '' }}" onclick="statusChange({{$invoice}})" disabled>
    //                 <option value="1" {{ $invoice->status == 1 ? 'selected' : '' }}>Paid</option>
    //                 <option value="0" {{ $invoice->status == 0 ? 'selected' : '' }}>Pending</option>
    //             </select>
    //         </td>

    //         </td>


    //         <td>
    //             <a href="{{ route('dealer.invoice.pdf', ['id' => $invoice->id]) }}" target="_blank" title="download pdf" style="font-size: 20px;padding-right:5px"><i
    //                 class="fa-solid fa-file-pdf"></i></a>


    //             <a href="#"
    //             class="text-danger delete_two"
    //             data-id="{{$invoice->id}}"  style="font-size: 20px;padding-right:5px">
    //                 <i class="fa
    //                 fa-delete-left
    //                 "></i>
    //             </a>
    //         </td>


    //     </tr>
    // @endforeach --}}
    public function allInvoice(Request $request, $id = null)
    {

        if($request->ajax()){
            $data = DueOrder::where('user_id',Auth::id())->orderBy('id','desc')->get();
            return DataTables::of($data)
            ->addIndexColumn()
                    ->addColumn('DT_RowIndex', function ($user) {
                        return $user->id; // Use any unique identifier for your rows
                    })



                    // ->editColumn('status', function ($row) {


                    //     $html = '<select  . ($row->status == 1 ? 'bg-success' : '') . " form-control status' style='font-size:10px; font-weight:bold; opacity:97%' data-id='$row->id' onclick="statusChange($row)" disabled>
                    //                     <option " . ($row->status == 1 ? 'selected' : '') . " value='1'>Paid</option>
                    //                     <option " . ($row->status == 0 ? 'selected' : '') . " value='0'>Pending</option>
                    //                 </select>';
                    //     return $html;
                    // })

                    ->addColumn('status', function ($row) {
                        $html = "<select class='action-select " . ($row->status == 1 ? 'bg-success' : '') . " form-control status' style='font-size:10px; font-weight:bold; opacity:97%' data-id='$row->id' onclick='statusChange($row)' disabled>
                                        <option " . ($row->status == 1 ? 'selected' : '') . " value='1'>Paid</option>
                                        <option " . ($row->status == 0 ? 'selected' : '') . " value='0'>Pending</option>
                                    </select>";
                        return $html;
                    })

                    ->addColumn('Inventory', function ($row) {
                        $inventory = explode(',', $row->inventory_id);
                        if(!empty($inventory)){ $result = count($inventory); }
                        return $result;
                    })
                    ->addColumn('Banner', function ($row) {
                        $is_null = $row->banner_id;
                        if($is_null != null){

                            $inventory = explode(',', $row->banner_id);
                            if(!empty($inventory)){ $result = count($inventory); }
                        }else{
                            $result = 0;
                        }
                        return $result;
                    })
                    ->addColumn('Slider', function ($row) {
                        $is_null = $row->slider_id;
                        if($is_null != null){

                            $inventory = explode(',', $row->banner_id);
                            if(!empty($inventory)){ $result = count($inventory); }
                        }else{
                            $result = 0;
                        }
                        return $result;
                    })



                    ->addColumn('action', function ($row) {
                        $html =

                                '<a href="' . route("dealer.invoice.pdf",['id' => $row->id]) . '"  style="font-size: 20px;padding-right:5px" target="_blank" title="download pdf"><i class="fa-solid fa-file-pdf"></i></a>' .
                                '<a  data-id="' . $row->id . '" style="font-size: 20px;padding-right:5px" class="text-danger delete_two" title="Delete"><i class="fa fa-delete-left"></i></a>';
                        return $html;
                    })

                    ->rawColumns(['Inventory','Banner','status','Slider','action'])
                    ->make(true);
        }




        $user = User::where('id',$id)->first();
        $invoicesTwo = DueOrder::where('user_id',$id)->orderBy('id','desc')->get();

        // if($invoicesTwo->count() < 1){
        //     return back()->with('error', 'No invoice found for the specified user.');
        // }
        // dd($invoicesTwo);
        return view('dealer.invoice.invoice',compact('user'));
    }


    public function invoice(Request $request){
        // dd('skjdfhjsadfjhfdh');
        // $user= Auth::user();
        // $invoicesTwo = DueOrder::where('user_id', Auth::id())->orderby('id','desc')->get();

        //  if($invoicesTwo->count() < 1 ){
        //     return back()->with('error','No invoice found for the specified user');

        // }
        //     return view('dealer.invoice.invoiceseen',compact('invoicesTwo','user'));



        //    $user = User::where('id',Auth::id())->first();
        //    $invoicesTwo = DueOrder::where('user_id',Auth::id())->orderBy('id','desc')->get();
        //    return view('dealer.invoice.invoice',compact('invoicesTwo','user'));
           $user = User::where('id',Auth::id())->first();

           return view('dealer.invoice.invoice',compact('user'));

    }


    public function getcartItem()
{
    $today = Carbon::now()->toDateString();
    $invoices = Invoice::where('user_id', Auth::id())
        ->where('status',0)
        ->latest()
        ->get();

    $html = '';

    if ($invoices) {

        $html .= '<form action="' . route('dealer.invoice.show') . '" method="POST">';
        $html .= csrf_field();
        $html .='<table class="table">';
        $html .='<tbody>';

        foreach ($invoices as $invoice) {
            $html .= '<tr>';

            if ($invoice->banner_id) {
                $html .= '<td style="padding: 0px">' . $invoice->banner->name . '</td>';
                $html .= '<td style="padding: 0px"><input type="hidden" name="banner_ids[]" value="' . $invoice->banner_id . '"></td>';
                $html .= '<td style="padding: 0px"><a href="#" class="deleteCart" data-id="' . $invoice->banner_id . '"><i class="fa fa-trash btn btn-sm btn-danger"></i></a></td>';
            }

            if ($invoice->slider_id) {
                $html .= '<td style="padding: 0px">' . $invoice->slider->title . '</td>';
                $html .= '<td style="padding: 0px"><input type="hidden" name="slider_ids[]" value="' . $invoice->slider_id . '"></td>';
                $html .= '<td style="padding: 0px"><a href="#" class="deleteCart" data-id="' . $invoice->slider_id . '"><i class="fa fa-trash btn btn-sm btn-danger"></i></a></td>';
            }

            if ($invoice->inventory_id) {
                $html .= '<td style="padding: 0px"># ' . ($invoice->inventory->stock ? $invoice->inventory->stock : '') . '</td>';
                $html .= '<td style="padding: 0px">' . $invoice->inventory->title . '</td>';
                $html .= '<td style="padding: 0px"><input type="hidden" name="inventory_ids[]" value="' . $invoice->inventory_id . '"></td>';
                $html .= '<td style="padding: 0px"><a href="#" class="deleteCart" data-id="' . $invoice->inventory_id . '"><i class="fa fa-trash btn btn-sm btn-danger"></i></a></td>';
            }

            $html .= '</tr>';
        }

        $html .='</tbody>';
        $html .='</table>';

        $html .= '<button class="btn btn-success checkInvoiceNull" style="float: right;" type="submit">Go Invoice</button>';
        $html .= '</form>';
        if (count($invoices) > 0) {
            $html .= '<button class="btn btn-danger clearAllBtn" type="button" style="float: left;">Clear All</button>';
        }

    }

//   echo $html;


    return response()->json(['status' => 'success', 'data' => $html,'count' => count($invoices)]);
}

    public function cartDelete(Request $request){
        Invoice::where('inventory_id', $request->id)->delete();
        Invoice::where('banner_id', $request->id)->delete();
        Invoice::where('slider_id', $request->id)->delete();
        return response()->json(['status' => 'success', 'message' => 'List Remove successfully']);

    }



    private function InventoryFeature($request)
    {


        try
        {
            $invoice_tb_update = DueOrder::where('id', $request['invoices']['id'])->where('status','0')->first();
            if($invoice_tb_update)
            {
              $invoice_tb_update->status = 1;
              $invoice_tb_update->save();

             $inventory_ids = explode(',', $request['invoices']['inventory_id']);

             if (!empty($inventory_ids)) {
                 foreach ($inventory_ids as $id) {
                     $feature_inventory = Inventory::find($id);

                     if ($feature_inventory) {
                         $feature_inventory->payment_date = now()->format('Y-m-d');
                         $feature_inventory->active_till = now()->format('Y-m-d');
                         $feature_inventory->featured_till = Carbon::now()->addDays(30)->format('Y-m-d');
                         $feature_inventory->is_feature = 1;
                         $feature_inventory->save();
                     }
                 }

                 return response()->json(['status'=>'success','message'=>'Listing Feature Successfully']);
             }

            }else
            {
                return response()->json(['status'=>'error','message'=>'Already Featured']);
            }

        }catch(Exception $e)
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }


    }



    public function invoicePaidPanding(Request $request)
    {


        if($request->status == '1')
        {

            return $this->InventoryFeature($request);

        }

        if($request->status == '0')
        {

           return 'hellow';

        }

    }

    public function invoiceDelete(Request $request){
        // return $request->id;
        $invoice= DueOrder::find($request->id);
        $invoice->delete();
        return response()->json([
            'status'=>'success'
        ]);
    }

    public function deleteAllCartItem()
    {

        $deleteCartData = Invoice::where('status',0)->get();
        foreach ($deleteCartData as $cartItem) {
            $cartItem->delete();
        }

        return response()->json(['status'=>'success','message'=>'Clear All']);
    }

    public function message(){
        $messages = LeadMessage::where('receiver_id',Auth::id())->get();
        return view('dealer.message.dealer_message', compact('messages'));
    }

}
