@extends('Dashboard.auth.layouts.app')
@section('title')
sign up
@endsection
@section('content')
<div class="bg-image" style="background-image: url('assets/media/photos/photo12@2x.jpg');">
    <div class="row g-0 justify-content-center bg-black-75">
      <!-- Main Section -->
      <div class="hero-static col-md-6 d-flex align-items-center bg-body-extra-light">
        <div class="p-3 w-100">
          <!-- Header -->
          <div class="mb-3 text-center">
            <a class="link-fx fw-bold fs-1" href="index.html">
              <span class="text-dark">Dash</span><span class="text-primary">mix</span>
            </a>
            <p class="text-uppercase fw-bold fs-sm text-muted">Create New Account</p>
          </div>
          <!-- END Header -->

          <!-- Sign Up Form -->
          <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
          <div class="row g-0 justify-content-center">
            <div class="col-sm-8 col-xl-6">
              <form class="js-validation-signup" action="{{ route('register') }}" method="POST">
                @csrf

                <div class="py-3">
                  <div class="mb-4">
                    <input type="text" class="form-control form-control-lg form-control-alt" id="name"  value="{{ old('name') }}" name="name" placeholder="Name">
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                  </div>
                  <div class="mb-4">
                    <input type="email" class="form-control form-control-lg form-control-alt" id="email"  value="{{ old('email') }}" name="email" placeholder="Email">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />

                  </div>
                  <div class="mb-4">
                    <input type="number" min="0" class="form-control form-control-lg form-control-alt" id="phone"  value="{{ old('phone') }}" name="phone" placeholder="Phone">
                    <x-input-error :messages="$errors->get('phone')" class="mt-2 text-danger" />

                  </div>
                  <div class="mb-4">
                    <input type="password" class="form-control form-control-lg form-control-alt" id="password" name="password" placeholder="Password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                  </div>
                  <div class="mb-4">
                    <input type="password" class="form-control form-control-lg form-control-alt" id="password_confirmation" name="password_confirmation" placeholder="Password Confirm">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />

                </div>
                  <div class="mb-4">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="signup-terms" name="signup-terms">
                      <label class="form-check-label" for="signup-terms">I agree to Terms &amp; Conditions</label>
                    </div>
                  </div>
                </div>
                <div class="mb-4">
                  <button type="submit" class="btn w-100 btn-lg btn-hero btn-primary">
                    <i class="fa fa-fw fa-plus opacity-50 me-1"></i> Sign Up
                  </button>
                  <p class="mt-3 mb-0 d-lg-flex justify-content-lg-between">
                    <a class="btn btn-sm btn-alt-secondary d-block d-lg-inline-block mb-1" href="{{ route('login') }}">
                      <i class="fa fa-sign-in-alt opacity-50 me-1"></i> Sign In
                    </a>
                    <a class="btn btn-sm btn-alt-secondary d-block d-lg-inline-block mb-1" href="#" data-bs-toggle="modal" data-bs-target="#modal-terms">
                      <i class="fa fa-book opacity-50 me-1"></i> Read Terms
                    </a>
                  </p>
                </div>
              </form>
            </div>
          </div>
          <!-- END Sign Up Form -->
        </div>
      </div>
      <!-- END Main Section -->
    </div>

    <!-- Terms Modal -->
    <div class="modal fade" id="modal-terms" tabindex="-1" role="dialog" aria-labelledby="modal-terms" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="block block-themed block-transparent mb-0">
            <div class="block-header bg-primary-dark">
              <h3 class="block-title">Terms &amp; Conditions</h3>
              <div class="block-options">
                <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                  <i class="fa fa-fw fa-times"></i>
                </button>
              </div>
            </div>
            <div class="block-content">
              <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
              <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
              <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
              <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
              <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
            </div>
            <div class="block-content block-content-full text-end bg-body">
              <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Done</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END Terms Modal -->
  </div>
@endsection

