<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property integer $user_type_id
 * @property string $login
 * @property string $password
 *
 * The followings are the available model relations:
 * @property UserType $userType
 * @property Profile $profile
 */
class User extends CActiveRecord {

    public $password_repeat;
    public $new_password;
    public $current_password;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login, password', 'required'),
			array('user_type_id, password_repeat', 'required','on'=>'register, registerPlusComparePassword'),
			array('password_repeat', 'required','on'=>'register, registerPlusComparePassword'),
			array('user_type_id', 'required', 'on'=>'register'),
			array('user_type_id', 'length', 'max'=>10),
            array('login', 'unique', 'on'=>'register'),
            array('login', 'email', 'on'=>'register'),
            array('password_repeat', 'compare', 'compareAttribute'=>'password', 'on'=>'registerPlusComparePassword'),
            array('password', 'authenticate', 'on'=>'index'),
			array('login, password', 'length', 'max'=>255),
			array('password_repeat, new_password, current_password', 'required' ,'on'=>'settings'),
			array('current_password', 'confirmPassword' ,'on'=>'settings'),
//			array('new_password', 'compare', 'compareAttribute'=>'current_password', 'operator'=>'!=' ,'on'=>'settings','message'=>Yii::t('trans','New password - must be new one')),
			array('password_repeat', 'compare', 'compareAttribute'=>'new_password', 'on'=>'settings'),
			array('id, user_type_id, password_repeat, new_password, current_password, login, password', 'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'userType' => array(self::BELONGS_TO, 'UserType', 'user_type_id'),
			'profile' => array(self::HAS_ONE, 'Profile', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_type_id' => 'User Type',
			'login' =>  Yii::t("trans",'Login'),
			'password' =>  Yii::t("trans",'Password'),
			'password_repeat' =>  Yii::t("trans",'Repeat password'),
		);
	}
    public function authenticate($attribute,$params)
    {
        if(!$this->hasErrors())
        {
            $identity= new UserIdentity($this->login, md5($this->password));
            $identity->authenticate();
            switch($identity->errorCode)
            {
                case UserIdentity::ERROR_NONE: {
                    Yii::app()->user->login($identity, 86400*7);
                    break;
                }
                case UserIdentity::ERROR_USERNAME_INVALID: {
                    $this->addError('login','User with this login does not exist');
                    break;
                }
                case UserIdentity::ERROR_PASSWORD_INVALID: {
                    $this->addError('password','Password is not right');
                    break;
                }
            }
        }
    }

	public function confirmPassword($attribute, $params) {
		$user = User::model()->findByPk(Yii::app()->user->id);
		if(md5($this->current_password) != $user->password) {
			$this->addError('current_password',Yii::t('trans','Password is not right'));
		}
	}

    public function getName(){
        if(!empty($this->profile))
            return $this->profile->first_name." ".$this->profile->second_name;
        else return $this->login;
    }
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_type_id',$this->user_type_id,true);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
