<?php

/**
 * This is the model class for table "comment_to_comment_like".
 *
 * The followings are the available columns in table 'comment_to_comment_like':
 * @property integer $id
 * @property string $commen_to_comment_id
 * @property string $user_id
 * @property integer $value
 *
 * The followings are the available model relations:
 * @property User $user
 * @property BooksCommentToComment $commenToComment
 */
class CommentToCommentLike extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'comment_to_comment_like';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('commen_to_comment_id, user_id, value', 'required'),
			array('value', 'numerical', 'integerOnly'=>true),
			array('commen_to_comment_id, user_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, commen_to_comment_id, user_id, value', 'safe', 'on'=>'search'),
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
			'commentToComment' => array(self::BELONGS_TO, 'BooksCommentToComment', 'commen_to_comment_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('trans','ID'),
			'commen_to_comment_id' => Yii::t('trans','Commen To Comment'),
			'user_id' => Yii::t('trans','User'),
			'value' => Yii::t('trans','Value'),
		);
	}


    public static function setCommentLike($id,$val){
        $val=$val>=0?1:-1;
        $rate=self::model()->findByAttributes(array('commen_to_comment_id'=>$id,'user_id'=>Yii::app()->user->id));
        if(empty ($rate)){
            $rate = new CommentToCommentLike();
            $rate->commen_to_comment_id=$id;
            $rate->user_id=Yii::app()->user->id;
        }else{

            if($rate->value==$val){
                $rate->delete();
                return 0;
            }
        }
        $rate->value=$val;
        $rate->save();
        $comment=BooksCommentToComment::model()->findByPk($id);
        if(!empty($comment)){
            $comment->updateRate();
        }
        return $val;
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

		$criteria->compare('id',$this->id);
		$criteria->compare('commen_to_comment_id',$this->commen_to_comment_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('value',$this->value);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CommentToCommentLike the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
