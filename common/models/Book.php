<?php

namespace common\models;


use Yii;
use yii\web\Cookie;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string|null $name
 */
class Book extends \yii\db\ActiveRecord
{
    public $authorIds = [];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
            ['authorIds', 'required'],
            ['authorIds', 'each', 'rule' => ['exist', 'targetClass' => Author::class, 'targetAttribute' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Book Name',
        ];
    }

    public function getAuthorBooks()
    {
        return $this->hasMany(AuthorBook::class, ['book_id' => 'id']);
    }

    public function getAuthors()
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])->via('authorBooks');
    }

    public function saveOrUpdateAuthorIds()
    {
        AuthorBook::deleteAll(['book_id' => $this->id]);
        foreach ($this->authorIds as $authorId) {
            $authorBook = new AuthorBook();
            $authorBook->book_id = $this->id;
            $authorBook->author_id = $authorId;
            $authorBook->save();
        }
        return true;
    }



}