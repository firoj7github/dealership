<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 7/5/19
 * Time: 7:30 PM
 */

namespace App\Http\Services;


use App\Http\Repository\ClinicRepository;
use App\Http\Repository\CustomerRepository;
use App\Http\Repository\SubscriberRepository;
use App\Http\Repository\UserRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerService extends CommonService
{
    public $repository;

    function __construct()
    {
        $this->repository = new CustomerRepository();
        parent::__construct($this->repository);
    }

    public function updateCustomer($where, $data)
    {
        $subscriberRepo = new SubscriberRepository();
        $subscriber = $subscriberRepo->getById($where['id']);
        $username = User::where('user_name', $data['username'])->where('user_name', '!=', $subscriber->customer->user->user_name)->first();
        if ($username) {
            return [
                'status' => false,
                'message' => __('User name already exists')
            ];
        }

        DB::beginTransaction();
        try {
            $startTime = new Carbon($data['start_date']);
            if ($data['end_date']) {
                $endTime = new Carbon($data['end_date']);
            } else {
                $time = new Carbon($data['start_date']);
                $endTime = $time->addMonths(DEFAULT_SUBSCRIPTION_TIME);
            }

            $updateData = [
//                'subscription_package_id' => $data['subscription_package_id'],
                'start_date' => $startTime->format('d-m-Y'),
                'end_date' => $endTime->format('d-m-Y'),
//                'color_1' => $data['color_1'],
//                'color_2' => $data['color_2'],
//                'credit' => $data['credit'],
                'status' => $data['status']
            ];

//            if (!empty($data['logo'])) {
//                $logo = uploadFile($data['logo'], logoPath());
//                $updateData['logo']  = $logo;
//            }
//
//            if (!empty($data['image'])) {
//                $image = uploadFile($data['image'], imagePath());
//                $updateData['image']  = $image;
//            }

            $subscriberRepo->update($where, $updateData);

            $customerRepo = new CustomerRepository();
            $customer = $customerRepo->getById($subscriber->customer->id);
            $customerRepo->update(['id' => $subscriber->customer->id], [
                'company_name' => $data['company_name'],
//                'vat_number' => $data['vat_number'],
                'password_text' => $data['password'],
//                'comment' => $data['comment'],
                'status' => $data['status'],
            ]);

//            $clinicRepo = new ClinicRepository();
//            $clinicRepo->update(['customer_id' => $customer->id], [
//                'customer_id' => $customer->id,
//
//                'status' => $data['status'],
//            ]);

            $userRepo = new UserRepository();
            $userRepo->update(['id' => $customer->user_id], [
                'email' => $data['email'],
                'user_name' => $data['username'],
                'password' => Hash::make($data['password']),
                'role' => ADMIN_ROLE,
                'status' => $data['status'],
                'address' => $data['address'],
                'zip_code' => $data['zip_code'],
                'city' => $data['city'],
                'country' => $data['country'],
            ]);

            DB::commit();

            return [
                'status' => true,
                'message' => __('Customer has been updated successfully')
            ];
        } catch (\Exception $exception) {
            DB::rollBack();

            return [
                'status' => false,
                'message' => __('Something went wrong') . $exception->getMessage() . $exception->getLine()
            ];
        }
    }

    public function createCustomer($data)
    {
        if (User::where('user_name', $data['username'])->first()) {
            return [
                'status' => false,
                'message' => __('User name already exists')
            ];
        }
        DB::beginTransaction();
        try {
            $userRepo = new UserRepository();
            $user = $userRepo->create([
                'email' => $data['email'],
                'user_name' => $data['username'],
                'password' => Hash::make($data['password']),
                'role' => ADMIN_ROLE,
                'status' => $data['status'],
                'address' => $data['address'],
                'zip_code' => $data['zip_code'],
                'city' => $data['city'],
                'country' => $data['country'],
            ]);

            $customerRepo = new CustomerRepository();
            $customer = $customerRepo->create([
                'user_id' => $user->id,
                'company_name' => $data['company_name'],
//                'vat_number' => $data['vat_number'],
                'password_text' => $data['password'],
//                'comment' => $data['comment'],
                'status' => $data['status'],
            ]);

//            $clinicRepo = new ClinicRepository();
//            $clinicRepo->create([
//                'customer_id' => $customer->id,
//                'address' => $data['address'],
//                'zip_code' => $data['zip_code'],
//                'city' => $data['city'],
//                'country' => $data['country'],
//                'status' => $data['status'],
//            ]);

//            $logo = null;
//            if (!empty($data['logo'])) {
//                $logo = uploadFile($data['logo'], logoPath());
//            }
//
//            $image = null;
//            if (!empty($data['image'])) {
//                $image = uploadFile($data['image'], imagePath());
//            }
            $startTime = new Carbon($data['start_date']);
            if ($data['end_date']) {
                $endTime = new Carbon($data['end_date']);
            } else {
                $time = new Carbon($data['start_date']);
                $endTime = $time->addMonths(DEFAULT_SUBSCRIPTION_TIME);
            }

            $subscriberRepo = new SubscriberRepository();
            $subscriberRepo->create([
                'customer_id' => $customer->id,
//                'subscription_package_id' => $data['subscription_package_id'],
                'start_date' => $startTime->format('d-m-Y'),
                'end_date' => $endTime->format('d-m-Y'),
//                'color_1' => $data['color_1'],
//                'color_2' => $data['color_2'],
//                'logo' => $logo ? $logo : null,
//                'image' => $image ? $image : null,
//                'credit' => $data['credit'],
                'status' => $data['status']
            ]);
            DB::commit();

            return [
                'status' => true,
                'message' => __('Customer has been added successfully')
            ];
        } catch (\Exception $exception) {
            DB::rollBack();

            return [
                'status' => false,
                'message' => __('Something went wrong') . $exception->getMessage()
            ];
        }
    }

    public function deleteCustomer($id)
    {
        DB::beginTransaction();
        try {
            $subscriberRepo = new SubscriberRepository();
            $subscriber = $subscriberRepo->getById($id);
            if (empty($subscriber)) {
                return [
                    'status' =>false,
                    'message' => __('Customer not found')
                ];
            }
            $userRepo = new UserRepository();
            $clinicRepo = new ClinicRepository();
            $customerRepo = new CustomerRepository();
            $userRepo->delete($subscriber->customer->user->id);
            $clinicRepo->getById($subscriber->customer->id);
            $customerRepo->delete($subscriber->customer->id);
            $subscriberRepo->delete($subscriber->id);
            DB::commit();

            return [
                'status' => true,
                'message' => __('Customer has been deleted successfully')
            ];
        } catch (\Exception $exception) {
            DB:: rollBack();

            return [
                'status' => false,
                'message' => __('Something went wrong') . $exception->getMessage()
            ];
        }
    }
}