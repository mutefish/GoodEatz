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
} elseif ($_GET['page'] === "search-result") {
	$homepageInfo = $model->selectAllFromTable("Restaurant");
	$cuisineTypeArr = $controlFunction->sideMenu($homepageInfo);
	if (isset($_GET['RestaurantSearch'])) {
		$searchID = $_GET['RestaurantSearch'];
		$restaurantSearch = $model->restaurantSearch($searchID);
		include '../views/cuisineSearch.php';
		exit;
	} elseif (isset($_GET['cuisineID'])) {
		$searchID = $_GET['cuisineID'];
		$restaurantSearch = $model->ratingOfAllRestaurantsByType($searchID);
		$searchID = $_GET['cuisineID'] . " Restaurant(s)";
		include '../views/cuisineSearch.php';
		exit;
	}
} 