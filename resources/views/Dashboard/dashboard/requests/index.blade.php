@extends('Dashboard.dashboard.layouts.app')
@section('title')
Requests
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('assets')}}/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="{{asset('assets')}}/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css">
<link rel="stylesheet"
    href="{{asset('assets')}}/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css">
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
                    <h4 class="mb-0">{{ __('Requests') }}
                        <div class="ml-auto" style="float:right;">
                            <div class="btn-group mt-1 mb-1">
                                <a class="btn btn-primary export-selected" data-type="excel">Export Selected</a>

                                    {{--  <a class="btn btn-primary export-selected" data-type="excel">Export Selected</a>  --}}
                                <form action="{{ route('requests.export') }}" method="POST" id="exportData"
                                    class="d-inline-block">
                                    <input type="hidden" id="exportIDS" name="IDS">
                                    <input type="hidden" id="id" name="id" value=null>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <input type="hidden" name="export_type" value="excel">
                                    @csrf
                                </form>
                            </div>
                            <div class="btn-group mt-1 mb-1">

                                <a class="btn btn-primary export-type" data-type="excel">Export</a>

                                {{--  <button type="button"
                                    class="btn btn-primary bg-split-primary dropdown-toggle dropdown-toggle-split"
                                    data-toggle="dropdown" aria-expanded="false">
                                </button>  --}}
                                {{--  <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left " style="">
                                    <a class="dropdown-item export-type" data-type="csv">CSV</a>
                                    <a class="dropdown-item export-type" data-type="excel">Excel</a>
                                </div>  --}}
                                <form action="{{ route('requests.export') }}" method="POST"
                                    class="d-inline-block">
                                    <input type="hidden" name="export_type" value="excel">
                                    <input type="hidden" name="id" value=null>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </h4>

                </div>
                <hr>
                <div class="table-responsive">
                    {{ $dataTable->table(['class' => 'table table-bordered table-striped mb-0','style'=>'width:100%'])
                    }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}

<script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
<script src="{{asset('assets')}}/js/dashmix.app.min.js"></script>


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
{{--  <script>
    $(document).ready(function () {
        $('[data-toggle="dropdown"]').dropdown();
    });
</script>  --}}
<script>
    $(document).on('click', '.export-type', function(e) {
        e.preventDefault();
        let form = $(this).closest('div').find('form');
        form.find('[name="export_type"]').val($(this).attr('data-type'));
        form.submit();
    });

    $(document).on('click', '.export-selected', function() {
        let form = $('#exportData');
        form.find('[name="export_type"]').val('excel'); // or set the export type dynamically if needed
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

    // Attach the click events for the "Export" and "Export Selected" buttons
    $(document).on('click', '.export-type, .export-selected', function() {
        checkMultiDeleteButton();
    });

  checkMultiDeleteButton();
    $(document).on('click', '.delete-selected', function() {
      let IDS = [];
      $('.request-checkbox:checked').each(function() {
          IDS.push($(this).val());
      });
      Swal.fire({
          title: '{{ __('Do you really want to delete this?') }}',
          showCancelButton: true,
          confirmButtonText: '{{ __('Yes') }}',
          cancelButtonText: '{{ __('No') }}',
      }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  type: "DELETE",
                  {{--  url: "{{ route('transactions.multi_destroy') }}",  --}}
                  data: {
                      IDS
                  },
                  success: function(msg) {
                      window.LaravelDataTables["requests"].draw();
                      Swal.fire(msg.message, '', msg.success ? 'success' : 'error');
                  }
              });

          }
      });
  });

  function addSelectedCount() {
      $(".selectedCount").text($(".request-checkbox:checked").length);
      let IDS = [];
      $('.request-checkbox:checked').each(function() {
          IDS.push($(this).val());
      });
      $("#exportIDS").val(IDS);
  }
  $(document).on('change', '#selectAllCheckbox', function() {
      $('table#requests tbody input[type="checkbox"].request-checkbox').prop('checked', $(this).is(
          ':checked'));
      checkMultiDeleteButton();
      addSelectedCount();
  });
  $(document).on('change', '.request-checkbox', function() {
      checkMultiDeleteButton();
      addSelectedCount();
  });

  $(document).on('click','#delete-this',function(e){
      e.preventDefault();
      let el=$(this);
      let url=el.attr('data-url');
      let id=el.attr('data-id');
      Swal.fire({
          title: '{{ __('Do you really want to delete this?') }}',
          showCancelButton: true,
          confirmButtonText: '{{ __('Yes') }}',
          cancelButtonText: '{{ __('No') }}',
      }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
              $.ajax({
                  method: "delete",
                  url: url,
                  data: {
              "_token": "{{ csrf_token() }}"},
                  success: function (msg) {
                      window.LaravelDataTables["requests"].draw();
                      Swal.fire(msg.message, '', msg.success?'success':'error');
                  }
              });

          }
      });
  });
</script>


@endsection
