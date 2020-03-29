<?php

namespace app\controllers;

use app\models\Item;
use app\models\ItemUsedHistory;
use Bills;
use DateTime;
use Yii;
use yii\filters\AccessControl;
use yii\rest\ActiveController;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class LastTimeController extends Controller
{
    public $enableCsrfValidation = false;
    private $allowedOriginDomain = "https://contacts.hawleywebdesign.com";

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionItems()
    {
        header("Access-Control-Allow-Origin: {$this->allowedOriginDomain}");

        $items2 = Item::find()->orderBy(['title' => SORT_ASC])->all();
        foreach ($items2 as $getItem) {
            $items[] = $getItem->toArray();
        }

        header("Content-type: text/json");

        echo json_encode($items);
        die();
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionAddItemUsed()
    {
        header("Access-Control-Allow-Origin: {$this->allowedOriginDomain}");

        $request = Yii::$app->request;

        $itemId = $request->get("item_id", 0);
        $dateUsed = $request->get("date_used", '');

        if (!$itemId || strtotime($dateUsed) == 0) {
            header("Content-type: text/json");

            echo json_encode([
                "success" => false,
                "err_message" => "Item ID and Date Used are required"
            ]);
            die();
        }

        $dateUsed = date("Y-m-d", strtotime($dateUsed));

        $itemUsedHistory = new ItemUsedHistory();
        $itemUsedHistory->item_id = $itemId;
        $itemUsedHistory->date_used = $dateUsed;
        $itemUsedHistory->save();

        header("Content-type: text/json");

        echo json_encode([
            "success" => true,
        ]);
        die();
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionDeleteItemUsed()
    {
        header("Access-Control-Allow-Origin: {$this->allowedOriginDomain}");

        $request = Yii::$app->request;

        $id = $request->get("id", 0);

        $itemUsedHistory = ItemUsedHistory::findOne(intval($id));
        if ($itemUsedHistory) {
            $itemUsedHistory->delete();

            header("Content-type: text/json");

            echo json_encode([
                "success" => true,
            ]);
            die();
        } else {

            header("Content-type: text/json");

            echo json_encode([
                "success" => false,
                "err_message" => "Item Used History not found"
            ]);
            die();
        }
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        header("Access-Control-Allow-Origin: {$this->allowedOriginDomain}");

        $request = Yii::$app->request;
        $get_days_back = $request->get('daysBack', 0);

        $pay_date = date("Y-m-d");

        $date = new DateTime($pay_date);
        $date->modify("-$get_days_back day");
        $pay_date = $date->format("Y-m-d");


        /*/
        $item = Item::findOne(1)->toArray();
        echo "<pre>";
        print_r($item);
        die();

        $itemUsedHist = ItemUsedHistory::find()->where(['id' => 1])->one();
        echo "<pre>";
        print_r($itemUsedHist->item->toArray());
        die();
        //*/

        $sql = "SELECT iuh.*, i.title as item_name, i.color  
                FROM ltc_item_used_history iuh 
                INNER JOIN ltc_item i 
                    ON iuh.item_id = i.id 
                WHERE iuh.date_used = :date_used ";
        $stmt_sel_items_used = Yii::$app->db->createCommand($sql);


        $start_date2 = date("Y-m-d", strtotime($pay_date));

        $dayNum = date("w", strtotime($start_date2));


        $daysBack = 77 - $dayNum;

        $date = new DateTime($pay_date);
        $date->modify("-$daysBack day");
        $start_date = $date->format("Y-m-d");


        $needsIncrease = 6 - $dayNum;
        $date2 = new DateTime($pay_date);
        $date2->modify("+$needsIncrease day");
        $end_date = $date2->format("Y-m-d");

        /*/
        $MyBills = array();
        $Bill = new Bills();
        $Bill->setPayPeriod($end_date, $start_date);
        $billDates = $Bill->loadBillDatesByUserID($user_id);

        foreach ($billDates as $getDate) {
            $newDate = array();
            $newDate['desc'] = $getDate['vnd_bill_desc'];
            $newDate['amount'] = $getDate['vnd_amount'];
            $key = strtotime(date("Y-m-d 00:00:00", strtotime($getDate['vnd_date'])));
            $MyBills[$key][] = $newDate;
        }
        //*/

        $days_arr = array();

        $pastStartWeek = false;
        $timestamp = strtotime($start_date);
        $x = 0;
        while ($timestamp <= strtotime($end_date)) {

            $cur_date = date("Y-m-d", $timestamp);
            $day = date("w", $timestamp);

            $monthName = "";
            if (intval(date("d", $timestamp)) == 1 || $x == 0) {
                $monthName = date("M", $timestamp);
            }

            switch ($day) {
                case 0:
                    $my_day = "Sunday";
                    break;
                case 1:
                    $my_day = "Monday";
                    break;
                case 2:
                    $my_day = "Tuesday";
                    break;
                case 3:
                    $my_day = "Wednesday";
                    break;
                case 4:
                    $my_day = "Thursday";
                    break;
                case 5:
                    $my_day = "Friday";
                    break;
                case 6:
                    $my_day = "Saturday";
                    break;
            }
            //$my_day = $monthName . $my_day;
            $my_day .= ", " . $this->getDaySuffix(intval(date("d", $timestamp)));

            $get_day = array();
            $get_day['showAsDay'] = true;
            $get_day['weekDayNum'] = $day;
            $get_day['Month'] = $monthName;
            $get_day['Day'] = $my_day;
            $get_day['Timestamp'] = $timestamp;
            $get_day['Date'] = date("m/d/Y", $timestamp);
            $bills_desc = "";
            $hasBills = false;

            $curDate = date("Y-m-d 00:00:00", $timestamp);
            $sql = "SELECT iuh.*, i.title as item_name, i.color 
                FROM ltc_item_used_history iuh 
                INNER JOIN ltc_item i 
                    ON iuh.item_id = i.id 
                WHERE iuh.date_used = :date_used ";
            $stmt_sel_items_used->bindParam(':date_used', $curDate);


            $myItemsUsed = $stmt_sel_items_used->queryAll();

            /*/
            echo "<pre>";
            print_r($myItemsUsed);
            //die();
            //*/

            $itemsUsedArr = [];
            foreach ($myItemsUsed as $getItem) {

                $itemsUsedArr[] = $getItem;
            }

            //*/
            $get_day['desc'] = $itemsUsedArr;
            //*/

            $timestamp = strtotime('+1 days', $timestamp);

            $days_arr[] = $get_day;
            $x++;
        }

        $i = 0;
        $daysWeeksArr = [];
        foreach ($days_arr as $get_day) {
            if ($i == 0) {
                $eachWeek = [];
            }
            $eachWeek[] = $get_day;
            if ($i > 5) {
                $daysWeeksArr[] = [
                    'title' => 'Week',
                    'days' => $eachWeek
                ];
                $i = 0;
            } else {
                $i++;
            }
        }

        header("Content-type: text/json");

        $results = [
            "results" => $daysWeeksArr,
        ];
        echo json_encode($results);
        die();
    }

    private function getDaySuffix($num)
    {

        switch ($num) {
            case 1:
                return $num . "st";
                break;
            case 2:
                return $num . "nd";
                break;
            case 3:
                return $num . "rd";
                break;
            case 4:
            case 5:
            case 6:
            case 7:
            case 8:
            case 9:
            case 10:
            case 11:
            case 12:
            case 13:
            case 14:
            case 15:
            case 16:
            case 17:
            case 18:
            case 19:
            case 20:
                return $num . "th";
                break;
            case 21:
                return $num . "st";
                break;
            case 22:
                return $num . "nd";
                break;
            case 23:
                return $num . "rd";
                break;
            case 24:
            case 25:
            case 26:
            case 27:
            case 28:
            case 29:
            case 30:
                return $num . "th";
                break;
            case 31:
                return $num . "st";
                break;
            default:
                return $num . "th";
        }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
