<?php
	require('./includes/config.inc.php');
	require(MYSQL);
	include('./includes/header.html');
?>

<div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="index.php">Home</a>
                        </li>
                        <li>Checkout - Order review</li>
                    </ul>
                </div>

                <div class="col-md-9" id="checkout">

                    <div class="box">
                        <form method="post" action="checkout4.html">
                            <h1>Checkout - Order review</h1>
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="#addressDiv"><i class="fa fa-map-marker"></i><br>Address</a>
                                </li>
                                <li><a href="#deliveryDiv"><i class="fa fa-truck"></i><br>Delivery Method</a>
                                </li>
                                <li><a href="#paymentDiv"><i class="fa fa-money"></i><br>Payment Method</a>
                                </li>
                                <li><a href="#orderDiv"><i class="fa fa-eye"></i><br>Order Review</a>
                                </li>
                            </ul>

                            <div class="content">
                            	<div class="row" id = "addressDiv">
                            		<div class = "col-sm-12">
                            			<h3>Address and Information</h3>
                            		</div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="firstname">Firstname</label>
                                            <input type="text" class="form-control" id="firstname">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="lastname">Lastname</label>
                                            <input type="text" class="form-control" id="lastname">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="street">Street</label>
                                            <input type="text" class="form-control" id="street">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->

                                <div class="row">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label for="zip">ZIP</label>
                                            <input type="text" class="form-control" id="zip">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label for="state">State</label>
                                            <select class="form-control" id="state"></select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="phone">Telephone</label>
                                            <input type="text" class="form-control" id="phone">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email">
                                        </div>
                                    </div>

                                </div>
                                <!-- /.row -->

                                <div class="row" id = "deliveryDiv">
                                	<div class = "col-sm-12">
                                		<h3>Shipping Method</h3>
                                	</div>
                                    <div class="col-sm-6">
                                        <div class="box shipping-method">

                                            <h4>USPS Next Day</h4>

                                            <p>Get it right on next day - fastest option possible.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->

                                <div class="row" id = "paymentDiv">
                                	<div class = "col-sm-12">
                                		<h3>Payment Method</h3>
                                	</div>
                                    <div class="col-sm-6">
                                        <div class="box payment-method">

                                            <h4>Paypal</h4>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->

								<div class = "col-sm-12" id = "orderDiv">
                            		<h3>Order Review</h3>
                            	</div>
                                <div class="table-responsive">
                                	
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Product</th>
                                                <th>Quantity</th>
                                                <th>Unit price</th>
                                                <th>Discount</th>
                                                <th>Total</th>
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
                                                        </tr>';
                                                    $i++;
                                                }
                                            }

                                        ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="5">Total</th>
                                                <th>$<?php if(isset($total)) echo $total; else echo "0.00"; ?></th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.content -->

                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="basket.php" class="btn btn-default"><i class="fa fa-chevron-left"></i>Back to Basket</a>
                                </div>
                                <div class="pull-right">
                                    <a href = "paypal.php" class="btn btn-primary">Place an order<i class="fa fa-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->


                </div>
                <!-- /.col-md-9 -->

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

                </div>
                <!-- /.col-md-3 -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->




<?php
	include('./includes/footer.html');
?>