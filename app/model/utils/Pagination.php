<?php

namespace App\Model\Utils;

class Pagination {

  public $firstIndex;
  public $pageSize;

  function __construct($firstIndex,$pageSize) {
    $this->firstIndex = $firstIndex;
    $this->pageSize = $pageSize;
  }

}
