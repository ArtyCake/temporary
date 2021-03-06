<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $number
 * @property string $surname
 * @property string $name
 * @property string $patronymic
 * @property integer $structure_point
 * @property integer $role
 * @property string $password
 * @property integer $create_user_id
 * @property string $create_date
 * @property integer $update_user_id
 * @property string $update_date
 * @property integer $deleted
 * @property integer $deleted_denied
 */
class Users extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, surname, name, structure_point, password', 'required'),
			array('structure_point, role, create_user_id, update_user_id, deleted, deleted_denied', 'numerical', 'integerOnly'=>true),
			array('number', 'length', 'max'=>10),
			array('number','unique'),
			array('surname, name, patronymic', 'length', 'max'=>50),
			array('password', 'length', 'max'=>60),
			array('create_date, update_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, number, surname, name, patronymic, structure_point, role, password, create_user_id, create_date, update_user_id, update_date, deleted, deleted_denied', 'safe', 'on'=>'search'),
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
			'structure'=>array(self::BELONGS_TO,'Structure','structure_point'),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'number' => 'Табельный номер',
			'surname' => 'Фамилия',
			'name' => 'Имя',
			'patronymic' => 'Отчество',
			'structure_point' => 'Подразделение',
			'role' => 'Роль',
			'password' => 'Пароль',
			'create_user_id' => 'Create User',
			'create_date' => 'Create Date',
			'update_user_id' => 'Update User',
			'update_date' => 'Update Date',
			'deleted' => 'Deleted',
			'deleted_denied' => 'Deleted Denied',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('number',$this->number,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('patronymic',$this->patronymic,true);
		$criteria->compare('structure_point',$this->structure_point);
		$criteria->compare('role',$this->role);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_user_id',$this->update_user_id);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('deleted_denied',$this->deleted_denied);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

  /**
   * в случае изменения этой модели через админку заменить
   * Yii::app()->user->getId() на Yii::app()->getModule('admin')->user->getId();
   */
	protected function beforeSave(){
      if($this->isNewRecord){
          $this->create_date = date('Y-m-d H:i:s');
          $this->create_user_id = Yii::app()->getModule('admin')->user->getId();
      }
      else{
          $this->update_date = date('Y-m-d H:i:s');
          $this->update_user_id = Yii::app()->getModule('admin')->user->getId();
      }
      return parent::beforeSave();
  }

  public function getShortFIO()
  {
  	return $this->surname.' '.substr($this->name, 0,1).'. '.($this->patronymic ? substr($this->patronymic, 0,1).'.' : ''); 
  }

}
