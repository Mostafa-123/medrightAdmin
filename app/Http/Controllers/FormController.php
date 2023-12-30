<?php

namespace App\Http\Controllers;

use App\DataTables\FormsDataTable;
use App\Exports\FormRequestsExport;
use App\Models\Form;
use App\Models\FormFields;
use App\Models\FormRequests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

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
            'textarea',
            'password',
            'selector',
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
            }elseif ($row['inputType'] === 'selector') {
                $options = $row['options'] ?? [];
                $formField->files_type = json_encode($options);
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

    public function formRequest(Request $request)
    {
        $form = json_decode($request->form, true);

        if (isset($form['fields'])) {
            $this->fieldValidation($request);

            foreach ($form['fields'] as $field) {
                $fieldId = $field['id'];

                if ($request->has($fieldId)) {
                    $data = [
                        'form_id' => $form['id'],
                        'field_id' => $fieldId,
                    ];

                    if ($field['input_type'] == 'file') {
                        $files = $request->file($fieldId);

                        if (is_array($files)) {
                            $filePaths = [];

                            foreach ($files as $file) {
                                $imageName = $form['id'] . $field['name'] . time() . '.' . $file->extension();
                                $file->move(public_path('forms/images'), $imageName);
                                $filePaths[] = 'forms/images' . $imageName;
                            }

                            $data['value'] = json_encode($filePaths);
                        } else {
                            $imageName = $form['id'] . $field['name'] . time() . '.' . $files->extension();
                            $files->move(public_path('forms/images'), $imageName);
                            $data['value'] = 'forms/images' . $imageName;
                        }
                    } elseif ($field['input_type'] == 'password') {
                        $data['value'] = Hash::make($request->input($fieldId));
                    } else {
                        $data['value'] = $request->input($fieldId);
                    }

                    FormRequests::create($data);
                }
            }
        }

        return redirect()->back()->with('success', 'Your request has been sent successfully. Please wait until we contact you. Do not submit more than once.');
    }

    public function fieldValidation($request)
{
    $form = json_decode($request->form, true);
    $rules = [];
    $messages = [];

    foreach ($form['fields'] as $field) {
        $fieldId = $field['id'];
        $fieldName = $field['name'];

        if ($field['input_type'] == 'file') {
            if ($field['required'] == 1) {
                if ($field['multi_file'] == 1) {
                    $rules["$fieldId"] = "required|array";
                    $rules["$fieldId.*"] = "file|max:" . ($field['file_size'] * 1024) . "|mimes:" . implode(',', $field['files_type']);
                } else {
                    $rules["$fieldId"] = "file|required|max:" . ($field['file_size'] * 1024) . "|mimes:" . implode(',', $field['files_type']);
                }
            } else {
                if ($field['multi_file'] == 1) {
                    $rules["$fieldId"] = "array";
                    $rules["$fieldId.*"] = "file|max:" . ($field['file_size'] * 1024) . "|mimes:" . implode(',', $field['files_type']);
                } else {
                    $rules["$fieldId"] = "file|max:" . ($field['file_size'] * 1024) . "|mimes:" . implode(',', $field['files_type']);
                }
            }
        } else if ($field['input_type'] == 'email') {
            if ($field['required'] == 1) {
                $rules["$fieldId"] = 'required|unique:form_requests,value';
            }
        } else {
            if ($field['required'] == 1) {
                $rules["$fieldId"] = "required|max:{$field['length']}";
            }
        }

        if ($field['required'] == 1) {
            $messages["$fieldId.required"] = "$fieldName is required.";
        }

        if ($field['input_type'] == 'file') {
            if ($field['multi_file'] == 1) {
                $messages["$fieldId.*.max"] = "$fieldName must not be greater than {$field['file_size']} KB.";
                $messages["$fieldId.*.mimes"] = "$fieldName must be of type " . implode(', ', $field['files_type']);
            } else {
                $messages["$fieldId.max"] = "$fieldName must not be greater than {$field['file_size']} KB.";
                $messages["$fieldId.mimes"] = "$fieldName must be of type " . implode(', ', $field['files_type']);
            }
        } else if ($field['input_type'] == 'email') {
            $messages["$fieldId.unique"] = "This $fieldName is already used.";
        } else {
            $messages["$fieldId.max"] = "$fieldName must not exceed {$field['length']} characters.";
        }
    }

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        abort(400, $validator->errors()->first());
    }
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
            'textarea',
            'password',
            'selector',
        ];
        // dd($form->fields);
        return view('Dashboard.dashboard.forms.create_edit',compact('form','types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Form $form)
{
    // dd($request);
    // $this->validateForm($request);

    $existingFieldIds = $form->fields()->pluck('id')->toArray();

    $updateData = [
        'form_link' => $request->input('form_link'),
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'informations' => $request->input('informations'),
        'published' => $request->input('published') === 'true',
    ];

    $form->update($updateData);
    FormFields::destroy($existingFieldIds);

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
        if ($row['inputType'] === 'selector') {
            $options = $row['options'] ?? [];
            $formField->file_types = json_encode($options);
            $formField->save();
        }
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

    public function export(Request $request){
        switch ($request->export_type){
            case'csv':
                if($request->form_id){
                    return Excel::download(new FormRequestsExport($request->form_id),Form::find($request->form_id)->name.time().'.csv',\Maatwebsite\Excel\Excel::CSV);
                }
                break;
            case'excel':
                if($request->form_id){
                    return Excel::download(new FormRequestsExport($request->form_id),Form::find($request->form_id)->name.time().'.xlsx',\Maatwebsite\Excel\Excel::XLSX);
                }
                break;
        }
    }


}
