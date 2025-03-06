<!doctype html>
<html lang="en">
  @include('Dashboard.auth.layouts.head')
  <body>

    <div id="page-container">

      <main id="main-container">
        <!-- Page Content -->
        @yield('content')
        <!-- END Page Content -->
      </main>
    </div>

    @include('Dashboard.auth.layouts.scripts')
  </body>
</html>
