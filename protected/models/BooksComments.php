<?php

/**
 * This is the model class for table "books_comments".
 *
 * The followings are the available columns in table 'books_comments':
 * @property string $id
 * @property string $book_id
 * @property string $user_id
 * @property string $comment
 * @property string $date
 * @property integer $rate
 *
 * The followings are the available model relations:
 * @property BooksCommentToComment[] $booksCommentToComments
 * @property User $user
 * @property Books $book
 * @property ComentLike[] $comentLikes
 */
class BooksComments extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'books_comments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('book_id, user_id, comment, date, rate', 'required'),
			array('rate', 'numerical', 'integerOnly'=>true),
			array('book_id, user_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, book_id, user_id, comment, date, rate', 'safe', 'on'=>'search'),
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
			'booksCommentToComments' => array(self::HAS_MANY, 'BooksCommentToComment', 'books_comment_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'book' => array(self::BELONGS_TO, 'Books', 'book_id'),
			'comentLikes' => array(self::HAS_MANY, 'ComentLike', 'comment_id'),
		);
	}
    public function updateRate(){
        $this->rate=self::getLike()-self::getLike('-');
        $this->save();
        return $this->rate;
    }
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('trans','ID'),
			'book_id' => Yii::t('trans','Book'),
			'user_id' => Yii::t('trans','User'),
			'comment' => Yii::t('trans','Comment'),
			'date' => Yii::t('trans','Date'),
			'rate' => Yii::t('trans','Rate'),
		);
	}

    public function getLike($char=''){
       return CommentLike::model()->countByAttributes(array('comment_id'=>$this->id,'val'=>$char.'1'));
    }
    public function wasLiked(){
       $model= CommentLike::model()->findByAttributes(array('comment_id'=>$this->id,'user_id'=>Yii::app()->user->id));
        if(empty($model)){
            return 0;
        }
        return $model->val;
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
		$criteria->compare('book_id',$this->book_id,true);
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
	 * @return BooksComments the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
