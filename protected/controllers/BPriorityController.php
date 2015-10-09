<?php
class BPriorityController extends Controller
{

	public function actionIndex()
	{
		$this->redirect(array('admin/menu'));
	}
	
	public function actionAdmin()
	{
		if(!Yii::app()->user->isGuest){
			$model=new BPriority('admin');
			$model->unsetAttributes(); 
			if(isset($_GET['BPriority'])){
				$model->attributes=$_GET['BPriority'];
			}
			$this->render('admin', array(
				'model'=>$model,
			));
		}
    else{
      $this->redirect(array('admin/index'));
    }
	}
	
	public function actionUpdate()
	{
		if(!Yii::app()->user->isGuest){
			$count=BPriority::model()->count();
			if(isset($_GET['id'])){
					$model=$this->loadModel($_GET['id']);
					$model->scenario = 'admin';
			}
			else{
					$model = new BPriority('admin');
					$count++;
			}
			$count = range(1, $count);
			$count = array_combine($count, $count);
			
      if(isset($_POST['BPriority'])){
        $model->attributes=$_POST['BPriority'];
        if($model->save()){
          $this->redirect(array('admin'));
        }
      }
      $this->render('update',array(
        'model'=>$model,
				'count'=>$count,
      ));
    }
    else{
      $this->redirect(array('admin/index'));
    }
	}

	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			$this->loadModel($id)->delete();
			
			if(!isset($_GET['ajax'])){
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
		}
		else{
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
	}

	public function loadModel($id)
	{
		$model=BPriority::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
}