@foreach ($controlCollection->controls as $input)
  @include($input->includedLayout)
@endforeach
