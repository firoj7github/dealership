<?php
namespace App\Service;

use App\Interface\UserServiceInterface as InterfaceUserServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService implements InterfaceUserServiceInterface
{
    // public function __construct(
        //     private FileUploaderServiceInterface $uploader,
        // ) {
        // }

        public function all()
        {
            // abort_if(! auth()->user()->can('hrm_visit_index'), 403, 'Access Forbidden');
            $user = User::query()->orderBy('id','desc');
            return $user;
        }

        //Get Trashed Item list
        public function getTrashedItem()
        {
            // abort_if(! auth()->user()->can('hrm_visit_index'), 403, 'Access Forbidden');
            // $item = Tmp_inventory::onlyTrashed()->orderBy('id', 'desc')->get();

            // return $item;
        }

        public function store(array $user)
        {
            if ($user['img']) {

                $image_url = userImageUpload($user['img']);

            }

            $dealer= new User();
            $dealer->fname= $user['fname'];
            $dealer->lname= $user['lname'];
            $dealer->username = $user['fname'] .' '. $user['lname'];
            $dealer->email = $user['email'];
            $dealer->address = $user['address'];
            $dealer->adf_email = $user['adf_email'];
            $dealer->phone = $user['phone'];
            $dealer->role = 2;
            $dealer->is_verify_email = 1;
            $dealer->package = 1;
            $dealer->img = $image_url;
            $dealer->password = Hash::make($user['password']);
            $dealer->save();
            return $dealer;
        }

        public function find(int $id)
        {
            // abort_if(! auth()->user()->can('hrm_visit_view'), 403, 'Access Forbidden');
            $item = User::find($id);
            return $item;
        }

        public function update(array $user, int $id)
        {
            // abort_if(! auth()->user()->can('hrm_visit_update'), 403, 'Access Forbidden');
            // $item = Tmp_inventory::find($id);
            // if (isset($visit['attachments'])) {
            //     if (isset($visit['attachments']) && ! empty($visit['attachments']) && file_exists('uploads/visits/'.$visit['old_photo']) && $visit['old_photo'] != null) {
            //         unlink(public_path('uploads/visits/'.$visit['old_photo']));
            //     }
            //     $visit['attachments'] = $this->uploader->upload($visit['attachments'], 'uploads/visits/');
            // } else {
            //     // unlink(public_path('uploads/visits/'.$visit['old_photo']));
            //     $visit['attachments'] = null;
            // }
            // $updatedItem = $item->update($visit);
        }

        public function updateUser($user)
        {
            // abort_if(! auth()->user()->can('hrm_visit_update'), 403, 'Access Forbidden');
            $dealer = User::find($user['dealer_id']);

            $username = trim($user['up_fname'] . ' ' . $user['up_lname']) ?: 'default_username';

            // Update user data
            if ($user['up_img']) {

                $filePath = public_path('dashboard/images/dealers/' . $dealer->img);
                if(file_exists($filePath))
                {
                    unlink($filePath);
                    $image_url = userImageUpload($user['up_img']);
                    $dealer->img = $image_url;
                }else
                {
                    $dealer->img = $dealer->img;
                }


            }


            $dealer->fname= $user['up_fname'];
            $dealer->lname= $user['up_lname'];
            $dealer->username =  $username;
            $dealer->email = $user['up_email'];
            $dealer->address = $user['up_address'];
            $dealer->adf_email = $user['up_adf_email'];
            $dealer->phone = $user['up_phone'];
            if($user['up_password'])
            {
                $dealer->password = Hash::make($user['up_password']);
            }
            $dealer->save();
            return $dealer;
        }

        //Move To Trash
        public function trash(int $id)
        {
            // abort_if(! auth()->user()->can('hrm_visit_delete'), 403, 'Access Forbidden');
            $item = User::find($id)->delete();
            return $item;
        }

        // File Delete
        public function visitFileDelete($id)
        {
            // abort_if(! auth()->user()->can('hrm_visit_delete'), 403, 'Access Forbidden');
            // $item = Tmp_inventory::findOrFail($id);
            // $filePath = public_path('uploads/visits/'.$item->attachments);
            // if (\file_exists($filePath)) {
            //     unlink($filePath);
            // }
            // $item->attachments = null;
            // $fileDelete = $item->save();

            // return $fileDelete;
        }

        //Bulk Move To Trash
        public function bulkTrash(array $ids)
        {
            // abort_if(! auth()->user()->can('hrm_visit_delete'), 403, 'Access Forbidden');
            // foreach ($ids as $id) {
            //     $item = Tmp_inventory::find($id);
            //     $item->delete($item);
            // }

            // return $item;
        }

        //Permanent Delete
        public function permanentDelete(int $id)
        {
            // abort_if(! auth()->user()->can('hrm_visit_delete'), 403, 'Access Forbidden');
            $item = User::find($id);
            $item->forceDelete();
            // return $item;
        }

        //Bulk Permanent Delete
        public function bulkPermanentDelete(array $ids)
        {
            // abort_if(! auth()->user()->can('hrm_visit_delete'), 403, 'Access Forbidden');
            // foreach ($ids as $id) {
            //     $item = Tmp_inventory::onlyTrashed()->find($id);
            //     $item->forceDelete($item);
            // }

            // return $item;
        }

        //Restore Trashed Item
        public function restore(int $id)
        {

            // abort_if(! auth()->user()->can('hrm_visit_delete'), 403, 'Access Forbidden');
            // $item = Tmp_inventory::withTrashed()->find($id)->restore();

            // return $item;
        }

        //Bulk Restore Trashed Item
        public function bulkRestore(array $ids)
        {
            // abort_if(! auth()->user()->can('hrm_visit_delete'), 403, 'Access Forbidden');
            // foreach ($ids as $id) {
            //     $item = Tmp_inventory::withTrashed()->find($id);
            //     $item->restore($item);
            // }

            // return $item;
        }

        //Get Row Count
        public function getRowCount()
        {
            // abort_if(! auth()->user()->can('hrm_visit_index'), 403, 'Access Forbidden');
            // $count = Tmp_inventory::all()->count();

            // return $count;
        }

        //Get Trashed Item Count
        public function getTrashedCount()
        {
            // abort_if(! auth()->user()->can('hrm_visit_index'), 403, 'Access Forbidden');
            // $count = Tmp_inventory::onlyTrashed()->count();

            // return $count;
        }

}
?>
