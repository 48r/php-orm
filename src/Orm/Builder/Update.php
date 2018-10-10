<?php
  
  namespace Orm\Builder;

  class Update extends \Orm\Builder {
    
    public static function parse(\Orm $orm, array $args) {
      return 'UPDATE `'. $args[0] .'`';
    }
  }