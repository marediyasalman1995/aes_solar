<?php

namespace App\DataTables\Admin;

use App\Models\Inquiry;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use App\MyClasses\GeneralHelperFunctions;

class InquiryDataTable extends DataTable
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
            ->editColumn('status', function (Inquiry $inquiry) {
                $status = $inquiry->status ?? 'Pending';
                $badgeCls = match($status) {
                    'Completed' => 'bg-success text-white',
                    'In Progress' => 'bg-info text-white',
                    default => 'bg-warning text-dark'
                };
                return '
                <select class="form-select form-select-sm inquiry-status-select ' . $badgeCls . '" data-uuid="' . $inquiry->uuid . '" style="width: auto; font-weight: 600; cursor: pointer; border-radius: 20px; padding: 4px 10px; border: none; display: inline-block;">
                    <option value="Pending" ' . ($status == 'Pending' ? 'selected' : '') . ' class="bg-white text-dark">Pending</option>
                    <option value="In Progress" ' . ($status == 'In Progress' ? 'selected' : '') . ' class="bg-white text-dark">In Progress</option>
                    <option value="Completed" ' . ($status == 'Completed' ? 'selected' : '') . ' class="bg-white text-dark">Completed</option>
                </select>';
            })
            ->editColumn('created_at', function (Inquiry $inquiry){
                return GeneralHelperFunctions::prepareHtmlDate($inquiry->created_at);
            })
            ->editColumn('updated_at', function (Inquiry $inquiry){
                return GeneralHelperFunctions::prepareHtmlDate($inquiry->updated_at);
            })
            ->rawColumns(['status', 'created_at', 'updated_at', 'action'])
            ->addColumn('action', 'admin.inquiries.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Inquiry $inquiries
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Inquiry $inquiries)
    {
        return $inquiries->newQuery();
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
                'order'     => [[5, 'desc']],
                'buttons'   => [],
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
            'name',
            'email',
            'phone',
            'subject',
            'message',
            'status',
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
        return 'inquiries_datatable_' . time();
    }
}
