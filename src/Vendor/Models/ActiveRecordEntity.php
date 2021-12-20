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
    public function save(): void {
        $mappedProperties = $this->mapPropertiesToDbFormat();
        if ($this->id !== null) {
            $this->update($mappedProperties);
        } else {
            $this->insert($mappedProperties);
        }
    }
    private function update(array $mappedProperties): void {
        $columns2params = [];
        $params2values = [];
        $index = 1;
        foreach ($mappedProperties as $column => $value) {
            $param = ':param' . $index;
            $columns2params[] = $column . ' = ' . $param;
            $params2values[$param] = $value;
            $index++;
        }
        $sql = 'UPDATE `' . static::getTableName() . '` SET ' . implode(',', $columns2params) . ' WHERE id = ' . $this->id . ';';
        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);    
    }
    private function insert(array $mappedProperties): void {
        $filteredProperties = array_filter($mappedProperties);
        $columns = [];
        $paramsNames = [];
        $params2values = [];
        foreach ($filteredProperties as $column => $value) {
            $columns[] = '`' . $column . '`';
            $paramName = ':' . $column;
            $paramsNames[] = $paramName;
            $params2values[$paramName] = $value;
        }
        $columnsViaComma = implode(', ', $columns);
        $paramsNamesViaComma = implode(', ', $paramsNames);
        $sql = 'INSERT INTO `' . static::getTableName() . '` (' . $columnsViaComma . ') VALUES (' . $paramsNamesViaComma . ');'; 
        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);
        $this->id = $db->getLastInsertId();
        $this->refresh();
    }
    public function delete(): void {
        $db = Db::getInstance();
        $db->query('DELETE FROM `' . static::getTableName() . '` WHERE id = :id', [':id' => $this->id]);
        $this->id = null;
    }
    private function refresh(): void {
        $objectFromDb = static::getById($this->id);
        foreach ($objectFromDb as $property => $value) {
            $this->$property = $value;
        }
    }
    private function underscoreToCamelCase(string $source): string {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }
    private function mapPropertiesToDbFormat(): array {
        $mappedProperties = [];
        foreach ($this as $key => $value) {
            $propertyNameAsUnderscore = $this->camelcaseToUnderscore($key);
            $mappedProperties[$propertyNameAsUnderscore] = $value;
        }
        return $mappedProperties;
    }
    private function camelcaseToUnderscore(string $source): string {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source));
    }

    abstract protected static function getTableName(): string;
}