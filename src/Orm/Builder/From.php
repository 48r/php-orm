<?php
  
  namespace Orm\Builder;

  class From extends \Orm\Builder {
    
    public static function parse(\Orm $orm, array $args) {
      return 'FROM `'. $args[0] .'`';
    }
  }