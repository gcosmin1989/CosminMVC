<?php

class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');

    }

    public function Register()
    {
        //Verificare POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Sanitize POST
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //Procesare formular
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            //Validare Email
            if (empty($data['email'])) {
                $data['email_err'] = 'Enter Email';
            }else{
                //verificare email daca exista
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err']='Email is already taken';
                }
            }
            //Validare Name
            if (empty($data['name'])) {
                $data['name_err'] = 'Enter Name';
            }
            //Validare Parola
            if (empty($data['password'])) {
                $data['password_err'] = 'Enter Password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be min 6 characters';
            }
            //Validare Confirmare Parola
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Confirm Password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['password_err'] = 'Passwords do not match';
                }
            }
            //Erorile sunt goale
            if (empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
            //Hash Password
                $data['password'] =password_hash($data['password'], PASSWORD_DEFAULT);
            //Register User
                if($this->userModel->register($data)){
              redirect('users/login');
                }else{
                    die('Ceva nu a mers');
                };
            } else {
                //incarcare view cu erori
                $this->view('users/register', $data);
            }
        } else {
            //Incarcare formular
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            //Incarcare View
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        //Verificare POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Procesare formular
        } else {
            //Incarcare formular
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',

            ];

            //Incarcare View
            $this->view('users/login', $data);
        }
    }
}