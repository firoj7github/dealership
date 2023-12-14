<?php

namespace App\Interface;
interface LeadServiceInterface extends BaseServiceInterface
{
    public function getItemByFilter(Request $request);
}
?>
