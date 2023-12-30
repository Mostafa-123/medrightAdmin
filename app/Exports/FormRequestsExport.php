<?php

namespace App\Exports;

use App\Models\Form;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\Config;

class FormRequestsExport implements WithMapping, WithHeadings,FromQuery
{
    protected $id;
    public function __construct($id)
    {
        $this->id = $id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Form::find($this->id)->formRequests();
    }
    /**
    * @return \Illuminate\Support\Collection
    */

    public function map($request) : array {
        // dd($request);
        return [
            $request->form->name,
            optional($request->field)->name ?? '__',
            $request->value ? ($request->field->input_type == 'file' ? Config::get('website_url') . '/' . $request->value : $request->value) : '__',
            $request->created_at ? $request->created_at->format('Y-m-d H:i:s') : '',
        ];
    }
    public function headings() : array {
        return [
            __('Form'),
            __('Field Name'),
            __('Entered Value'),
            __('Created At'),
        ] ;
    }
}
