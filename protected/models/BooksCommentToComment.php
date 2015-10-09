<?php

/**
 * This is the model class for table "books_comment_to_comment".
 *
 * The followings are the available columns in table 'books_comment_to_comment':
 * @property string $id
 * @property string $books_comment_id
 * @property string $user_id
 * @property string $comment
 * @property string $date
 * @property integer $rate
 *
 * The followings are the available model relations:
 * @property User $user
 * @property BooksComments $booksComment
 * @property CommentToCommentLike[] $commentToCommentLikes
 */
class BooksCommentToComment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'books_comment_to_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('books_comment_id, user_id, comment, date, rate', 'required'),
			array('rate', 'numerical', 'integerOnly'=>true),
			array('books_comment_id, user_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, books_comment_id, user_id, comment, date, rate', 'safe', 'on'=>'search'),
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
			'booksComment' => array(self::BELONGS_TO, 'BooksComments', 'books_comment_id'),
			'commentToCommentLikes' => array(self::HAS_MANY, 'CommentToCommentLike', 'commen_to_comment_id'),
		);
	}
    public function getLike($char=''){
        return CommentToCommentLike::model()->countByAttributes(array('commen_to_comment_id'=>$this->id,'value'=>$char.'1'));
    }
    public function wasLiked(){
        $model=CommentToCommentLike::model()->findByAttributes(array('commen_to_comment_id'=>$this->id,'user_id'=>Yii::app()->user->id));
        if(empty($model)){
            return 0;
        }
        return $model->value;
    }
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('trans','ID'),
			'books_comment_id' => Yii::t('trans','Books Comment'),
			'user_id' => Yii::t('trans','User'),
			'comment' => Yii::t('trans','Comment'),
			'date' => Yii::t('trans','Date'),
			'rate' => Yii::t('trans','Rate'),
		);
	}
    public function updateRate(){
        $this->rate=self::getLike()-self::getLike('-');
        $this->save();
        return $this->rate;
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
		$criteria->compare('books_comment_id',$this->books_comment_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('rate',$this->rate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BooksCommentToComment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
