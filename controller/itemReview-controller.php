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
} elseif ($_GET['page'] === "rater-profile-item-review") {
	$homepageInfo = $model->selectAllFromTable("Restaurant");
	$cuisineTypeArr = $controlFunction->sideMenu($homepageInfo);
	$userID = $_GET['userid'];
	$raterProfileInfo = $model->getRaterProfileInfo($userID);
	$raterProfileItemReviews = $model->getRaterItemReviews($userID);
	include '../views/itemReview.php';
	exit;
}