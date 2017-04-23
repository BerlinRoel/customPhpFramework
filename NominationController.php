<?php
	header("Access-Control-Allow-Origin: *");
	include __DIR__.'/config/database.php';
	include __DIR__.'/models/Response.php';
	include __DIR__.'/models/NominationResponse.php'; //to be replace with model for Nomination

	class NominationController {
		function createNomination() {

			try {
			    $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DBASE, DB_USER, DB_PASSWORD);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				// $stmt = $conn->prepare("SELECT user_id, first_name, last_name, middle_name, profile_code FROM tbl_users WHERE user_id=:user AND password=:pword");

				$stmt = $conn->prepare("INSERT INTO nominations (nominee_id, nominee_name, category_id, for_polling)
				    VALUES ('nominee_id', 'nominee_name', 'category_id', 'for_polling')";

				$conn->exec($stmt);

				$BaseResponse = new BaseResponse();

				$NominationResponse = new NominationResponse();


			}
			catch(PDOException $e) {

			}

		}
	}

?>