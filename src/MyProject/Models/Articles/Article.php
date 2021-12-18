<?php
namespace MyProject\Models\Articles;

use Vendor\Models\ActiveRecordEntity;
use MyProject\Models\Users\User;

class Article extends ActiveRecordEntity
{
    /** @var string */
    protected $name;

    /** @var string */
    protected $text;

    /** @var int */
    protected $authorId;

    /** @var string */
    protected $createdAt;
    
    public function getName(): string
    {
        return $this->name;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getAuthor(): User
    {
        return User::getById($this->authorId);
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setText(string $text): void {
        $this->text = $text;
    }

    protected static function getTableName(): string {
        return 'articles';
    }
}