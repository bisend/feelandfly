<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 14.12.2017
 * Time: 15:36
 */

namespace App\Repositories;


use App\DatabaseModels\User;

class UserRepository
{
    public $isEmailChanged = false;
    
    public $isNewEmailValid = true;
    
    public function saveUserName($userId, $name)
    {
        $user = User::whereId($userId)->first();
        $user->name = $name;
        $user->save();
    }
    
    public function checkIfEmailChanged($userId, $email)
    {
        $user = User::whereId($userId)->first();
        if ($user->email != $email)
        {
            $this->isEmailChanged = true;
        }
        return $this->isEmailChanged;
    }

    public function checkIfNewEmailValid($email)
    {
        if (User::whereEmail($email)->count() > 0)
        {
            $this->isNewEmailValid = false;
        }
        return $this->isNewEmailValid;
    }

    public function saveNewEmail($userId, $email)
    {
        $user = User::whereId($userId)->first();
        $user->new_email = $email;
        $user->save();
    }
    
    public function changePassword($userId, $newPassword)
    {
        $user = User::whereId($userId)->first();
        $user->password = bcrypt($newPassword);
        $user->save();
    }
}