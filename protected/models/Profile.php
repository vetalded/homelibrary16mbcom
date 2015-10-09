<?php

/**
 * This is the model class for table "profile".
 *
 * The followings are the available columns in table 'profile':
 * @property integer $user_id
 * @property integer $city_id
 * @property string $first_name
 * @property string $second_name
 * @property string $birthday
 * @property string $phone
 * @property string $image
 * @property string $profileImage
 */
class Profile extends CActiveRecord
{
    public $b_day;
    public $b_month;
    public $b_year;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, city_id, first_name, birthday, second_name', 'required'),
			array('b_day, b_month, b_year', 'required', 'on' => 'register'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('phone', 'match', 'pattern' => '/^([\+]+)*[0-9]{5,20}$/', 'message' => Yii::t('label', "Phone format is +1234567899999")	),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, city_id, phone, first_name, second_name', 'safe'),
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
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => Yii::t("trans",'User'),
			'first_name' =>  Yii::t("trans",'First Name'),
			'second_name' =>  Yii::t("trans",'Second Name'),
			'birthday' =>  Yii::t("trans",'Birthday'),
			'b_day' =>  Yii::t("trans",'Day'),
			'b_month' =>  Yii::t("trans",'Month'),
			'b_year' =>  Yii::t("trans",'Year'),
			'city_id' =>  Yii::t("trans",'City'),
		);
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('first_name',$this->first_name);
		$criteria->compare('second_name',$this->second_name);
		$criteria->compare('city_id',$this->city_id);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return string profile image src
	 */
	public function getProfileImage() {

		if($this->image) {
			return  '/'.$this->image;
		} else {
			return '/images/no_avatar.gif';
		}
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Profile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
