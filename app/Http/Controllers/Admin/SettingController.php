<?php

namespace App\Http\Controllers\Admin;


use App\Models\Setting;
use App\Http\Requests\Admin\CreateSettingRequest;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\Admin\SettingRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\DB;

class SettingController extends AppBaseController {
    private $settingRepository;

    public function __construct(SettingRepository $settingRepo) {
        $this->middleware('permission:setting.index')->only(['create','store']);
        $this->settingRepository = $settingRepo;
    }

    public function create() {
        $setting = Setting::where('id','1')->first();
        return view('admin.setting.create',compact('setting'));
    }


    public function store(CreateSettingRequest $request) {
        $input = $request->all();

        DB::beginTransaction();
        $request->merge(['id' => 1]);
        $setting = $this->settingRepository->update($input,1);
        if(isset($request->avatar) && $request->avatar != '') {
            $this->settingRepository->updateOrCreate_avatar($setting, $request);
        }
        if(isset($request->favicon) && $request->favicon != '') {
            $this->settingRepository->updateOrCreate_favicon($setting, $request);
        }
        if(isset($request->header_logo) && $request->header_logo != '') {
            $this->settingRepository->updateOrCreate_header_logo($setting, $request);
        }
        if(isset($request->footer_logo) && $request->footer_logo != '') {
            $this->settingRepository->updateOrCreate_footer_logo($setting, $request);
        }
        DB::commit();
        session()->flash('alert-type', 'success');
        session()->flash('message', 'Company Detail has been updated successfully.');
        return Response::json(['is_form_page' => 1, 'back_url' => route('admin.setting.create'), 'message' => 'Setting has been updated successfully.']);
    }




}
