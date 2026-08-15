<?php

namespace App\DataTables\Admin;

use App\Models\Blog;
use App\Models\Website;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use App\MyClasses\GeneralHelperFunctions;

class WebsiteDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->editColumn('created_at', function (Website $website){
                return GeneralHelperFunctions::prepareHtmlDate($website->created_at);
            })
            ->addColumn('image', function (Website $website){
                if ($website->hasMedia('avatar')) {
                    $imgUrl = $website->avatarUrl['250'];
                } else {
                    $fallback = match ($website->type) {
                        'Top_Banner' => 'images/hero-solar.jpg',
                        'About_Us' => 'images/about-main.jpg',
                        'Our_Vision', 'Our_Mission' => 'images/about-teaser.jpg',
                        'Why_Choose_Us' => 'images/team-install.jpg',
                        'Products' => str_contains($website->heading, 'Panel') ? 'images/product-panel.jpg' : (str_contains($website->heading, 'Inverter') ? 'images/product-inverter.jpg' : 'images/product-battery.jpg'),
                        'Solar_Solutions' => str_contains($website->heading, 'On-Grid') ? 'images/solution-ongrid.jpg' : (str_contains($website->heading, 'Off-Grid') ? 'images/solution-offgrid.jpg' : 'images/solution-hybrid.jpg'),
                        'Solar_Plans' => str_contains($website->heading, 'Small') ? 'images/plan-starter.jpg' : (str_contains($website->heading, 'Family') ? 'images/plan-family.jpg' : 'images/plan-business.jpg'),
                        'Services', 'Process_Steps' => str_contains($website->heading, 'Survey') ? 'images/team-design.jpg' : (str_contains($website->heading, 'Support') ? 'images/team-support.jpg' : 'images/team-install.jpg'),
                        default => 'images/hero-solar.jpg'
                    };
                    $imgUrl = asset($fallback);
                }
                return '<img class="rounded border shadow-sm" style="width:48px;height:48px;object-fit:cover;" src="'.$imgUrl.'" alt="image">';
            })
            ->editColumn('heading', function (Website $website){
                return '<b class="text-dark">'.$website->heading.'</b>';
            })
            ->editColumn('type', function (Website $website){
                return '<span class="badge bg-primary-transparent text-primary">'.str_replace('_' , ' ', $website->type).'</span>';
            })
            ->rawColumns(['created_at', 'image', 'heading', 'type', 'action'])
            ->addColumn('action', 'admin.websites.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Website $websites
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Website $websites)
    {
        $query = $websites->newQuery();
        if (request()->has('type')) {
            $query->where('type', request('type'));
        }
        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'B<\'row p-t-15\' <\'col-sm-6\'l><\'col-sm-6\'f>>rt<\'row\'<\'col-sm-12 col-md-5\'i><\'col-sm-12 col-md-7\'p>>',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    // ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    // ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
            ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'image',
            'heading',
            'sub_heading',
            'type',
            'created_at' => ['title' => 'Added on'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'websites_datatable_' . time();
    }
}
