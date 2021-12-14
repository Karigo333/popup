<?php


class User
{
    public $user;

    public function __construct($arr = NULL) {
        if ($arr == NULL) {
            $query = DB::query()->query('SELECT * FROM test_task.users');
            $this->user = $query->fetchAll();
        } else {
            $this->user = [];
            $query = 'SELECT * FROM test_task.users WHERE id=:id';
            foreach ($arr as $key => $value)
                if (is_int($key)) {
                    $query_p = DB::query()->prepare($query);
                    $query_p->bindValue(':id', $value);
                    $query_p->execute();
                    $this->user[] = $query_p->fetch();
                }
        }
    }

    public function register($name, $email, $pass) {
        $check = 'SELECT   email FROM test_task.users WHERE email  = :email';
        $query_r = DB::query()->prepare($check);
        $query_r->bindValue(':email', $email);
        $query_r->execute();
        $check1 = $query_r->fetch();
        if (!$check1) {
            $query = 'INSERT INTO test_task.users SET name = :name, email = :email, password = :password';
            try {
                $query_r = DB::query()->prepare($query);
                $query_r->bindValue(':email', $email);
                $query_r->bindValue(':name', $name);
                $query_r->bindValue(':password', $pass);
                $query_r->execute();
            } catch (Exception $e) {
                die();
                echo 'ERROR go home</a>';
            }
            return true;
        } else return false;

    }

    public function in($email, $password) {
        $query = 'SELECT * FROM test_task.users WHERE email = :email AND password = :password';
        $query_r = DB::query()->prepare($query);
        $query_r->bindValue(':email', $email);
        $query_r->bindValue(':password', $password);
        $query_r->execute();
        $arr = $query_r->fetch(PDO::FETCH_ASSOC);
        return !empty($arr) ? $arr['name'] : false;
    }


    public function isAdmin ($email) {


    }
}