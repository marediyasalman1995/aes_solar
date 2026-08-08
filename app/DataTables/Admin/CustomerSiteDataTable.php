<?php

namespace App\DataTables\Admin;

use App\Models\CustomerSite;
use App\MyClasses\GeneralHelperFunctions;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class CustomerSiteDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addColumn('customer', function (CustomerSite $site) {
                if ($site->user) {
                    return '<a href="' . route('admin.customers.show', $site->user->uuid) . '" class="fw-semibold text-primary" title="View Customer">' . $site->user->name . '</a><div class="text-muted fs-11">' . $site->user->mobile . '</div>';
                }
                return '<span class="text-muted">—</span>';
            })
            ->editColumn('capacity_kw', function (CustomerSite $site) {
                return '<span class="badge bg-primary-transparent text-primary fw-semibold">' . $site->capacity_kw . ' kW</span>';
            })
            ->editColumn('system_type', function (CustomerSite $site) {
                return '<span class="badge bg-info-transparent text-info">' . $site->system_type . '</span>';
            })
            ->editColumn('monthly_avg_kwh', function (CustomerSite $site) {
                return '<b>' . $site->monthly_avg_kwh . ' kWh</b>';
            })
            ->editColumn('installation_date', function (CustomerSite $site) {
                return $site->installation_date ? GeneralHelperFunctions::prepareHtmlDate($site->installation_date) : '—';
            })
            ->editColumn('created_at', function (CustomerSite $site) {
                return GeneralHelperFunctions::prepareHtmlDate($site->created_at);
            })
            ->addColumn('action', 'admin.customer_sites.datatables_actions')
            ->rawColumns(['customer', 'capacity_kw', 'system_type', 'monthly_avg_kwh', 'installation_date', 'created_at', 'action']);
    }

    public function query(CustomerSite $model)
    {
        return $model->newQuery()->with('user');
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '100px', 'printable' => false])
            ->parameters([
                'dom'       => 'B<\'row p-t-15\' <\'col-sm-6\'l><\'col-sm-6\'f>>rt<\'row\'<\'col-sm-12 col-md-5\'i><\'col-sm-12 col-md-7\'p>>',
                'stateSave' => true,
                'order'     => [[5, 'desc']],
                'buttons'   => [],
            ]);
    }

    protected function getColumns()
    {
        return [
            'site_name'         => ['title' => 'Site / Plant Name'],
            'customer'          => ['title' => 'Customer', 'orderable' => false, 'searchable' => false],
            'capacity_kw'       => ['title' => 'Capacity'],
            'system_type'       => ['title' => 'Type'],
            'monthly_avg_kwh'   => ['title' => 'Monthly Avg'],
            'created_at'        => ['title' => 'Added on'],
        ];
    }

    protected function filename(): string
    {
        return 'customer_sites_datatable_' . time();
    }
}
