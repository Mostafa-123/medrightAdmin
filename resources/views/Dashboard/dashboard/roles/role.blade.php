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
<div class="block block-rounded">
    <h2 class="content-heading">Inline</h2>
    <div class="row">
      <div class="col-lg-4">

      </div>
      <div class="col-lg-8 space-y-2">
        <!-- Form Inline - Default Style -->
        <form class="row row-cols-lg-auto g-3 align-items-center" action="{{ route('update_role',$role->id) }}" method="POST">
            @csrf
          <div class="col-12">
            <label class="visually-hidden" for="name">{{ $role->name }}</label>
            <input type="text" class="form-control" id="name"  name="name" value="{{ $role->name }}">
          </div>
          <div class="text-center">
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

