<?php
  
  namespace Orm\Builder;

  class Andwhere extends \Orm\Builder\Where {
      
    public static function parse(\Orm $orm, array $args) {
      $where = parent::parse($orm, $args);
      return self::$delimiter . substr($where, 4);
    }
  }