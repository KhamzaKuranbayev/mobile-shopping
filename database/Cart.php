<?php

// php cart class
class Cart
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->connection)) return null;
        $this->db = $db;
    }

    // insert into cart table
    public function insertIntoCart($params = null, $table = 'cart')
    {
        if ($this->db->connection != null) {
            if ($params != null) {
                // insert into cart(user_id) values(0)
                //get table columns
                $columns = implode(',', array_keys($params));
                $values = implode(',', array_values($params));

                // insert sql query
                $query_string = sprintf("INSERT INTO %s(%s) VALUES(%s)", $table, $columns, $values);
                $result = $this->db->connection->query($query_string);
                return $result;
            }
        }
    }

    // to get user_id and item_id and insert into cart table
    public function addToCart($user_id, $item_id)
    {
        if (isset($user_id) && isset($item_id)) {
            $params = array(
                "user_id" => $user_id,
                "item_id" => $item_id
            );

            // insert data into cart
            $result = $this->insertIntoCart($params);
            if ($result) {
                // reload page
                header("Location: " . $_SERVER['PHP_SELF']);
            }
        }
    }

    // calculate sub total
    public function getSum($arr)
    {
        if (isset($arr)) {
            $sum = 0;
            foreach ($arr as $item) {
                $sum += floatval($item[0]);
            }
            return sprintf('%.2f', $sum);
        }
    }

    // delete cart item by item_id
    public function deleteCart($item_id = null, $table = 'cart')
    {
        if ($item_id != null) {
            $result = $this->db->connection->query("DELETE FROM `$table` WHERE item_id='$item_id'");
            if ($result) {
                header("Location:" . $_SERVER['PHP_SELF']);
            }
            return $result;
        }
    }

    // get item_id of shopping cart list
    public function getCartId($cartArray = null, $key = "item_id")
    {
        if ($cartArray != null) {
            $cart_id = array_map(function ($value) use ($key) {
                return $value[$key];
            }, $cartArray);

            return $cart_id;
        }
    }

}