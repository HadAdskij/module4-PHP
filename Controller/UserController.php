<?php
/**
 * Created by PhpStorm.
 * User: anatolii
 * Date: 06.12.16
 * Time: 19:50
 */

namespace Controller;

use Model\UserModel;

class UserController extends BaseController
{

    public $messages;
    protected $name = 'User';

    public function validate($login, $pass, &$isAdmin)
    {
        $userModel = new UserModel();

        $user = $userModel->getUser($login);
        if (isset($user['admin']) && $user['admin'] == 1)
            $isAdmin = 1;
        if (!isset($user['password']) || $pass !== $user['password'])
            return NULL;
        return $user['login'];
    }

    public function registerForm()
    {
        $this->render('register');
    }

    public function register()
    {
        if (!isset($_POST['loginR']) || !isset($_POST['password1R']) || !isset($_POST['password2R'])
            || !isset($_POST['emailR']) || !$_POST['loginR'] || !$_POST['password1R'] || !$_POST['password2R']
            ||  !$_POST['emailR']) {
            $this->message = "Заповніть всі поля форми";
            $this->render('register');
            return 0;
        }

        $userModel = new UserModel();

        if ($userModel->checkLogin($_POST['loginR']))
        {
            $this->message = "Користувач з таким логіном вже існує!";
            $this->render('register');
            return 0;
        }

        if ($_POST['password1R'] != $_POST['password2R'])
        {
            $this->message = "Паролі не співпадають!";
            $this->render('register');
            return 0;
        }

        if (!filter_var($_POST['emailR'], FILTER_VALIDATE_EMAIL))
        {
            $this->message = "Невірний формат email!";
            $this->render('register');
            return 0;
        }

        $userModel->addUser();
        $this->message = "Вас було зараєстровано!";
        $this->render('registered');
    }
}