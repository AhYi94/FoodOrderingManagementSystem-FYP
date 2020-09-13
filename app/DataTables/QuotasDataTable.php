<?php

namespace App\DataTables;

use App\Models\Quota;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class QuotasDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($query) {
                $actions = '<a href=' . route('top-ups.show', $query->user->id) . ' class="btn btn-info btn-sm mr-1">Top-Up</a>';
                return $actions;
            })
            ->addColumn('name', function ($query) {
                return $query->user->name;
            });
    }

    public function query(Quota $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('quotas-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('excel'),
                Button::make('print')
            );
    }

    protected function getColumns()
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::computed('name')
                ->exportable(false)
                ->width(200)
                ->addClass('text-center'),
            Column::make('balance'),
            Column::make('created_at')
                ->width(200),
            Column::make('updated_at')
                ->width(200),

        ];
    }

    protected function filename()
    {
        return 'Quotas_' . date('YmdHis');
    }
}
