<?php
namespace App\Service;

use App\Interface\SliderServiceInterface;
use App\Models\Inventory;
use App\Models\Slide;

class SliderService implements SliderServiceInterface
{
    // public function __construct(
        //     private FileUploaderServiceInterface $uploader,
        // ) {
        // }

        public function all()
        {
            // abort_if(! auth()->user()->can('hrm_visit_index'), 403, 'Access Forbidden');
            $slide = Slide::query();
            return $slide;
        }

        //Get Trashed Item list
        public function getTrashedItem()
        {
            // abort_if(! auth()->user()->can('hrm_visit_index'), 403, 'Access Forbidden');
            // $item = Tmp_inventory::onlyTrashed()->orderBy('id', 'desc')->get();

            // return $item;

            // abort_if(! auth()->user()->can('hrm_visit_index'), 403, 'Access Forbidden');
            $item = Slide::onlyTrashed()->orderBy('id', 'desc')->get();
            return $item;
        }

        public function store(array $visits)
        {
            // abort_if(! auth()->user()->can('hrm_visit_create'), 403, 'Access Forbidden');
            // if (isset($visits['attachments'])) {
            //     $visits['attachments'] = $this->uploader->upload($visits['attachments'], 'uploads/visits/');
            // }
            // $item = Tmp_inventory::create($visits);

            // return $item;
        }

        public function find(int $id)
        {
            // abort_if(! auth()->user()->can('hrm_visit_view'), 403, 'Access Forbidden');
            // $item = Tmp_inventory::find($id);
            $item = Slide::find($id);

            return $item;
        }

        public function update(array $visit, int $id)
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

            // return $updatedItem;
        }

        //Move To Trash
        public function trash(int $id)
        {
            // abort_if(! auth()->user()->can('hrm_visit_delete'), 403, 'Access Forbidden');
            // $item = Tmp_inventory::find($id);
            // $item->delete($item);

            // return $item;
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
            // $item = Tmp_inventory::onlyTrashed()->find($id);
            // $item->forceDelete();

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
