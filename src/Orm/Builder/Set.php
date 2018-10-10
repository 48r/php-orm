<?php
  
  namespace Orm\Builder;

  class Set extends \Orm\Builder {
    
    public static function parse(\Orm $orm, array $args) {
      $args = (sizeof($args) == 1) ? $args[0] : $args ;
      $columns = [];
      foreach($args as $column => $value){
        $columns[] = '`'. $column .'` = :'. $column;
      }
      return 'SET '. implode(', ', $columns);
    }
  }