<?php

namespace app\controllers;

use Yii;
use app\models\Employees;
use app\service\EmployeesService;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\filters\ContentNegotiator;

class EmployeesController extends Controller{
    
    private $_listEmployees = [];
    public $enableCsrfValidation = false;
    
    public function behaviors(){
        $this->layout = "main_ysumma";
        return [
            'contentNegotiator' => [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
                'only' => ['register'],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    
    public function actionIndex(){
        $employeesService = new EmployeesService();
        $this->_listEmployees = $employeesService->getList(); 
        return $this->render('index', [
            'listEmployees' => $this->_listEmployees
        ]);
    }
    
    public function actionSave(){
        $response = [];
        $employeesService = new EmployeesService();
        if (Yii::$app->request->post()) {
            $data = Yii::$app->request->post();
            if(sizeof($data) > 0 && !empty($data)){
                $employee = $employeesService->getEmployee($data["person_id"]);
                if(sizeof($employee) > 0){
                    $response = ["success" => false, "response" => "El empleado ingresado actualmente existe"];
                }else{
                    $result = $employeesService->insertEmployees($data);
                    $response = ($result["success"]) ? ["success" => true , "response" => "Operación Correcta"] : ["success" => false , "response" => "Error"];
                }
            }else{
                $response = ["success" => false , "response" => "Error"];
            }
        }else{
            $response = ["success" => false , "response" => "Error"];
        }
        return json_encode($response);
    }
    
}
