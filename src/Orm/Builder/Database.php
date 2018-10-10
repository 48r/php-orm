<?php
  
  namespace Orm\Builder;

  class Database extends \Orm\Builder {
    
    public static function parse(\Orm $orm, array $args) {
      return 'DATABASE '. $args[0];
    }
  }