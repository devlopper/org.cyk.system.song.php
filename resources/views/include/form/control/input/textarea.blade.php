@extends('layouts.form.control.input.default')

@section('input')
  {{ Form::textarea($input->identifier, $input->value, ['class' => $input->cascadeStyleSheet->class]) }}
@overwrite
