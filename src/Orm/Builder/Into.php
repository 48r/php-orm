<?php
  
  namespace Orm\Builder;

  class Into extends \Orm\Builder {
    
    public static function parse(\Orm $orm, array $args) {
      return 'INTO `'. $args[0] .'`';
    }
  }