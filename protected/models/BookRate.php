<?php

/**
 * This is the model class for table "book_rate".
 *
 * The followings are the available columns in table 'book_rate':
 * @property string $user_id
 * @property string $book_id
 * @property integer $rate
 */
class BookRate extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'book_rate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, book_id, rate', 'required'),
			array('rate', 'numerical', 'integerOnly'=>true),
			array('user_id, book_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, book_id, rate', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => Yii::t('trans','User'),
			'book_id' => Yii::t('trans','Book'),
			'rate' => Yii::t('trans','Rate'),
		);
	}
    /**
     * @property $rates Array
     * @property $rate BookRate
     */
    public static function getBookRate($id){
        $rates=self::model()->findAllByAttributes(array('book_id'=>$id));
        if(count($rates)>0){
            $all=0;
            foreach ($rates as $rate) {
                $all+=$rate->rate;
            }
        return intval($all/count($rates));
        }
        return 0;
    }
    /**
     * @property  Books $book
     */
    public static function setBookRate($id,$percent){
        $percent=$percent>100?100:$percent<0?0:$percent;
        $rate=self::model()->findByAttributes(array('book_id'=>$id,'user_id'=>Yii::app()->user->id));
        if(empty ($rate)){
            $rate = new BookRate();
            $rate->book_id=$id;
            $rate->user_id=Yii::app()->user->id;
        }
        $rate->rate=$percent;
        $rate->save();
        $book=Books::model()->findByPk($id);
        if(!empty($book)){
            $book->updateRate();
        }
        return $book->rate;
    }
    public static function doUserRate($id){
        if(Yii::app()->user->isGuest){
            return true;
        }
        $rate=self::model()->findByAttributes(array('book_id'=>$id,'user_id'=>Yii::app()->user->id));
        if(empty ($rate)){
            return false;
        }
        return true;

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

		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('book_id',$this->book_id,true);
		$criteria->compare('rate',$this->rate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BookRate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
