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
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    @if (isset($form)&&isset($form->fields))
                                    @foreach ($form->fields as $field)
                                    <th>{{$field['name']}}</th>
                                    @endforeach
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>2011-04-25</td>
                                    <td>$320,800</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        new DataTable('#formData');
    }):
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


  <script src="{{asset('assets')}}/js/dashmix.app.min.js"></script>

  <!-- jQuery (required for DataTables plugin) -->

  <script src="{{asset('assets')}}/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js"></script>
  <script src="{{asset('assets')}}/js/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="{{asset('assets')}}/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
  <script src="{{asset('assets')}}/js/plugins/datatables-buttons/dataTables.buttons.min.js"></script>
  <script src="{{asset('assets')}}/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
  <script src="{{asset('assets')}}/js/plugins/datatables-buttons-jszip/jszip.min.js"></script>
  <script src="{{asset('assets')}}/js/plugins/datatables-buttons-pdfmake/pdfmake.min.js"></script>
  <script src="{{asset('assets')}}/js/plugins/datatables-buttons-pdfmake/vfs_fonts.js"></script>
  <script src="{{asset('assets')}}/js/plugins/datatables-buttons/buttons.print.min.js"></script>
  <script src="{{asset('assets')}}/js/plugins/datatables-buttons/buttons.html5.min.js"></script>

  <!-- Page JS Code -->
  <script src="{{asset('assets')}}/js/pages/be_tables_datatables.min.js"></script>
  @endsection
