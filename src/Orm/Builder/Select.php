<?php
  
  namespace Orm\Builder;

  class Select extends \Orm\Builder {
    
    public static function parse(\Orm $orm, array $args) {
      if(empty($args[0])) {
        $args[0] = '*';
      }
      return 'SELECT '. $args[0];
    }
  }