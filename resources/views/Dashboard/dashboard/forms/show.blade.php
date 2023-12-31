@extends('Dashboard.dashboard.layouts.app')
@section('title')
Forms
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css">
<link rel="stylesheet"
    href="{{ asset('assets') }}/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css">
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
@endsection
@section('content')
@if (Session::get('success'))
@php
$successMessage = Session::get('success');
@endphp
@endif

@if (Session::get('fail'))
@php
$failMessage = Session::get('fail');
@endphp
@endif
    <div class="page-content">
        <div class="card radius-15">
            <div class="card-body">
                <div class="card-title">
                    <h4 class="mb-0">{{ __('Your Form View') }}
                    </h4>

                </div>
                <hr>
                @if (isset($form) && isset($form->fields))
                <form class="row g-3" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="form" id="form" value="{{ $form }}">
                    @foreach ($form->fields as $field)
                    <div class="col-md-12">
                        <label for="{{ $field['name'] }}" class="form-label">{{ $field['name'] }}</label>
                        @if($field['input_type'] == 'selector')
                        @php
                        $options=json_decode($field['files_type']);
                        $placeholderText = __('Select :type', ['type' => $field['placeholder']]);
                        @endphp
                        <select id="{{ $field['name'] }}" @if ($field['required']==1) required="required" @endif
                            class="custom-select" name="{{ $field['id'] }}" data-placeholder="{{ $placeholderText }}">
                            <option value="0">
                                {{ __('Select :type', ['type' => __('All :type', ['type' => $field['placeholder']])]) }}
                            </option>
                            @foreach ($options as $option)
                            <option value="{{ $option }}">{{ $option }} input</option>
                            @endforeach
                        </select>
                        @else
                        <input class="form-control"
                            type="@if ($field['input_type'] == 'phone') tel @else {{ $field['input_type'] }} @endif"

                            @if($field['required']==1) required="required"@endif

                            @if (isset($field['placeholder']))
                            placeholder="{{ $field['placeholder'] }}"
                            @endif

                            name="{{ $field['id'] }}"
                            id="{{ $field['name'] }}"

                            @if ($field['input_type'] !='file' && $field['input_type'] !='email' )
                                @if ($field['input_type']=='number' )
                                max="{{ $field['length'] }}" min="0"
                                @else
                                 maxlength="{{ $field['length'] }}"
                                @endif
                            @endif

                            @if ($field['input_type']=='file' )
                            @php
                            $allowedExtensions=$field['files_type']; $acceptValue='.' . implode(', .',
                            $allowedExtensions);
                            @endphp
                            accept="{{ $acceptValue }}"
                                @if ($field['multi_file']==1)
                                multiple onchange="validateFileCount(this,{{ $field['file_num'] }})"
                                @endif
                            @endif>
                        @endif

                    </div>
                    @endforeach
                </form>

                <div class="text-end">
                    <a href="{{ Illuminate\Support\Facades\Config::get('website_url').'/forms/'.$form->form_link }}">
                        <button type="button"
                            class="btn btn-outline-primary ms-1">Show on
                            Website</button></a>
                    <button type="button" class="btn btn-outline-primary ms-1 export-type"
                        data-type="excel">Export</button>
                    <form action="{{ route('forms.export') }}" method="POST" class="d-inline-block">
                        <input type="hidden" name="export_type" value="excel">
                        <input type="hidden" name="form_id" value="{{ $form->id }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @csrf
                    </form>
                </div>
                @else
                @endif
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="{{ asset('assets') }}/js/lib/jquery.min.js"></script>
<script src="{{ asset('assets') }}/js/dashmix.app.min.js"></script>

<script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>

<script>
    $(document).on('click', '.export-type', function(e) {
        $('.custom-select').select2({
            placeholder: "Please Select",
            allowClear: true,
        });
            e.preventDefault();
            let form = $(this).closest('div').find('form');
            form.find('[name="export_type"]').val($(this).attr('data-type'));
            form.submit();
        });

        $(document).on('click', '.export-selected', function() {
            let form = $('#exportData');
            form.find('[name="export_type"]').val('excel');
            form.submit();
        });

        function checkMultiDeleteButton() {
            if ($(".request-checkbox").is(':checked')) {
                $(".delete-selected").removeClass('disabled');
                $(".export-selected,.export-types").removeClass('disabled');
            } else {
                $(".delete-selected").addClass('disabled');
                $(".export-selected,.export-types").addClass('disabled');
            }
        }

        $(document).on('click', '.export-type, .export-selected', function() {
            checkMultiDeleteButton();
        });
        document.addEventListener('DOMContentLoaded', function() {
            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ Session::get('success') }}',
                    showConfirmButton: true,
                    timer: 3000
                });
            @endif

            @if (Session::has('fail'))
                Swal.fire({
                    icon: 'error',
                    title: 'Fail!',
                    text: '{{ Session::get('fail') }}',
                    showConfirmButton: true,
                    timer: 3000
                });
            @endif
        });

        function validateFileCount(input, filesNum) {
            var maxFiles = filesNum;

            if (input.files.length > maxFiles) {
                alert("You can only upload a maximum of " + maxFiles + " files.");
                input.value = '';
            }
        }
</script>



<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
