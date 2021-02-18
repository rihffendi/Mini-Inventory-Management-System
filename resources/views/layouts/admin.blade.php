@include('../inc/header')

  <body class="h-100">
  
    <div class="container-fluid">
      <div class="row">
        <!--  Sidebar -->
        @include('../inc/sidebar')
        <!--  Sidebar -->

        <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
          <div class="main-navbar sticky-top bg-white">
          <!-- Navbar -->
          @include('../inc/navbar')
          <!-- Navbar -->
          
          <div class="main-content-container container-fluid px-4 mb-5">
             
             @yield('content')
             
          </div>  
          <footer class="main-footer d-flex p-2 px-3 bg-white border-top">
            <span class="copyright ml-auto my-auto mr-2">Copyright © 2021
              <a href="https://rihffendi.com" rel="nofollow">rihffendi</a>
            </span>
          </footer>
        </main>
      </div>
    </div>

    @include('../inc/footer')

  </body>
</html>