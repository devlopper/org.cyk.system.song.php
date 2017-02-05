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
      <h1>UP</h1>
  @show
</nav>

<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-2 sidenav">
      @section('left')
        <h1>LEFT</h1>
      @show
    </div>
    <div class="col-sm-8 text-left">
      @if (count($errors) > 0)
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

      @yield('content')

    </div>
    <div class="col-sm-2 sidenav">
      @section('right')
        <h1>RIGHT</h1>
      @show
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  @section('footer')
    <h1>FOOTER</h1>
  @show
</footer>

</body>
</html>
