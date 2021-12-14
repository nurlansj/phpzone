<?php
namespace Vendor\Models;

use Vendor\Services\Db;

abstract class ActiveRecordEntity
{
    /** @var int */
    protected $id;

    public function getId(): int
    {
        return $this->id;
    }
    
    public function __set($name, $value) {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    /**
     * @return static[]
     */
    public static function findAll(): array {
        $db = Db::getInstance();
        $entities = $db->query('SELECT * FROM `' . static::getTableName() . '`;', [], static::class);
        return $entities;
    }
    /**
     * @param int $id
     * @return static|null
     */
    public static function getById(int $id): ?self {
        $db = Db::getInstance();
        $entities = $db->query('SELECT * FROM `' . static::getTableName() . '` WHERE id=:id', ['id' => $id], static::class);
        return $entities ? $entities[0] : null;
    }

    private function underscoreToCamelCase(string $source): string {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }
    abstract protected static function getTableName(): string;
}