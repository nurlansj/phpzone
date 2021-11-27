<?php
namespace Vendor\Models;
use Vendor\Services\Db;

abstract class ActiveRecordEntity
{
    /** @var int */
    protected $id;

    /** 
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    public function __set($name, $value) {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    /**
     * @return Article[]
     */
    public static function findAll(): array {
        $db = Db::getInstance();
        return $db->query('SELECT * FROM `'. static::getTableName() .'`;', [], static::class);
    }
        
    /**
     * @param int $id
     * @return static/null
     */
    public static function getById(int $id): ?self {
        $db = Db::getInstance();
        $entities = $db->query(
            'SELECT * FROM `' . static::getTableName() . '`;',
            [':id' => $id],
            static::class
        );
        return $entities ? $entities[0] : null;
    }
    
    private function underscoreToCamelCase(string $string): string {
        return lcfirst(str_replace('_', '', ucwords($string, '_')));
    }

    abstract protected static function getTableName(): string;
}