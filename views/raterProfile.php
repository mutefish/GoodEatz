<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Good Eatz - Rater Profile</title>
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
        <?php
            if (count($raterProfileInfo) !== 0) {
                echo "<div style='position: absolute; top:55px; left:350px; width:300px; height:35px'>
                        <h2><b>". $userID ."</b></h2>
                        <h5>Joined on ". $raterProfileInfo[0]['join_date'] . "</h5>
                    </div>
                    <div style='position: absolute; top:150px; left:350px; width:700px; height:35px'>
                        <ul class='list-group'>
                            <li class='list-group-item'>
                                <h5>
                                    Name: ". $raterProfileInfo[0]['rater_name'] ."
                                    <span class='glyphicon glyphicon-user' aria-hidden='true'></span>
                                    <span style='padding-left:430px;'></span>
                                    <!--Delete restuarant button-->
                                    <form role='deleteUser' action='../controller/raterProfile-controller.php?page=delete-user&userid=".$userID."' method='post'>
                                        <button style='float: right;' type='submit' class='btn btn-danger'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span> Delete user</button> 
                                    </form>
                                </h5>
                                <h5>Email: ".$raterProfileInfo[0]['email']."
                                    <span class='glyphicon glyphicon-envelope' aria-hidden='true'></span>
                                </h5>
                                <h5>Type: ".$raterProfileInfo[0]['rater_type']."</h5>
                                <h5>User reputation: ".$raterProfileInfo[0]['reputation']."</h5>
                            </li>
                        </ul>
                    </div>
                    <div style='position: absolute; top:325px; left:350px; width:800px; height:35px'>
                        <ul class='nav nav-tabs'>
                            <li role='presentation' class='active'><a href='#'>Restaurant reviews</a></li>
                            <li role='presentation'>
                                <a style='text-decoration: none' href='".$GLOBALS['FS_INTRANET_RESTAURANT']."controller/itemReview-controller.php?page=rater-profile-item-review&userid=". $userID . "'>Item reviews</a></li>
                        </ul>
                    </div>";
            } else {
                echo "<div style='position: absolute; top:55px; left:350px; width:600px; height:35px'>
                        <h2><b>Cannot find user '". $userID ."'</b></h2>
                    </div>";
            }
        ?>
        <div style="position: absolute; top:385px; left:350px; width:800px; height:80px">
            <ul class="list-group">
                <?php
                    $rReviews = 0;
                    if (count($raterProfileInfo) !== 0) {
                        for ($i = 0, $size = count($raterProfileComments); $i < $size; $i++) {
                            echo "<li class='list-group-item'>
                                    <h5>Date posted: ".$raterProfileComments[$i]['datepub']." <span class='glyphicon glyphicon-time' aria-hidden='true'></span></h5>
                                    <h5>Review for: ".$raterProfileComments[$i]['name']."</h5>
                                    <p>Price: ".$raterProfileComments[$i]['price']."<span style='padding-left:68px;''></span>Food: ".$raterProfileComments[$i]['food']."</p>
                                    <p> Mood: ".$raterProfileComments[$i]['mood']."<span style='padding-left:59px;'></span>Staff: ".$raterProfileComments[$i]['staff']." </p>
                                    <p>Comments: ".$raterProfileComments[$i]['comments']."</p>
                                </li>";
                            $rReviews++;
                        } 
                        if ($rReviews === 0) {
                            echo "<li class='list-group-item'>
                                    <h5><Strong>None!</Strong></h5>
                                </li>";
                        }
                        unset($rReviews);
                    } 
                ?>
            </ul>
        </div>
    </body>
</html>