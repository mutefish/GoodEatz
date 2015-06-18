<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Good Eatz - Search</title>
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
        <div style="position: absolute; top:55px; left:320px; width:1007px; height:335px">
            <h2><?php echo $searchID; ?></h2>
        </div>
        <div style="position: absolute; top:115px; left:320px; width:700px; height:180px">
            <ul class="list-group">
                <?php
                    $size = count($restaurantSearch);
                    for ($i = 0; $i < $size; $i++) {
                      echo "<li class='list-group-item'>
                          <h4><a style='text-decoration: none' href='".$GLOBALS['FS_INTRANET_RESTAURANT']."controller/restaurantInfo-controller.php?page=restaurant-info&restaurantName=". $restaurantSearch[$i]['name'] ."&restaurantLoc=". $restaurantSearch[$i]['street_address'] . "&restRating=" . $restaurantSearch[$i]['overallrating'] ."'><b>".
                          $restaurantSearch[$i]['name']
                          . "</b></a></h4>
                          <p>Address: " . $restaurantSearch[$i]['street_address'] . "</p>
                          <p>Rating: ". (((float)$restaurantSearch[$i]['overallrating'])/5)*100 . "%" ."</>
                          </li>"; 
                    }
                    if ($size === 0) {
                      echo "<li class='list-group-item'>
                          <h4>Search invalid...</h4>
                          </li>"; 
                      unset($size);
                    }
                    ?>
            </ul>
        </div>
    </body>
</html>