<?php
  
  namespace Orm\Builder;

  class From extends \Orm\Builder {
    
    public static function parse(\Orm $orm, array $args) {
      if(empty($args[0])) {
        $args[0] = get_called_class();
      }
      return 'FROM `'. $args[0] .'`';
    }
  }