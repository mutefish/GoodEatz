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
} elseif ($_GET['page'] === "rater-profile") {
	$homepageInfo = $model->selectAllFromTable("Restaurant");
	$cuisineTypeArr = $controlFunction->sideMenu($homepageInfo);
	if (!isset($_POST['inputRaterIDSearch'])) {
		$userID = $_GET['userid'];
	}
	if (!isset($_GET['userid'])) {
		$userID = $_POST['inputRaterIDSearch'];
	}
	$raterProfileInfo = $model->getRaterProfileInfo($userID);
	$raterProfileComments = $model->getRaterProfileComments($userID);
	include '../views/raterProfile.php';
	exit;
} elseif ($_GET['page'] === "delete-user") {
	$deleteUserCond = "userid = " . "'" . $_GET['userid'] . "'";
	$deleteUser = $model->deleteFrom("Rater", $deleteUserCond);
	header("Location: homepage-controller.php");
} elseif ($_GET['page'] === "new-rater-profile") {
	$inputUserID = $_POST['inputUserID'];
	$insertRaterData = array('userid' => $inputUserID, 
						     'email' => $_POST['inputEmail'],
						     'rater_name' => $_POST['inputName'],
						     'join_date' => date("Y-m-d"),
						     'rater_type' => $_POST['inputType'],
						     'reputation' => 1);
	$insertRater = $model->insertInto("Rater", $insertRaterData);
	header("Location: raterProfile-controller.php?page=rater-profile&userid=$inputUserID");
}