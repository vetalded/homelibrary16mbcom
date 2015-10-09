<?php
class AdminController extends Controller
{
    public $layout='//layouts/column1';
	public function actionIndex(){
		$model = new User('index');

		if(isset($_POST['ajax']) && $_POST['ajax']==='form')
    {
			echo CActiveForm::validate($model);
			Yii::app()->end();
    }

		if(!empty($_POST['User'])){
			$model->attributes = $_POST['User'];

			if($model->validate())
			{
					$this->redirect(array('admin/menu'));
			}
			else{
              $this->redirect(array('admin/index'));

			}
		}else{
			$this->render('index', array('model' => $model));
		}
	}

	public function actionLogout(){
		Yii::app()->user->logout();
		$this->redirect(array('admin/index'));
	}

	public function actionMenu(){
		if(!Yii::app()->user->isGuest){
			$this->render('menu');
		}
		else{
			$this->redirect(array('admin/index'));
		}
	}

	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest){
				echo $error['message'];
			}
			else{
				$this->render('error', $error);
			}
		}
	}
}