<div class="panel panel-default">
  <div class="panel-heading">
    @yield('content_header')
    @section('content_header')
        {{ $page->contentTitle }}
    @show
  </div>
  <div class="panel-body">
    @include('layouts/message/default')
    @yield('content_body')
  </div>
  <!--div class="panel-footer">@yield('content_footer')</div-->
</div>
