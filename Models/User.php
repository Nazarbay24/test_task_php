<?php
include "Db.php";
class User
{
    private $db;
    public $id;
    public $name;
    public $phone;
    public $email;
    public $password;
    public $password_hash;
    public $error;
    public $success;

    public function __construct($data = [])
    {
        $this->db = new Db();

        $this->id = array_key_exists('id', $data) ? $data['id'] : null;
        $this->name = array_key_exists('name', $data) ? $data['name'] : null;
        $this->phone = array_key_exists('phone', $data) ? $data['phone'] : null;
        $this->email = array_key_exists('email', $data) ? $data['email'] : null;
        $this->password = array_key_exists('password', $data) ? $data['password'] : null;
    }

    public function registration()
    {
        if($this->validationReg() && $this->checkDuplicateEmail()) {
            $this->db->query(
                "INSERT INTO users (`name`, `phone`, `email`, `password_hash`) VALUES(?, ?, ?, ?)",
                [$this->name, $this->phone, $this->email, password_hash($this->password, PASSWORD_DEFAULT)]
            );

            return true;
        }
        return false;
    }

    public function login()
    {
        $user = $this->db->query(
            "SELECT * FROM users WHERE email = ?",
            [$this->email]
        );

        if ($user && password_verify($this->password, $user[0]['password_hash'])) {
            $_SESSION['user'] = $user;

            return true;
        }
        else {
            $this->error = 'Неверный email или пароль';
            return false;
        }
    }

    public function getAllUsers()
    {
        return $this->db->query("SELECT * FROM users");
    }

    public function findById($id)
    {
        $user = $this->db->query("SELECT * FROM users WHERE id = ?", [$id])[0];

        if ($user) {
            $this->id = $user['id'];
            $this->name = $user['name'];
            $this->phone = $user['phone'];
            $this->email = $user['email'];
            $this->password_hash = $user['password_hash'];

            return true;
        }

        return false;
    }

    public function save()
    {
        $this->db->query(
            "UPDATE users SET name = ?, phone = ?, email = ? WHERE id = ?",
            [$this->name, $this->phone, $this->email, $this->id]
        );

        $this->success = "Успешно сохранено";
        return true;
    }

    public function delete()
    {
        if ($this->id) {
            $this->db->query(
                "DELETE FROM users WHERE id = ?",
                [$this->id]
            );

            $this->success = "Успешно удалено";
            return true;
        }
        return false;
    }





    private function validationReg()
    {
        if(strlen($this->name) < 3) {
            $this->error = 'Имя должен состоять из 3 или более символов';
        }
        elseif (strlen($this->phone) < 11 || !is_numeric($this->phone)) {
            $this->error = 'Номер должен состоять из 11 цифр';
        }
        elseif (strlen($this->email) < 3) {
            $this->error = 'Email должен состоять из 3 или более символов';
        }
        elseif (strlen($this->password) < 6) {
            $this->error = 'Пароль должен состоять из 6 или более символов';
        }

        if ($this->error) {
            return false;
        }
        else {
            return true;
        }
    }

    private function checkDuplicateEmail()
    {
        $res = $this->db->query(
            "SELECT * FROM users WHERE email = ?",
            [$this->email]
        );

        if ($res) {
            $this->error = 'Такой Email уже существует';
            return false;
        }
        return true;
    }
}