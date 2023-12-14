<?php 

namespace App\Interface;

use App\Interface\BaseServiceInterface;

interface UserServiceInterface extends BaseServiceInterface
{
    public function updateUser($user);
}