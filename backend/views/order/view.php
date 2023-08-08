<?php



use yii\widgets\DetailView;
/* @var \frontend\models\Order $model*/

$this->title = 'Order Details';
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= $this->title ?></h1>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'customer_id',
        'created_at:datetime',
        [
            'label' => 'Product Details',
            'value' => function ($model) {
                $details = '';
                foreach ($model->orderItems as $orderItem) {
                    $details .= 'Book Name: ' . $orderItem->book->name . '<br>';
                    $details .= 'Quantity: ' . $orderItem->quantity . '<br>';
                    $details .= 'Price: ' . $orderItem->price . '<br>';
                    $details .= '<br>';
                }
                return $details;
            },
            'format' => 'html',
        ],
        [
            'label' => 'address',
            'value' => $model->customer->address,
            'format' => 'raw'
        ],
    ],



]) ?>



<?=\yii\helpers\Html::encode($model->customer->address)?>