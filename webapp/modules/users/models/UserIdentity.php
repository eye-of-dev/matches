<?php

namespace app\modules\users\models;

use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

class UserIdentity extends Users implements IdentityInterface {

    /**
     * @var array EAuth attributes
     */
    public $profile;

    /**
     * Finds an identity by the given ID.
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id) {

        return static::findOne(['id' => $id, 'is_active' => 1]);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|integer an ID that uniquely identifies a user identity.
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey() {
        // TODO: Implement getAuthKey() method.
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return boolean whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey) {
        // TODO: Implement validateAuthKey() method.
    }

    /**
     * Finds user by username
     * @param $username
     * @return static|null
     */
    public static function findByUsername($username) {
        return self::findOne(['username' => $username, 'is_active' => 1]);
    }

    /**
     * Finds user by email
     * @param $email
     * @return static|null
     */
    public static function findByEmail($email) {
        return self::findOne(['email' => $email, 'is_active' => 1]);
    }

    /**
     * Validates password
     *
     * @param  string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        return \Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    /**
     * Check user role
     * @param $role string|array
     * @return bool
     */
    public function checkRole($role) {
        if (is_array($role)) {
            return in_array($this->role, $role);
        } else {
            return $this->role === $role;
        }
    }

}
