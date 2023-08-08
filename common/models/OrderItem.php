<?php


namespace common\models;

use frontend\models\Order;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "orders_items".
 *
 * @property int $id
 * @property int $order_id
 * @property int $book_id
 * @property int $quantity
 * @property float $price
 *
 * @property Book $book
 * @property Order $order
 */
class OrderItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'book_id', 'quantity', 'price'], 'required'],
            [['order_id', 'book_id', 'quantity'], 'integer'],
            [['price'], 'number'],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::class, 'targetAttribute' => ['book_id' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::class, 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'book_id' => 'Book ID',
            'quantity' => 'Quantity',
            'price' => 'Price',
        ];
    }

    /**
     * Gets query for [[Book]].
     *
     * @return ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::class, ['id' => 'book_id']);
    }

    /**
     * Gets query for [[Order]].
     *
     * @return ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }

}