<?php
  
  namespace Orm\Builder;

  class Insert extends \Orm\Builder {
    
    public static function parse(\Orm $orm, array $args) {
      return 'INSERT';
    }
  }