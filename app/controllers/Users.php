<?php

class Users extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model("user");
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                "name" => trim($_POST['name']),
                "email" => trim($_POST['email']),
                "password" => trim($_POST['password']),
                "confirmpassword" => trim($_POST['confirmpassword']),
                "name_err" => "",
                "email_err" => "",
                "password_err" => "",
                "confirmpassword_err" => ""
            ];

            if (empty($data['name'])) {
                $data['name_err'] = "Name cannot be empty";
            }

            if (empty($data['email'])) {
                $data['email_err'] = "Email cannot be empty";
            } else {
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = "Email already taken";
                }
            }

            if (empty($data['password'])) {
                $data['password_err'] = "Password cannot be empty";
            } else {
                if ((strlen($data['password'])) < 6) {
                    $data['password_err'] = "Password length cannot be less than 6";
                }
            }

            if (empty($data['confirmpassword'])) {
                $data['confirmpassword_err'] = "Confirm password cannot be empty";
            } else {
                if ($data['confirmpassword'] != $data['password']) {
                    $data['confirmpassword_err'] = "Passwords do not match";
                }
            }

            if (
                (empty($data['name_err'])) && (empty($data['email_err'])) && (empty($data['password_err'])) &&
                (empty($data['confirmpassword_err']))
            ) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                if ($this->userModel->register($data)) {
                    redirect("users/login");
                } else {
                    die("oops");
                }
            } else {
                $this->view("/users/register", $data);
            }


        } else {
            $data = [
                "name" => "",
                "email" => "",
                "password" => "",
                "confirmpassword" => "",
                "name_err" => "",
                "email_err" => "",
                "password_err" => "",
                "confirmpassword_err" => ""
            ];
            $this->view("/users/register", $data);
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                "email" => trim($_POST['email']),
                "password" => trim($_POST['password']),
                "email_err" => "",
                "password_err" => ""
            ];

            if (empty($data['email'])) {
                $data['email_err'] = "Email cannot be empty";
            }

            if (empty($data['password'])) {
                $data['password_err'] = "Password cannot be empty";
            }

            if ($this->userModel->findUserByEmail($data['email'])) {
            } else {
                $data['email_err'] = "User not found";
            }


            if (empty($data['email_err']) && empty($data['password_err'])) {
                $loggedInUser = $this->userModel->login($data);
                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = "Incorrect password";
                    $this->view('users/login', $data);
                }
            } else {
                $this->view("/users/login", $data);
            }


        } else {
            $data = [
                "email" => "",
                "password" => "",
                "email_err" => "",
                "password_err" => "",
            ];
            $this->view("/users/login", $data);
        }
    }

    public function createUserSession($user)
    {
        session_start();
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        redirect('posts');
    }

    public function logout()
    {
        session_start();
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('users/login');
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }

}
?>