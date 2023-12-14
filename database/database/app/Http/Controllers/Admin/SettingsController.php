<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function settings()
    {
        $data['settings'] = allSetting();
        $data['mainMenu'] = 'settings';
        $data['menuName'] = __('Settings');

        return view('admin.settings.general_settings', $data);
    }

    public function settingsSaveProcess(Request $request)
    {
        try {
            DB::beginTransaction();
            foreach ($request->except('_token') as $key => $value) {
                AdminSetting::updateOrCreate(['slug' => $key], ['value' => $value]);
            }
            DB::commit();

            return redirect()->back()->withInput()->with(['success' => __('Settings has been updated successfully')]);
        } catch (\Exception $exception) {
            DB::rollBack();

            return redirect()->back()->with(['error' => __('Something went wrong. Please try again.') . $exception->getMessage()])->withInput();
        }
    }
}
