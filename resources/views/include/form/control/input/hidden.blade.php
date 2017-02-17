@extends('layouts.form.control.input.hidden')

@section('input')
  {{ Form::hidden($input->identifier, $input->value) }}
@overwrite
