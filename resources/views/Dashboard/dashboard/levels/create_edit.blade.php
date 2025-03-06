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
{{ (isset($lavel))?__('Edit'):__('Create') }}
@endsection
@section('content')

<div class="page-content-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <!--end breadcrumb-->
        <div class="card radius-15 border-lg-top-primary">
            <div class="card-body">
                <div class="card-title">
                    <h4 class="mb-0">{{ (isset($level))?__('Edit :type',['type'=>$level->name]):__('Create') }}</h4>
                </div>
                <hr>
                <form method="POST"
                    action="{{ isset($level)?route('levels.update',['level'=>$level]):route('levels.store') }}"
                    enctype="multipart/form-data">
                    @if(isset($level))
                    @method('PUT')
                    @endif
                    @csrf
                    <div class="row">
                        <div style="height: 0.5cm;"></div>
                        <x-forms.text-input-component name="name" id="name" type="text" text="Name"
                            value="{{ isset($level) ? $level->name : old('name') }}"
                            placeholder="{{ __('Enter :value', ['value' => __('Level Name')]) }}">
                        </x-forms.text-input-component>
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
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
<script src="{{asset('assets')}}/js/dashmix.app.min.js"></script>

<!-- jQuery (required for DataTables plugin) -->
<script src="{{asset('assets')}}/js/lib/jquery.min.js"></script>

<!-- Page JS Plugins -->

<!-- Page JS Code -->
<script src="{{asset('assets')}}/js/pages/be_tables_datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    {{--  document.addEventListener('DOMContentLoaded', function() {
        $("#parent_id").select2({
            ajax: {
                url: "{{ route('getAllPagesList') }}",
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

    });  --}}
    let countCheckbox=0
$("tbody tr").each(function(){
    let isChecked=true
    $(this).find("[name='permissions[]']").each(function(){
        isChecked=$(this).is(':checked')
        if(!$(this).is(':checked')){
            return false;
        }
    });
    $(this).find("[name='permissions[]']").each(function(key,item){
        console.log(item,'itme')
        console.log(key,'key')
    })
    $(this).find('td:first .selectAllPermission').prop('checked',isChecked)
})
let allChecked=true;
$(".selectAllPermission").each(function(){
    allChecked=$(this).is(':checked');
    if(!$(this).is(':checked')){
        return false;
    }
});
console.log(allChecked);
$("#pages_select_all").prop('checked',allChecked);
$(document).on('change',"#roles_select_all",function(){
    $(this).parent().parent().parent().parent().parent().find('tbody input[type="checkbox"]').prop('checked',$(this).is(':checked'))
});
$(document).on('change','.selectAllPermission',function(){
    $(this).parent().parent().parent().find('input[type="checkbox"]').prop('checked',$(this).is(':checked'));
    checkRoleSelectAll()

})
function checkRoleSelectAll(){
    let allCheckedPermissions=true;
    $('tbody input[type="checkbox"]').each(function(){
        allCheckedPermissions=$(this).is(':checked');
        console.log($(this).is(':checked'))
        if(!$(this).is(':checked')){
            return false;
        }
    })
    $("#roles_select_all").prop('checked',allCheckedPermissions)
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
$('input[name="permissions[]"]').prop('checked', false).prop('hidden',false);
console.log("Number of permissions: " + selectedPermissions.length);
selectedPermissions.forEach(function(permission) {
    var trimmedValue = $.trim(permission.name);
    $('input[value="' + trimmedValue + '"]').prop('hidden',true).prop('checked', true);
});
}

    $(document).ready(function () {
        $('#parent_id').on('change', function () {
            var selectedRoles = $(this).val();
            roleData(selectedRoles);
        });

        roleData($('#parent_id').val());
    });
</script>
@endsection
