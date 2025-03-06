<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query->select('users.id','users.name','users.email','users.phone','users.created_at')->with('roles','permissions')))
            ->addColumn('action', function($model){
                $html='<div class="btn-group pull-right">';
                if(PerUser('users.edit')){
                    $html.='<a style="padding: 1px 0px ; width: 30px" class="btn btn-info m-1" href="'.route('users.edit',['user'=>$model->id]).'" class="btn btn-sm btn-success">&ocir; <span class="fadeIn animated bx bx-edit-alt"></span></a>';
                }
                if(PerUser('users.destroy')){
                    $html.='<a style="padding: 1px 0px ; width: 30px" class="btn btn-danger m-1" href="'.route('users.destroy',[$model->id]).'" class="btn btn-sm btn-danger delete-this" > &Cross;<span class="fadeIn animated bx bx-trash"> </span></a>';
                }
                $html.='</div>';
                return$html;
            })
            ->addColumn('roles', function (User $user) {
                // dd($user->roles->toArray()); // Debugging line
                foreach($user->roles->toArray() as $role){
                    return '<span style="font-size: 12pt;" >'.__(ucwords($role['name'])).'</span>';
                }
                // return $user->roles->map(function($role) {
                //     return '<span style="font-size: 10pt;" class="badge badge-primary">'.__(ucwords($role->name)).'</span>';
                // })->implode('');
            })
            ->addColumn('permissions', function (User $user) {
                $html = '<div>';
                foreach ($user->permissions->toArray() as $permission) {
                    $words = explode('.', $permission['name']);
                    $abbreviatedWords = array_map(function($word) {
                        return strtoupper(substr($word, 0, 2));
                    }, $words);
                    $html .= '<span style="font-size: 10pt;">' . implode(' ', $abbreviatedWords) . '</span> ';
                }
                $html .= '</div>';
                return $html;
            })
                ->editColumn('created_at',function ($model){
                    return $model->created_at->format('Y-m-d H:i:s');
                })

            ->rawColumns(['roles','permissions','action'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('users')
            ->columns($this->getColumns())
            ->minifiedAjax()
//                    ->dom('Bfrtip')
            ->orderBy(['0','desc'])
            ->pageLength(10)
            ->lengthMenu([10, 20, 50, 100, 150])
//                    ->buttons(
//                        Button::make('export'),
//                        Button::make('print'),
//                        Button::make('reset'),
//                        Button::make('reload')
//                    )
            ;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [

            Column::make('id'),
            Column::make('roles'),
            Column::make('permissions'),
            Column::make('name'),
            Column::make('email'),
            Column::make('phone'),

            Column::make('created_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
