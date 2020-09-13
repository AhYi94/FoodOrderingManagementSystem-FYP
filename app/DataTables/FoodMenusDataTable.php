<?php

namespace App\DataTables;

use App\Models\FoodMenu;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FoodMenusDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($query) {
                $actions = '<a href=' . route('food-menus.edit', $query) . ' class="btn btn-info btn-sm mr-1">Edit</a>';
                $actions .=  '<button class="btn btn-danger btn-sm delete btn-delete" data-id-variable="/food-menus/' . $query->id . '" >Delete</button>';
                return $actions;
            })
            ->editColumn('created_at', function ($query) {
                return $query->created_at->format('d.m.Y');
            })
            ->editColumn('updated_at', function ($query) {
                return $query->updated_at->format('d.m.Y');
            })
            ->editColumn('image', function ($query) {
                return '<img src="storage/' . $query->image . '" border="0" width="50%" class="img-rounded" align="center" />';
            })->rawColumns(['image', 'action']);
    }

    public function query(FoodMenu $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('foodmenus-table')
            ->columns(
                [
                    ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
                    ['data' => 'image', 'width' => '30%', 'title' => 'Image'],
                    ['data' => 'name', 'title' => 'Food Name'],
                    ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
                    ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Updated At'],
                    ['data' => 'action', 'name' => 'action', 'title'=> 'Action'],
                ]
            )
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('excel'),
                Button::make('print'),
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
            Column::make('id'),
            Column::make('food_name'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    protected function filename()
    {
        return 'FoodMenus_' . date('YmdHis');
    }
}
