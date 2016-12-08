<?php
namespace frontend\controllers;
use Yii;
use yii\web\Controller;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
		return [];
       /* return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
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
        ];*/
    }

	public function actionTest()
	{
		if(!Yii::$app->request->isPost && !Yii::$app->request->isAjax){
			echo \GuzzleHttp\json_encode(['code'=>400,'info'=>'非法请求']);die;
		}
		//print_r($_FILES);
		//print_r($_REQUEST);die;
		$xmlstr = file_get_contents("php://input","rb");
		if(!$xmlstr){
			echo \GuzzleHttp\json_encode(['code'=>400,'info'=>'非法数据']);die;
		}
		$jpg = $xmlstr;
		//echo $xmlstr;die;
		$file = "file_".time().".jpg";
		$hand = fopen($file,"wb");
		fwrite($hand,$jpg);
		fclose($hand);
		echo \GuzzleHttp\json_encode(['code'=>200,'info'=>$file]);

	}
}
