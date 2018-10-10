<?php
  
  namespace Orm\Builder;

  class Limit extends \Orm\Builder {
    
    public static function parse(\Orm $orm, array $args) {
      return 'LIMIT '. $args[0];
    }
  }