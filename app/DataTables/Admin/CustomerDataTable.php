<?php

namespace App\DataTables\Admin;

use App\Models\User;
use App\MyClasses\GeneralHelperFunctions;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class CustomerDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addColumn('sites_count', function (User $user) {
                return '<span class="badge bg-primary-transparent text-primary">' . $user->sites()->count() . ' Site(s)</span>';
            })
            ->editColumn('wallet_balance', function (User $user) {
                return '<span class="fw-bold text-success">₹' . number_format($user->wallet_balance, 2) . '</span>';
            })
            ->editColumn('referral_code', function (User $user) {
                return '<span class="badge bg-info-transparent text-info fw-bold">' . ($user->referral_code ?? '—') . '</span>';
            })
            ->editColumn('status', function (User $user) {
                return $user->status == 1
                    ? '<span class="badge bg-success-transparent text-success">Active</span>'
                    : '<span class="badge bg-danger-transparent text-danger">Inactive</span>';
            })
            ->editColumn('created_at', function (User $user) {
                return GeneralHelperFunctions::prepareHtmlDate($user->created_at);
            })
            ->addColumn('action', 'admin.customers.datatables_actions')
            ->rawColumns(['sites_count', 'wallet_balance', 'referral_code', 'status', 'created_at', 'action']);
    }

    public function query(User $model)
    {
        return $model->newQuery()->where('user_type', 'customer');
    }

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

    protected function getColumns()
    {
        return [
            'name',
            'mobile',
            'referral_code' => ['title' => 'Referral Code'],
            'sites_count'   => ['title' => 'Sites', 'orderable' => false, 'searchable' => false],
            'wallet_balance'=> ['title' => 'Wallet Balance'],
            'created_at'    => ['title' => 'Added on'],
            'status'        => ['title' => 'Status'],
        ];
    }

    protected function filename(): string
    {
        return 'customers_datatable_' . time();
    }
}
