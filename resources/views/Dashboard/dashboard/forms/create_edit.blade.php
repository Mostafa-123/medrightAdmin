@extends('Dashboard.dashboard.layouts.app')
@section('css')
<style>
    .custom-select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background: transparent;
        background-image: url('path-to-your-arrow-icon.png');
        background-position: right center;
        background-repeat: no-repeat;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 8px 12px;
        font-size: 16px;
        width: 100%;
    }

    .select2-container--default .select2-selection--single,
    .select2-container--default .select2-selection--multiple {
        min-height: 40px;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection
@section('title')
{{ (isset($form))?__('Edit'):__('Create') }}
@endsection
@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        {{-- @dd($existingRows) --}}
        <div class="card radius-15 border-lg-top-primary">
            <div class="card-body">
                <div class="card-title">
                    <h4 class="mb-0">{{ (isset($form))?__('Edit :type',['type'=>$form->name]):__('Create') }}</h4>
                </div>
                <hr>
                <form method="POST"
                    action="{{ isset($form)?route('forms.update',['form'=>$form]):route('forms.store') }}"
                    enctype="multipart/form-data">
                    @if(isset($form))
                    @method('PUT')
                    @endif
                    @csrf
                    <div class="row">
                        <input type="hidden" name="rows" id="rows"  value=@if(isset($form))
                        "{{ $form->fields }}"
                        @else
                        "[]"
                        @endif>
                        <div style="height: 0.5cm;"></div>
                        <x-forms.text-input-component name="name" id="name" type="text" text="Name"
                            value="{{ isset($form) ? $form->name : (is_array(old('name')) ? '' : old('name')) }}"
                            placeholder="{{ __('Enter :value', ['value' => __('Form Name')]) }}">
                        </x-forms.text-input-component>
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                        <x-forms.text-input-component name="form_link" id="form_link" type="text" text="Form Link"
                            value="{{ isset($form) ? $form->form_link : old('form_link') }}"
                            placeholder="{{ __('Enter :value', ['value' => __('Form Link')]) }}">
                        </x-forms.text-input-component>
                        <x-input-error :messages="$errors->get('form_link')" class="mt-2 text-danger" />
                        <x-forms.text-input-component name="description" id="description" type="text" text="Description"
                            value="{{ isset($form) ? $form->description : old('description') }}"
                            placeholder="{{ __('Enter :value', ['value' => __('Description')]) }}">
                        </x-forms.text-input-component>
                        <x-input-error :messages="$errors->get('description')" class="mt-2 text-danger" />

                        <x-forms.text-input-component name="informations" id="informations" type="text"
                            text="Informations" value="{{ isset($form) ? $form->informations : old('informations') }}"
                            placeholder="{{ __('Enter :value', ['value' => __('Informations')]) }}">
                        </x-forms.text-input-component>
                        <x-input-error :messages="$errors->get('informations')" class="mt-2 text-danger" />
                        <div class="form-group col-lg-12">
                            <label>{{ __('Published') }}</label>
                            <div class="input-group input-group-lg">
                                <select name="published" class="custom-select" id="published" required>
                                    <option value="">{{ __('Select :type', ['type' => __('Status')]) }}
                                    </option>
                                    <option @if (isset($form)&&$form->published==true)
                                        selected="selected" @endif
                                        value=true>Yes</option>
                                    <option @if (isset($form)&&$form->published==false) selected="selected" @endif
                                        value=false>No</option>
                                </select>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('published')" class="mt-2 text-danger" />
                        <div style="height: 2cm;"></div>

                        <div class="form-group col-lg-12">
                            <label>{{ __('Input Type') }}</label>
                            <div class="input-group input-group-lg">
                                <div class="row">
                                    <div class="col-9">
                                        <select id="input_type" class="custom-select" name="input_type"
                                            data-placeholder="{{ __('Select :type',['type'=>__('Input')]) }}">
                                            <option value="0">{{ __('Select :type',['type'=>__('All Inputs Type')]) }}
                                            </option>
                                            @foreach($types
                                            as $type)
                                            <option value="{{ $type }}">{{ $type }} input</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <a class="btn btn-primary" id="addDiv">+</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="height: 2cm;"></div>
                        <div id="rowParent">
                            @if (!empty($form))
                            @foreach ($form->fields as $row)
                            @if($row['input_type'] == "file")
                            <div class="row">
                                <input type="hidden" name="input_type[]" id="input_type" value="{{ $row['input_type'] }}">
                                <div class="col-3">
                                    <input type="text" class="form-control" placeholder="Name" name="fieldName[]"
                                        value="{{ $row['name'] }}" required id="name">
                                </div>
                                <div class="col-3">
                                    <input type="number" class="form-control" placeholder="File Size" name="fileSize[]"
                                        min="0" max="9999999" value="{{ $row['file_size'] }}" required id="fileSize">
                                </div>
                                <div class="col-3">
                                    <label for="fileTypes">File Types:</label>
                                    <select id="fileTypes" name="fileTypes[]" class="custom-select select2"
                                        multiple="multiple">
                                        <option value="png">PNG</option>
                                        <option value="pdf">PDF</option>
                                        <option value="jpg">JPG</option>
                                        <option value="xls">XLS</option>
                                    </select>
                                </div>
                                @if ($row['multi_file'])
                                <div class="col-3">
                                    <input type="number" class="form-control" placeholder="Files Number" min="0"
                                        max="9999999" name="filesNum[]" value="{{ $row['file_num'] }}" required
                                        id="filesNum">
                                </div>
                                @endif
                                <div class="col-3">
                                    <label class="form-check-label">Multiple Files</label>
                                    <input class="form-check-input" type="checkbox" name="multiFile[]" @if(
                                        $row['multi_file'] )
                                    checked
                                    @endif id="multiFile">
                                </div>

                                <div class="col-3">
                                    <label class="form-check-label">Required</label>
                                    <input class="form-check-input" type="checkbox" name="required[]" @if(
                                        $row['required'] )
                                    checked
                                    @endif id="required">
                                </div>
                                <div class="col-3">
                                    <a onclick="removeTr(this)" class="btn btn-danger">Remove</a>
                                </div>
                            </div>
                            @elseif($row['input_type'] == "email")
                            <div class="row">
                                <input type="hidden" name="input_type[]" id="input_type" value="{{ $row['input_type'] }}">
                                <div class="col-3">
                                    <input type="text" class="form-control" placeholder="Name" name="fieldName[]"
                                        value="{{ $row['name'] }}" required id="name">
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" placeholder="Placeholder"
                                        name="placeholder[]" value="{{ $row['placeholder'] }}" required
                                        id="placeholderid">
                                </div>
                                <div class="col-3">
                                    <label class="form-check-label">Required</label>
                                    <input class="form-check-input" type="checkbox" name="required[]" @if(
                                        $row['required'] )
                                    checked
                                    @endif id="required">
                                </div>
                                <div class="col-3">
                                    <a onclick="removeTr(this)" class="btn btn-danger">Remove</a>
                                </div>
                            </div>
                            @else
                            <div class="row">
                                <input type="hidden" name="input_type[]" id="input_type" value="{{ $row['input_type'] }}">
                                <div class="col-3">
                                    <input type="text" class="form-control" placeholder="Name" name="fieldName[]"
                                        value="{{ $row['name'] }}" required id="name">
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" placeholder="Placeholder"
                                        name="placeholder[]" value="{{ $row['placeholder'] }}" required
                                        id="placeholderid">
                                </div>
                                <div class="col-3">
                                    <input type="number" class="form-control" placeholder="Length" min="0" max="9999999"
                                        name="length[]" value="{{ $row['length'] }}" required id="lengthid">
                                </div>
                                <div class="col-3">
                                    <label class="form-check-label">Required</label>
                                    <input class="form-check-input" type="checkbox" name="required[]" @if(
                                        $row['required'] )
                                    checked
                                    @endif id="required">
                                </div>
                                <div class="col-3" id="actionTd">
                                    <a onclick="removeTr(this)" class="btn btn-danger">Remove</a>
                                </div>
                            </div>
                            @endif
                            @endforeach
                            @endif
                        </div>
                        <div style="height: 2cm;"></div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-danger px-5">{{ __('Save') }}</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{asset('assets')}}/js/dashmix.app.min.js"></script>

<script src="{{asset('assets')}}/js/lib/jquery.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#input_type').select2({
            placeholder: "{{ __('Select :type',['type'=>__('Input')]) }}",
            allowClear: true,
        });
        $('#fileTypes').select2({
            placeholder: "{{ __('Select :type',['type'=>__('type')]) }}",
            allowClear: true,
        });
        const rowParent = document.getElementById("rowParent");
        const existingRows = JSON.parse(document.getElementById('rows').value);

        function createInputField(placeholder) {
            const input = document.createElement("input");
            input.type = "text";
            input.className = "form-control";
            input.placeholder = placeholder;
            return input;
        }

        function createRow() {
            const inputTypeValue = document.getElementById("input_type").value;

            if (inputTypeValue == 'number' || inputTypeValue == 'phone' || inputTypeValue == 'textarea' || inputTypeValue == 'text') {
                const tr = document.createElement("div");
                tr.className = "row";

                const hiddenInputType = document.createElement("input");
                hiddenInputType.type = "hidden";
                hiddenInputType.name = "input_type[]";
                hiddenInputType.value = inputTypeValue;

                const nameTd = document.createElement("div");
                nameTd.className = "col-3";
                const nameInput = createInputField("Name");
                nameInput.type = "text";
                nameInput.name = "fieldName[]";
                nameInput.id = "nameid";
                nameInput.required = true;
                nameTd.appendChild(nameInput);

                const placeholderTd = document.createElement("div");
                placeholderTd.className = "col-3";
                const placeholderInput = createInputField("Placeholder");
                placeholderInput.type = "text";
                placeholderInput.name = "placeholder[]";
                placeholderInput.id = "placeholderid";
                placeholderInput.required = true;
                placeholderTd.appendChild(placeholderInput);

                const lengthTd = document.createElement("div");
                lengthTd.className = "col-3";
                const lengthInput = createInputField("Length");
                lengthInput.type = "number";
                lengthInput.min = "0";
                lengthInput.name = "length[]";
                lengthInput.id = "lengthid";
                lengthInput.required = true;
                lengthTd.appendChild(lengthInput);

                const requiredTd = document.createElement("div");
                requiredTd.className = "col-3";
                const requiredInput = document.createElement("input");
                requiredInput.type = "checkbox";
                requiredInput.name = "required[]";
                requiredInput.className = "form-check-input";
                const label = document.createElement("label");
                label.innerText = "Required";
                label.className = "form-check-label";
                requiredTd.appendChild(requiredInput);
                requiredTd.appendChild(label);

                const actionTd = document.createElement("div");
                actionTd.className = "col-3";
                const removeButton = document.createElement("a");
                removeButton.innerText = "Remove";
                removeButton.className = "btn btn-danger";
                removeButton.addEventListener("click", () => {
                    tr.remove();
                    updateRowsData();
                });
                actionTd.appendChild(removeButton);

                tr.appendChild(hiddenInputType);
                tr.appendChild(nameTd);
                tr.appendChild(placeholderTd);
                tr.appendChild(lengthTd);
                tr.appendChild(requiredTd);
                tr.appendChild(actionTd);
                rowParent.appendChild(tr);

                const newRowData = {
                    inputType: inputTypeValue,
                    name: "",
                    placeholder: "",
                    length: "",
                    required: false,
                };

                existingRows.push(newRowData);
                document.getElementById('rows').value = JSON.stringify(existingRows);
            }else if(inputTypeValue=='email'){
                const tr = document.createElement("div");
                tr.className = "row";

                const hiddenInputType = document.createElement("input");
                hiddenInputType.type = "hidden";
                hiddenInputType.name = "input_type[]";
                hiddenInputType.value = inputTypeValue;

                const nameTd = document.createElement("div");
                nameTd.className = "col-3";
                const nameInput = createInputField("Name");
                nameInput.type = "text";
                nameInput.name = "fieldName[]";
                nameInput.id = "name";
                nameInput.required = true;
                nameTd.appendChild(nameInput);

                const placeholderTd = document.createElement("div");
                placeholderTd.className = "col-3";
                const placeholderInput = createInputField("Placeholder");
                placeholderInput.type = "text";
                placeholderInput.name = "placeholder[]";
                placeholderInput.id = "placeholder";
                placeholderInput.required = true;
                placeholderTd.appendChild(placeholderInput);

                const requiredTd = document.createElement("div");
                requiredTd.className = "col-3";
                const requiredInput = document.createElement("input");
                requiredInput.type = "checkbox";
                requiredInput.name = "required[]";
                requiredInput.className = "form-check-input";
                const label = document.createElement("label");
                label.innerText = "Required";
                label.className = "form-check-label";
                requiredTd.appendChild(requiredInput);
                requiredTd.appendChild(label);

                const actionTd = document.createElement("div");
                actionTd.className = "col-3";
                const removeButton = document.createElement("a");
                removeButton.innerText = "Remove";
                removeButton.className = "btn btn-danger";
                removeButton.addEventListener("click", () => {
                    tr.remove();
                                        updateRowsData();
                });
                actionTd.appendChild(removeButton);
                tr.appendChild(hiddenInputType);

                tr.appendChild(nameTd);
                tr.appendChild(placeholderTd);
                tr.appendChild(requiredTd);
                tr.appendChild(actionTd);
                rowParent.appendChild(tr);
                const newRowData = {
                    inputType: inputTypeValue,
                    name: "",
                    placeholder: "",
                    required: false,
                };

                existingRows.push(newRowData);
                document.getElementById('rows').value = JSON.stringify(existingRows);
            }
            else if (inputTypeValue == 'file') {
                const tr = document.createElement("div");
                tr.className = "row";

                const hiddenInputType = document.createElement("input");
                hiddenInputType.type = "hidden";
                hiddenInputType.name = "input_type[]";
                hiddenInputType.value = inputTypeValue;

                const nameTd = document.createElement("div");
                nameTd.className = "col-3";
                const nameInput = createInputField("Name");
                nameInput.type = "text";
                nameInput.name = "fieldName[]";
                nameInput.id = "name";
                nameInput.required = true;
                nameTd.appendChild(nameInput);

                const fileSizeTd = document.createElement("div");
                fileSizeTd.className = "col-3";
                const fileSizeInput = createInputField("File Size");
                fileSizeInput.type = "number";
                fileSizeInput.min = "0";
                fileSizeInput.name = "fileSize[]";
                fileSizeInput.id = "fileSize";
                fileSizeInput.required = true;
                fileSizeTd.appendChild(fileSizeInput);


                const fileTypesTd = document.createElement("div");
                    fileTypesTd.className = "col-6";

                    const fileTypesSelect = document.createElement("select");
                    fileTypesSelect.name = "fileTypes[]";
                    fileTypesSelect.id = "fileTypes";
                    fileTypesSelect.className = "custom-select select2";
                    fileTypesSelect.multiple = true;

                    const fileTypesLabel = document.createElement("label");
                    fileTypesLabel.innerText = "File Types";
                    fileTypesLabel.className = "form-label";

                    const fileTypesOptions = ["png", "pdf", "jpg", "xls"];
                    fileTypesOptions.forEach((fileType) => {
                        const option = document.createElement("option");
                        option.value = fileType;
                        option.innerText = fileType.toUpperCase();
                        fileTypesSelect.appendChild(option);
                    });

                    fileTypesTd.appendChild(fileTypesLabel);
                    fileTypesTd.appendChild(fileTypesSelect);

                    $(fileTypesSelect).select2({
                        placeholder: "{{ __('Select :type',['type'=>__('File Types')]) }}",
                        allowClear: true,
                    });


                const multiFileTd = document.createElement("div");
                multiFileTd.className = "col-3";
                const multiFileInput = document.createElement("input");
                multiFileInput.type = "checkbox";
                multiFileInput.name = "multiFile[]";
                multiFileInput.id = "multiFile";
                multiFileInput.className = "form-check-input";
                const multi_label = document.createElement("label");
                multi_label.innerText = "Multiple Files";
                multi_label.className = "form-check-label";
                multiFileTd.appendChild(multiFileInput);
                multiFileTd.appendChild(multi_label);

                const filesNumTd = document.createElement("div");
                filesNumTd.className = "col-3";
                const filesNumInput = createInputField("Files Number");
                filesNumInput.type = "number";
                filesNumInput.min = "0";
                filesNumTd.style.display ='none';
                            filesNumInput.name = "filesNum[]";
                            filesNumInput.id = "filesNum";

                filesNumInput.required = true;
                filesNumTd.appendChild(filesNumInput);

                const multiFileChangeHandler = () => {
                    filesNumTd.style.display = multiFileInput.checked ? 'block' : 'none';
                };

                multiFileInput.addEventListener("change", multiFileChangeHandler);

                const requiredTd = document.createElement("div");
                requiredTd.className = "col-3";
                const requiredInput = document.createElement("input");
                requiredInput.type = "checkbox";
                requiredInput.name = "required[]";
                requiredInput.id = "required";
                requiredInput.className = "form-check-input";
                const label = document.createElement("label");
                label.innerText = "Required";
                label.className = "form-check-label";
                requiredTd.appendChild(requiredInput);
                requiredTd.appendChild(label);

                const actionTd = document.createElement("div");
                actionTd.className = "col-3";
                const removeButton = document.createElement("a");
                removeButton.innerText = "Remove";
                removeButton.className = "btn btn-danger";
                removeButton.addEventListener("click", () => {
                    tr.remove();
                                        updateRowsData();

                });
                actionTd.appendChild(removeButton);
                tr.appendChild(hiddenInputType);

                tr.appendChild(nameTd);
                tr.appendChild(fileSizeTd);
                tr.appendChild(filesNumTd);
                tr.appendChild(fileTypesTd);

                tr.appendChild(requiredTd);
                tr.appendChild(multiFileTd);
                tr.appendChild(actionTd);
                rowParent.appendChild(tr);
                if(document.getElementById("multiFile").checked){
                    const newRowData = {
                        inputType: inputTypeValue,
                        name: "",
                        fileSize:"",
                        fileTypes:"",
                        multiFile:false,
                        filesNum:"",
                        required:false,
                    };
                    existingRows.push(newRowData);
                    document.getElementById('rows').value = JSON.stringify(existingRows);
                }else{
                    const newRowData = {
                        inputType: inputTypeValue,
                        name: "",
                        fileSize:"",
                        fileTypes:"",
                        multiFile:false,
                        required:false,
                    };
                    existingRows.push(newRowData);
                    document.getElementById('rows').value = JSON.stringify(existingRows);
                }
            }
            function removeTr(element) {
                element.remove();
            }
        }

        function updateRowsData() {
            existingRows.length = 0;

            const rows = document.querySelectorAll('.row');
            rows.forEach((row) => {
                const inputTypeInput = row.querySelector('input[name="input_type[]"]');
                if (inputTypeInput) {
                    const inputTypeValue = inputTypeInput.value;
                    if (["text", "number", "phone", "textarea"].includes(inputTypeValue)) {
                        const inputTypeInput = row.querySelector('input[name="input_type[]"]');
                    const nameInput = row.querySelector('input[name="fieldName[]"]');
                    const placeholderInput = row.querySelector('input[name="placeholder[]"]');
                    const lengthInput = row.querySelector('input[name="length[]"]');
                    const requiredInput = row.querySelector('input[name="required[]"]');

                    if (inputTypeInput && nameInput && placeholderInput && lengthInput && requiredInput) {
                        const existingRow = {
                            inputType: inputTypeInput.value,
                            name: nameInput.value,
                            placeholder: placeholderInput.value,
                            length: lengthInput.value,
                            required: requiredInput.checked,
                        };

                        const existingRowIndex = existingRows.findIndex(row => (
                            row.inputType === existingRow.inputType &&
                            row.name === existingRow.name &&
                            row.placeholder === existingRow.placeholder &&
                            row.length === existingRow.length &&
                            row.required === existingRow.required
                        ));

                        if (existingRowIndex !== -1) {
                            existingRows[existingRowIndex] = existingRow;
                        } else {
                            existingRows.push(existingRow);
                        }
                    }
                } else if (inputTypeValue === "email") {
                    const inputTypeInput = row.querySelector('input[name="input_type[]"]');
                    const nameInput = row.querySelector('input[name="fieldName[]"]');
                    const placeholderInput = row.querySelector('input[name="placeholder[]"]');
                    const requiredInput = row.querySelector('input[name="required[]"]');

                    if (inputTypeInput && nameInput && placeholderInput && requiredInput) {
                        const existingRow = {
                            inputType: inputTypeInput.value,
                            name: nameInput.value,
                            placeholder: placeholderInput.value,
                            required: requiredInput.checked,
                        };

                        const existingRowIndex = existingRows.findIndex(row => (
                            row.inputType === existingRow.inputType &&
                            row.name === existingRow.name &&
                            row.placeholder === existingRow.placeholder &&
                            row.required === existingRow.required
                        ));

                        if (existingRowIndex !== -1) {
                            existingRows[existingRowIndex] = existingRow;
                        } else {
                            existingRows.push(existingRow);
                        }
                    }
                    }else if (inputTypeValue === "file") {
                        const inputTypeInput = row.querySelector('input[name="input_type[]"]');
                        const nameInput = row.querySelector('input[name="fieldName[]"]');
                        const filesizeInput = row.querySelector('input[name="fileSize[]"]');
                        const filesTypeSelect = row.querySelector('select[name="fileTypes[]"]');
                        const filesTypeInput = Array.from(filesTypeSelect.selectedOptions).map(option => option.value);
                                                const multiFilesInput = row.querySelector('input[name="multiFile[]"]');
                        const filesNumInput = row.querySelector('input[name="filesNum[]"]');
                        const requiredInput = row.querySelector('input[name="required[]"]');
                        if(multiFilesInput&&multiFilesInput.checked){
                            if (inputTypeInput && nameInput && filesizeInput && filesTypeInput && multiFilesInput && filesNumInput && requiredInput) {
                                const existingRow = {
                                    inputType: inputTypeInput.value,
                                    name: nameInput.value,
                                    filesize: filesizeInput.value,
                                    fileTypes: filesTypeInput,
                                    multiFiles: multiFilesInput.checked,
                                    filesNum: filesNumInput.value,
                                    required: requiredInput.checked,
                                };

                                const existingRowIndex = existingRows.findIndex(row => (
                                    row.inputType === existingRow.inputType &&
                                    row.name === existingRow.name &&
                                    row.filesize === existingRow.filesize &&
                                    JSON.stringify(row.fileTypes) === JSON.stringify(existingRow.fileTypes) &&
                                    row.multiFiles === existingRow.multiFiles &&
                                    row.filesNum === existingRow.filesNum &&
                                    row.required === existingRow.required
                                ));

                                if (existingRowIndex !== -1) {
                                    existingRows[existingRowIndex] = existingRow;
                                } else {
                                    existingRows.push(existingRow);
                                }
                            }
                        }else{
                            if (inputTypeInput && nameInput && filesizeInput && filesTypeInput && multiFilesInput && requiredInput) {
                                const existingRow = {
                                    inputType: inputTypeInput.value,
                                    name: nameInput.value,
                                    filesize: filesizeInput.value,
                                    fileTypes: filesTypeInput,
                                    multiFiles: multiFilesInput.checked,
                                    required: requiredInput.checked,
                                };

                                const existingRowIndex = existingRows.findIndex(row => (
                                    row.inputType === existingRow.inputType &&
                                    row.name === existingRow.name &&
                                    row.filesize === existingRow.filesize &&
                                    JSON.stringify(row.fileTypes) === JSON.stringify(existingRow.fileTypes) &&
                                    row.multiFiles === existingRow.multiFiles &&
                                    row.required === existingRow.required
                                ));

                                if (existingRowIndex !== -1) {
                                    existingRows[existingRowIndex] = existingRow;
                                } else {
                                    existingRows.push(existingRow);
                                }
                            }
                        }

                        }
                }

            });

            document.getElementById('rows').value = JSON.stringify(existingRows);
        }


        document.getElementById("addDiv").addEventListener("click", createRow);
        rowParent.addEventListener('input', updateRowsData);
    });
</script>
<script>
    function removeTr(button) {
        var row = button.closest('.row');
        if (row) {
            row.remove();
            updateRowsData();
        }
    }
</script>

@endsection
