<?php
namespace MyProject\Models\Articles;

use MyProject\Models\Users\User;
use Vendor\Models\ActiveRecordEntity;

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
    
    /** 
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }
    
    /** 
     * @return string
     */
    public function getText(): string {
        return $this->text;
    }

    /**
     * @return User
     */
    public function getAuthor(): User {
        return User::getById($this->authorId);
    }

    /**
     * @param string $name
     */
    public function setName(string $name) {
        $this->name = $name;
    }

    /**
     * $param User $author
     */
    public function setAuthor(User $author) {
        $this->authorId = $author->getId();
    }
    /**
     * @param string $text
     */
    public function setText(string $text) {
        $this->text = $text;
    }
    
    protected static function getTableName(): string {
        return 'articles';
    }
}