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
            ->addColumn('attachments', function (ServiceRequest $srv) {
                $photos = $srv->getMedia('service_images');
                if ($photos->count() > 0) {
                    $html = '<div class="d-flex gap-1 flex-wrap align-items-center">';
                    foreach ($photos as $photo) {
                        $html .= '<a href="' . $photo->getUrl() . '" target="_blank" data-bs-toggle="tooltip" title="View Full Image"><img src="' . $photo->getUrl() . '" class="rounded border shadow-sm" style="width:34px; height:34px; object-fit:cover;"></a>';
                    }
                    $html .= '</div>';
                    return $html;
                }
                return '<span class="text-muted fs-12">—</span>';
            })
            ->editColumn('status', function (ServiceRequest $srv) {
                $cls = $srv->status == 'Resolved' ? 'bg-success-transparent text-success' : ($srv->status == 'In Progress' ? 'bg-primary-transparent text-primary' : ($srv->status == 'Scheduled' ? 'bg-warning-transparent text-warning' : 'bg-secondary-transparent text-secondary'));
                return '<span class="badge ' . $cls . '">' . $srv->status . '</span>';
            })
            ->editColumn('created_at', function (ServiceRequest $srv) {
                return GeneralHelperFunctions::prepareHtmlDate($srv->created_at);
            })
            ->addColumn('action', 'admin.service_requests.datatables_actions')
            ->rawColumns(['customer', 'issue_type', 'attachments', 'status', 'preferred_date', 'created_at', 'action']);
    }

    public function query(ServiceRequest $model)
    {
        $query = $model->newQuery()->with(['user', 'site', 'media']);
        if (auth()->check() && auth()->user()->hasRole('Dealer')) {
            $query->whereHas('user', function ($q) {
                $q->where('dealer_id', auth()->id());
            });
        }
        return $query;
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
                'order'     => [[6, 'desc']],
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
            'attachments'   => ['title' => 'Photos', 'orderable' => false, 'searchable' => false],
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
