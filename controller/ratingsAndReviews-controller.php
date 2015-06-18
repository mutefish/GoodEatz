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

	$restReviewsInfo = $model->restaurantReviews($restaurantName);
	include '../views/RatingsAndReviews.php';
	exit;
}