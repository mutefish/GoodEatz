<?php

require_once '../includes/php/DBAccessObject.php';

class RestaurantModel extends DBAccessObject 
{
	public function selectAllFromTable($table) {
		return ($this->select($table));
	}

	public function selectAllFromRestaurant($table, $key, $condition) {
		return ($this->select($table, $key, $condition));
	}

	public function insertInto($table, $data = null) {
		return ($this->insert($table, $data));
	}

	public function deleteFrom($table, $condition = null) {
		return ($this->delete($table, $condition));
	}

	public function getRestaurantByName($key = null) {
		return ($this->query(
					"SELECT *
					FROM 	RESTAURANT R, 
							Location L
					WHERE 	R.name = '$key' 
							AND R.restaurantID = L.restaurantID;"));
	}

	public function getRestaurantByLocation($restName = null, $restLoc = null) {
		return ($this->query(
					"SELECT *
					FROM 	RESTAURANT R, 
							Location L
					WHERE 	R.name = '$restName' 
							AND L.street_address = '$restLoc'
							AND R.restaurantID = L.restaurantID;"));
	}

	public function restaurantType($key = null) {
		return ($this->query(
					"SELECT *
					FROM 	RESTAURANT R, 
							Location L
					WHERE 	R.type = '$key' 
							AND R.restaurantID = L.restaurantID;"));
	}

	public function partB($key = null) {
		return ($this->query(
					"SELECT MI.MI_NAME, 
							MI.PRICE, 
							MI.DESCRIPTION
					FROM 	MENUITEM MI, 
							RESTAURANT R
					WHERE 	MI.restaurantid = R.restaurantid 
							AND R.name = '$key'
					ORDER BY MI.CATEGORY;"));
	}

	public function getMenuInfo($key = null) {
		return ($this->query(
					"SELECT MI.ITEMID,
							MI.MI_NAME, 
							MI.PRICE, 
							MI.DESCRIPTION,
							MI.CATEGORY
					FROM 	MENUITEM MI, 
							RESTAURANT R
					WHERE 	MI.restaurantid = R.restaurantid 
							AND R.name = '$key'
					ORDER BY MI.CATEGORY;"));
	}


	public function partC($key = null) {
		return ($this->query(
					"SELECT R.NAME, 
							L.MANAGER_NAME, 
							L.FIRST_OPEN_DATE
					FROM 	Location L, 
							RESTAURANT R
					WHERE 	R.type = '$key' 
							AND R.restaurantID = L.restaurantID
					ORDER BY R.NAME;"));
	}

	public function partD($key = null) {
		return ($this->query(
					"SELECT MI.mi_name,
					       MI.price,
					       L.manager_name,
					       L.hour_open,
					       R.url
					FROM   location L,
					       restaurant R,
					       menuitem MI
					WHERE  MI.price = (SELECT Max(MI2.price)
					                   FROM   menuitem MI2
					                   WHERE  MI2.restaurantid = R.restaurantid)
					       AND R.name = '$key'
					       AND R.restaurantid = L.restaurantid;"));
	}

	public function partE() {
		return ($this->query(
					"SELECT R.type,
					       MI.category,
					       Round(Avg(MI.price), 2) AS AVERAGEPRICE
					FROM   restaurant R,
					       menuitem MI
					WHERE  MI.restaurantid = R.restaurantid
					GROUP  BY R.type,
					          MI.category
					ORDER  BY R.type,
					          ( CASE
					              WHEN MI.category = 'Starter' THEN 0
					              WHEN MI.category = 'Main' THEN 1
					              WHEN MI.category = 'Dessert' THEN 2
					            end );"));
	}

	public function partF() {
		return ($this->query(
					"SELECT R.name,
					       RA.userid,
					       RATE.price,
					       RATE.food,
					       RATE.mood,
					       RATE.staff
					FROM   restaurant R,
					       rater RA,
					       rating RATE
					WHERE  RATE.userid = RA.userid
					       AND RATE.restaurantid = R.restaurantid
					ORDER  BY R.name,
					          RA.userid;"));
	}

	public function partG() {
		return ($this->query(
					"SELECT R.name,
					       Round(Avg(RATE.price), 1) AS PriceRating,
					       Round(Avg(RATE.food), 1)  AS FoodRating,
					       Round(Avg(RATE.mood), 1)  AS MoodRating,
					       Round(Avg(RATE.staff), 1) AS StaffRating
					FROM   restaurant R,
					       rating RATE
					WHERE  RATE.restaurantid = R.restaurantid
					GROUP  BY R.name
					ORDER  BY R.name;"));
	}

	/**
	 * Find average rating of each category for each restaurant
	 */
	public function avgCategoryRatingRestaurant() {
		return ($this->query(
					"SELECT R.name,
					       Round(Avg(RATE.price), 1) AS PriceRating,
					       Round(Avg(RATE.food), 1)  AS FoodRating,
					       Round(Avg(RATE.mood), 1)  AS MoodRating,
					       Round(Avg(RATE.staff), 1) AS StaffRating
					FROM   restaurant R,
					       rating RATE
					WHERE  RATE.restaurantid = R.restaurantid
					GROUP  BY R.name
					ORDER  BY R.name;"));
	}

	/**
	 * Finds the average food rating of a specified restaurant type
	 */
	public function avgFoodRating($key = null) {
		return ($this->query(
					"SELECT DISTINCT R.name,
					                V.foodrating
					FROM   rating RATE,
					       restaurant R
					       LEFT OUTER JOIN(SELECT R.restaurantid,
					                              Round(Avg(RATE.food), 2) AS FoodRating
					                       FROM   rating RATE,
					                              restaurant R
					                       WHERE  RATE.restaurantid = R.restaurantid
					                       GROUP  BY R.restaurantid) V
					                    ON R.restaurantid = V.restaurantid
					WHERE  R.type = '$key'
					ORDER  BY R.name;"));
	}

	public function partI($key = null) {
		return ($this->query(
					"SELECT R.name,
					       RA.userid,
					       RA.food
					FROM   restaurant R,
					       rating RA
					WHERE  RA.restaurantid = R.restaurantid
					       AND RA.food >= ALL (SELECT RA2.food
					                           FROM   rating RA2
					                           WHERE  NOT RA.userid = RA2.userid)
					       AND R.type = '$key'
					ORDER  BY RA.datepub;"));
	}

	public function partK() {
		return ($this->query(
					"SELECT R.rater_name,
					       R.join_date,
					       REST.name,
					       RA.datepub,
					       RA.comments
					FROM   rater R,
					       rating RA,
					       restaurant REST
					WHERE  R.userid = RA.userid
					       AND REST.restaurantid = RA.restaurantid
					       AND RA.food >= ALL (SELECT RA2.food
					                           FROM   rating RA2
					                           WHERE  NOT RA.userid = RA2.userid)
					       AND RA.mood >= ALL (SELECT RA2.food
					                           FROM   rating RA2
					                           WHERE  NOT RA.userid = RA2.userid);"));
	}

	public function partL() {
		return ($this->query(
					"SELECT R.rater_name,
					       R.join_date,
					       REST.name,
					       RA.datepub,
					       RA.comments
					FROM   rater R,
					       rating RA,
					       restaurant REST
					WHERE  R.userid = RA.userid
					       AND REST.restaurantid = RA.restaurantid
					       AND ( RA.food >= ALL (SELECT RA2.food
					                             FROM   rating RA2
					                             WHERE  NOT RA.userid = RA2.userid)
					              OR RA.mood >= ALL (SELECT RA2.food
					                                 FROM   rating RA2
					                                 WHERE  NOT RA.userid = RA2.userid) );"));
	}

	public function partN() {
		return ($this->query(
					"SELECT R.rater_name,
					       R.email,
					       V2.overallrating
					FROM   rater R
					       LEFT OUTER JOIN (SELECT R.userid,
					                               Round(( Avg(RA.price) + Avg(RA.food) +
					                                       Avg(RA.mood)
					                                       + Avg(RA.staff) ) / 4, 1) AS
					                               OverallRating
					                        FROM   rating RA,
					                               rater R
					                        WHERE  R.userid = RA.userid
					                               AND NOT R.rater_name = 'John'
					                        GROUP  BY R.userid) V2
					                    ON R.userid = V2.userid
					GROUP  BY R.rater_name,
					          R.email,
					          V2.overallrating
					HAVING V2.overallrating > (SELECT Round(( Avg(RA.price) + Avg(RA.food) +
					                                          Avg(RA.mood)
					                                          + Avg(RA.staff) ) / 4, 1) AS
					                                  OverallRating
					                           FROM   rating RA,
					                                  rater R
					                           WHERE  R.userid = RA.userid
					                                  AND R.rater_name = 'John');"));
	}

	/**
	 * Finds the overall rating of a specific restaurant
	 */
	public function overallRating() {
		return ($this->query(
					"SELECT R.name,
					       Round(( Avg(RA.price) + Avg(RA.food) + Avg(RA.mood)
					               + Avg(RA.staff) + Avg(RI.rating) ) / 5, 1) AS OverallRating
					FROM   restaurant R,
					       rating RA,
					       menuitem MI,
					       ratingitem RI
					WHERE  R.restaurantid = RA.restaurantid
					        OR ( MI.itemid = RI.itemid
					             AND MI.restaurantid = R.restaurantid )
					GROUP  BY R.name
					ORDER  BY overallrating;"));
	}

	public function ratingOfRestaurant($key = null) {
		return ($this->query(
					"SELECT R.name, L.street_address,
							Round(( Avg(RA.price) + Avg(RA.food) + Avg(RA.mood)
							       + Avg(RA.staff) + Avg(RI.rating) ) / 5, 1) AS OverallRating
					FROM   	restaurant R, 
							location L,
							rating RA,
							menuitem MI,
							ratingitem RI
					WHERE  (R.restaurantid = RA.restaurantid
							OR ( MI.itemid = RI.itemid
							     AND MI.restaurantid = R.restaurantid )) AND L.restaurantId = R.Restaurantid
							     AND R.type = '$key' 
					GROUP  BY R.name, L.street_address
					ORDER  BY overallrating;"));
	}

	public function restaurantSearch($key = null) {
		return ($this->query(
					"SELECT R.name, L.street_address,
							Round(( Avg(RA.price) + Avg(RA.food) + Avg(RA.mood)
							       + Avg(RA.staff) + Avg(RI.rating) ) / 5, 1) AS OverallRating
					FROM   	restaurant R, 
							location L,
							rating RA,
							menuitem MI,
							ratingitem RI
					WHERE  (R.restaurantid = RA.restaurantid
							OR ( MI.itemid = RI.itemid
							     AND MI.restaurantid = R.restaurantid )) AND L.restaurantId = R.Restaurantid
							     AND R.name = '$key'
					GROUP  BY R.name, L.street_address
					ORDER  BY overallrating;"));
	}

	/**
	 * Find average rating of each category
	 */
	public function avgCategoryRating() {
		return ($this->query(
					"SELECT R.name,
					       Round(Avg(RA.price), 1) AS avg_price,
					       Round(Avg(RA.food), 1) AS avg_food,
					       Round(Avg(RA.mood), 1) AS avg_mood,
					       Round(Avg(RA.staff), 1) AS avg_staff,
					       Round(Avg(RI.rating), 1) AS avg_rating
					FROM   restaurant R,
					       rating RA,
					       menuitem MI,
					       ratingitem RI
					WHERE  R.restaurantid = RA.restaurantid
					        OR ( MI.itemid = RI.itemid
					             AND MI.restaurantid = R.restaurantid )
					GROUP  BY R.name;"));
	}

	/**
	 * Displays average price of the food
	 */
	public function avgFoodPrice() {
		return ($this->query(
					"SELECT R.name,
					       Round(Avg(MI.price), 2) AS AveragePrice
					FROM   restaurant R,
					       menuitem MI
					WHERE  MI.restaurantid = R.restaurantid
					GROUP  BY R.name
					ORDER  BY averageprice;"));
	}

	/**
	 * List the reviews of restaurants by a specific review
	 */
	public function restaurantSpecReview() {
		return ($this->query(
					"SELECT REST.name,
					       R.comments,
					       R.price,
					       R.food,
					       R.mood,
					       R.staff
					FROM   rating R,
					       rater RATE,
					       restaurant REST
					WHERE  R.userid = RATE.userid
					       AND R.userid = 'TLui'
					       AND REST.restaurantid = R.restaurantid
					ORDER  BY R.datepub;"));
	}

	/**
	 * Number of reviews a restaurant has
	 */
	public function restaurantNumReviews() {
		return ($this->query(
					"SELECT R.name,
					       ( V1.numberofreviews + V2.numberofitemreviews ) AS number_of_review
					FROM   restaurant R
					       LEFT OUTER JOIN (SELECT R.restaurantid,
					                               Count(*) AS NumberOfReviews
					                        FROM   restaurant R,
					                               rating RA
					                        WHERE  R.restaurantid = RA.restaurantid
					                        GROUP  BY R.restaurantid) V1
					                    ON R.restaurantid = V1.restaurantid
					       LEFT OUTER JOIN (SELECT R.restaurantid,
					                               Count(*) AS NumberOfItemReviews
					                        FROM   restaurant R,
					                               ratingitem RI,
					                               menuitem MI
					                        WHERE  MI.itemid = RI.itemid
					                               AND MI.restaurantid = R.restaurantid
					                        GROUP  BY R.restaurantid) V2
					                    ON R.restaurantid = V2.restaurantid;"));
	}

	/**
	 * Number of reviews each reviewer has made
	 */
	public function reviewerNumReviews() {
		return ($this->query(
					"SELECT R.rater_name,
					       R.reputation,
					       ( V1.numberofreviews + V2.numberofitemreviews ) AS NumReviews
					FROM   rater R
					       LEFT OUTER JOIN (SELECT R.userid,
					                               Count(RA.price) AS NumberOfReviews
					                        FROM   rater R,
					                               rating RA
					                        WHERE  R.userid = RA.userid
					                        GROUP  BY R.userid) V1
					                    ON R.userid = V1.userid
					       LEFT OUTER JOIN (SELECT R.userid,
					                               Count(*) AS NumberOfItemReviews
					                        FROM   rater R,
					                               ratingitem RI,
					                               menuitem MI
					                        WHERE  MI.itemid = RI.itemid
					                               AND R.userid = RI.userid
					                        GROUP  BY R.userid) V2
					                    ON R.userid = V2.userid, restaurant REST;"));
	}

	/**
	 * Average rating specific restaurant
	 */
	public function uniRestaurantAvgRating() {
		return ($this->query(
					"SELECT R.rater_name,
					       R.email,
					       V1.overallrating
					FROM   rater R
					       LEFT OUTER JOIN (SELECT R.userid,
					                               Round(( Avg(RA.price) + Avg(RA.food) +
					                                       Avg(RA.mood)
					                                       + Avg(RA.staff) ) / 4, 1) AS
					                               OverallRating
					                        FROM   rating RA,
					                               rater R,
					                               restaurant REST
					                        WHERE  R.userid = RA.userid
					                               AND REST.name = 'Fratelli'
					                        GROUP  BY R.userid) V1
					                    ON R.userid = V1.userid,
					       restaurant REST
					WHERE  REST.name = 'Fratelli';"));
	}

	/**
	 * List of average ratings for every restaurant
	 */
	public function restaurantAvgRating() {
		return ($this->query(
					"SELECT R.rater_name,
					       R.email,
					       V1.overallrating
					FROM   rater R
					       LEFT OUTER JOIN (SELECT R.userid,
					                               Round(( Avg(RA.price) + Avg(RA.food) +
					                                       Avg(RA.mood)
					                                       + Avg(RA.staff) ) / 4, 1) AS
					                               OverallRating
					                        FROM   rating RA,
					                               rater R,
					                               restaurant REST
					                        WHERE  R.userid = RA.userid
					                        GROUP  BY R.userid) V1
					                    ON R.userid = V1.userid;"));
	}

	/**
	 * List of user reviews by restaurant
	 */
	public function restaurantReviews($key = null) {
		return ($this->query(
					"SELECT  RA.Userid, 
							RA.Comments, 
							RA.Datepub
					FROM 	RESTAURANT R, 
							RATING RA
					WHERE 	R.restaurantid = RA.restaurantid 
							AND R.name = '$key'
					ORDER BY RA.userid;"));
	}

	/**
	 * Gets the comment information of a specific user
	 */
	public function getRaterProfileComments($key = null) {
		return ($this->query(
					"SELECT RA.datepub,
							RA.restaurantid,
							RA.price,
							RA.food,
							RA.mood,
							RA.staff,
							RA.comments,
							REST.description,
							REST.name,
							REST.type,
							REST.url
					FROM   rater R,
					       rating RA,
					       restaurant REST
					WHERE  R.userid = RA.userid
					       AND REST.restaurantid = RA.restaurantid
					       AND R.userid = '$key';"));
	}

	public function getRaterItemReviews($key = null) {
		return ($this->query(
					"SELECT *
					FROM RatingItem RI,
						 MenuItem MI
					WHERE RI.itemid = MI.itemid 
						  AND userid = '$key';"));
	}
	/**
	 * Gets the information of a specific user
	 */
	public function getRaterProfileInfo($key = null) {
		return ($this->query(
					"SELECT * 
					FROM rater
					WHERE userid = '$key';"));
	}

	/**
	 * Gets the rating of all of the restaurants based on a specific type
	 */
	public function ratingOfAllRestaurantsByType($key = null) {
		return ($this->query(
					"SELECT R.name, 
					       L.street_address, 
					       Coalesce(V.overallrating, 0) AS OverallRating
					FROM   location L, 
					       restaurant R 
					       LEFT OUTER JOIN (SELECT R.restaurantid, 
					                               Round(( Avg(RA.price) + Avg(RA.food) + 
					                                       Avg(RA.mood) 
					                                       + Avg(RA.staff) + Avg(RI.rating) ) / 5, 1 
					                               ) AS 
					                                            OverallRating 
					                        FROM   rating RA, 
					                               menuitem MI, 
					                               ratingitem RI, 
					                               location L, 
					                               restaurant R 
					                        WHERE  ( R.restaurantid = RA.restaurantid 
					                                  OR ( MI.itemid = RI.itemid 
					                                       AND MI.restaurantid = R.restaurantid ) ) 
					                               AND L.restaurantid = R.restaurantid 
					                               AND R.type = '$key' 
					                        GROUP  BY R.restaurantid) V 
					                    ON V.restaurantid = R.restaurantid 
					WHERE  R.type = '$key' 
					       AND R.restaurantid = L.restaurantid
					ORDER  BY R.name;"));
	}
}