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
            'SELECT * FROM `' . static::getTableName() . '` WHERE id = :id;',
            [':id' => $id],
            static::class
        );
        return $entities ? $entities[0] : null;
    }
    
    private function underscoreToCamelCase(string $string): string {
        return lcfirst(str_replace('_', '', ucwords($string, '_')));
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
        $sql = 'UPDATE `' . static::getTableName() . '` SET ' . implode(', ', $columns2params) . ' WHERE id = ' . $this->id;
        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);
    }

    private function insert(array $mappedProperties): void {

    }

    private function mapPropertiesToDbFormat(): array {
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();
        $mappedProperties = [];
        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $propertyNameAsUnderscore = $this->camelCaseToUnderscore($propertyName);
            $mappedProperties[$propertyNameAsUnderscore] = $this->$propertyName;
        }
        return $mappedProperties;
    }

    private function camelCaseToUnderscore(string $source): string {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source));
    }

    abstract protected static function getTableName(): string;
}