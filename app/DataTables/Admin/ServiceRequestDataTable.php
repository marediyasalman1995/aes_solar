<?php

namespace App\DataTables\Admin;

use App\Models\ServiceRequest;
use App\MyClasses\GeneralHelperFunctions;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ServiceRequestDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addColumn('customer', function (ServiceRequest $srv) {
                if ($srv->user) {
                    return '<a href="' . route('admin.customers.show', $srv->user->uuid) . '" class="fw-semibold text-primary" title="View Customer">' . $srv->user->name . '</a><div class="text-muted fs-11">' . $srv->user->mobile . '</div>';
                }
                return '<span class="text-muted">—</span>';
            })
            ->addColumn('site_name', function (ServiceRequest $srv) {
                return optional($srv->site)->site_name ?? 'Primary Plant';
            })
            ->editColumn('issue_type', function (ServiceRequest $srv) {
                return '<span class="badge bg-info-transparent text-info">' . $srv->issue_type . '</span>';
            })
            ->editColumn('preferred_date', function (ServiceRequest $srv) {
                return $srv->preferred_date ? GeneralHelperFunctions::prepareHtmlDate($srv->preferred_date) : '—';
            })
            ->editColumn('status', function (ServiceRequest $srv) {
                $cls = $srv->status == 'Resolved' ? 'bg-success-transparent text-success' : ($srv->status == 'In Progress' ? 'bg-primary-transparent text-primary' : ($srv->status == 'Scheduled' ? 'bg-warning-transparent text-warning' : 'bg-secondary-transparent text-secondary'));
                return '<span class="badge ' . $cls . '">' . $srv->status . '</span>';
            })
            ->editColumn('created_at', function (ServiceRequest $srv) {
                return GeneralHelperFunctions::prepareHtmlDate($srv->created_at);
            })
            ->addColumn('action', 'admin.service_requests.datatables_actions')
            ->rawColumns(['customer', 'issue_type', 'status', 'preferred_date', 'created_at', 'action']);
    }

    public function query(ServiceRequest $model)
    {
        return $model->newQuery()->with(['user', 'site']);
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
            'ticket_no'     => ['title' => 'Ticket #'],
            'customer'      => ['title' => 'Customer', 'orderable' => false, 'searchable' => false],
            'site_name'     => ['title' => 'Plant / Site', 'orderable' => false, 'searchable' => false],
            'issue_type'    => ['title' => 'Issue Type'],
            'preferred_date'=> ['title' => 'Preferred Date'],
            'created_at'    => ['title' => 'Raised on'],
            'status'        => ['title' => 'Status'],
        ];
    }

    protected function filename(): string
    {
        return 'service_requests_datatable_' . time();
    }
}
