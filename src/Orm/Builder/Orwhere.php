<?php
  
  namespace Orm\Builder;

  class Orwhere extends \Orm\Builder {
    protected static $delimiter = ' OR ';
  }