<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Good Eatz - About Us</title>
        <link rel="stylesheet" type="text/css" href="../includes/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../includes/css/homepage.css">
        <script language="javascript" type="text/javascript" src="../includes/js/jquery-1.11.2.min.js"></script>
        <script language="javascript" type="text/javascript" src="../includes/js/bootstrap.min.js"></script>
        <?php require '../includes/php/config.php'; ?>
    </head>
    <body>
        <?php include("../includes/php/header.php"); ?>
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
                        <li><a href=<?php echo $GLOBALS['FS_INTRANET_RESTAURANT']; ?>><span class="glyphicon glyphicon-home"></span> Home<span class="sr-only">(current)</span></a></li>
                        <li class="active"><a href=<?php echo ($GLOBALS['FS_INTRANET_RESTAURANT']."views/about_us.php");?> >About Us</a></li>
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
            <!-- Introduction Row -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">About Us
                        <small>It's Nice to Meet You!</small>
                    </h1>
                    <p style="font-size: 17px;">Good Eatz is a online local bar and restaurant guide that provides reviews from professional food critics, bloggers, and diners, etc. Available online only and provides information for Ottawa, Canada.</p>
                </div>
            </div>
            <!-- Team Members Row -->
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Our Team</h2>
                </div>
                <div class="col-lg-4 col-sm-6 text-center">
                    <img class="img-circle img-responsive img-center" src="../includes/images/" alt="">
                    <h3>Omnomnom
                        <small>Senior Eater</small>
                    </h3>
                    <p>The fatty of the group</p>
                </div>
                <div class="col-lg-4 col-sm-6 text-center">
                    <img class="img-circle img-responsive img-center" src="../includes/images/" alt="">
                    <h3>Miss Dessert Eater
                        <small>Senior Dessert Eater</small>
                    </h3>
                    <p>Omnomnom</p>
                </div>
                <div class="col-lg-4 col-sm-6 text-center">
                    <img class="img-circle img-responsive img-center" src="../includes/images/" alt="">
                    <h3>Miss Fatty
                        <small>Junior Cake Eater</small>
                    </h3>
                    <p>Thinks she's a fatty, but really not</p>
                </div>
            </div>
            <!-- <hr> -->
        </div>
        <!-- /.container -->
        <?php include("../includes/php/footer.php"); ?>
    </body>
</html>