@extends('layouts.form.control.input.default')

@section('input')
  @if($input->isReadOnly())
    @include($input->exporter->includedLayout,['exporter' => $input->exporter])
  @else
    {{ Form::file($input->identifier, ['class' => $input->cascadeStyleSheet->class,$input->readOnly]) }}
  @endif

@overwrite

@section('output')
  @include($input->exporter->includedLayout,['exporter' => $input->exporter])
@overwrite
