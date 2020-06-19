<?php

namespace app\modules\users\models;

use app\components\la\ActiveRecord;

/**
 * This is the model class for table "users".
 */
class Users extends ActiveRecord
{

    private $oldPassword;

    const ROLE_GUEST = 'guest';
    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';

    public static $roles = array(
        self::ROLE_ADMIN => 'Администратор',
        self::ROLE_USER  => 'Пользователь'
    );

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'name', 'email', 'role'], 'required'],
            [['email'], 'email'],
            [['password'], 'safe'],
            [['username', 'email'], 'unique'],
            [['is_active'], 'integer'],
            [['username', 'name', 'password', 'email', 'avatar'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'username'   => 'Логин',
            'password'   => 'Пароль',
            'name'       => 'Имя пользователя',
            'email'      => 'E-mail',
            'role'       => 'Роль',
            'is_active'  => 'Активность',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения'
        ];
    }

    public function afterFind()
    {
        $this->oldPassword = $this->password;
    }

    public function beforeValidate()
    {
        if (!empty($this->password))
        {
            $this->password = \Yii::$app->getSecurity()->generatePasswordHash($this->password);
        }
        else
        {
            $this->password = $this->oldPassword;
        }

        return parent::beforeValidate();
    }

    public function isAdmin()
    {
        return in_array($this->role, ['admin']);
    }

    public function getUserFio()
    {
        return $this->name;
    }

}
