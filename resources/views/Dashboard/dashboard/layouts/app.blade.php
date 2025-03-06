<!doctype html>
<html lang="en">
@include('Dashboard.dashboard.layouts.head')

<body>

    <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-fixed main-content-narrow">
     @include('Dashboard.dashboard.layouts.aside')
     @include('Dashboard.dashboard.layouts.sidebar')

        @include('Dashboard.dashboard.layouts.header')

        <!-- Main Container -->
        <main id="main-container">


            <!-- Page Content -->
            @yield('content')
            <!-- END Page Content -->
        </main>
        <!-- END Main Container -->

       @include('Dashboard.dashboard.layouts.footer')
    </div>
    <!-- END Page Container -->

    <!--
      Dashmix JS

      Core libraries and functionality
      webpack is putting everything together at assets/_js/main/app.js
    -->
    @include('Dashboard.dashboard.layouts.scripts')

</body>

</html>
