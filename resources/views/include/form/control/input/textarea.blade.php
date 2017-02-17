@extends('layouts.form.control.input.default')

@section('input')
  {{ Form::textarea($input->identifier, $input->value, ['class' => $input->cascadeStyleSheet->class,$input->readOnly]) }}
@overwrite

@section('output')
  @include('include.output.text',['text' => $input->value])
@overwrite
