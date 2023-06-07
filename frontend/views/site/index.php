<?php

/** @var yii\web\View $this */
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'My Yii Application';
?>

<div class="row">
    <?php foreach ($books as $book): ?>
        <div class="col-md-4">
            <div class="book-item card">
                <div class="card-body">
                    <h2 class="card-title"><?= Html::encode($book->name) ?></h2>
                    <!--<p class="card-text"><?/*= Html::encode($book->getAuthorsAsString()) */?></p>-->
                    <div class="add-to-cart-form">
                        <label>
                            <input type="number" value="1" min="1" name="quantity">
                        </label>
                        <button class="add-to-cart-btn btn btn-primary" data-book-id="<?= $book->id ?>">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script>
$(document).ready(function() {
    $('.add-to-cart-btn').on('click', function(e) {
        e.preventDefault();

        var bookId = $(this).data('book-id');
        var quantity = $(this).closest('.add-to-cart-form').find('input[name="quantity"]').val();

        $.ajax({
            type: 'POST',
            url: '<?= Url::to(['book/add-to-cart']) ?>',
            data: { bookId: bookId, quantity: quantity },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('Book added to cart successfully.');
                } else {
                    alert('An error occurred while adding the book to cart.');
                }
            },
            error: function() {
                alert('An error occurred while adding the book to cart.');
            }
        });
    });
});
</script>





