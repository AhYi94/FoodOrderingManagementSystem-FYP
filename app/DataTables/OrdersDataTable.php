<?php

namespace App\DataTables;

use App\Models\Order;
use App\Models\Quota;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrdersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($query) {
                $actions = '<a href=' . route('admin.orders.showSchedule', $query->id) . ' class="btn btn-info btn-sm mr-1">Order</a>';
                return $actions;
            })

            ->addColumn('address', function ($query) {
                return $query->user->address . " " . $query->user->city . " " . $query->user->country . " " . $query->user->postal;
            })

            ->addIndexColumn()

            ->filterColumn('name', function ($query, $keyword) {
                $query->whereRaw('name like ?', ["%{$keyword}%"]);
            })

            ->filterColumn('address', function ($query, $keyword) {
                $query->whereRaw('CONCAT(address, city, country, postal) like ?', ["%{$keyword}%"]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Quota $quota)
    {
        $quota = Quota::leftJoin('users', 'users.id', '=', 'quotas.user_id');
        // $quota = Quota::join('users', 'users.id', '=', 'quotas.user_id')
        //     ->select('quotas.*', 'users.address', 'users.name');
        // $quota = Quota::with('user')->select('[

        // ]');

        return $quota;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('orders-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1, 'asc')
            ->buttons(
                Button::make('excel'),
                Button::make('print'),
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::computed('DT_RowIndex')->title('No'),
            Column::make('name'),
            Column::make('balance'),
            Column::computed('address')
                ->searchable(true),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Orders_' . date('YmdHis');
    }
}
