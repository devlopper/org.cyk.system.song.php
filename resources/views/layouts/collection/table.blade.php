<table id="{{$table->identifier}}" class="display" width="100%" cellspacing="0">
  {{-- Header  --}}
  <thead>
    <tr>
      <td>
        @section('td.count.content')
          #
        @show
      </td>

      @foreach ($table->columns as $column)
        <td>
          {{$column->name}}
        </td>
      @endforeach

      <td>
        Actions
      </td>

    </tr>
  </thead>

  {{-- Details --}}
  <!--tbody>
    @foreach ($table->rows as $row)
      <tr>
        <td>
          {{$loop->index+1}}
        </td>

        @foreach ($table->columns as $column)
          <td>
            {{$row->cells[$loop->index]->value}}
          </td>
        @endforeach

        <td>
          @foreach ($row->commands as $command)
            <p>
              {{$command->name}}
            </p>
          @endforeach
        </td>

      </tr>
    @endforeach
  </tbody-->

</table>
