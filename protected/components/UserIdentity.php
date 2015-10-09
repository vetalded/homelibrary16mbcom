<?php

class UserIdentity extends CUserIdentity
{	
	private $_id;
	private $_type;
	private $_name;
	public function authenticate()
	{

		$record=User::model()->findByAttributes(array('login'=>$this->username));
        if($record===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;

		else if($record->password!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->_id=$record->id;
			$this->_type=$record->userType;
            Yii::app()->user->setState('__type',$record->userType);
			$this->_name=$record->name;
            $this->errorCode=self::ERROR_NONE;

		}

		return !$this->errorCode;
	}

	public function getId()
	{
		return $this->_id;
	}
    public function getType()
	{
		return $this->_type;
	}
    public function setType($type)
	{
		 $this->_type=$type;
         Yii::app()->user->setState('__type',$type);
	}
    public function getName()
	{
		return $this->_name;
	}

}