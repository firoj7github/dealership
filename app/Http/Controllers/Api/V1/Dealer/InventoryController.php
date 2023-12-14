<?php

namespace App\Http\Controllers\Api\V1\Dealer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\InventoryResources;
use App\Interface\InventoryServiceInterface;

class InventoryController extends Controller
{
    private $inventoryService;
    public function __construct(InventoryServiceInterface $inventoryService)
    {
        $this->inventoryService = $inventoryService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data = InventoryResources::collection($this->inventoryService->all()->get());
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = InventoryResources::make($this->inventoryService->find($id));
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function latestInventory()
    {
        // $data = $this->inventoryService->all()->select('year','make','model','trim','body','description','miles','image_from_url','price')->latest()->limit(8)->get();
        $data = InventoryResources::collection($this->inventoryService->all()->limit(8)->get());

        return $data;
    }
}
