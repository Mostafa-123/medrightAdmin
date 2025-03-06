<?php

namespace App\DataTables;

use App\Models\RequestHiring;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RequestHiringDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->editColumn('checkbox',function($request){
            return '<div class="custom-control custom-checkbox"><input type="checkbox"  class="custom-control-input request-checkbox" value="'.$request->id.'" id="selectCheckbox-'.$request->id.'"><label class="custom-control-label" for="selectCheckbox-'.$request->id.'"></label></div>';
        })
        ->editColumn('action', function($model){
            $html='<div class="btn-group">';
            if(PerUser('requests.show')){
              $html.='<a  href="'.route('requests.show',['request'=>$model->id]).'" class="btn btn-sm btn-alt-success js-bs-tooltip-enabled edit-this">
                         &ocir;  <span class="fadeIn animated bx bx-edit-alt"></span> </a>';
            }
            if(PerUser('requests.destroy')){
              $html.='<button  type="button" class="btn btn-sm btn-alt-danger js-bs-tooltip-enabled " id="delete-this" data-id="'.$model->id.'" data-url="'.route('requests.destroy',['request'=>$model->id]).'">
              &Cross;
              </button>';
            }
          $html.='</div>';
              return $html;
      })
        ->editColumn('created_at',function ($model){
            return $model->created_at->format('Y-m-d H:i:s');
        })
        ->editColumn('position_id',function ($model){
            return $model->position->name;
        })
        ->editColumn('level_id',function ($model){
            return $model->level->name;
        })
            ->rawColumns(['checkbox','action'])
            // ->addColumns(['created_at','position_id','level_id'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(RequestHiring $model): QueryBuilder
    {
        return $model->newQuery()->with('position','level');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('requests')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('checkbox')
                ->title('<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="selectAllCheckbox"><label class="custom-control-label" for="selectAllCheckbox"></label></div>')
                ->searchable(false)
                ->exportable(false)
                ->printable(false)
                ->width('10px')
                ->orderable(false),
            Column::make('id'),
            Column::make('email')->title('Email'),
            Column::make('position_id')->title('Postition'),
            Column::make('level_id')->title('Level'),
            Column::make('full_name')->title('Full Name'),
            // Column::make('applied')->title('Applied'),
            Column::make('phone')->title('Phone'),
            Column::make('gender')->title('Gender'),
            // Column::make('birth_date')->title('Birth Date'),
            // Column::make('live_in_cairo')->title('Live In Cairo'),
            // Column::make('address')->title('Address'),
            // Column::make('personal_photo')->title('Personal Photo'),
            // Column::make('college')->title('College'),
            // Column::make('degree')->title('Degree'),
            // Column::make('work_style')->title('Work Style'),
            // Column::make('employment')->title('Employment'),
            Column::make('experience')->title('Experience'),
            // Column::make('cv')->title('CV'),
            // Column::make('start_date')->title('Start Date'),
            // Column::make('employed')->title('Employed'),
            // Column::make('company_name')->title('Company Name'),
            // Column::make('currant_position')->title('Currant Position'),
            // Column::make('currant_salary')->title('Currant Salary'),
            // Column::make('expected_salary')->title('Expected Salary'),
            // Column::make('projects_links')->title('Projects Links'),
            // Column::make('skillset')->title('Skillset'),
            // Column::make('experience_essay')->title('Experience Essay'),
            // Column::make('have_laptop')->title('Have Laptop'),
            // Column::make('laptop_brand')->title('Laptop Brand'),
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
        return 'RequestHiring_' . date('YmdHis');
    }
}
