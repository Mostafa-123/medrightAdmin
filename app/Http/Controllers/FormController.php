<?php

namespace App\Http\Controllers;

use App\DataTables\FormsDataTable;
use App\Models\Form;
use App\Models\FormFields;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index(FormsDataTable $dataTable){
        return $dataTable->render('Dashboard.dashboard.forms.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types=[
            'text',
            'number',
            'email',
            'file',
            'phone',
            'textarea'
        ];
        return view('Dashboard.dashboard.forms.create_edit',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $this->validateForm($request);

        $form = Form::create([
            'form_link' => $request->input('form_link'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'informations' => $request->input('informations'),
            'published' => $request->input('published') === 'true',
            'created_by'=>auth()->user()->id,
            'published_by'=>$request->input('published') === 'true'?auth()->user()->id:null,
        ]);
        $rows = json_decode($request->input('rows'), true);

        foreach ($rows as $row) {
            $formField = new FormFields();
            $formField->form_id = $form->id;
            $formField->input_type = $row['inputType'];
            $formField->name = $row['name'];
            $formField->placeholder = $row['placeholder'] ?? null;
            $formField->length = $row['length'] ?? 0;
            $formField->required = $row['required'] ?? false;

            if ($row['inputType'] === 'file') {
                $formField->file_size = $row['filesize'] ?? null;
                $formField->files_type = $row['fileTypes'] ?? [];
                $formField->multi_file = $row['multiFiles'] ?? false;
                $formField->file_num = $row['filesNum'] ?? 0;
            }

            $formField->save();
        }

        return redirect(route('forms.index'))->with('success', 'Form added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Form $form)
    {
        return view('Dashboard.dashboard.forms.show',compact('form'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Form  $form)
    {
        $types=[
            'text',
            'number',
            'email',
            'file',
            'phone',
            'textarea'
        ];
        return view('Dashboard.dashboard.forms.create_edit',compact('form','types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Form $form)
{
    dd($request);
    // $this->validateForm($request);

    $updateData = [
        'form_link' => $request->input('form_link'),
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'informations' => $request->input('informations'),
        'published' => $request->input('published') === 'true',
        'fields' => json_encode($request->rows),
    ];

    $form->update($updateData);

    $rows = json_decode($request->input('rows'), true);

    foreach ($rows as $row) {
        $formField = FormFields::updateOrCreate(
            ['form_id' => $form->id, 'input_type' => $row['inputType']],
            [
                'name' => $row['name'],
                'placeholder' => $row['placeholder'] ?? null,
                'length' => $row['length'] ?? 0,
                'required' => $row['required'] ?? false,
                'file_size' => $row['filesize'] ?? null,
                'files_type' => $row['fileTypes'] ?? [],
                'multi_file' => $row['multiFiles'] ?? false,
                'file_num' => $row['filesNum'] ?? 0,
            ]
        );
    }

    return redirect(route('forms.index'))->with('success', 'Updated successfully');
}
    public function destroy(Form $form)
    {
        $form->deleted_by=auth()->id();
        $form->save();
        foreach($form->fields as $field){
            $field->delete();
        }
        $form->delete();
        return response()->json(['success'=>true,'message'=>__('Delete Successfully')]);
    }


    public function validateForm($request){
        $valid=[
            'name'=>'required|unique:website.forms',
            'form_link' => 'required|regex:/^[^\s]+$/|unique:website.forms,form_link',
        ];
        $messages = [
            'form_link.regex' => 'The From Link must not contain spaces.',
        ];
        return $request->validate($valid,$messages);
    }
}
