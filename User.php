<?php
require_once 'Server.php';

class User {

    private $db;

    public function __construct()
    {
        $this->db = new Server;
    }

    public function findUserByEmailOrUsername($email, $username) {
        $this->db->prepare('SELECT * FROM customers WHERE customer_email = :email OR customer_username = :username');
        $this->db->bind(":email", $email);
        $this->db->bind(":username", $username);

        $row = $this->db->single_record();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function findUserByEmail($email) {
        $this->db->prepare('SELECT * FROM customers WHERE customer_email = :email');
        $this->db->bind(":email", $email);

        $row = $this->db->single_record();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function register($userData) {
        $this->db->prepare("INSERT INTO customers (customer_name, customer_email, customer_username, customer_password, customer_address) VALUES (:name, :email, :username, :password, :address)");
        $this->db->bind(":name", $userData['name']);
        $this->db->bind(":username", $userData['username']);
        $this->db->bind(":email", $userData['email']);
        $this->db->bind(":password", $userData['password']);
        $this->db->bind(":address", $userData['address']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($nameOrEmail, $password) {
        $row = $this->findUserByEmailOrUsername($nameOrEmail, $nameOrEmail);

        if ($row == false) return false;

        $hashedPassword = $row->customer_password;

        if (password_verify($password, $hashedPassword)){    //check if passwords match
            return $row;
        } else {
            return false;
        }
    }

    public function update_email($email) {
        $id = $_SESSION['id'];
        $this->db->prepare("UPDATE customers SET customer_email = :email WHERE customer_id = :id");
        $this->db->bind(":email", $email);
        $this->db->bind(":id", $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function update_address($address) {
        $id = $_SESSION['id'];
        $this->db->prepare("UPDATE customers SET customer_address = :address WHERE customer_id = :id");
        $this->db->bind(":address", $address);
        $this->db->bind(":id", $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function update_password($password) {
        $id = $_SESSION['id'];
        $this->db->prepare("UPDATE customers SET customer_password = :password WHERE customer_id = :id");
        $this->db->bind(":password", $password);
        $this->db->bind(":id", $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function reset_password($newPasswordHash, $tokenEmail) {
        $this->db->prepare("UPDATE customers SET customer_password = :password WHERE customer_email = :email");
        $this->db->bind(":password", $newPasswordHash);
        $this->db->bind(":email", $tokenEmail);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
