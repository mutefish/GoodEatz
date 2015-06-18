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
            <img style="border-radius:5px; padding: 0px;"
                src="../includes/images/cat.jpg">
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
                    	."&restaurantLoc=". $restaurantLoc ."&restRating=". $restaurantRating."'>".$restaurantReviewNum[0]['number_of_review']." Review(s)</a>";
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
                        	."&restaurantLoc=". $restaurantLoc ."&restRating=". $restaurantRating."'>About</a>";
                        ?>
                </li>
                <li role="presentation">
                    <?php
                        echo "<a style='text-decoration: none' href='".$GLOBALS['FS_INTRANET_RESTAURANT']."controller/menu-controller.php?page=restaurant-info&restaurantName=". $restaurantName 
                        	."&restaurantLoc=". $restaurantLoc ."&restRating=". $restaurantRating."'>Menu</a>";
                        ?>
                </li>
                <li role="presentation" class="active"><a href="#">Ratings and Reviews</a></li>
            </ul>
        </div>
        <!--Restaurant rating and review-->
        <div style="position: absolute; top:415px; left:300px; width:900px; height:80px">
            <div id="bigblock2">
                <div class="transbox">
                    <h4><span style="padding-left:28px;"></span><b>Restaurant Ratings</b></h4>
                    <div class="ratings">
                        <ul class="list-group" style="color:#D11919">
                            <li class="list-group-item list">
                                <h5><b>Price: </b><span style="padding-left:78px;">
                                    <?php
                                        echo ($specificRestRatings[0]['avg_price'].'/5');
                                        ?>
                                </h5>
                            </li>
                            <li class="list-group-item">
                                <h5><b>Food:</b> <span style="padding-left:78px;">
                                    <?php
                                        echo ($specificRestRatings[0]['avg_food'].'/5');
                                        ?>
                                </h5>
                            </li>
                            <li class="list-group-item">
                                <h5><b>Mood: </b><span style="padding-left:73px;">
                                    <?php
                                        echo ($specificRestRatings[0]['avg_mood'].'/5');
                                        ?>
                                </h5>
                            </li>
                            <li class="list-group-item">
                                <h5><b>Staff: </b><span style="padding-left:80px;">
                                    <?php
                                        echo ($specificRestRatings[0]['avg_staff'].'/5');
                                        ?>
                                </h5>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="transbox">
                    <h4> <span style="padding-left:28px;"><b><?php echo ($restaurantReviewNum[0]['number_of_review'] . " Reviews:"); ?></b> </h4>
                    <!-- <a name="reviews"> -->
                    <ul class="list-group">
                        <?php
                            $reviewCount = 0;
                            for ($i = 0, $size = count($restReviewsInfo); $i < $size; $i++) {
                            	echo "<li class='list-group-item'>
                            				<h4><B>". ($i+1) .". </B>". $restReviewsInfo[$i]['comments'] ."</h4>
                            				<p>Posted by: <a style='text-decoration: none' href='".$GLOBALS['FS_INTRANET_RESTAURANT']."controller/raterProfile-controller.php?page=rater-profile&userid=". $restReviewsInfo[$i]['userid'] ."'>"
                            				. $restReviewsInfo[$i]['userid'] ."</a><br>Posted on:". $restReviewsInfo[$i]['datepub'] ."</p>	
                            			</li>";
                                $reviewCount++;
                            }
                            if ($reviewCount === 0) {
                                echo "<li class='list-group-item'>
                                            <h5><b>None</b></h5>
                                    </li>";
                                unset($reviewCount);
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </body>
</html>