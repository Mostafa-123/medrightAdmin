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
{{ (isset($user))?__('Edit'):__('Create') }}
@endsection
@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="card radius-15 border-lg-top-primary">
            <div class="card-body">
                <div class="card-title">
                    <h4 class="mb-0">{{ isset($user) ? __('Edit :type', ['type' => $user->name]) : __('Create User') }}
                    </h4>
                </div>
                <hr>
                <form method="POST"
                    action="{{ isset($user) ? route('users.update', ['user' => $user]) : route('users.store') }}"
                    enctype="multipart/form-data">
                    @if (isset($user))
                    @method('PUT')
                    @endif
                    @csrf
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label>{{ __('Role') }}</label>
                            <div class="input-group g-r-left">
                                <select name="role_id[]" class="select2 custom-select" id="role_id" >

                                    <option value="0">{{ __('Select :Role',['Role'=>__('All Roles')]) }}</option>
                                    @foreach(\Spatie\Permission\Models\Role::pluck('name','id')->toArray() as $id=>$name)
                                    <option @if(request()->has('role_id') && request()->query('role_id') == $id)
                                        selected="selected" @endif value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @include('Dashboard.dashboard.permissions')

                        <x-forms.text-input-component name="name" id="name" type="text" text="Name"
                            value="{{ isset($user) ? $user->name : old('name') }}"
                            placeholder="{{ __('Enter :value', ['value' => __('Name')]) }}"></x-forms.text-input-component>
                            <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />

                        <x-forms.text-input-component name="phone" id="phone" type="number" text="Phone"
                            value="{{ isset($user) ? $user->phone : old('phone') }}"
                            placeholder="{{ __('Enter :value', ['value' => __('Phone')]) }}"></x-forms.text-input-component>
                            <x-input-error :messages="$errors->get('phone')" class="mt-2 text-danger" />

                        <x-forms.text-input-component name="email" id="email" type="email" text="Email"
                            value="{{ isset($user) ? $user->email : old('email') }}"
                            placeholder="{{ __('Enter :value', ['value' => __('Email')]) }}"></x-forms.text-input-component>
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />

                        <x-forms.text-input-component name="password" id="password" type="password" text="Password" value=""
                            placeholder="{{ __('Enter :value', ['value' => __('Password')]) }}">
                        </x-forms.text-input-component>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />

                    </div>

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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $("#role_id").select2({
            ajax: {
                url: "{{ route('getAllRolesList') }}",
                dataType: 'json',
                type: 'get',
                data: function(params) {
                    return {
                        q: params.term,
                        selected: $(this).val(),
                        _token: "{{ csrf_token() }}",
                    };
                },
                processResults: function(data, params) {

                    return {
                        results: data,
                    };
                },

            }
        })

    });
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
<script>
    function roleData(role_id) {
            $.ajax({
                url: "{{ route('roles.rolesPermissions') }}",
                method: "POST",
                data: {
                    'array': JSON.stringify(role_id),
                    '_token': "{{ csrf_token() }}",

                },
                success: function(data) {
                    updateCheckboxes(data.data);
                },
                error: function() {
                    console.log('Error fetching data');
                }
            });
        }

        function updateCheckboxes(selectedPermissions) {
            $('input[name="permissions[]"]').prop('checked', false).prop('hidden', false);
            console.log("Number of permissions: " + selectedPermissions.length);
            selectedPermissions.forEach(function(permission) {
                var trimmedValue = $.trim(permission.name);
                $('input[value="' + trimmedValue + '"]').prop('hidden', true).prop('checked', true);
            });
        }

        $(document).ready(function() {
            $('#role_id').on('change', function() {
                var selectedRoles = $(this).val();
                roleData(selectedRoles);
            });

            roleData($('#role_id').val());
        });
</script>
@endsection
