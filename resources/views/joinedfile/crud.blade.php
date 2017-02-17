@extends('layouts.page.up_right_bottom_left')

@section('content_body')
  @include($form->includedLayout,['form' => $form])
@endsection
