<?php

namespace App\DataTables\Admin;

use App\Models\WalletTransaction;
use App\MyClasses\GeneralHelperFunctions;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class WalletTransactionDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addColumn('customer', function (WalletTransaction $tx) {
                if ($tx->user) {
                    return '<a href="' . route('admin.customers.show', $tx->user->uuid) . '" class="fw-semibold text-primary" title="View Customer">' . $tx->user->name . '</a><div class="text-muted fs-11">' . $tx->user->mobile . '</div>';
                }
                return '<span class="text-muted">—</span>';
            })
            ->editColumn('type', function (WalletTransaction $tx) {
                $cls = $tx->type == 'Credit' ? 'bg-success-transparent text-success' : ($tx->type == 'Payout' ? 'bg-warning-transparent text-warning' : 'bg-danger-transparent text-danger');
                return '<span class="badge ' . $cls . '">' . $tx->type . '</span>';
            })
            ->editColumn('amount', function (WalletTransaction $tx) {
                $cls = $tx->type == 'Credit' ? 'text-success' : 'text-danger';
                $sign = $tx->type == 'Credit' ? '+' : '-';
                return '<b class="' . $cls . '">' . $sign . '₹' . number_format($tx->amount, 2) . '</b>';
            })
            ->editColumn('status', function (WalletTransaction $tx) {
                $cls = ($tx->status == 'Credited' || $tx->status == 'Approved') ? 'bg-success-transparent text-success' : ($tx->status == 'Pending' ? 'bg-warning-transparent text-warning' : 'bg-danger-transparent text-danger');
                return '<span class="badge ' . $cls . '">' . $tx->status . '</span>';
            })
            ->editColumn('created_at', function (WalletTransaction $tx) {
                return GeneralHelperFunctions::prepareHtmlDate($tx->created_at);
            })
            ->addColumn('action', 'admin.wallet_transactions.datatables_actions')
            ->rawColumns(['customer', 'type', 'amount', 'status', 'created_at', 'action']);
    }

    public function query(WalletTransaction $model)
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
                'order'     => [[4, 'desc']],
                'buttons'   => [],
            ]);
    }

    protected function getColumns()
    {
        return [
            'customer'          => ['title' => 'Customer', 'orderable' => false, 'searchable' => false],
            'title'             => ['title' => 'Title / Description'],
            'type'              => ['title' => 'Type'],
            'amount'            => ['title' => 'Amount'],
            'created_at'        => ['title' => 'Date'],
            'status'            => ['title' => 'Status'],
        ];
    }

    protected function filename(): string
    {
        return 'wallet_transactions_datatable_' . time();
    }
}
