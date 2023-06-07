<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $cart array */

$this->title = 'Cart';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-cart">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (empty($cart)): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Book Name</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart as $bookId => $item): ?>
                    <tr>
                        <td><?= Html::encode($item['book']->name) ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td>
                            <?= Html::a('Remove', ['book/remove-from-cart', 'bookId' => $bookId], ['class' => 'btn btn-danger']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?= Html::a('Clear Cart', ['book/clear-cart'], ['class' => 'btn btn-danger']) ?>
        <?= Html::a('Order', ['book/order-products'], ['class' => 'btn btn-primary']) ?>
    <?php endif; ?>
</div>



