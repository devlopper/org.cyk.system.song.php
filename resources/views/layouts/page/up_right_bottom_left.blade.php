<!DOCTYPE html>
<html lang="en">
<head>
  <title>{{ $page->title }}</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="{{ URL::asset('js/jquery/jquery_min_3_1_1.js') }}"></script>
  <script src="{{ URL::asset('js/bootstrap_min_3_3_7.js') }}"></script>
  <script src="{{ URL::asset('js/jquery_datatables_bootstrap_min_1_10_13.js') }}"></script>

  <link rel="stylesheet" href="{{ URL::asset('css/bootstrap_min_3_3_7.css') }}"/>
  <link rel="stylesheet" href="{{ URL::asset('css/jquery_datatables_bootstrap_min_1_10_13.css') }}"/>

  <link rel="stylesheet" href="{{ URL::asset('css/css.css') }}"/>

  @yield('head')
</head>
<body>

<nav class="navbar navbar-inverse">
  @section('up')
      @include('layouts/page/up/default')
  @show
</nav>

<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-2 sidenav">
      @section('left')
        @include('layouts/page/left/default')
      @show
    </div>
    <div class="col-sm-8 text-left">

      @include('layouts/page/content/titleup_contentbody_footerdown')

    </div>
    <div class="col-sm-2 sidenav">
      @section('right')
        @include('layouts/page/right/default')
      @show
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  @section('footer')
    @include('layouts/page/footer/default')
  @show
</footer>

</body>
</html>
