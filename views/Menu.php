<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Good Eatz - Restaurant Info</title>
        <link rel="stylesheet" type="text/css" href="../includes/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../includes/css/homepage.css">
        <link rel="stylesheet" type="text/css" href="../includes/css/restaurantInfo.css">
        <script language="javascript" type="text/javascript" src="../includes/js/jquery-1.11.2.min.js"></script>
        <script language="javascript" type="text/javascript" src="../includes/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php include("../includes/php/header.php"); ?>
        <!-- Page Content -->
        <div style="position: absolute; top:60px; left:10px; width:1070px; height:335px">
            <div class="col-md-3">
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
            </div>
        </div>
        <!--Restaurant name & type & URL-->
        <div style="position: absolute; top:120px; left:550px; width:300px; height:35px">
            <h2><b><?php echo $restaurantInfo[0]['name']; ?></b></h2>
            <h4><?php echo $restaurantInfo[0]['phone_num']; ?></h4>
            <h5><?php echo $restaurantInfo[0]['street_address']; ?> <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span></h5>
            <h5><?php echo $restaurantInfo[0]['type']; ?> <span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span></h5>
            <h5><a style='text-decoration: none' href="<?php echo $restaurantInfo[0]['url']; ?>"><?php echo $restaurantInfo[0]['url']; ?></a> <span class="glyphicon glyphicon-globe" aria-hidden="true"></span></h5>
        </div>
        <!--Picture of restaurant -->
        <div style="position: absolute; top:120px; left:320px; width:5005px; height:35px">
            <img style="border-radius:5px; padding: 0px;" src="../includes/images/cat.jpg">
        </div>
        <!--Overall rating for restaurant -->
        <div style="position: absolute; top:155px; left:990px; width:95px; height:45px">
            <div id='Rating'>
                <h1><?php echo (((float)$restaurantRating/5*100)."%"); ?></h1>
            </div>
        </div>
        <!--Number of reviews -->
        <div style="position: absolute; top:245px; left:1000px; width:500px; height:35px">
            <h5>
                <?php
                    echo "<a style='text-decoration: none' href='".$GLOBALS['FS_INTRANET_RESTAURANT']."controller/ratingsAndReviews-controller.php?page=restaurant-info&restaurantName=". $restaurantName 
                    	."&restaurantLoc=". $restaurantLoc ."&restRating=". $restaurantRating ."'>".$restaurantReviewNum[0]['number_of_review']." Review(s)</a>";
                    ?>
            </h5>
            <!--Delete restuarant button-->
            <?php
                echo "<form role='deleteRest' action='../controller/restaurantInfo-controller.php?page=delete-restaurant-location&restLocId=".$restaurantInfo[0]['locationid']."' method='post'>
                        <button type='submit' class='btn btn-danger'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span> Delete restaurant</button>
                    </form>";
            ?>
        </div>
        <div style="position: absolute; top:355px; left:300px; width:800px; height:35px">
            <ul class="nav nav-tabs">
                <li role="presentation">
                    <?php
                        echo "<a style='text-decoration: none' href='".$GLOBALS['FS_INTRANET_RESTAURANT']."controller/restaurantInfo-controller.php?page=restaurant-info&restaurantName=". $restaurantName 
                        	."&restaurantLoc=". $restaurantLoc ."&restRating=". $restaurantRating ."'>About</a>";
                        ?>
                </li>
                <li role="presentation" class="active"><a href="#">Menu</a></li>
                <li role="presentation">
                    <?php
                        echo "<a style='text-decoration: none' href='".$GLOBALS['FS_INTRANET_RESTAURANT']."controller/ratingsAndReviews-controller.php?page=restaurant-info&restaurantName=". $restaurantName 
                        	."&restaurantLoc=". $restaurantLoc ."&restRating=". $restaurantRating ."'>Ratings and Reviews</a>";
                        ?>
                </li>
            </ul>
        </div>
        <!--Restaurant MENU-->
        <div style="position: absolute; top:415px; left:300px; width:900px; height:80px">
            <div class="container">
                <h3>Add menu item</h3>
                <form class="form-inline" role="add-menu-item" action='../controller/menu-controller.php?page=add-menu-item' method='post'>
                    <?php echo "<input type='hidden' name='rest-id' value='".$restaurantInfo[0]['restaurantid']."'>
                                <input type='hidden' name='rest-name' value='".$restaurantName."'>
                                <input type='hidden' name='rest-loc' value='".$restaurantLoc."'>
                                <input type='hidden' name='rest-rating' value='".$restaurantRating."'>"; 
                    ?>
                    <div class="form-group">
                        <select class="form-control" name="menu-category">
                            <option value="Starter">Starter</option>
                            <option value="Main">Main</option>
                            <option value="Dessert">Dessert</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="menu-type">
                            <option value="Food">Food</option>
                            <option value="Beverage">Beverage</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="item-id" class="form-control" name="item-id" placeholder="Item ID" size="8">
                    </div>
                    <div class="form-group">
                        <input type="item-name" class="form-control" name="item-name" placeholder="Item name">
                    </div>
                    <div class="form-group">
                        <input type="item-description" class="form-control" name="item-description" placeholder="Description" size="25">
                    </div>
                    <div class="form-group">
                        <input type="item-price" class="form-control" name="item-price" placeholder="Price (No $)" size="8">
                    </div>
                        <button type="submit" class="btn btn-success" aria-label="Left Align">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
                    </button>
                </form>
            </div>
            <div id="bigblock2">
                <div class= "transbox">
                    <h4><span style="padding-left:28px;"><B>Starters:</B></h4>
                    <ul class="list-group">
                        <?php
                            $sCount = 0;
                            for ($i = 0, $size = count($menuInfo); $i < $size; $i++) {
                            	if ($menuInfo[$i]['category'] === 'Starter') {
                            		echo "<li class='list-group-item'>
                    						<h5><b>Item name:</b> ". $menuInfo[$i]['mi_name'] ."</h5>
                    						<p><b>Description:</b> ". $menuInfo[$i]['description'] ."</p>
                    						<p><b>Price:</b> ". $menuInfo[$i]['price'] ."</p>
                                            <form role='deleteMenuStarter' action='../controller/menu-controller.php?page=delete-menu-item&menuItemId=".$menuInfo[$i]['itemid']."&restaurantName=". $restaurantName 
                                        ."&restaurantLoc=". $restaurantLoc ."&restRating=". $restaurantRating."' method='post'>
                                                <button type='submit' class='btn btn-danger'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span> Delete item</button>
                                            </form>
                            			</li>";
                            		$sCount++;
                            	} 
                            }
                            if ($sCount === 0) {
                            	echo "<li class='list-group-item'>
                        					<h5><b>None</b></h5>
                        			</li>";
                            	unset($sCount);
                            }
                        ?>
                    </ul>
                </div>
                <div class= "transbox">
                    <h4><span style="padding-left:28px;"><B>Mains:</B></h4>
                    <ul class="list-group">
                    <?php
                        $mCount = 0;
                        for ($i = 0, $size = count($menuInfo); $i < $size; $i++) {
                        	if ($menuInfo[$i]['category'] === 'Main') {
                        		echo "<li class='list-group-item'>
                						<h5><b>Item name:</b> ". $menuInfo[$i]['mi_name'] ."</h5>
                						<p><b>Description:</b> ". $menuInfo[$i]['description'] ."</p>
                						<p><b>Price:</b> ". $menuInfo[$i]['price'] ."</p>
                						<form role='deleteMenuMain' action='../controller/menu-controller.php?page=delete-menu-item&menuItemId=".$menuInfo[$i]['itemid']."&restaurantName=". $restaurantName 
                                        ."&restaurantLoc=". $restaurantLoc ."&restRating=". $restaurantRating."' method='post'>
                                            <button type='submit' class='btn btn-danger'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span> Delete item</button>
                                        </form>
                    				</li>";
                        		$mCount++;
                        	} 
                        }
                        if ($mCount === 0) {
                        	echo "<li class='list-group-item'>
                    					<h5><b>None</b></h5>
                    			</li>";
                    		unset($mCount);
                        }
                    ?>
                </div>
                <div class= "transbox">
                    <h4><span style="padding-left:28px;"><B>Desserts:</B></h4>
                    <ul class="list-group">
                    <?php
                        $dCount = 0;
                        for ($i = 0, $size = count($menuInfo); $i < $size; $i++) {
                        	if ($menuInfo[$i]['category'] === 'Dessert') {
                        		echo "<li class='list-group-item'>
                						<h5><b>Item name:</b> ". $menuInfo[$i]['mi_name'] ."</h5>
                						<p><b>Description:</b> ". $menuInfo[$i]['description'] ."</p>
                						<p><b>Price:</b> ". $menuInfo[$i]['price'] ."</p>
                						<form role='deleteMenuDessert' action='../controller/menu-controller.php?page=delete-menu-item&menuItemId=".$menuInfo[$i]['itemid']."&restaurantName=". $restaurantName 
                                        ."&restaurantLoc=". $restaurantLoc ."&restRating=". $restaurantRating."' method='post'>
                                            <button type='submit' class='btn btn-danger'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span> Delete item</button>
                                        </form>
                        			</li>";
                        		$dCount++;
                        	} 
                        }
                        if ($dCount === 0) {
                        	echo "<li class='list-group-item'>
                    					<h5><b>None</b></h5>
                    			</li>";
                        	unset($dCount);
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>