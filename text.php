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
                        <li>About Us</li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <!-- *** PAGES MENU ***
 _________________________________________________________ -->
                    <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">Pages</h3>
                        </div>

                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked">
                                <li>
                                    <a href="contact.php">Contact page</a>
                                </li>
                                <li>
                                    <a href="faq.php">FAQ</a>
                                </li>

                            </ul>

                        </div>
                    </div>

                    <!-- *** PAGES MENU END *** -->
                </div>

                <div class="col-md-9">

                    <div class="box" id="text-page">
                        <h1>About Us</h1>

                        <p class="lead">This company was founded around the principles of bringing everyone the pleasures and joys they experienced in the past.</p>

                        <p>Nostalgia has struck this company with the goal to bring great memories from the past back into light. As a newly founded company from Louisville, Kentucky, we aim to provide the best possible online store for personalized and pre-made items. The three creators of this site: Drew Greenwood, Robert Settles, and Cole Rodenberg attend Bellarmine University and started this company in class.</p>

                        <h2>Learn More About Us!</h2>
                        <p>If you would like to know more about the company or the founders, contact us on social media through the links at the bottom of the page! We love to engage with our customers!</p>

                    </div>


                </div>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->

<?php
include('./includes/footer.html');
?>