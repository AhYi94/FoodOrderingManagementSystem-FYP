<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($query) {
                $actions = '<a href=' . route('users.edit', $query) . ' class="btn btn-info btn-sm mr-1">Edit</a>';
                $actions .=  '<button class="btn btn-danger btn-sm delete btn-delete" data-id-variable="/users/' . $query->id . '" >Delete</button>';
                return $actions;
            })
            ->editColumn('created_at', function ($query) {
                return $query->created_at->format('d.m.Y');
            })->editColumn('updated_at', function ($query) {
                return $query->updated_at->format('d.m.Y');
            });
    }

    public function query(User $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('user-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('<"top d-flex justify-content-between"Bf>rt<"bottom"lp><"clear">')
            ->orderBy(1, 'acs')
            ->buttons(
                Button::make('create'),
                Button::make('excel'),
                Button::make('print'),
            );
    }

    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('email'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center'),
        ];
    }

    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}
