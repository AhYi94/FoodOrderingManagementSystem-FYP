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
                $actions = '<a href=' . route('food-menus.edit', $query) . ' class="btn btn-info btn-sm mr-1">Edit</a>';
                // $actions .=  '<a href=' . route('food-menus.destroy', $query) . ' onclick="return confirm(\'Are you sure you want to delete this user?\');" class="btn btn-danger btn-sm">Delete</a>';
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
    /**
     * Get query source of dataTable.
     *
     * @param \App\FoodMenu $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(FoodMenu $model)
    {
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
            Column::make('id'),
            Column::make('food_name'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'FoodMenus_' . date('YmdHis');
    }
}
