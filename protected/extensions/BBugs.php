<?php

class BBugs extends CActiveRecord
{
	public $image1;
	public $image2;
	public $image_load1;
	public $image_load2;
	public $check_load1;
	public $check_load2;
  public $img_flag1 = 1;
	public $img_flag2 = 1;
	
	public $unit;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
  
	public function tableName()
	{
		return 'b_bugs';
	}

	public function rules()
	{
		return array(
			array('project_id, name, priority_id, status_id, dt, user_to_id, first_status_id', 'required'),
			array('project_id, priority_id, status_id, user_id', 'numerical', 'integerOnly'=>true),
      array('time_to', 'numerical', 'allowEmpty'=>true),
      //array('time_to'),
			array('name, url', 'length', 'max'=>255),
			array('ext1, ext2', 'length', 'max'=>3),
			array('id, project_id, name, description, priority_id, status_id, unit, user_id, dt, dt_fixed, dt_closed, url, user_to_id,
						user_id_fixed, user_id_closed, ext1, ext2, img_flag1, img_flag2, image_load1, image_load2, check_load1, check_load2, dt_deadline', 'safe'),
		);
	}

	public function relations()
	{
		return array(
			'project' => array(self::BELONGS_TO, 'BProject', 'project_id'),
			'priority' => array(self::BELONGS_TO, 'BPriority', 'priority_id'),
			'status' => array(self::BELONGS_TO, 'BStatus', 'status_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'user_to' => array(self::BELONGS_TO, 'User', 'user_to_id'),
			'user_closed' => array(self::BELONGS_TO, 'User', 'user_id_closed'),
			'user_fixed' => array(self::BELONGS_TO, 'User', 'user_id_fixed'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('trans','id'),
			'dt' => Yii::t('trans','dt_created'),
			'dt_fixed' => Yii::t('trans','dt_fixed'),
			'dt_closed' => Yii::t('trans','dt_closed'),
			'name' => Yii::t('trans','name'),
			'short_info' => Yii::t('trans','short_info'),
			'description' => Yii::t('trans','description'),
			'user_id' => Yii::t('trans','user'),
			'user_to_id' => Yii::t('trans','Assign to'),
			'user_id_fixed' => Yii::t('trans','User fixed'),
			'user_id_closed' => Yii::t('trans','User closed'),
			'time_to' => Yii::t('trans','Time'),
			'project_id' => Yii::t('trans','project'),
			'priority_id' => Yii::t('trans','Priority'),
			'status_id' => Yii::t('trans','Status'),
			'url' => Yii::t('trans','url'),
			
			'ext1' => Yii::t('trans','ext'),
			'image1' => Yii::t('trans','image'),
			'image_load1' => Yii::t('trans','image_load'),
			'ext2' => Yii::t('trans','ext'),
			'image2' => Yii::t('trans','image'),
			'image_load2' => Yii::t('trans','image_load'),
		);
	}
	
	public function getBugsDateCreated($no_year=null) 
  {
		return UserFunctions::GetBugsDate($this->dt, $no_year);
  }

	public function getBugsDateFixed($no_year=null) 
  {
		return UserFunctions::GetBugsDate($this->dt_fixed, $no_year);
  }

	public function getBugsDateClosed($no_year=null) 
  {
		return UserFunctions::GetBugsDate($this->dt_closed, $no_year);
  }

  protected function beforeSave(){
    parent::beforeSave();
    if(!empty($this->dt_deadline)){
      $this->dt_deadline = date('Y-m-d', strtotime($this->dt_deadline));
    }
    else $this->dt_deadline = null;
    return true;
  }

  protected function afterFind(){
    parent::afterFind();
    if(!empty($this->dt_deadline))
    $this->dt_deadline = date('d.m.Y', strtotime($this->dt_deadline));
  }

    public function search()
	{
		$criteria=new CDbCriteria;
		
		$order = 'status.number ASC, dt DESC, t.id DESC';
		
		/*if(Yii::app()->user->getState('utype') == 4){
			$criteria->addCondition('user_id='.Yii::app()->user->id);
		}*/
		$proj = !Yii::app()->user->isGuest ? User::model()->findByPk(Yii::app()->user->id) : array();
		//if(Yii::app()->user->getState('utype') == 2 && !empty($proj)){
		if((Yii::app()->user->getState('utype') != 3) && !empty($proj)){
			$criteria->addCondition('project_id IN('.$proj->project_arr.')');
		}
		
    if(empty($this->status_id)){
      $criteria->addCondition('status_id <> 2');
      $order = 'status.number ASC, t.dt DESC, t.id DESC';
    }	
		
		$criteria->with=array('status', 'priority');
		$criteria->compare('t.id',$this->id);
		$criteria->compare('project_id',$this->project_id);
		$criteria->compare('t.name',$this->name,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('priority_id',$this->priority_id);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('ext1',$this->ext1,true);
		$criteria->compare('ext2',$this->ext2,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_to_id',$this->user_to_id);
		$criteria->compare('user_id_fixed',$this->user_id_fixed);
		$criteria->compare('user_id_closed',$this->user_id_closed);
    $criteria->compare('time_to',$this->time_to,true);
		$criteria->compare('dt',$this->dt,true);
		$criteria->compare('dt_fixed',$this->dt_fixed,true);
		$criteria->compare('dt_closed',$this->dt_closed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>50),
			'sort'=>array(
				'defaultOrder'=>$order
			),
		));
	}
}