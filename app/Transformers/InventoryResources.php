<?php
namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
class InventoryResources extends JsonResource
{
    public function toArray($request)
    {
        $inputString  = explode(',' , $this->image_from_url );
        $image = array_map('trim', $inputString);

        return [
            'id' => $this->id,
            'vin' => $this->vin,
            'title' => $this->year. ' '.$this->make. ' '.$this->model. ' '.$this->trim. ' '.$this->body,
            'body' => $this->body,
            'description' => $this->description,
            'condition' => $this->condition,
            'dealer_name' => $this->dealer_name,
            'dealer_address' => $this->dealer_address,
            'drive_train' => $this->drive_train,
            'category' => $this->make,
            // 'sub_category' => $this->model,
            'model' => $this->model,
            'mileage' => $this->miles,
            'image' => $image,
            'price' => $this->price,
            'transmission' => $this->transmission,
            'fuel' => $this->fuel,
            'zipcode' => $this->dealer_zip,
            'engine' => $this->engine_description,
            'day_in_stock' => $this->date_in_stock,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'status' => $this->status,

        ];
    }
}
?>