<?php

namespace App\Exports;

use App\Models\Form;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\Config;

class FormRequestsExport implements WithMapping, WithHeadings, FromQuery
{
    protected $id;
    protected $form;

    public function __construct($id)
    {
        $this->id = $id;
        $this->form = Form::find($this->id);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return Form::find($this->id)->formRequests;
    }

    /**
     * @param mixed $request
     * @return array
     */
    public function map($request): array
{
    $data = [];

    foreach ($this->form->fields as $field) {
        $formRequestField = $this->form->formRequests->where('field_id', $field->id)->first();

        $data[] = $formRequestField ? $formRequestField->value : '__';
    }

    return [
        $request->form->name,
        ...$data,
        $request->created_at ? $request->created_at->format('Y-m-d H:i:s') : '',
    ];
}

    /**
     * @return array
     */
    public function headings(): array
    {
        $headings = [__('Form')];

        foreach ($this->form->fields as $field) {
            $headings[] = __($field['name']);
        }

        $headings[] = __('Created At');

        return $headings;
    }
}
