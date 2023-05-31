<?php
use yii\grid\GridView;

/**
 * @var \yii\data\ActiveDataProvider $dataProvider
*/

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'name'
    ]
]);

