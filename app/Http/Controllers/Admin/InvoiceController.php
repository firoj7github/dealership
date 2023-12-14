<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\invoicePdfSend;
use App\Models\Banner;
use App\Models\DueOrder;
use App\Models\Inventory;
use App\Models\Invoice;
use App\Models\Slide;
use App\Models\User;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{
    public function InvoiceCreate()
    {
        $users = User::where('role', 2)->get();
        return view('admin.invoice.create-invoice', compact('users'));
    }

    public function InvoiceShow(Request $request)
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

        return view('admin.invoice.show-invoice', compact('userInfo'));
    }

    public function InvoiceList($id)
    {

        $user = User::find($id);
        $inventories = Inventory::where(['user_id' => $id, 'package' => 1])->get();
        $banners = Banner::where(['user_id' => $id, 'status' => 1])->get();

        return view('admin.dealer.invoice_list', compact('inventories', 'user', 'banners'));
    }



    // public function store(Request $request, $type)
    // {
    //     try {
    //         $selectedData = $request->ListingSelectedData;

    //         $package = $request->packagePlan;
    //         $existingInvoices = Invoice::whereIn("{$type}_id", $selectedData)->get();
    //         // return $existingInvoices;


    //         if ($existingInvoices->isEmpty()) {
    //             $price = $this->getPriceBasedOnType($type);
    //             $this->insertCustomStore($selectedData, $type, $package, $price);
    //             return response()->json(['status' => 'success', 'total' => $existingInvoices]);
    //         }else
    //         {
    //             return response()->json(['status' => 'error', 'message' => "Already Checked"]);
    //         }


    //     } catch (Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }
    public function store(Request $request, $type)
    {
        try {
            $selectedData = $request->ListingSelectedData;
            $package = $request->packagePlan;

            // Check if there are existing invoices among the selected data
            $existingInvoices = Invoice::whereIn("{$type}_id", $selectedData)->get();

            $existingDataIds = $existingInvoices->pluck("{$type}_id")->toArray();


            $newData = array_diff($selectedData, $existingDataIds);

            if (!empty($newData)) {
                // New data found, insert new invoices
                $price = $this->getPriceBasedOnType($type);
                $this->insertCustomStore($newData, $type, $package, $price);

                return response()->json(['status' => 'success', 'message' => 'New invoices created']);
            } else {
                // No new data, return a response indicating that data has already been checked.
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



    public function invoiceNewStore(Request $request)
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


    public function invoicePdf($id)
    {

        try
        {
           $dataToCompact = $this->invoiceCustomPdfService($id);
            // return view('admin.pdf.invoice_download',$dataToCompact);
            Log::info('PDF generation successful', $dataToCompact);
            $pdf = PDF::loadView('admin.pdf.invoice_download',$dataToCompact);
            return $pdf->stream('invoice_' . rand(1234, 9999) . '.pdf');

        }catch(Exception $e)
        {
            Log::error('PDF generation failed: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }


    }


    public function invoiceEmail($id)
    {
        $dataToCompact = $this->invoiceCustomPdfService($id);
        $email = $dataToCompact['products']->user->email;
        $pdf = PDF::loadView('admin.pdf.invoice_download', $dataToCompact);
    //    Mail::to('vgcbcytjbq@897666.cloudwaysapps.com')->send(new EmailLeadSMS($data));

         Mail::to($email)->send(new invoicePdfSend($pdf));
       return redirect()->back()->with('message','Message sent successfully!');

    }

    // public function getcartItem()
    // {

    //     $today = Carbon::now()->toDateString();
    //          $invoices = Invoice::where('user_id',Auth::id())
    //             ->whereDate('created_at', $today)
    //             ->latest()
    //             ->get();
    //             // if($invoices)
    //             // {
    //             //     Session::put('invoices',$invoices);
    //             // }
    //             $html = '';
    //             if($invoices)
    //             {
    //                 $html .=`<form action="{{ route('admin.invoice.show')}}" method="POST">
    //                         @csrf
    //                         @forelse ($invoices as $invoice)
    //                         <tr>
    //                             @if ($invoice->banner_id)
    //                                 <td style="padding: 0px">{{$invoice->banner->name}}</td>
    //                                 <td style="padding: 0px"><input type="hidden" name="banner_ids[]" value="{{ $invoice->banner_id}}"></td>
    //                                 <td style="padding: 0px"><a href="#" class="deleteCart" data-id="{{ $invoice->banner_id}}"><i class="fa fa-trash btn btn-sm btn-danger"></i></a></td>
    //                             @endif
    //                             @if ($invoice->slider_id)
    //                                 <td style="padding: 0px">{{$invoice->slider->title}}</td>
    //                                 <td style="padding: 0px"><input type="hidden" name="slider_ids[]" value="{{ $invoice->slider_id}}"></td>
    //                                 <td style="padding: 0px"><a href="#" class="deleteCart" data-id="{{ $invoice->slider_id}}"><i class="fa fa-trash btn btn-sm btn-danger"></i></a></td>
    //                             @endif
    //                             @if ($invoice->inventory_id)
    //                                 <td style="padding: 0px"># {{($invoice->inventory->stock) ? $invoice->inventory->stock : ''}}</td>
    //                                 <td style="padding: 0px">{{$invoice->inventory->title}}</td>
    //                                 <td style="padding: 0px"><input type="hidden" name="inventory_ids[]" value="{{ $invoice->inventory_id}}"></td>
    //                                 <td style="padding: 0px"><a href="#" class="deleteCart" data-id="{{ $invoice->inventory_id}}"><i class="fa fa-trash btn btn-sm btn-danger"></i></a></td>
    //                             @endif
    //                         </tr>
    //                     @empty
    //                         <p>No listing here</p>
    //                     @endforelse
    //                     <button class="btn btn-success" type="submit">Go Invoice</button>

    //             </form>  `;

    //             }



    //        return response()->json(['status'=>'success','data'=>$invoices]);

    // }


 public function getcartItem()
{
    // $today = Carbon::now()->toDateString();
    $invoices = Invoice::where('user_id', Auth::id())
        ->where('status',0)
        ->latest()
        ->get();

    $html = '';


    if ($invoices) {

        $html .= '<form action="' . route('admin.invoice.show') . '" method="POST" id="invoice_form_submit">';
        $html .= csrf_field();
        $html .='<table class="table">';
        $html .='<tbody>';

        foreach($invoices as $invoice) {
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


        $html .= '<button class="btn btn-success checkInvoiceNull" type="submit" style="float: right;">Go Invoice</button>';
        $html .= '</form>';
        if (count($invoices) > 0) {
            $html .= '<button class="btn btn-danger clearAllBtn" type="button" style="float: left;">Clear All</button>';
        }



    }

//   echo $html;


    return response()->json(['status' => 'success', 'data' => $html,'count' => count($invoices)]);
}

    public function deleteCart(Request $request)
    {

        Invoice::where('inventory_id', $request->id)->delete();
        Invoice::where('banner_id', $request->id)->delete();
        Invoice::where('slider_id', $request->id)->delete();
        return response()->json(['status' => 'success', 'message' => 'List Remove successfully']);
    }


    public function allInvoice($id)
    {



        $user = User::where('id',$id)->first();
        $invoicesTwo = DueOrder::where('user_id',$id)->orderBy('id','desc')->get();

        if($invoicesTwo->count() < 1){
            return back()->with('error', 'No invoice found for the specified user.');
        }
        // dd($invoicesTwo);
        return view('admin.dealer.invoice',compact('invoicesTwo','user'));
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
                     $feature_inventory = Inventory::with('user')->find($id);
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


    public function deleteAllCartItem()
    {

        $deleteCartData = Invoice::where('status',0)->get();
        foreach ($deleteCartData as $cartItem) {
            $cartItem->delete();
        }

        return response()->json(['status'=>'success','message'=>'Clear All']);
    }

    public function invoiceDelete(Request $request){
        // return $request->id;
        $invoice= DueOrder::find($request->id);
        $invoice->delete();
        return response()->json([
            'status'=>'success'
        ]);
    }







}


