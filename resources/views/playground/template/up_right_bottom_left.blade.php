@extends('layouts.page.up_right_bottom_left')

@section('page.title', 'Page Title')

@section('sidebar')
    @parent
    <p>This is appended to the master sidebar.</p>
@endsection

@section('page.content')
    <p>This is my body content.</p>
@endsection
