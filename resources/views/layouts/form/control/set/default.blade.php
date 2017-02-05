@foreach ($controls as $control)
  @include($control->includedLayout)
@endforeach
