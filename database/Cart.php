<?php

// php cart class
class Cart
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) return null;
        $this->db = $db;
    }

    // insert into cart table
    public  function insertIntoCart($params = null, $table = "wishlist"){
        if ($this->db->con != null){
            if ($params != null){
                // "Insert into cart(user_id) values (0)"
                // get table columns
                $columns = implode(',', array_keys($params));

                $values = implode(',' , array_values($params));

                // create sql query
                $query_string = sprintf("INSERT INTO %s(%s) VALUES(%s)", $table, $columns, $values);

                // execute query
                $result = $this->db->con->query($query_string);
                return $result;
            }
        }
    }

    // to get user_id and item_id and insert into cart table
    public  function addToCart($userid, $itemid){
        if (isset($userid) && isset($itemid)){
            $params = array(
                "user_id" => $userid,
                "item_id" => $itemid
            );

            // insert data into cart
            $result = $this->insertIntoCart($params);
            if ($result){
                // Reload Page
                header("Location: " . $_SERVER['PHP_SELF']);
            }
        }
    }

    // delete cart item using cart item id
    public function deleteCart($item_id = null, $user_id=null, $table = 'cart'){
        if($item_id != null){
        $result = $this->db->con->query("DELETE FROM {$table} WHERE item_id={$item_id} AND user_id={$user_id}");
            if($result){
                header("Location:" . $_SERVER['PHP_SELF']);
            }
            return $result;
        }
    }

    // calculate sub total
    public function getSum($arr){
        if(isset($arr)){
            $sum = 0;
            foreach ($arr as $item){
                $sum += floatval($item[0]);
            }
            return sprintf('%.2f' , $sum);
        }
    }

    // get item_id of shopping cart list
    public function getCartId($cartArray = null, $key = "item_id"){
        if ($cartArray != null){
            $cart_id = array_map(function ($value) use($key){
                return $value[$key];
            }, $cartArray);
            return $cart_id;
        }
    }

    // Save for later
    public function saveForLater($item_id = null, $user_id=null, $saveTable = "wishlist", $fromTable = "cart"){
        if ($item_id != null){
            $query = "INSERT INTO {$saveTable} SELECT * FROM {$fromTable} WHERE item_id={$item_id} AND user_id={$user_id};";
            $query .= "DELETE FROM {$fromTable} WHERE item_id={$item_id} AND user_id={$user_id};";

            // execute multiple query
            $result = $this->db->con->multi_query($query);

            if($result){
                header('location:cart.php');
            }
            return $result;
        }
    }

    public function addProduct($pid,$qty){
        $_SESSION['cart'][$pid]['qty']=$qty;
    }
    public function updateProduct($pid,$qty){
        if(isset($_SESSION['cart'][$pid])){
            $_SESSION['cart'][$pid]['qty']=$qty;
        }
        
    }
    public function removeProduct($pid){
        if(isset($_SESSION['cart'][$pid])){
            unset($_SESSION['cart'][$pid]);
        }
    }
    public function emptyProduct(){
        unset($_SESSION['cart']);
    }
    public function totalProduct(){
        if(isset($_SESSION['cart'])){
            return count($_SESSION['cart']);
        }else{
            return 0; 
        } 
    }
}