<?php

  namespace Orm;

  class Builder {

    private $parsed = [];

    public function __construct(\Orm $orm, $components) {
      $components = self::sortComponents($components);
      foreach($components as $name => $args) {
        $clazz = '\\Orm\\Builder\\'. ucfirst(strtolower($name));
        if(!class_exists($clazz)) {
          throw new \OrmBuilderComponentNotImplementedException('Unable to locate builder "'. $clazz .'" for "'. $name .'" component');
        }
        $this->parsed[$name] = $clazz::parse($orm, $args);
      }
    }

    public function sql() {
      return implode(' ', $this->parsed);
    }

    public static function parse(\Orm $orm, array $args) {
      throw new \OrmBuilderParserNotImplementedException('Should implement own parse method for component');
    }

    private static function sortComponents(array $components) : array {
      uksort($components, function($a, $b){
        $values = [
          'select' => 0,
          'delete' => 0,
          'insert' => 0,
          'update' => 0,
          'alter' => 0,
          'show' => 0,
          'drop' => 0,
          'create' => 0,
          'truncate' => 0,
          'set' => 1,
          'from' => 1,
          'table' => 1,
          'database' => 1,
          'columns' => 2,
          'join' => 2,
          'leftJoin' => 2,
          'rightJoin' => 2,
          'innerJoin' => 2,
          'on' => 2,
          'where' => 3,
          'andWhere' => 4,
          'orWhere' => 4,
          'groupBy' => 5,
          'having' => 6,
          'orderBy' => 7,
          'limit' => 8,
          'offset' => 9
        ];
        return $values[$a] <=> $values[$b];
      });
      return $components;
    }

  }