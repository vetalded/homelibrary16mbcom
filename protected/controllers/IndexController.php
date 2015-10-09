<?php
class IndexController extends SiteController
{
	
	public function actionIndex(){
        $books=Books::model()->findAll(array('order'=>'RAND()','limit'=>10));

        $this->render("index",array('books'=>$books));
	}
    public function actionSignin(){
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
                if(isset($_POST['page_url']))
                $this->redirect(array($_POST['page_url']));else{
                    $this->redirect(array('index/index'));
                }
            }
            else{
                $this->redirect(array('index/index'));

            }
        }else{
            $this->render('index', array('model' => $model));
        }
	}
    public function actionLogout(){
        Yii::app()->user->logout();
        $this->redirect(array('index/index'));
    }
    public function actionRegister(){
        $user=new User('register');
        $profile=new Profile('register');
        if(isset($_POST['ajax']) && $_POST['ajax']==='register')
        {
            $user->scenario='registerPlusComparePassword';
            echo CActiveForm::validate(array($user,$profile));
            Yii::app()->end();
        }
        if(isset($_POST['User'])){
            $user->attributes=$_POST['User'];
            $user->password=md5($user->password);
            $user->password_repeat=md5($user->password_repeat);
            $user->user_type_id=2;

            if($user->save()){
                if(isset($_POST['Profile'])){
                    $profile->attributes=$_POST['Profile'];

                    $profile->birthday = $profile->b_year."-".$profile->b_month."-".$profile->b_day;
                    $profile->user_id=$user->id;

                    $profile->save();

                    $identity=new UserIdentity($user->login, $user->password);
                    $identity->authenticate();
                    Yii::app()->user->login($identity, 86400*7);
                }
                $this->redirect(array('index/index'));
            }

        }
        $this->render("registration",array('user'=>$user,'profile'=>$profile));
    }

    public function actionLogin(){
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
                $this->redirect("/admin/index");

            }
        }else{
            $this->render('index', array('model' => $model));
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
    public function actionTest(){
        $this->render('test');
    }
    public function actionDoMigration()
	{
	}
}