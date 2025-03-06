@extends('Dashboard.dashboard.layouts.app')
@section('title')
Permission
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
<div class="block block-rounded" >
    <h2 class="content-heading" style="margin-left: 20px;">Update</h2>
    <div class="row">
        <div class="col-lg-8 space-y-2">
            <!-- Form Inline - Default Style -->
            <form class="row row-cols-lg-auto g-3 align-items-center" style="margin-left: 20px;"
                action="{{ route('permissions.update',['permission'=>$permission->id]) }}" method="PUT">
                @csrf
                <x-forms.text-input-component name="name" id="name" type="text" text="Name"
                    value="{{ isset($permission) ? $permission->name : old('name') }}"
                    placeholder="{{ __('Enter :value', ['value' => __('Name')]) }}"></x-forms.text-input-component>
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />

                <x-forms.text-input-component name="group" id="group" type="text" text="Group"
                    value="{{ isset($permission) ? $permission->group : old('group') }}"
                    placeholder="{{ __('Enter :value', ['value' => __('Group')]) }}"></x-forms.text-input-component>
                    <x-input-error :messages="$errors->get('group')" class="mt-2 text-danger" />
                <div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>

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
@endsection
