@extends('Dashboard.dashboard.layouts.app')
@section('title')
Request {{ $request->full_name }}
@endsection
@section('css')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet" />
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('vendor') }}/plugins/cropperjs/dist/cropper.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('vendor') }}/styles/style.css" />
<style>
    .profile-image{
        width: 200px;
        height: 200px;
        border-radius: 50%;
    }
</style>
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
                {{-- <div class="card-title"> --}}
                    {{-- <h4 class="mb-0">{{ __('Request') }} {{ $request->full_name }}
                    </h4> --}}
                    <section class="profile-sec">


                          <div class="row">
                            <div class="col-lg-4">
                              <div class="card mb-4">
                                <div class="card-body text-center">
                                  <img class="profile-image"  src="{{ $request->getFirstMediaUrl('requests_personal_images') }}">
                                  <input type="file" id="fileInput" style="display: none;" onchange="handleFileSelect()">
                                  <h5 class="my-3">{{ $request->full_name }}</h5>
                                  <p class="text-muted mb-1">{{ $request->currant_position }} @if($request->employed=='yes')
                                    <a class="text-primary-lighter" href="javascript:void(0)">{{ $request->company_name
                                        }}</a>
                                    @endif</p>
                                  <div class="d-flex justify-content-center mb-2">
                                  </div>
                                </div>
                              </div>
                              <div class="card mb-4 mb-lg-0">
                                <div class="card-body p-0">
                                  <ul class="list-group list-group-flush rounded-3">
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                      <a href="https://www.google.com/intl/ar/gmail/about/"  target="_blank"><img class="icon" src="{{ asset('icon/Gmail_icon_(2020).svg.png') }}" width="10%;" alt=""></a>

                                      <a href="https://www.google.com/intl/ar/gmail/about/" target="_blank">{{ $request->email }}</a>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-8">
                              <div class="card mb-4">
                                <div class="card-body">
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Applied Before</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0">{{ $request->applied }}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Phone Number</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0">{{ $request->phone }}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Gender</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0">{{ $request->gender }}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Position</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0">{{ $request->position->name }}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Level</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0">{{ $request->level->name }}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Live In Cairo</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0">{{ $request->live_in_cairo }}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Address</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0">{{ $request->address }}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">College</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0">{{ $request->college }}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Degree</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0">{{ $request->degree }}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Work Style</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0">{{ $request->work_style }}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Employment</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0">{{ $request->employment }}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Experience</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0">{{ $request->experience }} year</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">CV</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0"><a class="btn btn-primary" href="{{ $request->getFirstMediaUrl('requests_personal_cvs') }}">Cv</a>
                                      </p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Currant Salary</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0"> {{ $request->currant_salary }}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Expected Salary</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0"> {{ $request->expected_salary }}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Birth Date</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0"> {{ $request->birth_date }}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Projects Links</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0"> <a class="text-primary-lighter" href="{{ $request->projects_links }}">{{
                                        $request->projects_links }}</a></p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Skillset</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0"> {{ $request->skillset }}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Experience Essay</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0"> {{ $request->experience_essay }}</p>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Have Laptop</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0"> {{ $request->have_laptop }}</p>
                                    </div>
                                  </div>
                                  @if ($request->have_laptop=='yes')
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0">Laptop Brand</p>
                                    </div>
                                    <div class="col-sm-9">
                                      <p class="text-muted mb-0"> {{ $request->laptop_brand }}</p>
                                    </div>
                                  </div>
                                            @endif

                                </div>
                              </div>

                            </div>
                            <div class="text-end">
                              <button type="button" class="btn btn-outline-primary ms-1 export-type" data-type="excel">Export</button>
                              <form action="{{ route('requests.export') }}" method="POST"
                                        class="d-inline-block">
                                        <input type="hidden" name="export_type" value="excel">
                                        <input type="hidden" name="id" value="{{ $request->id }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        @csrf
                                    </form>
                            </div>
                          </div>
                      </section>


                </div>
                <hr>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>


<script src="{{asset('assets')}}/js/dashmix.app.min.js"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"></script>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2973766580778258"
    crossorigin="anonymous"></script>
<script>
    window.dataLayer = window.dataLayer || [];
  function gtag() {
	  dataLayer.push(arguments);
  }
  gtag("js", new Date());

  gtag("config", "G-GBZ3SGGX85");
</script>
<script>
    $(document).on('click', '.export-type', function(e) {
        e.preventDefault();
        let form = $(this).closest('div').find('form');
        form.find('[name="export_type"]').val($(this).attr('data-type'));
        form.submit();
    });

    $(document).on('click', '.export-selected', function() {
        let form = $('#exportData');
        form.find('[name="export_type"]').val('excel'); // or set the export type dynamically if needed
        form.submit();
    });

    function checkMultiDeleteButton() {
        if ($(".request-checkbox").is(':checked')) {
            $(".delete-selected").removeClass('disabled');
            $(".export-selected,.export-types").removeClass('disabled');
        } else {
            $(".delete-selected").addClass('disabled');
            $(".export-selected,.export-types").addClass('disabled');
        }
    }

    // Attach the click events for the "Export" and "Export Selected" buttons
    $(document).on('click', '.export-type, .export-selected', function() {
        checkMultiDeleteButton();
    });

  checkMultiDeleteButton();
    $(document).on('click', '.delete-selected', function() {
      let IDS = [];
      $('.request-checkbox:checked').each(function() {
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
                  {{--  url: "{{ route('transactions.multi_destroy') }}",  --}}
                  data: {
                      IDS
                  },
                  success: function(msg) {
                      window.LaravelDataTables["requests"].draw();
                      Swal.fire(msg.message, '', msg.success ? 'success' : 'error');
                  }
              });

          }
      });
  });

  function addSelectedCount() {
      $(".selectedCount").text($(".request-checkbox:checked").length);
      let IDS = [];
      $('.request-checkbox:checked').each(function() {
          IDS.push($(this).val());
      });
      $("#exportIDS").val(IDS);
  }
  $(document).on('change', '#selectAllCheckbox', function() {
      $('table#requests tbody input[type="checkbox"].request-checkbox').prop('checked', $(this).is(
          ':checked'));
      checkMultiDeleteButton();
      addSelectedCount();
  });
  $(document).on('change', '.request-checkbox', function() {
      checkMultiDeleteButton();
      addSelectedCount();
  });

  $(document).on('click','#delete-this',function(e){
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
                  method: "delete",
                  url: url,
                  data: {
              "_token": "{{ csrf_token() }}"},
                  success: function (msg) {
                      window.LaravelDataTables["requests"].draw();
                      Swal.fire(msg.message, '', msg.success?'success':'error');
                  }
              });

          }
      });
  });
</script>

<!-- Google Tag Manager -->
<script>
    (function (w, d, s, l, i) {
	  w[l] = w[l] || [];
	  w[l].push({ "gtm.start": new Date().getTime(), event: "gtm.js" });
	  var f = d.getElementsByTagName(s)[0],
		  j = d.createElement(s),
		  dl = l != "dataLayer" ? "&l=" + l : "";
	  j.async = true;
	  j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
	  f.parentNode.insertBefore(j, f);
  })(window, document, "script", "dataLayer", "GTM-NXZMQSS");
</script>
<script src="{{ asset('vendor') }}/scripts/script.min.js"></script>
<script src="{{ asset('vendor') }}/scripts/process.js"></script>
<script src="{{ asset('vendor') }}/scripts/layout-settings.js"></script>
<script src="{{ asset('vendor') }}/plugins/cropperjs/dist/cropper.js"></script>
<script>
    window.addEventListener("DOMContentLoaded", function () {
				var image = document.getElementById("image");
				var cropBoxData;
				var canvasData;
				var cropper;

				$("#modal")
					.on("shown.bs.modal", function () {
						cropper = new Cropper(image, {
							autoCropArea: 0.5,
							dragMode: "move",
							aspectRatio: 3 / 3,
							restore: false,
							guides: false,
							center: false,
							highlight: false,
							cropBoxMovable: false,
							cropBoxResizable: false,
							toggleDragModeOnDblclick: false,
							ready: function () {
								cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
							},
						});
					})
					.on("hidden.bs.modal", function () {
						cropBoxData = cropper.getCropBoxData();
						canvasData = cropper.getCanvasData();
						cropper.destroy();
					});
			});
</script>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
        style="display: none; visibility: hidden"></iframe></noscript>
@endsection
