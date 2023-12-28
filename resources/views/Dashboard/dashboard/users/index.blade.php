@extends('Dashboard.dashboard.layouts.app')
@section('title')
Users
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
            <!--breadcrumb-->

            </div>
            <!--end breadcrumb-->
            <div class="card radius-15">
                <div class="card-body">
                    <div class="card-title">
                        <h4 class="mb-0">{{ __('Users') }}
                            @if(PerUser('users.create'))
                            <a href="{{ route('users.create') }}" style="float: right;" class="btn btn-primary ml-auto"><i class="fadeIn animated bx bx-message-square-add"></i> {{ __('Create :type',['type'=>__('User')]) }}</a>
                        @endif
                    </h4>
                    </div>
                    <hr>
{{--                    <div class="table-responsive">--}}
{{--                        <table class="table table-bordered table-striped mb-0"></table>--}}
{{--                    </div>--}}
                    <div class="table-responsive">
                        {{ $dataTable->table(['class' => 'table table-bordered table-striped mb-0','style'=>'width:100%']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script>
    {{--  $(document).on('click','.delete-selected',function(){
        let IDS=[];
        $('.user-checkbox:checked').each(function(){
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
                    url: "{{ route('users.multi_destroy') }}",
                    data:{IDS},
                    success: function (msg) {
                        window.LaravelDataTables["users"].draw();
                        Swal.fire(msg.message, '', msg.success?'success':'error');
                    }
                });

            }
        });
    });  --}}
    function addSelectedCount(){
        $(".selectedCount").text($(".user--checkbox:checked").length);
        let IDS=[];
        $('.user-checkbox:checked').each(function(){
            IDS.push($(this).val());
        });
        $("#exportIDS").val(IDS);
    }
    $(document).on('change','#selectAllCheckbox',function(){
        $('table#users tbody input[type="checkbox"].user-checkbox').prop('checked',$(this).is(':checked'));
        checkMultiDeleteButton();
        addSelectedCount();
    });;
    $(document).on('change','.user-checkbox',function (){
        checkMultiDeleteButton();
        addSelectedCount();
    });;
    {{--  @if(PerUser('users.destroy'))
    $(document).on('click','.delete-this',function(e){
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
                    type: "DELETE",
                    url: url,
                    success: function (msg) {
                        window.LaravelDataTables["users"].draw();
                        Swal.fire(msg.message, '', msg.success?'success':'error');
                    }
                });

            }
        });
    });
    @endif  --}}
</script>

  <script src="{{asset('assets')}}/js/dashmix.app.min.js"></script>

  <!-- jQuery (required for DataTables plugin) -->
  <script src="{{asset('assets')}}/js/lib/jquery.min.js"></script>

  <!-- Page JS Plugins -->
  <script src="{{asset('assets')}}/js/plugins/datatables/jquery.dataTables.min.js"></script>
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
@push('footerScripts')
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        $(document).on('click','.export-type',function(e){
            e.preventDefault();
            let form=$(this).parent().parent().find('form');
            form.find('[name="export_type"]').val($(this).attr('data-type'));
            form.submit();
        });
        function checkMultiDeleteButton(){
           if($(".user-checkbox").is(':checked')){
               $(".delete-selected").removeClass('disabled');
               $(".export-selected,.export-types").removeClass('disabled');
           }else{
               $(".delete-selected").addClass('disabled');
               $(".export-selected,.export-types").addClass('disabled');

           }
        }
        checkMultiDeleteButton();
        $(document).on('click','.delete-selected',function(){
            let IDS=[];
            $('.user-checkbox:checked').each(function(){
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
                        url: "{{ route('users.multi_destroy') }}",
                        data:{IDS},
                        success: function (msg) {
                            window.LaravelDataTables["users"].draw();
                            Swal.fire(msg.message, '', msg.success?'success':'error');
                        }
                    });

                }
            });
        });
        function addSelectedCount(){
            $(".selectedCount").text($(".user--checkbox:checked").length);
            let IDS=[];
            $('.user-checkbox:checked').each(function(){
                IDS.push($(this).val());
            });
            $("#exportIDS").val(IDS);
        }
        $(document).on('change','#selectAllCheckbox',function(){
            $('table#users tbody input[type="checkbox"].user-checkbox').prop('checked',$(this).is(':checked'));
            checkMultiDeleteButton();
            addSelectedCount();
        });;
        $(document).on('change','.user-checkbox',function (){
            checkMultiDeleteButton();
            addSelectedCount();
        });;
        @if(PerUser('users.destroy'))
        $(document).on('click','.delete-this',function(e){
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
                        type: "DELETE",
                        url: url,
                        success: function (msg) {
                            window.LaravelDataTables["users"].draw();
                            Swal.fire(msg.message, '', msg.success?'success':'error');
                        }
                    });

                }
            });
        });
        @endif
    </script>
@endpush
