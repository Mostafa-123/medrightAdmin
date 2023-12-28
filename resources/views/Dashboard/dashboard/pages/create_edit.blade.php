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
{{ (isset($page))?__('Edit'):__('Create') }}
@endsection
@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <!--end breadcrumb-->
        <div class="card radius-15 border-lg-top-primary">
            <div class="card-body">
                <div class="card-title">
                    <h4 class="mb-0">{{ (isset($page))?__('Edit :type',['type'=>$page->name]):__('Create') }}</h4>
                </div>
                <hr>
                <form method="POST"
                    action="{{ isset($page)?route('pages.update',['page'=>$page]):route('pages.store') }}"
                    enctype="multipart/form-data">
                    @if(isset($page))
                    @method('PUT')
                    @endif
                    @csrf
                    <div class="row">
                        <div class="form-group">
                            <label>{{ __('Parent') }}</label>
                            <div class="input-group input-group-lg col-12">
                                <select id="parent_id" class="custom-select " name="parent_id"
                                    data-placeholder="{{ __('Select :type',['type'=>__('Parent')]) }}">
                                    <option value="0">{{ __('Select :type',['type'=>__('Parent')]) }}</option>
                                    @foreach(\App\Models\Page::where(function
                                    ($q){$q->where('parent_id',0);})->whereNot('id',isset($page)?$page->id:0)->pluck('name','id')->toArray()
                                    as $id=>$name)
                                    <option @if((isset($page)&&$page->
                                        parent_id==$id)||(old('parent_id')&&in_array($id,old('parent_id'))))
                                        selected="selected" @endif value="{{ $id }}">{{ $name }}</option>
                                    {!! selectSup($id,(isset($page)?$page->parent_id:old('parent_id')),null,
                                    (isset($page)?$page->id:0) ,'title',\App\Models\Page::class) !!}
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div style="height: 0.5cm;"></div>
                        <x-forms.text-input-component name="name" id="name" type="text" text="Name"
                            value="{{ isset($page) ? $page->name : old('name') }}"
                            placeholder="{{ __('Enter :value', ['value' => __('Page Name')]) }}">
                        </x-forms.text-input-component>
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                        <x-forms.text-input-component name="name_ar" id="name_ar" type="text" text="الاسم"
                            value="{{ isset($page) ? $page->name_ar : old('name_ar') }}"
                            placeholder="{{ __('Enter :value', ['value' => __('اسم الصفحه')]) }}">
                        </x-forms.text-input-component>
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                        <x-forms.text-input-component name="slug" id="slug" type="text" text="Slug"
                            value="{{ isset($page) ? $page->slug : old('slug') }}"
                            placeholder="{{ __('Enter :value', ['value' => __('Page slug')]) }}">
                        </x-forms.text-input-component>
                        <x-input-error :messages="$errors->get('slug')" class="mt-2 text-danger" />

                        <x-forms.text-input-component name="sort" id="sort" type="number" text="Sort"
                            value="{{ isset($page) ? $page->sort : old('sort') }}"
                            placeholder="{{ __('Enter :value', ['value' => __('Page Sort')]) }}">
                        </x-forms.text-input-component>
                        <x-input-error :messages="$errors->get('sort')" class="mt-2 text-danger" />
                        <div class="form-group col-lg-12">
                            <label>{{ __('Status') }}</label>
                            <div class="input-group input-group-lg">
                                <select name="status" class="custom-select" id="status">
                                    <option value="">{{ __('Select :type', ['type' => __('Status')]) }}
                                    </option>
                                    <option @if (isset($page)&&$page->status=='active')
                                        selected="selected" @endif
                                        value="active">Active</option>
                                    <option @if (isset($page)&&$page->status=='unactive') selected="selected" @endif
                                        value="unactive">Unactive</option>
                                    <option @if (isset($page)&&$page->status=='draft') selected="selected" @endif
                                        value="draft">Draft</option>
                                </select>

                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('status')" class="mt-2 text-danger" />
                        <div class="form-group col-lg-12">
                            <label>{{ __('Header Style') }}</label>
                            <div class="input-group input-group-lg">
                                <select name="header_style" class="custom-select" id="header_style">
                                    <option @if (isset($page)&&$page->header_style=='white')
                                        selected="selected" @endif
                                        value="white">White</option>
                                    <option @if (isset($page)&&$page->header_style=='transparent') selected="selected"
                                        @endif
                                        value="transparent">Transparent</option>
                                </select>

                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('header_style')" class="mt-2 text-danger" />
                        <div style="height: 2cm;"></div>
                        <x-forms.text-input-component name="meta_description" id="meta_description" type="text"
                            text="Meta Description"
                            value="{{ isset($page) ? $page->meta_description : old('meta_description') }}"
                            placeholder="{{ __('Enter :value', ['value' => __('Page Meta Description')]) }}">
                        </x-forms.text-input-component>
                        <x-input-error :messages="$errors->get('meta_description')" class="mt-2 text-danger" />

                        <x-forms.text-input-component name="meta_title" id="meta_title" type="text" text="Meta Title"
                            value="{{ isset($page) ? $page->meta_title : old('meta_title') }}"
                            placeholder="{{ __('Enter :value', ['value' => __('Page Meta Title')]) }}">
                        </x-forms.text-input-component>
                        <x-input-error :messages="$errors->get('meta_title')" class="mt-2 text-danger" />

                        <x-forms.text-input-component name="meta_keywords" id="meta_keywords" type="text"
                            text="Meta Keywords"
                            value="{{ isset($page) ? $page->meta_keywords : old('meta_keywords') }}"
                            placeholder="{{ __('Enter :value', ['value' => __('Page Meta Keywords')]) }}">
                        </x-forms.text-input-component>
                        <x-input-error :messages="$errors->get('meta_keywords')" class="mt-2 text-danger" />
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
    document.addEventListener('DOMContentLoaded', function() {
    $('#parent_id').select2({
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    }).on('select2:select',function(e){
        parentDiv.addClass('loading').removeClass('d-none');
        selectedData=e.params.data;
        console.log(selectedData);
        let parent_id=selectedData.id;
        $.ajax({
            type: "GET",
            url: "{{ request()->fullUrl() }}",
            data:{parent_id},
            success: function (msg) {
                parentDiv.removeClass('loading');
                divData.append(msg.html);
                divData.find('.select2').each(function(){
                    $(this).select2({
                        placeholder: $(this).data('placeholder'),
                        allowClear: Boolean($(this).data('allow-clear')),
                    });
                });
                $('[data-toggle="tooltip"]').tooltip();
                getViewPriceListType();
            }
        });
    }).on('select2:unselect',function (e) {
        selectedData=e.params.data;
        parentDiv.addClass('loading').removeClass('d-none');
        $("#parent_"+selectedData.id).remove();
        parentDiv.removeClass('loading');
        if(!parentDiv.find('.border-provider-services').length){
            parentDiv.addClass('d-none')
        }
    });});
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
