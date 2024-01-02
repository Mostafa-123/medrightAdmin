<?php

namespace App\Exports;

use App\Models\Form;
use Illuminate\View\View; // Make sure to include this import statement
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FormRequestsExport implements ShouldAutoSize, FromView
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
    public function view(): View
    {
        return view('Dashboard.dashboard.forms.form_data_export', ['form' => $this->form]);
    }
}
