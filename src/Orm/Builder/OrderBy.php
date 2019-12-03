<?php
  
  namespace Orm\Builder;

  class OrderBy extends \Orm\Builder {
    protected static $delimiter = ', ';

    public static function parse(\Orm $orm, array $args) {
      $order = [];
      switch(gettype($args[0])) {
        case 'array':
          foreach($args[0] as $column) {
            $order[] = $column;
          }
          break;
        case 'string':
          $order[] = $args[0];
          break;
      }
      return 'ORDER BY '. implode(self::$delimiter, $order);
    }
  }