<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 14.12.2017
 * Time: 15:36
 */

namespace App\Repositories;

use App\DatabaseModels\User;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository
{
    /**
     * @var bool
     */
    public $isEmailChanged = false;

    /**
     * @var bool
     */
    public $isNewEmailValid = true;

    /**
     * save user name
     * @param $userId
     * @param $name
     */
    public function saveUserName($userId, $name)
    {
        $user = User::whereId($userId)->first();
        $user->name = $name;
        $user->save();
    }

    /**
     * return isEmailChanged
     * @param $userId
     * @param $email
     * @return bool
     */
    public function checkIfEmailChanged($userId, $email)
    {
        $user = User::whereId($userId)->first();
        if ($user->email != $email)
        {
            $this->isEmailChanged = true;
        }
        return $this->isEmailChanged;
    }

    /**
     * return isNewEmailValid
     * @param $email
     * @return bool
     */
    public function checkIfNewEmailValid($email)
    {
        if (User::whereEmail($email)->count() > 0)
        {
            $this->isNewEmailValid = false;
        }
        return $this->isNewEmailValid;
    }

    /**
     * save new email
     * @param $userId
     * @param $email
     */
    public function saveNewEmail($userId, $email)
    {
        $user = User::whereId($userId)->first();
        $user->new_email = $email;
        $user->save();
    }

    /**
     * change password
     * @param $userId
     * @param $newPassword
     */
    public function changePassword($userId, $newPassword)
    {
        $user = User::whereId($userId)->first();
        $user->password = bcrypt($newPassword);
        $user->save();
    }
}