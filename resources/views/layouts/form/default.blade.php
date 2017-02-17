{{ Form::model($form, ['action' => $form->submitCommand->action , 'enctype' => 'multipart/form-data'] ) }}

  @foreach ($form->controlCollections as $controlCollection)
    @include($controlCollection->includedLayout)
  @endforeach

  @include($form->commandCollection->includedLayout,['collection' => $form->commandCollection])

{{ Form::close() }}
