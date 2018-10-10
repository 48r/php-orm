<?php
  
  namespace Orm\Builder;

  class Delete extends \Orm\Builder {
    
    public static function parse(\Orm $orm, array $args) {
      return 'DELETE';
    }
  }