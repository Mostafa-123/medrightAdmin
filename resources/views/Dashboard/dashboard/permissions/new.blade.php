@extends('Dashboard.dashboard.layouts.app')
@section('title')
Permissions
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
        <div class="card radius-15 border-lg-top-primary">
            <div class="card-body">
                <div class="card-title">
                    <h4 class="mb-0">{{ isset($permission) ? __('Edit :type', ['type' => $permission->name]) : __('Create Permission') }}
                    </h4>
                </div>
                <hr>
                <form method="POST"  action="{{ isset($permission) ? route('permissions.update', ['permission'=>$permission->id]) : route('permissions.store') }}">
                    @if (isset($permission))
                    @method('PUT')
                    @endif
                    @csrf
                    <div class="form-group">
                        <x-forms.text-input-component name="name" id="name" type="text" text="Permission Name"
                            value="{{ isset($permission) ? $permission->name : old('name') }}"
                            placeholder="{{ __('Enter :value', ['value' => __('Permission Name')]) }}">
                        </x-forms.text-input-component>
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                            <x-forms.text-input-component name="group" id="group" type="text" text="Germission Group"
                            value="{{ isset($permission) ? $permission->group : old('group') }}"
                            placeholder="{{ __('Enter :value', ['value' => __('permission Group')]) }}">
                        </x-forms.text-input-component>
                        <x-input-error :messages="$errors->get('group')" class="mt-2 text-danger" />
                        <div class="text-center">
                            <button type="submit" class="btn btn-danger px-5">{{ __('Save') }}</button>
                        </div>
                </form>
            </div>
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
