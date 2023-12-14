<?php
namespace App\Interface;

interface InventoryServiceInterface extends BaseServiceInterface
{
    public function getItemByFilter($request);
    public function tmpInventoryImportAjax($request);
    public function findWithVin( $vin);
    public function getByUserId(int $userId);
    public function soldListing();
    public function archiveListing();
}
?>
