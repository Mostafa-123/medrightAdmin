<?php

namespace App\DataTables;

use App\Models\Page;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class pagesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        app()->setLocale('en');

        return (new EloquentDataTable($query))
        ->addColumn('action', function($model){
              $html='<div class="btn-group">';
              if(PerUser('pages.create')){
                foreach (config('app.editorLanguagesAvailable') as $lang) {

                    $html.='<a  href="'.route('pages.editor',['page'=>$model->id]).'?lang='.$lang.'" class="btn btn-primary">
                    <i class="fa fa-newspaper"></i>'.$lang.'
                    </a>';
                }
              }
              $edit_and_delete='';
              if(PerUser('pages.edit')){
                $edit_and_delete.='<a  href="'.route('pages.edit',['page'=>$model->id]).'" class="btn btn-sm btn-alt-success js-bs-tooltip-enabled edit-this">
                <i class="fa fa-pencil-alt"></i>
                </a>';
              }
              if(PerUser('pages.destroy')){
                $edit_and_delete.='<button  type="button" class="btn btn-sm btn-alt-danger js-bs-tooltip-enabled " id="delete-this" data-id="'.$model->id.'" data-url="'.route('pages.destroy',['page'=>$model->id]).'">
                <i class="fa fa-times"></i>
                </button>';
              }
            $html.=$edit_and_delete;
            $html.='</div>';
                return $html;
        })
        ->editColumn('parent_id', function ($model) {
            $name = " ";
            if ($model->parent_id != 0) {
                $translations = Page::where('id', $model->parent_id)->first()->getTranslations('name');
                $name = isset($translations['en']) ? $translations['en'] : '';
            }
            return $name;
        })
        ->editColumn('name', function ($model) {
            $translations = $model->getTranslations('name');
            $englishTranslation = isset($translations['en']) ? $translations['en'] : '';
            return $englishTranslation;
        })
        ->editColumn('created_at',function ($model){
            return $model->created_at?$model->created_at->format('Y-m-d H:i:s'):'';
        })
            ->
            rawColumns(['name','action','created_at','parent_id'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Page $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('pages')
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
            Column::make('parent_id')->title('Parant'),
            Column::make('name'),
            Column::make('slug'),
            Column::make('sort'),
            Column::make('status'),
            Column::make('meta_description'),
            Column::make('meta_title'),
            Column::make('meta_keywords'),
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
        return 'pages_' . date('YmdHis');
    }
}
