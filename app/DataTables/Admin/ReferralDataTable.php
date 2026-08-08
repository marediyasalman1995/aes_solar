<?php

namespace App\DataTables\Admin;

use App\Models\Referral;
use App\MyClasses\GeneralHelperFunctions;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ReferralDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addColumn('referrer', function (Referral $ref) {
                if ($ref->referrer) {
                    return '<a href="' . route('admin.customers.show', $ref->referrer->uuid) . '" class="fw-semibold text-primary" title="View Customer">' . $ref->referrer->name . '</a><div class="text-muted fs-11">Code: ' . $ref->referrer->referral_code . '</div>';
                }
                return '<span class="text-muted">—</span>';
            })
            ->editColumn('stage', function (Referral $ref) {
                $cls = $ref->stage == 'Installed' ? 'bg-success-transparent text-success' : ($ref->stage == 'Rejected' ? 'bg-danger-transparent text-danger' : 'bg-warning-transparent text-warning');
                return '<span class="badge ' . $cls . '">' . $ref->stage . '</span>';
            })
            ->editColumn('reward_amount', function (Referral $ref) {
                return '<b class="text-primary">₹' . number_format($ref->reward_amount, 2) . '</b>';
            })
            ->editColumn('reward_status', function (Referral $ref) {
                $cls = $ref->reward_status == 'Credited' ? 'bg-success-transparent text-success' : 'bg-secondary-transparent text-secondary';
                return '<span class="badge ' . $cls . '">' . $ref->reward_status . '</span>';
            })
            ->editColumn('created_at', function (Referral $ref) {
                return GeneralHelperFunctions::prepareHtmlDate($ref->created_at);
            })
            ->addColumn('action', 'admin.referrals.datatables_actions')
            ->rawColumns(['referrer', 'stage', 'reward_amount', 'reward_status', 'created_at', 'action']);
    }

    public function query(Referral $model)
    {
        return $model->newQuery()->with('referrer');
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
            'referrer'      => ['title' => 'Referred By', 'orderable' => false, 'searchable' => false],
            'referee_name'  => ['title' => 'Referee (Friend)'],
            'referee_mobile'=> ['title' => 'Mobile Number'],
            'stage'         => ['title' => 'Stage'],
            'reward_amount' => ['title' => 'Reward'],
            'created_at'    => ['title' => 'Added on'],
            'reward_status' => ['title' => 'Reward Status'],
        ];
    }

    protected function filename(): string
    {
        return 'referrals_datatable_' . time();
    }
}
