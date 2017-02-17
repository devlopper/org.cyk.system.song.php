@if ($command->rendered == true)
<button
  class="{{$command->cascadeStyleSheet->class}}"
  type="{{$command->type}}"
  >
  {{$command->name}}
</button>
@endif
