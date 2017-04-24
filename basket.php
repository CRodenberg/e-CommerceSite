<?php
require('./includes/config.inc.php');
require(MYSQL);
if(isset($_GET['buy'])){
  $product_id = $_GET['buy'];
  if(isset($_SESSION['cart'])){
    array_push($_SESSION['cart'],$product_id);
    }
}
if(isset($_POST['index_to_remove']) && $_POST['index_to_remove'] != ""){
    $key_to_remove = $_POST['index_to_remove'];
    if(sizeof($_SESSION["cart"]) <= 1){
        unset($_SESSION["cart"]);
    }else{
        unset($_SESSION["cart"]["$key_to_remove"]);
        sort($_SESSION["cart"]);
    }
}
include('./includes/header.html');
?>


    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="\index.php">Home</a>
                        </li>
                        <li>Shopping cart</li>
                    </ul>
                </div>

                <div class="col-md-9" id="basket">

                    <div class="box">

                        <form method="post" action="basket.php">

                            <h1>Shopping cart</h1>
                            <p class="text-muted">You currently have <?php if(isset($_SESSION['cart'])){echo sizeof($_SESSION['cart']);} else{ echo 0;}?> item(s) in your cart.</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Product</th>
                                            <th>Quantity</th>
                                            <th>Unit price</th>
                                            <th>Discount</th>
                                            <th colspan="2">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(empty($_SESSION['cart'])){
                                                echo 'Your Cart is Empty!';
                                            }
                                            else{
                                                $total = 0;
                                                $i = 0;
                                                foreach($_SESSION['cart'] as $cart_item){
                                                    if($cart_item >= 1000 && $cart_item < 2000){
                                                        $cart_array = $dbc->query("SELECT * FROM decade_products WHERE product_code =" . $cart_item);//DB Call
                                                    }else{
                                                       $cart_array = $dbc->query("SELECT * FROM specific_products WHERE product_code =" . $cart_item);//DB Call 
                                                    }
                                                    $row = $cart_array->fetch_assoc();
                                                    $total += ($row["price"]/100);
                                                    echo '<tr>
                                                            <td>
                                                                <a href="#">
                                                                    <img src="' . $row["image"] . '" alt="' . $row["image"] . '">
                                                                </a>
                                                            </td>
                                                            <td><a href="#">' . $row["name"] . '</a>
                                                            </td>
                                                            <td>
                                                                1
                                                            </td>
                                                            <td>$' . $row["price"]/100 . '</td>
                                                            <td>$0.00</td>
                                                            <td>$' . $row["price"]/100 . '</td>
                                                            <td>
                                                                <form action = "basket.php" method = "post"><input name="deleteBtn' . $cart_item . '" type = "submit" value ="X"/><input name = "index_to_remove" type = "hidden" value = "'. $i .'"/>
                                                                </form>
                                                            </td>
                                                        </tr>';
                                                    $i++;
                                                }
                                            }

                                        ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5">Total</th>
                                            <th colspan="2">$<?php if(isset($total)) echo $total; else echo "0.00"; ?></th>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                            <!-- /.table-responsive -->

                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="category.php?id=retro" class="btn btn-default"><i class="fa fa-chevron-left"></i> Continue shopping</a>
                                </div>
                                <div class="pull-right">
                                    <button class="btn btn-default"><i class="fa fa-refresh"></i> Update basket</button>
                                    <a href = "checkout.php" class = "btn btn-default">Proceed to checkout <i class="fa fa-chevron-right"></i>
                                    </a>
                                </div>
                            </div>

                        </form>

                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-md-3">
                    <div class="box" id="order-summary">
                        <div class="box-header">
                            <h3>Order summary</h3>
                        </div>
                        <p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Order subtotal</td>
                                        <th>$<?php if(isset($total)) echo $total; else echo "0.00";?></th>
                                    </tr>
                                    <tr>
                                        <td>Shipping and handling</td>
                                        <th>$10.00</th>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <th>$0.00</th>
                                    </tr>
                                    <tr class="total">
                                        <td>Total</td>
                                        <th>$<?php if(isset($total)) echo ($total + 10); else echo "0.00";?></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>


                    <div class="box">
                        <div class="box-header">
                            <h4>Coupon code</h4>
                        </div>
                        <p class="text-muted">If you have a coupon code, please enter it in the box below.</p>
                        <form>
                            <div class="input-group">

                                <input type="text" class="form-control">

                                <span class="input-group-btn">

					<button class="btn btn-primary" type="button"><i class="fa fa-gift"></i></button>

				    </span>
                            </div>
                            <!-- /input-group -->
                        </form>
                    </div>

                </div>
                <!-- /.col-md-3 -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->

<?php
    include('./includes/footer.html');
?>