<?php

require('./includes/config.inc.php');
require(MYSQL);
include('./includes/header.html');

//Encode the URL
$current_url = urlencode($url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

//Get the searched id from the URL. If an id is not set, then default the category to retro
if(isset($_GET['id'])){
  $category_name = $_GET['id'];  
}else{
    $category_name = 'retro';
}
?>
<div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li>
                            <a href="\index.php">Home</a>
                        </li>
                        <?php 
                            if($category_name == "women") echo '<li>Women</li>';
                            elseif($category_name == "men") echo '<li>Men</li>';
                            elseif($category_name == "retro") echo '<li>Retro Items</li>';
                        ?>
                    </ul>
                </div>

                <div class="col-md-3">
                    <!-- *** MENUS AND FILTERS ***
 _________________________________________________________ -->
                    <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">Categories</h3>
                        </div>

                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked category-menu">
                                <li id = "men_tab" <?php if($category_name == "men") echo 'class="active"'; ?>>
                                    <a href="category.php?id=men">Men</a>
                                    <ul>
                                        <li><a href="category.php?id=men">T-shirts</a>
                                        </li>
                                        <li><a href="category.php?id=men">Shirts</a>
                                        </li>
                                        <li><a href="category.php?id=men">Pants</a>
                                        </li>
                                    </ul>
                                </li>
                                <li id = "women_tab" <?php if($category_name == "women") echo 'class="active"'; ?>>
                                    <a href="category.php?id=women">Women</a>
                                    <ul>
                                        <li><a href="category.php?id=women">T-shirts</a>
                                        </li>
                                        <li><a href="category.php?id=women">Pants</a>
                                        </li>
                                    </ul>
                                </li>
                                <li id = "kids_tab" <?php if($category_name == "kids") echo 'class="active"'; ?>>
                                    <a href="category.php?id=men">Kids</a>
                                    <ul>
                                        <li><a href="category.php?id=men">T-shirts</a>
                                        </li>
                                        <li><a href="category.php?id=men">Pants</a>
                                        </li>
                                    </ul>
                                </li>
                                <li id = "retro_tab" <?php if($category_name == "retro") echo 'class="active"'; ?>>
                                    <a href="category.php?id=retro">Retro Items</a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="box" <?php if($category_name != "women") echo 'style = "display: none"'?> id = "women_box">
                        <h1>Women</h1>
                        <p>In our Women's department we offer wide selection of the best products we have found and carefully selected from the past.</p>
                    </div>
                    <div class="box" <?php if($category_name != "men") echo 'style = "display: none"'?> id = "men_box">
                        <h1>Men</h1>
                        <p>Check out all of our latest products for Men. We have various items from the past, and customizable options as well!</p>
                    </div>
                    <div class="box" <?php if($category_name != "boys") echo 'style = "display: none"'?> id = "boys_box">
                        <h1>Boys</h1>
                        <p>Check out all of our latest products for Boys. We have various items from the past, and customizable options as well!</p>
                    </div>
                    <div class="box" <?php if($category_name != "girls") echo 'style = "display: none"'?> id = "girls__box">
                        <h1>Girls</h1>
                        <p>Check out all of our latest products for Girls. We have various items from the past, and customizable options as well!</p>
                    </div>
                    <div class="box info-bar">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 products-showing">
                                Showing <strong>12</strong> of <strong>25</strong> products
                            </div>

                            <div class="col-sm-12 col-md-8  products-number-sort">
                                <div class="row">
                                    <form class="form-inline">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="products-number">
                                                <strong>Show</strong>  <a href="#" class="btn btn-default btn-sm btn-primary">12</a>  <a href="#" class="btn btn-default btn-sm">24</a>  <a href="#" class="btn btn-default btn-sm">All</a> products
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="products-sort-by">
                                                <strong>Sort by</strong>
                                                <select name="sort-by" class="form-control">
                                                    <option>Price</option>
                                                    <option>Name</option>
                                                    <option>Sales first</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row products">
<!--PHP Code to Generate the Products from the Database. As of 4/9/17, this code will also check to see whether the user searched for Men, Women, or Retro-->
<?php

//Check if the cart is empty. If true, initialize the cart session.
if(empty($_SESSION['cart'])){
  $_SESSION['cart'] = array();
}

//Check if the category is retro. If so, select all retro products from the DB. Display all products.
if($category_name == 'retro'){
    $product_array = $dbc->query("SELECT * FROM decade_products ORDER BY id ASC");//DB Call
    while($row = $product_array->fetch_assoc()) {

        $id = $row['product_code'];//Set $id = product. This will be passed through the URL.

        //echo the html for the individual products along with their values from the database
        echo '                    <div class="col-md-4 col-sm-6">
                                <div class="product">
                                    <div class="flip-container">
                                        <div class="flipper">
                                            <div class="front">
                                                <a href="detail.html">
                                                    <img src="'. $row["image"] .'" alt="" class="img-responsive">
                                                </a>
                                            </div>
                                            <div class="back">
                                                <a href="detail.html">
                                                    <img src="'. $row["image"] .'" alt="" class="img-responsive">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="detail.html" class="invisible">
                                        <img src="'. $row["image"] .'" alt="" class="img-responsive">
                                    </a>
                                    <div class="text">
                                        <h3><a href="detail.html">' . $row["name"] . '</a></h3>
                                        <p class="price">' . '$' . $row["price"]/100 . '</p>
                                        <p class="buttons">
                                            <a href="#" class="btn btn-default">View detail</a>
                                            <a href="basket.php?buy=' . $id . '" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </p>
                                    </div>
                                    <!-- /.text -->
                                </div>
                                <!-- /.product -->
                            </div>             
            '; 
    }//End while
}//End if

//Check if the category is men. If so, select all men products from the DB. Display all products.
else if($category_name == 'men'){
    $product_array = $dbc->query("SELECT * FROM specific_products WHERE general_categories_id = 1 ORDER BY id ASC");
    while($row = $product_array->fetch_assoc()) {

    echo '                    <div class="col-md-4 col-sm-6">
                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="detail.html">
                                                <img src="'. $row["image"] .'" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="detail.html">
                                                <img src="'. $row["image"] .'" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="detail.html" class="invisible">
                                    <img src="'. $row["image"] .'" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3><a href="detail.html">' . $row["name"] . '</a></h3>
                                    <p class="price">' . '$' . $row["price"]/100 . '</p>
                                    <p class="buttons">
                                        <a href="detail.html" class="btn btn-default">View detail</a>
                                        <a href="basket.html" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </p>
                                </div>
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                        </div>             
        '; 
    }
}//End else if
else if($category_name == 'women'){
    $product_array = $dbc->query("SELECT * FROM specific_products WHERE general_categories_id = 2 ORDER BY id ASC");
    while($row = $product_array->fetch_assoc()) {
    //foreach($product_array as $key=>$value){
    echo '                    <div class="col-md-4 col-sm-6">
                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="detail.html">
                                                <img src="'. $row["image"] .'" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="detail.html">
                                                <img src="'. $row["image"] .'" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="detail.html" class="invisible">
                                    <img src="'. $row["image"] .'" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3><a href="detail.html">' . $row["name"] . '</a></h3>
                                    <p class="price">' . '$' . $row["price"]/100 . '</p>
                                    <p class="buttons">
                                        <a href="detail.html" class="btn btn-default">View detail</a>
                                        <a href="basket.html" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </p>
                                </div>
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                        </div>             
        '; 
    }
}//else if
else{
    echo 'Sorry, that category is no longer being offered on our site. For further information, ask us on our Social Media or email support';
}

// if(isset($_SESSION["cart"]) && count($_SESSION["cart"]) > 0){
//     $total = 0;
//     $b = 0;
//     foreach($_SESSION["cart"] as $cart_itm){
//         $product_name = $cart_itm["name"];
//         $product_qty = $cart_itm["product_qty"];
//         $product_price = $cart_itm["price"];
//         $product_code = $cart_itm["product_code"];

//         $subtotal = ($product_price * $product_qty);
//         $total = ($total + $subtotal);
//     }

//     $current_url = urlencode($url="http://". $SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
// }

?>
<!--End PHP Code for Generating Products -->

                    </div>
                    <!-- /.products -->
                    <div class="pages">

                        <p class="loadMore">
                            <a href="#" class="btn btn-primary btn-lg"><i class="fa fa-chevron-down"></i> Load more</a>
                        </p>

                        <ul class="pagination">
                            <li><a href="#">&laquo;</a>
                            </li>
                            <li class="active"><a href="#">1</a>
                            </li>
                            <li><a href="#">2</a>
                            </li>
                            <li><a href="#">3</a>
                            </li>
                            <li><a href="#">4</a>
                            </li>
                            <li><a href="#">5</a>
                            </li>
                            <li><a href="#">&raquo;</a>
                            </li>
                        </ul>
                    </div>


                </div>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
<script type="text/javascript">
    var TB = TB || {};
    TB.Categories = {};

    TB.SetTab = function(){

    }


</script>


<?php
include('./includes/footer.html');
?>