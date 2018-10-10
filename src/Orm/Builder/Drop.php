<?php
  
  namespace Orm\Builder;

  class Drop extends \Orm\Builder {
    
    public static function parse(\Orm $orm, array $args) {
      return 'DROP';
    }
  }