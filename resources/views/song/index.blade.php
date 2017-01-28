@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Songs CRUD</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" > Create New Song</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Code</th>
            <th>Name</th>
            <th>Lyrics</th>
            <th width="280px">Action</th>
        </tr>
    @foreach ($songs as $key => $song)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $song->code }}</td>
        <td>{{ $song->name }}</td>
        <td>{{ $song->lyrics }}</td>
        <td>
            <a class="btn btn-info" >Show</a>
            <a class="btn btn-primary" >Edit</a>
            
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

            {!! Form::close() !!}

        </td>
    </tr>
    @endforeach
    </table>

    {!! $songs->render() !!}
@endsection
