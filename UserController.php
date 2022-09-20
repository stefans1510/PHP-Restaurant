<?php
ob_start();
require_once 'User.php';
require_once 'QueryBuilder.php';
require_once 'notifications.php';

class UserController
{
    private $userModel;
    private $qb;

    public function __construct()
    {
        $this->userModel = new User;
        $this->qb = new QueryBuilder;
    }

    public function register()
    {
        $userData = [
            'name' => trim($_POST['name']),
            'username' => trim($_POST['username']),
            'email' => trim($_POST['email']),
            'address' => trim($_POST['address']),
            'password' => trim($_POST['password_1']),
            'password2' => trim($_POST['password_2'])
        ];

        if (filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {

            if ($userData['password'] == $userData['password2']) {

                if ($this->userModel->findUserByEmailOrUsername($userData['email'], $userData['username'])) {
                    notification("register", "Username or Email already taken");
                    redirect("registration.php");
                }

                $userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);

                if ($this->userModel->register($userData)) {
                    notification("login", 'Account created successfully!', 'form-message form-message-green');
                    redirect("login.php");
                } else {
                    die("Error occurred");
                }
            } else {
                notification("register", "Passwords don't match");
                redirect("registration.php");
            }
        } else {
            notification("register", "Invalid email adress");
            redirect("registration.php");
        }
    }

    public function login()
    {
        $userData = [
            'username/email' => trim($_POST['username/email']),
            'password' => trim($_POST['password'])
        ];

        $selectAdmin = $this->qb->select("customers", "customer_username", " = 'admin'");

        $row = $selectAdmin->fetch();

        $adminEmail = $row['customer_email'];
        $adminUsername = $row['customer_username'];
        $adminPassword = $row['customer_password'];


        if ($this->userModel->findUserByEmailOrUsername($userData['username/email'], $userData['username/email'])) {
            $loggedUser = $this->userModel->login($userData['username/email'], $userData['password']);

            if ($userData['username/email'] === $adminEmail || $userData['username/email'] === $adminUsername && $userData['password'] === $adminPassword) {
                $_SESSION['admin'] = $loggedUser;
                redirect("admin.php");
            } elseif ($loggedUser) {
                $this->user_session($loggedUser);
            } else {
                notification("login", "Check your inputs again");
                redirect("login.php");
            }
        } else {
            notification("login", "User not found");
            redirect("login.php");
        }
    }

    private function user_session($user)
    {
        $_SESSION['id'] = $user->customer_id;
        $_SESSION['name'] = $user->customer_name;
        $_SESSION['username'] = $user->customer_username;
        $_SESSION['email'] = $user->customer_email;
        $_SESSION['address'] = $user->customer_address;
        redirect("index.php");
    }

    public function logout()
    {
        unset($_SESSION['id']);
        unset($_SESSION['name']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['address']);
        session_destroy();
        redirect("index.php");
    }

    public function update_email()
    {
        $email  = $_POST['email'];

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if ($this->userModel->findUserByEmail($email)) {
                notification("profile", "Email already taken");
                redirect("profile.php?change_email");
            }

            if ($this->userModel->update_email($email)) {
                notification("profile", 'Email updated successfully!', 'form-message form-message-success');
                redirect("profile.php");
            } else {
                die("Error occurred");
            }
        } else {
            notification("profile", "Invalid email adress");
            redirect("profile.php?change_email");
        }
    }

    public function update_address()
    {
        $address = trim($_POST['address']);

        if ($this->userModel->update_address($address)) {
            notification("profile", 'Address updated successfully!', 'form-message form-message-success');
            redirect("profile.php");
        } else {
            die("Error occurred");
        }
    }

    public function update_password()
    {
        $password = trim($_POST['password']);
        $repeatedPassword = trim($_POST['repeat_password']);

        if ($password == $repeatedPassword) {

            $password = password_hash($password, PASSWORD_DEFAULT);

            if ($this->userModel->update_password($password)) {
                notification("profile", 'Password updated successfully!', 'form-message form-message-success');
                redirect("profile.php");
            } else {
                die("Error occurred");
            }
        } else {
            notification("profile", "Passwords don't match");
            redirect("profile.php?change_password");
        }
    }
}

$init = new UserController;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['action']) {
        case 'register':
            $init->register();
            break;
        case 'login':
            $init->login();
            break;
        case 'update_email':
            $init->update_email();
            break;
        case 'update_address':
            $init->update_address();
            break;
        case 'update_password':
            $init->update_password();
            break;
        default:
            redirect("index.php");
    }
} else {
    switch ($_REQUEST['q']) {
        case 'logout';
            $init->logout();
            break;
        default:
            redirect("index.php");
    }
}
