@extends('layouts.form.control.input.default')

@section('input')
  {{ Form::textarea($input->identifier, get_class_vars(get_class($form))[$input->identifier], ['class' => 'form-control']) }}
@endsection
