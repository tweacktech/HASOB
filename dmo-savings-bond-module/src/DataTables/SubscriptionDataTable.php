<?php

namespace DMO\SavingsBond\DataTables;

use DMO\SavingsBond\Models\Subscription;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

use Hasob\FoundationCore\Models\Organization;

class SubscriptionDataTable extends DataTable
{
    protected $organization;

    public function __construct(Organization $organization){
        $this->organization = $organization;
    }

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'dmo-savings-bond-module::pages.subscriptions.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Subscription $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Subscription $model)
    {
        if ($this->organization != null){
            return $model->newQuery()->where("organization_id", $this->organization->id);
        }
        
        return $model->newQuery();
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
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    ['extend' => 'create', 'className' => 'btn btn-primary btn-outline btn-xs no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-primary btn-outline btn-xs no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-primary btn-outline btn-xs no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-primary btn-outline btn-xs no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-primary btn-outline btn-xs no-corner',],
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
            'broker_code',
            'broker_name',
            'status',
            'price_per_unit',
            'total_price',
            'interest_rate_pct',
            'offer_start_date',
            'offer_end_date',
            'offer_settlement_date',
            'offer_maturity_date',
            'tenor_years' => ['searchable' => false],
            'investor_email',
            'investor_telephone',
            'first_name',
            'middle_name',
            'last_name',
            'date_of_birth' => ['searchable' => false],
            'origin_geo_zone',
            'origin_lga',
            'address_street',
            'address_town',
            'address_state',
            'bank_account_name',
            'bank_account_number',
            'bank_name',
            'bank_verification_number',
            'national_id_number',
            'cscs_id_number',
            'chn_id_number'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'subscriptions_datatable_' . time();
    }
}
