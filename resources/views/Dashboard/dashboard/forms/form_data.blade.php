@extends('Dashboard.dashboard.layouts.app')
@section('title')
Forms
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('assets')}}/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="{{asset('assets')}}/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="{{asset('assets')}}/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css">

@endsection
@section('content')
@if (Session::get('success'))
<div class="alert alert-success">{{ Session::get('success') }}</div>
@endif
@if (Session::get('fail'))
<div class="alert alert-danger">{{ Session::get('fail') }}</div>
@endif
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="card radius-15">
                <div class="card-body">
                    <div class="card-title">
                        <h4 class="mb-0">{{ __('Form Data') }}
                        </h4>
                    </div>
                    <hr>
                    <div class="card-body">
                        <table id="formData" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    @if (isset($form)&&isset($form->fields))
                                    @foreach ($form->fields as $field)
                                    @if ($field['input_type']=='password')
                                    @else
                                    <th>{{$field['name']}}</th>
                                    @endif
                                    @endforeach
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($form->units as $unit)
                                <tr>
                                    @foreach ($form->fields as $field)
                                    @php
                                        $formRequest = $unit->formRequests->where('field_id', $field['id'])->first();
                                    @endphp
                                    @if ($field['input_type']=='password')
                                    @else
                                    <td>
                                        @if ($formRequest)
                                        @if($field['input_type']=='file')
                                        @if($field['multi_file'])
                                        @php
                                            $fiels=json_decode($formRequest->value,true)
                                        @endphp
                                        @foreach ($fiels as $file)
                                        <a href="{{$file}}">{{ $file }}</a>
                                        @endforeach
                                        @else
                                        <a href="{{$formRequest->value}}">{{ $formRequest->value }}</a>
                                        @endif
                                        @elseif($field['input_type']=='selector'&&$formRequest->value==0)
                                        Any Of Choices
                                        @else
                                        {{ $formRequest->value }}
                                        @endif
                                        @endif
                                    </td>
                                    @endif

                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="{{asset('assets')}}/js/dashmix.app.min.js"></script>

<script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>

<script>



    document.addEventListener('DOMContentLoaded', function() {
        $( document ).ready(function() {
            new DataTable('#formData');
        });
    });
    $(document).on('click', '#delete-this', function (e) {
        e.preventDefault();
        let el = $(this);
        let url = el.attr('data-url');
        let id = el.attr('data-id');
        let csrfToken = "{{ csrf_token() }}";

        Swal.fire({
            title: '{{ __('Do you really want to delete this?') }}',
            showCancelButton: true,
            confirmButtonText: '{{ __('Yes') }}',
            cancelButtonText: '{{ __('No') }}',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function (msg) {
                        window.LaravelDataTables["forms"].draw();
                        Swal.fire(msg.message, '', msg.success ? 'success' : 'error');
                    }
                });
            }
        });
    });
</script>



  <!-- jQuery (required for DataTables plugin) -->


  @endsection
