<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "authors".
 *
 * @property int $id
 * @property string|null $name
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Author Name',
        ];
    }

    public function getAuthorBooks()
    {
        return $this->hasMany(AuthorBook::class, ['author_id' => 'id']);
    }

    public function getBooks()
    {
        return $this->hasMany(Book::class, ['id' => 'book_id'])->via('authorBooks');
    }

    public static function getAllAuthors()
    {
        return self::find()->select(['name', 'id'])->indexBy('id')->column();
    }
}
