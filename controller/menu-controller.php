<?php
session_start();
//============================================================================================
// Model and functions
//============================================================================================
require 'controller-functions.php';
require '../models/restaurant-model.php';
$model = new RestaurantModel();
$controlFunction = new ControllerFunction();

//============================================================================================
// Load the page requested by the user
//============================================================================================

if (!isset($_GET['page'])) {
	// May add something later on
} elseif ($_GET['page'] === "restaurant-info") {
	$homepageInfo = $model->selectAllFromTable("Restaurant");
	$cuisineTypeArr = $controlFunction->sideMenu($homepageInfo);
	
	$restaurantName = $_GET['restaurantName'];
	$restaurantLoc = $_GET['restaurantLoc'];
	$restaurantRating = $_GET['restRating'];

	$restaurantInfo = $model->getRestaurantByLocation($restaurantName, $restaurantLoc);

	$avgRestaurantRatings = $model->avgCategoryRating();
	$specificRestRatings = $controlFunction->filterRatings($restaurantName, $avgRestaurantRatings);

	$reviewNum = $model->restaurantNumReviews();
	$restaurantReviewNum = $controlFunction->filterReviews($restaurantName, $reviewNum);

	$menuInfo = $model->getMenuInfo($restaurantName);
	include '../views/Menu.php';
	exit;
} elseif ($_GET['page'] === "delete-menu-item") {
	$restaurantName = $_GET['restaurantName'];
	$restaurantLoc = $_GET['restaurantLoc'];
	$restaurantRating = $_GET['restRating'];
	$deleteMenuItemCond = "itemid = " . "'" . $_GET['menuItemId'] . "'";
	$deleteMenuItem = $model->deleteFrom("Menuitem", $deleteMenuItemCond);
	header("Location: menu-controller.php?page=restaurant-info&restaurantName=$restaurantName&restaurantLoc=$restaurantLoc&restRating=$restaurantRating");
} elseif ($_GET['page'] === "add-menu-item") {
	$restaurantName = $_POST['rest-name'];
	$restaurantLoc = $_POST['rest-loc'];
	$restaurantRating = $_POST['rest-rating'];
	$insertMenuData = array('itemid' => $_POST['item-id'], 
						    'restaurantid' => $_POST['rest-id'],
						    'mi_name' => $_POST['item-name'],
						    'mi_type' => $_POST['menu-type'],
						    'category' => $_POST['menu-category'],
						    'description' => $_POST['item-description'],
						    'price' => $_POST['item-price']);
	$insertRestaurant = $model->insertInto("Menuitem", $insertMenuData);
	header("Location: menu-controller.php?page=restaurant-info&restaurantName=$restaurantName&restaurantLoc=$restaurantLoc&restRating=$restaurantRating");
}