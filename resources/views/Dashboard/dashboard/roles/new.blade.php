@extends('Dashboard.dashboard.layouts.app')
@section('title')
Roles
@endsection
@section('css')
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
        <!--end breadcrumb-->
        <div class="card radius-15 border-lg-top-primary">
            <div class="card-body">
                <div class="card-title">
                    <h4 class="mb-0">{{ isset($role) ? __('Edit :type', ['type' => $role->name]) : __('Create Role') }}
                    </h4>
                </div>
                <hr>
                <form method="POST"  action="{{ isset($role) ? route('roles.update', ['role'=>$role->id]) : route('roles.store') }}">
                    @if (isset($role))
                    @method('PUT')
                    @endif
                    @csrf
                    <div class="form-group">
                        <x-forms.text-input-component name="name" id="name" type="text" text="Role Name"
                            value="{{ isset($role) ? $role->name : old('name') }}"
                            placeholder="{{ __('Enter :value', ['value' => __('Role Name')]) }}">
                        </x-forms.text-input-component>
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                        @include('Dashboard.dashboard.permissions')
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

<!-- jQuery (required for DataTables plugin) -->
<script src="{{ asset('assets') }}/js/lib/jquery.min.js"></script>

<!-- Page JS Plugins -->

<!-- Page JS Code -->
<script src="{{ asset('assets') }}/js/pages/be_tables_datatables.min.js"></script>
<script>
    let countCheckbox = 0
        $("tbody tr").each(function() {
            let isChecked = true
            $(this).find("[name='permissions[]']").each(function() {
                isChecked = $(this).is(':checked')
                if (!$(this).is(':checked')) {
                    return false;
                }
            });
            $(this).find("[name='permissions[]']").each(function(key, item) {
                console.log(item, 'itme')
                console.log(key, 'key')
            })
            $(this).find('td:first .selectAllPermission').prop('checked', isChecked)
        })
        let allChecked = true;
        $(".selectAllPermission").each(function() {
            allChecked = $(this).is(':checked');
            if (!$(this).is(':checked')) {
                return false;
            }
        });
        console.log(allChecked);
        $("#users_select_all").prop('checked', allChecked);
        $(document).on('change', "#roles_select_all", function() {
            $(this).parent().parent().parent().parent().parent().find('tbody input[type="checkbox"]').prop(
                'checked', $(this).is(':checked'))
        });
        $(document).on('change', '.selectAllPermission', function() {
            $(this).parent().parent().parent().find('input[type="checkbox"]').prop('checked', $(this).is(
                ':checked'));
            checkRoleSelectAll()

        })

        function checkRoleSelectAll() {
            let allCheckedPermissions = true;
            $('tbody input[type="checkbox"]').each(function() {
                allCheckedPermissions = $(this).is(':checked');
                console.log($(this).is(':checked'))
                if (!$(this).is(':checked')) {
                    return false;
                }
            })
            $("#roles_select_all").prop('checked', allCheckedPermissions)
        }
        checkRoleSelectAll()
</script>
@endsection
