<?php

namespace App\Http\Controllers\Playground;

class TemplateController {

  public function upRightBottomLeft(){
    $page = new \App\Model\Page\Page();
    $page->title ="Templates";
    return view('playground/template/up_right_bottom_left',['page' => $page]);
  }

}
