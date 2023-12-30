@extends('Dashboard.dashboard.layouts.app')
@section('title')
    Forms
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet"
        href="{{ asset('assets') }}/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css">
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
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="card radius-15">
                <div class="card-body">
                    <div class="card-title">
                        <h4 class="mb-0">{{ __('Your Form View') }}
                        </h4>

                    </div>
                    <hr>
                    @if (isset($form) && isset($form->fields))
                        <form class="row g-3" method="POST" action="{{ route('form_request') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="form" id="form" value="{{ $form }}">
                            @foreach ($form->fields as $field)
                                <div class="col-md-12">
                                    <label for="{{ $field['name'] }}" class="form-label">{{ $field['name'] }}</label>
                                    <input class="form-control"
                                        type="@if ($field['input_type'] == 'phone') tel @else {{ $field['input_type'] }} @endif"
                                        @if ($field['required'] == 1) required="required" @endif
                                        @if (isset($field['placeholder'])) placeholder="{{ $field['placeholder'] }}" @endif
                                        name="{{ $field['id'] }}" id="{{ $field['name'] }}"
                                        @if ($field['input_type'] != 'file' && $field['input_type'] != 'email') @if ($field['input_type'] == 'number')
                                            max="{{ $field['length'] }}" min="0"
                                            @else
                                            maxlength="{{ $field['length'] }}" @endif
                                        @endif
                                    @if ($field['input_type'] == 'file') @php
                                                $allowedExtensions = $field['files_type'];
                                                $acceptValue = '.' . implode(', .', $allowedExtensions);
                                            @endphp
                                            accept="{{ $acceptValue }}"
                                        @if ($field['multi_file'] == 1)
                                        multiple
                                        onchange="validateFileCount(this,{{ $field['file_num'] }})" @endif
                            @endif
                            >
                </div>
                @endforeach

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </div>
                </form>

                <div class="text-end">
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
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets') }}/js/lib/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/js/dashmix.app.min.js"></script>

    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>

    <script>
        $(document).on('click', '.export-type', function(e) {
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
