<?php

namespace app\controllers;

use Bills;
use DateTime;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class LastTimeController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
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
    public function actionIndex()
    {
        $pay_date = date("Y-m-d");


        $date = new DateTime($pay_date); // For today/now, don't pass an arg.
        $date->modify("-77 day");
        $start_date = $date->format("Y-m-d");

        $start_day = intval(date("d", strtotime($start_date)));

        $start_date2 = date("Y-m-d", strtotime($pay_date));

        $dayNum = date("w", strtotime($start_date2));
        $needsIncrease = 6 - $dayNum;
        $date2 = new DateTime($pay_date); // For today/now, don't pass an arg.
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
        while ($timestamp <= strtotime($end_date)) {

            $cur_date = date("Y-m-d", $timestamp);
            $day = date("w", $timestamp);
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
            $my_day .= ", " . $this->getDaySuffix(intval(date("d", $timestamp)));

            if ($day > 0 && $pastStartWeek == false) {

                $lastIndex = 0;
                $pastStartWeek = true;
                for ($p = 0; $p < $day; $p++) {
                    $get_day = array();
                    $get_day['showAsDay'] = false;
                    $get_day['weekDayNum'] = $p;
                    $get_day['Day'] = '';
                    $get_day['Timestamp'] = 0;
                    $get_day['Date'] = '';
                    $get_day['desc'] = [];
                    $days_arr[] = $get_day;
                    $lastIndex = $p;
                }
            }

            $get_day = array();
            $get_day['showAsDay'] = true;
            $get_day['weekDayNum'] = $day;
            $get_day['Day'] = $my_day;
            $get_day['Timestamp'] = $timestamp;
            $get_day['Date'] = date("m/d/Y 00:00:00", $timestamp);
            $bills_desc = "";
            $hasBills = false;

            $billsDescArr = [];
            /*/
            foreach ($MyBills[$timestamp] as $getBill) {

                $hasBills = true;
                $billsDescArr[] = $getBill['desc'] . " - $" . $getBill["amount"];
                $full_cur_amount -= $getBill["amount"];
            }
            //*/



            /*/
            $get_day['desc'] = $billsDescArr;
            //*/



            //if ($hasBills == true) {
            //$get_day['Balance'] = '$' . $full_cur_amount;
            /*} else {
                $get_day['Balance'] = "";
            }*/
            $timestamp = strtotime('+1 days', $timestamp);

            $days_arr[] = $get_day;
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
