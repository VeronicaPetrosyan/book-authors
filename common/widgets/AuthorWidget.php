<?php

namespace common\widgets;
use yii\base\Widget;
use common\models\Author;
use InvalidArgumentException;
use yii\data\ActiveDataProvider;

class AuthorWidget extends Widget
{

    public $author;

    public function init()
    {
        parent::init();

        if (is_numeric($this->author)) {
            $this->author = Author::findOne($this->author);
        } else if (!($this->author instanceof Author)) {
            throw new InvalidArgumentException('Invalid author input.');
        }
    }

    public function run()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->author->getBooks()
        ]);
        return $this->render('authorView', [
            'dataProvider' => $dataProvider,
            'author' => $this->author,
        ]);
    }

}

