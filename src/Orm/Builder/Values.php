<?php
  
  namespace Orm\Builder;

  class Values extends \Orm\Builder {
    
    public static function parse(\Orm $orm, array $args) {
      $columns = array_keys($args[0]);
      return '('. implode(', ', $columns) .') VALUES(:'. implode(', :', $columns) .')';
    }
  }