<?php
namespace Vendor\Models;

use Vendor\Services\Db;

abstract class AciveRecordEntity
{
    protected $id;
    public function getId(): int {
        return $this->id;
    }
    public function __set($name, $value) {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }
    public function findAll(): array {
        $db = Db::getInstance();
        return $db->query('SELECT * FROM `' . static::getTableName() . '`;', [], static::class);
    }
    public function getById(): self {
        
    }
    private function underscoreToCamelCase($source) {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }
    abstract protected static function getTableName(): string;
}