<?php
  
  namespace Orm\Builder;

  class Table extends \Orm\Builder {
    
    public static function parse(\Orm $orm, array $args) {
      return 'TABLE `'. $args[0] .'`';
    }
  }