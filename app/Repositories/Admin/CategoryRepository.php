<?php

namespace App\Repositories\Admin;

use App\Models\Category;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class CategoryRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'title_gujarati',
        'title_english',
        'title_hindi',
        'category_id',
        'show_in_home_page',
        'meta_title',
        'meta_description',
        'meta_keyword'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Category::class;
    }

    /**
     * request handler for store and update
     * @param Request $request
     * @return array
     */
    public static function requestHandler(Request $request) {
        return [];
    }
}
