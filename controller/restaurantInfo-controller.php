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
	include '../views/restaurantInfo.php';
	exit;
} elseif ($_GET['page'] === "delete-restaurant-location") {
	$deleteRestCond = "locationid = " . "'" . $_GET['restLocId'] . "'";
	$deleteRest = $model->deleteFrom("Location", $deleteRestCond);
	header("Location: homepage-controller.php");
} elseif ($_GET['page'] === "new-restaurant-info") {
	$restName = $_POST['inputRestaurantName'];
	$restLoc = $_POST['inputAddress'];
	$insertRestData = array('restaurantid' => $_POST['inputRestaurantID'], 
						    'description' => $_POST['inputDescription'],
						    'name' => $_POST['inputRestaurantName'],
						    'type' => $_POST['inputRestaurantType'],
						    'url' => $_POST['inputURL']);
	$insertLocData = array('locationid' => $_POST['inputLocationID'], 
						   'first_open_date' => $_POST['inputFirstDateOpen'],
						   'manager_name' => $_POST['inputManager'],
						   'phone_num' => $_POST['inputPhoneNum'],
						   'street_address' => $restLoc,
						   'hour_open' => $_POST['inputHourOpen'],
						   'hour_close' => $_POST['inputHourClose'],
						   'restaurantid' => $_POST['inputRestaurantID']);
	$insertRestaurant = $model->insertInto("Restaurant", $insertRestData);
	$insertLocation = $model->insertInto("Location", $insertLocData);
	header("Location: restaurantInfo-controller.php?page=restaurant-info&restaurantName=$restName&restaurantLoc=$restLoc&restRating=0");
} 