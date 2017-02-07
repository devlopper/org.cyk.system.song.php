@extends('layouts.form.control.input.default')

@section('input')
  {{ Form::text($input->identifier, $input->value, ['class' => $input->cascadeStyleSheet->class,$input->readOnly]) }}
@overwrite
