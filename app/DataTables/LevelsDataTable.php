<?php

namespace App\DataTables;

use App\Models\Lavel;
use App\Models\Level;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LevelsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->editColumn('action', function($model){
            $html='<div class="btn-group">';
            if(PerUser('levels.edit')){
              $html.='<a  href="'.route('levels.edit',['level'=>$model->id]).'" class="btn btn-sm btn-alt-success js-bs-tooltip-enabled edit-this">
                         &ocir;  <span class="fadeIn animated bx bx-edit-alt"></span> </a>';
            }
            if(PerUser('levels.destroy')){
              $html.='<button  type="button" class="btn btn-sm btn-alt-danger js-bs-tooltip-enabled " id="delete-this" data-id="'.$model->id.'" data-url="'.route('levels.destroy',['level'=>$model->id]).'">
              &Cross;
              </button>';
            }
          $html.='</div>';
              return $html;
      })
        // ->addColumn('action', function($model){
        //     $html='<div class="btn-group pull-right">';
        //     if(PerUser('levels.destroy')){
        //         $html.='<button  type="button" class="btn btn-sm btn-alt-danger js-bs-tooltip-enabled " id="delete-this" data-id="'.$model->id.'" data-url="'.route('levels.destroy',['level'=>$model->id]).'">
        //         &Cross;
        //         </button>';
        //     }
        //     $html.='</div>';
        //     return $html;
        // })
        ->editColumn('created_at',function ($model){
            return $model->created_at->format('Y-m-d H:i:s');
        })
            ->addColumns(['created_at','action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Level $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('levels')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(['0','desc'])
                    ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('created_at'),
            Column::computed('action')->title(__('Action'))
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Lavels_' . date('YmdHis');
    }
}
