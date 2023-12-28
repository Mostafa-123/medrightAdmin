@extends('Dashboard.dashboard.layouts.app')
@section('title')
    Permissions
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet"
        href="{{ asset('assets') }}/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css">
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
                        <h4 class="mb-0">{{ __('Permissions') }}
                            @if (PerUser('permissions.create'))
                            <a href="{{ route('permissions.create') }}" class="btn btn-primary" style="float: right;">New
                                Permission</a>                            @endif
                        </h4>

                    </div>
                    <hr>
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th style="width: 80px;">ID</th>
                                <th style="width: 80px;">Group</th>
                                <th style="width: 80px;">Name</th>
                                <th class="d-none d-sm-table-cell" style="width: 15%;">Actions</th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->group }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        <div class="row" style="float: right;">
                                            <a style="padding: 1px 0px ; width: 30px" class="btn btn-info m-1"
                                                href="{{ route('permissions.edit', ['permission'=>$permission->id]) }}">&ocir;</a>
                                            <a style="padding: 1px 0px ; width: 30px" class="btn btn-danger m-1"
                                                href="{{ route('permissions.destroy', [$permission->id]) }}">&Cross;</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets') }}/js/dashmix.app.min.js"></script>

    <!-- jQuery (required for DataTables plugin) -->
    <script src="{{ asset('assets') }}/js/lib/jquery.min.js"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('assets') }}/js/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-buttons/dataTables.buttons.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-buttons-jszip/jszip.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-buttons-pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-buttons-pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-buttons/buttons.print.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/datatables-buttons/buttons.html5.min.js"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('assets') }}/js/pages/be_tables_datatables.min.js"></script>
@endsection
