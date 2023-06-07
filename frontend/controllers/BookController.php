<?php


namespace frontend\controllers;

use frontend\models\AddToCart;
use Yii;
use yii\web\Response;
use common\models\Book;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Cookie;

class BookController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }


    public function actionAddToCart()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $cookieName = 'bookQuantities';
        $cookie = Yii::$app->request->cookies->getValue($cookieName, '[]');
        $bookQuantities = json_decode($cookie, true);

        $addToCart = new AddToCart();
        if ($addToCart->load(Yii::$app->request->post(), '') && $addToCart->validate()) {
            if (!empty($bookQuantities[$addToCart->bookId])) {
                $bookQuantities[$addToCart->bookId] += $addToCart->quantity;
            } else {
                $bookQuantities[$addToCart->bookId] = $addToCart->quantity;
            }
            $cookie = new Cookie([
                'name' => $cookieName,
                'value' => json_encode($bookQuantities),
            ]);
            Yii::$app->response->cookies->add($cookie);
            return ['success' => true];
        }
        return ['success' => false];
    }


    public function actionCart()
    {
        $cookieName = 'bookQuantities';
        $cookie = Yii::$app->request->cookies->getValue($cookieName, '[]');
        $bookQuantities = json_decode($cookie, true);

        $cart = [];
        if (!empty($bookQuantities)) {
            foreach ($bookQuantities as $bookId => $quantity) {
                $book = Book::findOne($bookId);
                if ($book !== null) {
                    $cart[$bookId] = [
                        'book' => $book,
                        'quantity' => $quantity,
                    ];
                }
            }
        }
        return $this->render('cart', ['cart' => $cart]);
    }

    public function actionRemoveFromCart($bookId)
    {
        $cookieName = 'bookQuantities';
        $cookie = Yii::$app->request->cookies->getValue($cookieName, '[]');
        $bookQuantities = json_decode($cookie, true);

        if (isset($bookQuantities[$bookId])) {
            unset($bookQuantities[$bookId]);

            $cookie = new Cookie([
                'name' => $cookieName,
                'value' => json_encode($bookQuantities),
            ]);
            Yii::$app->response->cookies->add($cookie);
            Yii::$app->session->setFlash('success', 'Book has been removed from cart.');
        }

        return $this->redirect(['book/cart']);
    }

    public function actionClearCart()
    {
        $cookieName = 'bookQuantities';
        $cookie = new Cookie([
            'name' => $cookieName,
            'value' => '',
        ]);
        Yii::$app->response->cookies->add($cookie);
        Yii::$app->session->setFlash('success', 'Cart has been cleared.');
        return $this->redirect(['book/cart']);
    }
}
