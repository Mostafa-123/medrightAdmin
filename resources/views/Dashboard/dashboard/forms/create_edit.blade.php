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
    {{ isset($form) ? __('Edit') : __('Create') }}
@endsection
@section('content')
    @if (isset($form))
        @php
            $formFields = $form->fields ?? [];
        @endphp
    @endif

    <div class="page-content-wrapper">
        <div class="page-content">
            {{-- @dd($existingRows) --}}
            <div class="card radius-15 border-lg-top-primary">
                <div class="card-body">
                    <div class="card-title">
                        <h4 class="mb-0">{{ isset($form) ? __('Edit :type', ['type' => $form->name]) : __('Create') }}</h4>
                    </div>
                    <hr>
                    <form method="POST"
                        action="{{ isset($form) ? route('forms.update', ['form' => $form]) : route('forms.store') }}"
                        enctype="multipart/form-data">
                        @if (isset($form))
                            @method('PUT')
                        @endif
                        @csrf
                        <div class="row">
                            <input type="hidden" name="rows" id="rows" value="[]">
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
                            <x-forms.text-input-component name="description" id="description" type="text"
                                text="Description" value="{{ isset($form) ? $form->description : old('description') }}"
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
                                        <option @if (isset($form) && $form->published == true) selected="selected" @endif value=true>Yes
                                        </option>
                                        <option @if (isset($form) && $form->published == false) selected="selected" @endif value=false>No
                                        </option>
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
                                                data-placeholder="{{ __('Select :type', ['type' => __('Input')]) }}">
                                                <option value="0">
                                                    {{ __('Select :type', ['type' => __('All Inputs Type')]) }}
                                                </option>
                                                @foreach ($types as $type)
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
    <script src="{{ asset('assets') }}/js/dashmix.app.min.js"></script>

    <script src="{{ asset('assets') }}/js/lib/jquery.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#input_type').select2({
                placeholder: "{{ __('Select :type', ['type' => __('Input')]) }}",
                allowClear: true,
            });
            $('#fileTypes').select2({
                placeholder: "{{ __('Select :type', ['type' => __('type')]) }}",
                allowClear: true,
            });


            const rowParent = document.getElementById("rowParent");
            const existingRows = JSON.parse(document.getElementById('rows').value);
            const formFields = @json($formFields ?? []);
            formFields.forEach((row) => {
                createFormExisitingRow(row);
            });

            function createInputField(placeholder) {
                const input = document.createElement("input");
                input.type = "text";
                input.className = "form-control";
                input.placeholder = placeholder;
                return input;
            }

            function createHiddenElement(input_type) {
                const hiddenInputType = document.createElement("input");
                hiddenInputType.type = "hidden";
                hiddenInputType.name = "input_type[]";
                hiddenInputType.value = input_type;
                return hiddenInputType;
            }

            function createElement(divClass, inputType, inputName, inputPlaceholder, inputValue = null, inputId,
                required =
                false, labelText =
                null) {
                const divTd = document.createElement("div");
                divTd.className = divClass;

                let Input;

                if (inputType === "checkbox") {
                    Input = document.createElement("input");
                    Input.className = "form-check-input";
                    Input.type = "checkbox";
                    Input.name = inputName;
                    Input.id = inputId;
                    Input.required = required;
                    Input.checked = inputValue == 1 ? true : false;
                    const label = document.createElement("label");
                    label.innerText = labelText;
                    label.className = "form-check-label";
                    divTd.appendChild(Input);
                    divTd.appendChild(label);
                } else {
                    Input = createInputField(inputPlaceholder);
                    if (inputType === "number") {
                        Input.min = "0";
                    }
                    Input.type = inputType;
                    Input.name = inputName;
                    Input.id = inputId;
                    Input.value = inputValue;
                    Input.required = required;

                    divTd.appendChild(Input);
                }

                return divTd;
            }

            function createFormExisitingRow(row) {
                const inputTypeValue = row['input_type'];

                if (inputTypeValue == 'number' || inputTypeValue == 'phone' || inputTypeValue == 'password' ||
                    inputTypeValue == 'textarea' ||
                    inputTypeValue == 'text') {
                    const tr = document.createElement("div");
                    tr.className = "row";
                    const actionTd = document.createElement("div");
                    actionTd.className = "col-1";
                    const removeButton = document.createElement("a");
                    removeButton.innerText = "X";
                    removeButton.className = "btn btn-danger";
                    removeButton.addEventListener("click", () => {
                        tr.remove();
                        updateRowsData();
                    });
                    actionTd.appendChild(removeButton);
                    tr.appendChild(createHiddenElement(inputTypeValue));
                    tr.appendChild(createElement("col-3", "text", "fieldName[]", "Name", row['name'], "nameid",
                        true));
                    tr.appendChild(createElement("col-3", "text", "placeholder[]", "Placeholder", row[
                            'placeholder'],
                        "placeholderid", true));
                    tr.appendChild(createElement("col-3", "number", "length[]", "Length", row['length'], "lengthid",
                        true));
                    tr.appendChild(createElement("col-2", "checkbox", "required[]", "input", row['required'],
                        "requiredid",
                        false,
                        "Required"));
                    tr.appendChild(actionTd);
                    rowParent.appendChild(tr);

                    const newRowData = {
                        inputType: inputTypeValue,
                        name: row['name'],
                        placeholder: row['placeholder'],
                        length: row['length'],
                        required: row['required'],
                    };

                    existingRows.push(newRowData);
                    document.getElementById('rows').value = JSON.stringify(existingRows);
                } else if (inputTypeValue == 'email') {
                    const tr = document.createElement("div");
                    tr.className = "row";
                    const actionTd = document.createElement("div");
                    actionTd.className = "col-1";
                    const removeButton = document.createElement("a");
                    removeButton.innerText = "X";
                    removeButton.className = "btn btn-danger";
                    removeButton.addEventListener("click", () => {
                        tr.remove();
                        updateRowsData();
                    });
                    actionTd.appendChild(removeButton);
                    tr.appendChild(createHiddenElement(inputTypeValue));
                    tr.appendChild(createElement("col-3", "text", "fieldName[]", "Name", row['name'], "nameid",
                        true));
                    tr.appendChild(createElement("col-3", "text", "placeholder[]", "Placeholder", row[
                            'placeholder'],
                        "placeholderid", true));
                    tr.appendChild(createElement("col-3", "checkbox", "required[]", "input", row['required'],
                        "requiredid",
                        false,
                        "Required"));
                    tr.appendChild(actionTd);
                    rowParent.appendChild(tr);
                    const newRowData = {
                        inputType: inputTypeValue,
                        name: row['name'],
                        placeholder: row['placeholder'],
                        required: row['required'],
                    };

                    existingRows.push(newRowData);
                    document.getElementById('rows').value = JSON.stringify(existingRows);
                } else if (inputTypeValue == 'file') {
                    const tr = document.createElement("div");
                    tr.className = "row";

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
                        if (row['files_type'].includes(fileType)) {
                            option.selected = true;
                        }
                        fileTypesSelect.appendChild(option);
                    });

                    fileTypesTd.appendChild(fileTypesLabel);
                    fileTypesTd.appendChild(fileTypesSelect);

                    $(fileTypesSelect).select2({
                        placeholder: "{{ __('Select :type', ['type' => __('File Types')]) }}",
                        allowClear: true,
                    });


                    const multiFileTd = document.createElement("div");
                    multiFileTd.className = "col-3";
                    const multiFileInput = document.createElement("input");
                    multiFileInput.type = "checkbox";
                    multiFileInput.name = "multiFile[]";
                    multiFileInput.id = "multiFile";
                    multiFileInput.checked = row['multi_file'] == 1 ? true : false;
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
                    filesNumInput.value = row['file_num'];
                    filesNumTd.style.display = row['multi_file'] == 1 ? true : false;
                    filesNumInput.name = "filesNum[]";
                    filesNumInput.id = "filesNum";
                    filesNumInput.required = multiFileInput.checked ? true : false;
                    filesNumTd.appendChild(filesNumInput);

                    const multiFileChangeHandler = () => {
                        filesNumTd.style.display = multiFileInput.checked ? 'block' : 'none';
                    };

                    multiFileInput.addEventListener("change", multiFileChangeHandler);

                    const actionTd = document.createElement("div");
                    actionTd.className = "col-1";
                    const removeButton = document.createElement("a");
                    removeButton.innerText = "X";
                    removeButton.className = "btn btn-danger";
                    removeButton.addEventListener("click", () => {
                        tr.remove();
                        updateRowsData();

                    });
                    actionTd.appendChild(removeButton);
                    tr.appendChild(createHiddenElement(inputTypeValue));

                    tr.appendChild(createElement("col-3", "text", "fieldName[]", "Name", row['name'], "nameid",
                        true));
                    tr.appendChild(createElement("col-3", "number", "fileSize[]", "File Size", row['file_size'],
                        "fileSizeid", true));
                    tr.appendChild(fileTypesTd);
                    tr.appendChild(filesNumTd);
                    tr.appendChild(createElement("col-3", "checkbox", "required[]", "input", row['required'],
                        "requiredid",
                        false,
                        "Required"));
                    tr.appendChild(multiFileTd);
                    tr.appendChild(actionTd);
                    rowParent.appendChild(tr);
                    if (document.getElementById("multiFile").checked) {
                        const newRowData = {
                            inputType: inputTypeValue,
                            name: row['name'],
                            fileSize: row['file_size'],
                            fileTypes: row['files_type'],
                            multiFile: row['multi_file'],
                            filesNum: row['file_num'],
                            required: row['required'],
                        };
                        existingRows.push(newRowData);
                        document.getElementById('rows').value = JSON.stringify(existingRows);
                    } else {
                        const newRowData = {
                            inputType: inputTypeValue,
                            name: row['name'],
                            fileSize: row['file_size'],
                            fileTypes: row['files_type'],
                            multiFile: row['multi_file'],
                            required: row['required'],
                        };
                        existingRows.push(newRowData);
                        document.getElementById('rows').value = JSON.stringify(existingRows);
                    }

                }

                function removeTr(element) {
                    element.remove();
                }
            }

            function createRow() {
                const inputTypeValue = document.getElementById("input_type").value;

                if (inputTypeValue == 'number' || inputTypeValue == 'phone' || inputTypeValue == 'password' ||
                    inputTypeValue == 'textarea' ||
                    inputTypeValue == 'text') {
                    const tr = document.createElement("div");
                    tr.className = "row";
                    const actionTd = document.createElement("div");
                    actionTd.className = "col-1";
                    const removeButton = document.createElement("a");
                    removeButton.innerText = "X";
                    removeButton.className = "btn btn-danger";
                    removeButton.addEventListener("click", () => {
                        tr.remove();
                        updateRowsData();
                    });
                    actionTd.appendChild(removeButton);
                    tr.appendChild(createHiddenElement(inputTypeValue));
                    tr.appendChild(createElement("col-3", "text", "fieldName[]", "Name", null, "nameid", true));
                    tr.appendChild(createElement("col-3", "text", "placeholder[]", "Placeholder", null,
                        "placeholderid",
                        true));
                    tr.appendChild(createElement("col-3", "number", "length[]", "Length", null, "lengthid", true));
                    tr.appendChild(createElement("col-2", "checkbox", "required[]", "input", null, "requiredid",
                        false,
                        "Required"));
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
                } else if (inputTypeValue == 'email') {
                    const tr = document.createElement("div");
                    tr.className = "row";
                    const actionTd = document.createElement("div");
                    actionTd.className = "col-1";
                    const removeButton = document.createElement("a");
                    removeButton.innerText = "X";
                    removeButton.className = "btn btn-danger";
                    removeButton.addEventListener("click", () => {
                        tr.remove();
                        updateRowsData();
                    });
                    actionTd.appendChild(removeButton);
                    tr.appendChild(createHiddenElement(inputTypeValue));
                    tr.appendChild(createElement("col-3", "text", "fieldName[]", "Name", null, "nameid", true));
                    tr.appendChild(createElement("col-3", "text", "placeholder[]", "Placeholder", null,
                        "placeholderid",
                        true));
                    tr.appendChild(createElement("col-3", "checkbox", "required[]", "input", null, "requiredid",
                        false,
                        "Required"));
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
                } else if (inputTypeValue == 'file') {
                    const tr = document.createElement("div");
                    tr.className = "row";

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
                        placeholder: "{{ __('Select :type', ['type' => __('File Types')]) }}",
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
                    filesNumTd.style.display = 'none';
                    filesNumInput.name = "filesNum[]";
                    filesNumInput.id = "filesNum";
                    filesNumInput.required = false;
                    filesNumTd.appendChild(filesNumInput);

                    const multiFileChangeHandler = () => {
                        filesNumTd.style.display = multiFileInput.checked ? 'block' : 'none';
                        filesNumInput.required = multiFileInput
                            .checked; // Update the required attribute based on the checkbox state
                    };

                    multiFileInput.addEventListener("change", multiFileChangeHandler);

                    const actionTd = document.createElement("div");
                    actionTd.className = "col-1";
                    const removeButton = document.createElement("a");
                    removeButton.innerText = "X";
                    removeButton.className = "btn btn-danger";
                    removeButton.addEventListener("click", () => {
                        tr.remove();
                        updateRowsData();

                    });
                    actionTd.appendChild(removeButton);
                    tr.appendChild(createHiddenElement(inputTypeValue));

                    tr.appendChild(createElement("col-3", "text", "fieldName[]", "Name", null, "nameid", true));
                    tr.appendChild(fileSizeTd);
                    tr.appendChild(fileTypesTd);
                    tr.appendChild(filesNumTd);
                    tr.appendChild(multiFileTd);
                    tr.appendChild(createElement("col-3", "checkbox", "required[]", "input", null, "requiredid",
                        false,
                        "Required"));
                    tr.appendChild(actionTd);
                    rowParent.appendChild(tr);
                    if (document.getElementById("multiFile").checked) {
                        const newRowData = {
                            inputType: inputTypeValue,
                            name: "",
                            fileSize: "",
                            fileTypes: "",
                            multiFile: false,
                            filesNum: "",
                            required: false,
                        };
                        existingRows.push(newRowData);
                        document.getElementById('rows').value = JSON.stringify(existingRows);
                    } else {
                        const newRowData = {
                            inputType: inputTypeValue,
                            name: "",
                            fileSize: "",
                            fileTypes: "",
                            multiFile: false,
                            required: false,
                        };
                        existingRows.push(newRowData);
                        document.getElementById('rows').value = JSON.stringify(existingRows);
                    }
                } else if (inputTypeValue == 'selector') {
                    const tr = document.createElement("div");
                    tr.className = "row";
                    const actionTd = document.createElement("div");
                    actionTd.className = "col-1";
                    const removeButton = document.createElement("a");
                    removeButton.innerText = "X";
                    removeButton.className = "btn btn-danger";
                    removeButton.addEventListener("click", () => {
                        tr.remove();
                        updateRowsData();
                    });
                    actionTd.appendChild(removeButton);

                    tr.appendChild(createHiddenElement(inputTypeValue));
                    tr.appendChild(createElement("col-3", "text", "fieldName[]", "Name", null, "nameid", true));
                    tr.appendChild(createElement("col-3", "text", "placeholder[]", "Placeholder", null,
                        "placeholderid", true));

                    const numOptionsInput = createInputField("Number of Options");
                    numOptionsInput.type = "number";
                    numOptionsInput.min = "0";
                    numOptionsInput.name = "numOptions[]";
                    numOptionsInput.id = "numOptions";
                    numOptionsInput.required = true;

                    const createOptionsButton = document.createElement("button");
                    createOptionsButton.innerText = "Create Options";
                    createOptionsButton.className = "btn btn-primary";
                    createOptionsButton.addEventListener("click", () => {
                        event.preventDefault();
                        createOptionsInputs(tr);
                        updateRowsData();
                    });

                    const optionsContainer = document.createElement("div");
                    optionsContainer.id = "optionsContainer";

                    const actionContainer = document.createElement("div");
                    actionContainer.className = "col-2";
                    actionContainer.appendChild(numOptionsInput);
                    actionContainer.appendChild(createOptionsButton);
                    actionContainer.appendChild(optionsContainer);

                    tr.appendChild(actionContainer);
                    tr.appendChild(actionTd);
                    rowParent.appendChild(tr);

                    const newRowData = {
                        inputType: inputTypeValue,
                        name: "",
                        placeholder: "",
                        numOptions: 0,
                        options: [],
                    };

                    existingRows.push(newRowData);
                    document.getElementById('rows').value = JSON.stringify(existingRows);
                }

                function removeTr(element) {
                    element.remove();
                }
            }


            function createOptionsInputs(parentElement) {
                const numOptions = document.getElementById("numOptions").value;
                const optionsContainer = parentElement.querySelector("#optionsContainer");
                optionsContainer.innerHTML = ""; // Clear previous inputs

                for (let i = 1; i <= numOptions; i++) {
                    const optionInput = createInputField(`Option ${i}`);
                    optionInput.name = `options[${i}]`;
                    optionsContainer.appendChild(optionInput);
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

                            if (inputTypeInput && nameInput && placeholderInput && lengthInput &&
                                requiredInput) {
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
                        } else if (inputTypeValue === "file") {
                            const inputTypeInput = row.querySelector('input[name="input_type[]"]');
                            const nameInput = row.querySelector('input[name="fieldName[]"]');
                            const filesizeInput = row.querySelector('input[name="fileSize[]"]');
                            const filesTypeSelect = row.querySelector('select[name="fileTypes[]"]');
                            const filesTypeInput = Array.from(filesTypeSelect.selectedOptions).map(option =>
                                option.value);
                            const multiFilesInput = row.querySelector('input[name="multiFile[]"]');
                            const filesNumInput = row.querySelector('input[name="filesNum[]"]');
                            const requiredInput = row.querySelector('input[name="required[]"]');
                            if (multiFilesInput && multiFilesInput.checked) {
                                if (inputTypeInput && nameInput && filesizeInput && filesTypeInput &&
                                    multiFilesInput && filesNumInput && requiredInput) {
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
                                        JSON.stringify(row.fileTypes) === JSON.stringify(existingRow
                                            .fileTypes) &&
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
                            } else {
                                if (inputTypeInput && nameInput && filesizeInput && filesTypeInput &&
                                    multiFilesInput && requiredInput) {
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
                                        JSON.stringify(row.fileTypes) === JSON.stringify(existingRow
                                            .fileTypes) &&
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

                        } else if (inputTypeValue === "selector") {
                const inputTypeInput = row.querySelector('input[name="input_type[]"]');
                const nameInput = row.querySelector('input[name="fieldName[]"]');
                const placeholderInput = row.querySelector('input[name="placeholder[]"]');
                const numOptionsInput = row.querySelector('input[name="numOptions[]"]');

                if (inputTypeInput && nameInput && placeholderInput && numOptionsInput) {
                    const numOptions = numOptionsInput.value;
                    const options = [];

                    for (let i = 1; i <= numOptions; i++) {
                        const optionInput = row.querySelector(`#optionsContainer input[name="options[${i}]"]`);
                        if (optionInput) {
                            options.push(optionInput.value);
                        }
                    }

                    const existingRow = {
                        inputType: inputTypeInput.value,
                        name: nameInput.value,
                        placeholder: placeholderInput.value,
                        numOptions: numOptions,
                        options: options,
                    };

                    const existingRowIndex = existingRows.findIndex(row => (
                        row.inputType === existingRow.inputType &&
                        row.name === existingRow.name &&
                        row.placeholder === existingRow.placeholder &&
                        row.numOptions === existingRow.numOptions &&
                        JSON.stringify(row.options) === JSON.stringify(existingRow.options)
                    ));

                    if (existingRowIndex !== -1) {
                        existingRows[existingRowIndex] = existingRow;
                    } else {
                        existingRows.push(existingRow);
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
@endsection
