<?php

namespace App\Repositories\Admin;

use App\Models\Blog;
use App\Models\Course;
use App\Models\Setting;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\ParameterBag;


class SettingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Setting::class;
    }

    /**
     * request handler for store and update
     * @param Request $request
     * @return array
     */
    public static function requestHandler(ParameterBag $request)
    {
        return $request->all();
    }
    public function updateOrCreate_avatar(Setting $setting, Request $request) {
        $defaultMedia = 'https://ui-avatars.com/api/?' . http_build_query(['name' => $setting->name, 'size' => '500']);
        return GeneralHelperFunctions::updateOrCreate_singleMedia_viaDropZone($setting, $request->input('avatar'),  $defaultMedia);
    }
    public function updateOrCreate_favicon(Setting $setting, Request $request) {
        if ($request->has('favicon') && $request->input('favicon') != '') {
            GeneralHelperFunctions::updateOrCreate_singleMedia_viaDropZone($setting, $request->input('favicon'), null, 'favicon');
        }
    }
    public function updateOrCreate_header_logo(Setting $setting, Request $request) {
        if ($request->has('header_logo') && $request->input('header_logo') != '') {
            GeneralHelperFunctions::updateOrCreate_singleMedia_viaDropZone($setting, $request->input('header_logo'), null, 'header_logo');
        }
    }
    public function updateOrCreate_footer_logo(Setting $setting, Request $request) {
        if ($request->has('footer_logo') && $request->input('footer_logo') != '') {
            GeneralHelperFunctions::updateOrCreate_singleMedia_viaDropZone($setting, $request->input('footer_logo'), null, 'footer_logo');
        }
    }


}
