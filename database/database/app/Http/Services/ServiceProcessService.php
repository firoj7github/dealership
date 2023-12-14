<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 7/8/19
 * Time: 5:53 PM
 */

namespace App\Http\Services;


use App\Http\Repository\ServiceRepository;

class ServiceProcessService extends CommonService
{
    public $repository;

    function __construct()
    {
        $this->repository = new ServiceRepository();
        parent::__construct($this->repository);
    }

    public function serviceList($locationId, $parentId = 0)
    {
        if (is_null($parentId)) {
            $parentId = 0;
        }
        $services = $this->selectWhere(['id', 'parent_service_id', 'title', 'image'], ['clinic_id' => $locationId, 'status' => ACTIVE_STATUS, 'parent_service_id' => $parentId]);
        $services = $services->each(function ($item) use ($locationId){
            $item->image = asset(serviceImageViewPath() . $item->image);
            $childServices = $this->selectWhere(['id', 'parent_service_id', 'title', 'image'], ['clinic_id' => $locationId, 'status' => ACTIVE_STATUS, 'parent_service_id' => $item->id]);
            $childServices = $childServices->each(function ($service) {
                $service->image = asset(serviceImageViewPath() . $service->image);
            });
            $item->child_services = $childServices;
        });

        return [
            'success' => true,
            'message' => '',
            'data' => [
                'services' => $services
            ]
        ];
    }
}
