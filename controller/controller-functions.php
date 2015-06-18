<?php
/**
 * This class includes commonly used functions in the application
 *
 * @author Tong Liu
 * Date: April 6, 2015
 */
class ControllerFunction {
	/**
	 *	This function is used to 'display' the side menu
	 */
	public function sideMenu($info = array()) {
		if (count($info) > 0) {
			$cuisineTypeArr = array();
			for ($i = 0, $size = count($info); $i < $size; $i++) {
				array_push($cuisineTypeArr, $info[$i]['type']);
			}
			$cuisineTypeArr = array_count_values($cuisineTypeArr);
			ksort($cuisineTypeArr); // Only variables should be passed by reference
			return $cuisineTypeArr;
		} else {
			return "Please pass a non-empty...";
		}
	}
	/**
	 *	This function takes a restaurant name and rating information and filters the rating info
	 */
	public function filterRatings($restName = null, $ratings = array()) {
		if (count($ratings) > 0 && $restName !== null) {
			$result = array();
			for ($i = 0, $size = count($ratings); $i < $size; $i++) {
				if ($ratings[$i]['name'] === $restName) {
					array_push($result, $ratings[$i]);
					return $result;
				}
			}
		} else {
			return "Please pass a non-empty array...";
		}
	}
	/**
	 *	This function takes a restaurant name and rating information and filters the rating info
	 */
	public function filterReviews($restName = null, $reviews = array()) {
		if (count($reviews) > 0 && $restName !== null) {
			$result = array();
			for ($i = 0, $size = count($reviews); $i < $size; $i++) {
				if ($reviews[$i]['name'] === $restName) {
					array_push($result, $reviews[$i]);
					return $result;
				}
			}
		} else {
			return "Please pass a non-empty array...";
		}
	}
}