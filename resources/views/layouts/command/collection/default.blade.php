@foreach ($collection->commands as $command)
  @include($command->includedLayout)
@endforeach
