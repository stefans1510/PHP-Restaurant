<?php
include_once 'Server.php';
include_once 'notifications.php';

class QueryBuilder
{
    private $db;
    public $productData;
    public $orderData;

    public function __construct()
    {
        $this->db = new Server;

        if (isset($_POST['update'])) {
            $this->productData = [
                'id' => trim($_POST['product_id']),
                'name' => trim($_POST['product_name']),
                'image' => trim($_POST['product_image']),
                'description' => trim($_POST['product_description']),
                'category' => trim($_POST['product_category']),
                'price' => trim($_POST['product_price'])
            ];
        } elseif (isset($_POST['create'])) {
            $this->productData = [
                'id' => trim($_POST['product_id']),
                'name' => trim($_POST['product_name']),
                'image' => trim($_POST['product_image']),
                'description' => trim($_POST['product_description']),
                'category' => trim($_POST['product_category']),
                'price' => trim($_POST['product_price'])
            ];
        }

        if (isset($_POST['order'])) {
            $_SESSION['input_email'] = $_POST['email'];
            $_SESSION['input_phone'] = $_POST['phone'];
            $_SESSION['input_address'] = $_POST['address'];
            $_SESSION['input_apartment'] = $_POST['apartment'];
            $_SESSION['input_payment'] = $_POST['payment'];

            $this->orderData = [
                'customer_id' => $_SESSION['id'],
                'total' => trim($_SESSION['total_price']),
                'email' => trim($_SESSION['input_email']),
                'phone' => trim($_SESSION['input_phone']),
                'address' => trim($_SESSION['input_address']),
                'apartment' => trim($_SESSION['input_apartment']),
                'payment' => trim($_SESSION['input_payment'])
            ];
        }
    }

    public function select_all($table)
    {
        $sql = "SELECT * FROM $table";
        $result = $this->db->conn->query($sql);
        return $result;
    }

    public function select($table, $column, $clause)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE ' . $column . $clause;
        $result = $this->db->conn->query($sql);
        return $result;
    }

    public function create_product()
    {
        $sql = 'INSERT INTO products VALUES (null, :name, :image, :category, :description, :price)';
        $this->db->prepare($sql);
        $this->db->bind(":name", $this->productData['name']);
        $this->db->bind(":image", $this->productData['image']);
        $this->db->bind(":category", $this->productData['category']);
        $this->db->bind(":description", $this->productData['description']);
        $this->db->bind(":price", $this->productData['price']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function update_product()
    {
        $sql = 'UPDATE products SET product_name = :name, product_image = :image, product_description = :description, product_category = :category, product_price = :price WHERE product_id = :id';
        $this->db->prepare($sql);
        $this->db->bind(":name", $this->productData['name']);
        $this->db->bind(":image", $this->productData['image']);
        $this->db->bind(":description", $this->productData['description']);
        $this->db->bind(":category", $this->productData['category']);
        $this->db->bind(":price", $this->productData['price']);
        $this->db->bind(":id", $this->productData['id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function update_order_status($status, $id)
    {
        $sql = 'UPDATE orders SET status = :status WHERE order_id = :id';
        $this->db->prepare($sql);
        $this->db->bind(":status", $status);
        $this->db->bind(":id", $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($table, $column, $clause)
    {
        $sql = 'DELETE FROM ' . $table . ' WHERE ' . $column . ' = :namedPlaceholder';
        $this->db->prepare($sql);
        $this->db->bind(":namedPlaceholder", $clause);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function create_order()
    {
        $this->db->prepare("INSERT INTO orders (customer_id, grand_total, address, apartment, email, phone, payment, status) VALUES (:customerId, :grandTotal, :address, :apartment, :email, :phone, :payment, :status)");
        $this->db->bind(":customerId", $this->orderData['customer_id']);
        $this->db->bind(":grandTotal", $this->orderData['total']);
        $this->db->bind(":address", $this->orderData['address']);
        $this->db->bind(":apartment", $this->orderData['apartment']);
        $this->db->bind(":email", $this->orderData['email']);
        $this->db->bind(":phone", $this->orderData['phone']);
        $this->db->bind(":payment", $this->orderData['payment']);
        $this->db->bind(":status", "Pending");
        $insertOrder = $this->db->execute();

        if ($insertOrder) {
            foreach ($_SESSION['cart'] as $cartItem) {
                $productId = $cartItem['id'];
                $productQuantity = $cartItem['quantity'];
                $selectOrderId = $this->db->conn->query("SELECT order_id FROM orders ORDER BY order_id DESC LIMIT 1");
                $fetch = $selectOrderId->fetch();
                $orderId = $fetch['order_id'];

                $this->db->prepare("INSERT INTO order_details (order_id, product_id, quantity) VALUES (:orderId, :productId, :quantity)");
                $this->db->bind(":orderId", $orderId);
                $this->db->bind(":productId", $productId);
                $this->db->bind(":quantity", $productQuantity);
                $insertOrderDetails = $this->db->execute();
                $insertOrderDetails;

                unset($_SESSION['cart']);
                unset($_SESSION['total_price']);
                unset($_SESSION['input_address']);
                unset($_SESSION['input_apartment']);
                unset($_SESSION['input_email']);
                unset($_SESSION['input_phone']);
                unset($_SESSION['input_payment']);
                notification('success', 'Thank you for your order. You can check order details&nbsp;<a href="profile.php?user_orders">here</a>.', 'form-message form-message-green');
                redirect("index.php");
            }
        }
        return $insertOrder;
        return $insertOrderDetails;
    }

    public function validate_cc($cardNumber)
    {
        $cardType = [
            'visa' => "/^4[0-9]{12}(?:[0-9]{3})?$/",
            'mastercard' => "/^5[1-5][0-9]{14}$/"
        ];

        if (preg_match($cardType['visa'], $cardNumber)) {
            return 'visa';
        } elseif (preg_match($cardType['mastercard'], $cardNumber)) {
            return 'mastercard';
        } else {
            return false;
        }
    }
}
