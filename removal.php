<?php
require('./includes/config.inc.php');
require(MYSQL);
	if(isset($_POST['index_to_remove']) && $_POST['index_to_remove'] != ""){
        $key_to_remove = $_POST['index_to_remove'];
        if(sizeof($_SESSION["cart"]) <= 1){
            unset($_SESSION["cart"]);
        }else{
            unset($_SESSION["cart"]["$key_to_remove"]);
            sort($_SESSION["cart"]);
        }
    }
	header("Location: basket.php");
    exit;

?>