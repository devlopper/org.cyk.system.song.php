<!--
<div class="form-group">
    {{ Form::label($input->identifier, $input->name) }}
    @yield('input')
</div>
-->

<div class="form-group">
    {{ Form::label($input->identifier, $input->name) }}
    @if($input->isReadOnly())
      @yield('output')
    @else
      @yield('input')
    @endif
</div>

<!--

@if($input->isReadOnly())
  @yield('output')
@else
  @yield('input')
@endif

 -->
