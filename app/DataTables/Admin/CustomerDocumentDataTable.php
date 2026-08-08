<?php

namespace App\DataTables\Admin;

use App\Models\CustomerDocument;
use App\MyClasses\GeneralHelperFunctions;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class CustomerDocumentDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addColumn('customer', function (CustomerDocument $doc) {
                if ($doc->user) {
                    return '<a href="' . route('admin.customers.show', $doc->user->uuid) . '" class="fw-semibold text-primary" title="View Customer">' . $doc->user->name . '</a><div class="text-muted fs-11">' . $doc->user->mobile . '</div>';
                }
                return '<span class="text-muted">—</span>';
            })
            ->editColumn('doc_type', function (CustomerDocument $doc) {
                return '<span class="badge bg-primary-transparent text-primary">' . $doc->doc_type . '</span>';
            })
            ->editColumn('title', function (CustomerDocument $doc) {
                $html = '<b>' . $doc->title . '</b>';
                if (!empty($doc->file_path)) {
                    $html .= ' <a href="' . asset($doc->file_path) . '" target="_blank" download class="badge bg-danger-transparent text-danger ms-1" title="Download / View PDF" data-bs-toggle="tooltip"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-file-download"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M12 17v-6" /><path d="M9.5 14.5l2.5 2.5l2.5 -2.5" /></svg> PDF</a>';
                }
                return $html;
            })
            ->addColumn('site_name', function (CustomerDocument $doc) {
                return optional($doc->site)->site_name ?? 'All Sites';
            })
            ->editColumn('valid_until', function (CustomerDocument $doc) {
                return $doc->valid_until ? GeneralHelperFunctions::prepareHtmlDate($doc->valid_until) : 'Lifetime';
            })
            ->editColumn('created_at', function (CustomerDocument $doc) {
                return GeneralHelperFunctions::prepareHtmlDate($doc->created_at);
            })
            ->addColumn('action', 'admin.customer_documents.datatables_actions')
            ->rawColumns(['customer', 'doc_type', 'title', 'valid_until', 'created_at', 'action']);
    }

    public function query(CustomerDocument $model)
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
            'customer'      => ['title' => 'Customer', 'orderable' => false, 'searchable' => false],
            'doc_type'      => ['title' => 'Doc Type'],
            'title'         => ['title' => 'Document Title'],
            'site_name'     => ['title' => 'Plant / Site', 'orderable' => false, 'searchable' => false],
            'valid_until'   => ['title' => 'Validity'],
            'created_at'    => ['title' => 'Added on'],
        ];
    }

    protected function filename(): string
    {
        return 'customer_documents_datatable_' . time();
    }
}
