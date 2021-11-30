<?php
namespace Vendor\Models;

use Vendor\Services\Db;

abstract class ActiveRecordEntity
{
    protected $id;
    public function getId(): int {
        return $this->id;
    }
    public function __set($name, $value) {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }
    public static function findAll(): array {
        $db = Db::getInstance();
        return $db->query('SELECT * FROM `' . static::getTableName() . '`;', [], static::class);
    }
    public static function getById(int $articleId): ?self {
        $db = Db::getInstance();
        $entities = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` where id=:id;', 
            [':id' => $articleId], 
            static::class
        );
        return $entities ? $entities[0] : null;
    }
    private function underscoreToCamelCase($source) {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }
    abstract protected static function getTableName(): string;
}