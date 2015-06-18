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
	$homepageInfo = $model->selectAllFromTable("Restaurant");
	$cuisineTypeArr = $controlFunction->sideMenu($homepageInfo);
	
	$restaurantHomepageLinks1 = $model->getRestaurantByName($homepageInfo[0]['name']);
	$restaurantHomepageLinks2 = $model->getRestaurantByName($homepageInfo[4]['name']);
	$restaurantHomepageLinks3 = $model->getRestaurantByName($homepageInfo[2]['name']);

	$restaurantRating1 = $model->restaurantSearch($restaurantHomepageLinks1[0]['name']);
	$restaurantRating2 = $model->restaurantSearch($restaurantHomepageLinks2[0]['name']);
	$restaurantRating3 = $model->restaurantSearch($restaurantHomepageLinks3[0]['name']);
	include '../views/homepage.php';
	exit;
} elseif ($_GET['page'] === "restaurant-search") {
	$homepageInfo = $model->selectAllFromTable("Restaurant");
	$_SESSION['sideMenu'] = $controlFunction->sideMenu($homepageInfo);
	$searchInput = $_POST['nav-search'];
	header("Location: search-controller.php?page=search-result&RestaurantSearch=$searchInput");
} 