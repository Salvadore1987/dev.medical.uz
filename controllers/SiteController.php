<?php

namespace app\controllers;

use app\models\Lists;
use app\models\RegisterForm;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
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

    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->identity->type_id == User::PATIENT) {
                $this->redirect('patient');
            } else {
                $this->redirect('doctor');
            }
        } else {
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->goBack();
            }
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

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

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionRegister() {
        if (Yii::$app->request->post()) {
            $post = Yii::$app->getRequest()->post('RegisterForm');
            $data = [
                'username' => $post['username'],
                'email' => $post['email'],
                'password' => $post['password'],
                'type_id' => $post['type_id']
            ];
            if (User::saveUser($data)) {
                $this->redirect('/');
            } else {
                echo 'Error';
            }

        } else {
            $model = new RegisterForm();
            return $this->render('register', [
                'model' => $model
            ]);
        }
    }

    public function actionPatient() {
        $lists = null;
        $sql = "SELECT lists.*, user.username FROM lists INNER JOIN user ON user.id = lists.doctor_id
                WHERE lists.patient_id = " . Yii::$app->user->identity->getId();
        $lists = Yii::$app->db->createCommand($sql)->queryAll();
        return $this->render('patient', [
            'lists' => $lists,
            'patient_name' => Yii::$app->user->identity->username,
            'doctors' => User::find()->where(['type_id' => User::DOCTOR])->all()
        ]);
    }

    public function actionDoctor() {
        $lists = null;
        $sql = "SELECT lists.*, user.username FROM lists INNER JOIN user ON user.id = lists.patient_id
                WHERE lists.doctor_id = " . Yii::$app->user->identity->getId();
        $lists = Yii::$app->db->createCommand($sql)->queryAll();
        return $this->render('doctor', [
            'lists' => $lists,
            'doctor_name' => Yii::$app->user->identity->username
        ]);
    }

    public function actionAdd() {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $list = new Lists();
            $list->doctor_id = $request->post('doctor_id');
            $list->patient_id = Yii::$app->user->getId();
            $list->status = Lists::STATUS_INACTIVE;
            $list->date = $request->post('date');
            if ($list->insert()) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function actionActivation() {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $upd = Yii::$app->db->createCommand()
                    ->update('lists', ['status' => Lists::STATUS_ACTIVE], "id = " . $request->post('id'))
                    ->execute();
            if ($upd) {
                return true;
            } else {

            }
        }
    }
}
