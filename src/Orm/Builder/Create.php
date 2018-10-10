<?php
  
  namespace Orm\Builder;

  class Create extends \Orm\Builder {
    
    public static function parse(\Orm $orm, array $args) {
      return 'CREATE';
    }
  }