@extends('layouts.page.up_right_bottom_left')

  @section('head')
  @endsection

  @section('content')
    @include($form->includedLayout,['form' => $form])
  @endsection
