<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Good Eatz - Home</title>
        <link rel="stylesheet" type="text/css" href="../includes/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../includes/css/homepage.css">
        <script language="javascript" type="text/javascript" src="../includes/js/jquery-1.11.2.min.js"></script>
        <script language="javascript" type="text/javascript" src="../includes/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top navbar-static-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href=<?php echo $GLOBALS['FS_INTRANET_RESTAURANT']; ?>><Strong style="color:#168716">Good Eatz</Strong></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href=<?php echo $GLOBALS['FS_INTRANET_RESTAURANT']; ?>><span class="glyphicon glyphicon-home"></span> Home<span class="sr-only">(current)</span></a></li>
                        <li><a href=<?php echo ($GLOBALS['FS_INTRANET_RESTAURANT']."views/about_us.php");?>>About Us</a></li>
                        <li><a href="http://fc09.deviantart.net/fs71/f/2014/007/0/2/the_cute_yellow_dude_____by_devil_of_my_own-d7199hi.jpg" target="_blank">Pikachu</a></li>
                    </ul>
                    <form class="navbar-form navbar-left" role="search" action='../controller/homepage-controller.php?page=restaurant-search' method='post'>
                        <div class="form-group">
                            <input name="nav-search" type="text" class="form-control" placeholder="Search...">
                        </div>
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span></button>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown" style="list-style-type: none;">
                            <!-- <a class="dropdown-toggle" data-toggle="dropdown">
                                <button type="button" class="btn btn-success"style="padding: 5px;">Sign in<b class="caret"></b></button>
                            </a> -->
                            <a class="dropdown-toggle" data-toggle="dropdown">Sign In <b class="caret"></b></a>
                            <ul class="dropdown-menu" style="padding: 10px; min-width: 270px;">
                                <li>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form class="form" role="form" method="post" action="../controller/raterProfile-controller.php?page=rater-profile" accept-charset="UTF-8" id="create-new-rater">
                                                <div class="form-group">
                                                    <label class="sr-only" for="inputRaterIDSearch">Rater search</label>
                                                    <input type="raterIDSearch" class="form-control" name="inputRaterIDSearch" placeholder="RaterID search" maxlength="25" required>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success btn-block">Search!</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown">Join <b class="caret"></b></a>
                            <ul class="dropdown-menu" style="padding: 15px; min-width: 270px;">
                                <li>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form class="form" role="form" method="post" action="../controller/raterProfile-controller.php?page=new-rater-profile" accept-charset="UTF-8" id="create-new-rater">
                                                <div class="form-group">
                                                    <label class="sr-only" for="inputUserID">Username</label>
                                                    <input type="userID" class="form-control" name="inputUserID" placeholder="Username" maxlength="25" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="inputEmail">Email address</label>
                                                    <input type="email" class="form-control" name="inputEmail" placeholder="Email address" maxlength="40" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="inputName">Full name</label>
                                                    <input type="fullName" class="form-control" name="inputName" placeholder="Full name" maxlength="35" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="inputType">Rater type</label>
                                                    <input type="raterType" class="form-control" name="inputType" placeholder="Rater type" maxlength="25" required>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success btn-block">Join!</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
        <!-- Page Content -->
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div style="position: absolute; top:-10px; left:-3px; width:237px; height:335px">
                        <h3>Cuisine</h3>
                        <ul class="list-group">
                            <?php
                                foreach ($cuisineTypeArr as $key=>$value) {
                                echo "<li class='list-group-item'>
                                        <span class='badge'>$value</span>
                                        <b><a style='text-decoration: none' href='".$GLOBALS['FS_INTRANET_RESTAURANT']."controller/search-controller.php?page=search-result&cuisineID=$key'>$key</a></b>
                                        </li>";
                                }
                            ?>
                        </ul>
                        <li class="dropdown" style="list-style-type: none;">
                            <a class="dropdown-toggle" data-toggle="dropdown">
                            <button type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add restaurant <b class="caret"></b></button>
                            </a>
                            <ul class="dropdown-menu" style="padding: 15px; min-width: 270px;">
                                <li>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form class="form" role="form" method="post" action="../controller/restaurantInfo-controller.php?page=new-restaurant-info" accept-charset="UTF-8" id="create-new-rater">
                                                <div class="form-group">
                                                    <label class="sr-only" for="inputRestaurantName">Restaurant name</label>
                                                    <input type="restaurantName" class="form-control" name="inputRestaurantName" placeholder="Restaurant name" maxlength="50" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="inputRestaurantID">Restaurant ID</label>
                                                    <input type="restaurantID" class="form-control" name="inputRestaurantID" placeholder="Restaurant ID" maxlength="10" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="inputRestaurantType">Restaurant type</label>
                                                    <input type="restaurantType" class="form-control" name="inputRestaurantType" placeholder="Restaurant type" maxlength="20" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="inputURL">URL</label>
                                                    <input type="url" class="form-control" name="inputURL" placeholder="Website" maxlength="100" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="inputDescription">Description</label>
                                                    <input type="description" class="form-control" name="inputDescription" placeholder="Description" maxlength="150" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="inputLocationID">Location ID</label>
                                                    <input type="locationID" class="form-control" name="inputLocationID" placeholder="Location ID" maxlength="10" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="inputFirstDateOpen">First date open</label>
                                                    <input type="firstDateOpen" class="form-control" name="inputFirstDateOpen" placeholder="Dated opened (YYYY-MM-DD)" maxlength="10" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="inputManager">Manager name</label>
                                                    <input type="managerName" class="form-control" name="inputManager" placeholder="Manager name" maxlength="15" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="inputPhoneNum">Phone number</label>
                                                    <input type="phoneNum" class="form-control" name="inputPhoneNum" placeholder="Phone number" maxlength="15" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="inputAddress">Address</label>
                                                    <input type="address" class="form-control" name="inputAddress" placeholder="Address" maxlength="50" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="inputHourOpen">Hour Open</label>
                                                    <input type="hourOpen" class="form-control" name="inputHourOpen" placeholder="Hour open" maxlength="10" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="sr-only" for="inputHourClose">Hour Close</label>
                                                    <input type="hourClose" class="form-control" name="inputHourClose" placeholder="Hour close" maxlength="10" required>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success btn-block">Add!</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row carousel-holder">
                        <div class="col-md-12">
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <img class="slide-image" src="../includes/images/slide-img1.jpg" alt="">
                                    </div>
                                    <div class="item">
                                        <img class="slide-image" src="../includes/images/slide-img2.jpg" alt="">
                                    </div>
                                    <div class="item">
                                        <img class="slide-image" src="../includes/images/slide-img3.jpg" alt="">
                                    </div>
                                </div>
                                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <h1>Most popular in Ottawa</h1>
                    <div class="row">
                        <div class="col-sm-4 col-lg-4 col-md-4">
                            <div class="thumbnail">
                                <img src="../includes/images/img1.jpg" alt="">
                                <div class="caption">
                                    <h4>
                                        <?php 
                                            echo "<a style='text-decoration: none' href='".$GLOBALS['FS_INTRANET_RESTAURANT']."controller/restaurantInfo-controller.php?page=restaurant-info&restaurantName=".$restaurantHomepageLinks1[0]['name'].
                                            "&restaurantLoc=".$restaurantHomepageLinks1[0]['street_address']."&restRating=". $restaurantRating1[0]['overallrating'] ."'>".$restaurantHomepageLinks1[0]['name']."</a>";
                                            ?>
                                    </h4>
                                    <p><?php echo $restaurantHomepageLinks1[0]['description']; ?></p>
                                    <p><Strong><?php echo $restaurantHomepageLinks1[0]['street_address'] ?></Strong></p>
                                </div>
                                <div class="ratings" style="color:#D11919">
                                    <p class="pull-right">8 reviews</p>
                                    <p>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star-empty"></span>
                                        <span class="glyphicon glyphicon-star-empty"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-lg-4 col-md-4">
                            <div class="thumbnail">
                                <img src="../includes/images/img2.jpg" alt="">
                                <div class="caption">
                                    <h4>
                                        <?php 
                                            echo "<a style='text-decoration: none' href='".$GLOBALS['FS_INTRANET_RESTAURANT']."controller/restaurantInfo-controller.php?
                                            page=restaurant-info&restaurantName=".$restaurantHomepageLinks2[0]['name'].
                                            "&restaurantLoc=".$restaurantHomepageLinks2[0]['street_address']."&restRating=". $restaurantRating2[0]['overallrating']."'>".$restaurantHomepageLinks2[0]['name']."</a>";
                                            ?>
                                    </h4>
                                    <p><?php echo $restaurantHomepageLinks2[0]['description']; ?></p>
                                    <p><Strong><?php echo $restaurantHomepageLinks2[0]['street_address'] ?></Strong></p>
                                </div>
                                <div class="ratings" style="color:#D11919">
                                    <p class="pull-right">7 reviews</p>
                                    <p>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star-empty"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-lg-4 col-md-4">
                            <div class="thumbnail">
                                <img src="../includes/images/img3.jpg" alt="">
                                <div class="caption">
                                    <h4>
                                        <?php 
                                            echo "<a style='text-decoration: none' href='".$GLOBALS['FS_INTRANET_RESTAURANT']."controller/restaurantInfo-controller.php?
                                            page=restaurant-info&restaurantName=".$restaurantHomepageLinks3[0]['name'].
                                            "&restaurantLoc=".$restaurantHomepageLinks3[0]['street_address'] ."&restRating=". $restaurantRating3[0]['overallrating']."'>".$restaurantHomepageLinks3[0]['name']."</a>";
                                            ?>
                                    </h4>
                                    <p><?php echo $restaurantHomepageLinks3[0]['description']; ?></p>
                                    <p><Strong><?php echo $restaurantHomepageLinks3[0]['street_address'] ?></Strong></p>
                                </div>
                                <div class="ratings" style="color:#D11919">
                                    <p class="pull-right">8 reviews</p>
                                    <p>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star"></span>
                                        <span class="glyphicon glyphicon-star-empty"></span>
                                        <span class="glyphicon glyphicon-star-empty"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include("../includes/php/footer.php"); ?>
    </body>
</html>