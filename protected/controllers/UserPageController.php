<?php
class UserPageController extends SiteController
{
	
	public function actionUserPage(){

            $this->render('userPage');
    }
    public function actionSettings(){
            $user=User::model()->findByPk(Yii::app()->user->id);
            $user->scenario = 'settings';
            $profile=$user->profile;
            if(!$profile) {
                $this->redirect(['index/index']);
            }

            $this->render('settings',array('profile'=>$profile,'user'=>$user));
    }
    public function actionFilter(){
            $this->render('filter');
    }
     public function actionMessages(){
            $this->render('messages');
    }
    public function actionDialogs(){

            $this->render('dialogs');
    }
    public function actionBooks(){
            $this->render('books');
    }

    public function actionProfile_settings() {
        $user = User::model()->findByPk(Yii::app()->user->id);
        $profile = $user->profile;
        $profile->attributes = Yii::app()->request->getPost('Profile');
        $profile->save();
    }

    public function actionChange_password() {
        $user = User::model()->findByPk(Yii::app()->user->id);
        $user->scenario = 'settings';
        if(isset($_POST['ajax']) && $_POST['ajax']==='profile_password') {
            echo CActiveForm::validate(array($user));
            Yii::app()->end();
        }
        if(isset($_POST['User']['new_password'])) {
            $user->scenario = '';
            $user->password = md5($_POST['User']['new_password']);
            $user->save();
        }
    }
    public function actionSaveImage() {
        $user = User::model()->findByPk(Yii::app()->user->id);
        $profile = $user->profile;
        if(!empty($_FILES['Profile']['name']['image'])){
            $file = CUploadedFile::getInstance($profile, 'image');
            if($file){
                $profile->image = 'images/'.mb_strtolower('Profile').'/'.$file;
                $file->saveAs($profile->image);
                $profile->save();
            }
        }
        $this->redirect(['userPage/settings']);
    }
}