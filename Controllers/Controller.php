<?php
include "Traits/View.php";
include "Models/User.php";
class MainController
{
    use View;
    public function __construct()
    {

    }

    public function register()
    {
        $model = new User($_POST);
        $res = $model->registration();

        if($res) {
            header('Location: ?action=login');
            exit();
        }

        return $this->view('register', compact('model'));
    }

    public function login()
    {
        $model = new User($_POST);
        $res = $model->login();

        if($res) {
            header('Location: ?action=users');
            exit();
        }

        return $this->view('login', compact('model'));
    }


    public function users()
    {
        if (!$_SESSION['user']) {
            header('Location: ?action=login');
        }

        $model = new User();
        $users = $model->getAllUsers();

        return $this->view('usersList', compact('users'));
    }

    public function userEdit()
    {
        $model = new User($_POST);

        if ($model->id) {
            $model->save();
        }
        else {
            if( !$model->findById($_GET['id']) ) {
                header('Location: ?action=users');
                exit();
            }
        }

        return $this->view('user', compact('model'));
    }

    public function userDelete()
    {
        $model = new User();
        $model->findById($_GET['id']);
        $model->delete();

        header('Location: ?action=users');
    }
}

