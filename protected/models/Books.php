<?php

/**
 * This is the model class for table "books".
 *
 * The followings are the available columns in table 'books':
 * @property string $id
 * @property string $name
 * @property string $author_id
 * @property string $genre_1
 * @property string $genre_2
 * @property string $genre_3
 * @property integer $year
 * @property string $description
 * @property string $ext1
 * @property string $genre
 * @property integer $rate
 * @property integer $seo_id
 *
 * The followings are the available model relations:
 * @property Genre $genre3
 * @property Author $author
 * @property Genre $genre1
 * @property Genre $genre2
 * @property Seo $url
 * @property BooksComments[] $booksComment
 */
class Books extends CActiveRecord
{
    public $delete_img1=0;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'books';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('author_id, name, genre_1, year, description', 'required'),
			array('year, rate', 'numerical', 'integerOnly'=>true),
			array('author_id, genre_1, genre_2, genre_3', 'length', 'max'=>10),
			array('delete_img1', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id,name,rate, author_id, genre_1, genre_2, genre_3, year, description, ext1', 'safe', 'on'=>'search'),
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
			'genre3' => array(self::BELONGS_TO, 'Genre', 'genre_3'),
			'author' => array(self::BELONGS_TO, 'Author', 'author_id'),
			'genre1' => array(self::BELONGS_TO, 'Genre', 'genre_1'),
			'genre2' => array(self::BELONGS_TO, 'Genre', 'genre_2'),
            'booksComment' => array(self::HAS_MANY, 'BooksComments', 'book_id'),
            'url' => array(self::BELONGS_TO, 'Seo', 'seo_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'author_id' =>  Yii::t("trans",'Author'),
			'name' =>  Yii::t("trans",'Name'),
			'genre_1' =>  Yii::t("trans",'Genre 1'),
			'genre_2' =>  Yii::t("trans",'Genre 2'),
			'genre_3' =>  Yii::t("trans",'Genre 3'),
			'year' =>  Yii::t("trans",'Year'),
			'description' =>  Yii::t("trans",'Description'),
			'ext1' =>  Yii::t("trans",'Image'),
			'rate' =>  Yii::t("trans",'Rate'),
		);
	}
    public function updateRate(){
        $this->rate=BookRate::getBookRate($this->id);
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
    public function getGenre(){
        $genre=$this->genre1->name;
        if(!empty($this->genre2)){
            $genre.=", ".$this->genre2->name;
        }
        if(!empty($this->genre3)){
            $genre.=", ".$this->genre3->name;
        }
        return $genre;
    }
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('author_id',$this->author_id );
		$criteria->compare('name',$this->name,true);
		$criteria->compare('genre_1',$this->genre_1);
		$criteria->compare('genre_2',$this->genre_2);
		$criteria->compare('genre_3',$this->genre_3);
		$criteria->compare('year',$this->year);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('rate',$this->rate,true);
		$criteria->compare('ext1',$this->ext1,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'id ASC',
            ),
		));
	}
    public function afterSave(){
        parent::afterSave();

        if(empty($this->url)){
            $this->url=new Seo();
            $this->url->controller="bookInfo";
            $this->url->action="about";
            $this->url->item_id=$this->id;


            $url=UserFunctions::translit($this->author->name."_".$this->name);
            if(!is_null(Seo::model()->findByAttributes(array('url'=>$url)))){
                $url.=time();
            }
            $this->url->url=$url;
            if($this->url->save()){
                $this->seo_id = $this->url->id;
            }
            $this->save();
        }
    }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Books the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
