<?php
	header("Access-Control-Allow-Origin: *");
	include __DIR__.'/config/database.php';
	include __DIR__.'/models/Response.php';
	include __DIR__.'/models/AuthenticateResponse.php';

 	$data = json_decode(file_get_contents('php://input'), true);
	$AuthenticateController = new AuthenticateController();
	
	if ($data['username'] == '') {
		$AuthenticateController->login($_POST['username'], $_POST['password']);
	} else {
		$AuthenticateController->login($data['username'], $data['password']);
	}

	class AuthenticateController {
		function login($loginUser, $loginPassword) {
			try 
			{
			    $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DBASE, DB_USER, DB_PASSWORD);
			    // set the PDO error mode to exception
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			    $stmt = $conn->prepare("SELECT user_id, first_name, last_name, middle_name, profile_code FROM tbl_users WHERE user_id=:user AND password=:pword");

			    $username = $loginUser;
			    $password = $loginPassword;

			    $stmt->bindParam('user',$username);
			    $stmt->bindParam('pword',$password);

			   	$stmt->execute();

			   	$AuthenticateResponse = new AuthenticateResponse();

      			for ($i=0; $row = $stmt->fetch(); $i++) {
    				$AuthenticateResponse->setUserId($row['user_id']);
    				$AuthenticateResponse->setFirstName($row['first_name']);
    				$AuthenticateResponse->setLastName($row['last_name']);
    				$AuthenticateResponse->setMiddleName($row['middle_name']);
    				$AuthenticateResponse->setProfileCode($row['profile_code']);
      			}			    

			    $BaseResponse = new BaseResponse();

			    if($stmt->rowCount() > 0) {
				    $BaseResponse->setCode(200);
				    $BaseResponse->setResponse($AuthenticateResponse);
				    $BaseResponse->setError(null);
			    	echo json_encode($BaseResponse, JSON_PRETTY_PRINT);
			    } else {
				    $BaseResponse->setCode(200);
				    $BaseResponse->setResponse('Not Authenticated');
				    $BaseResponse->setError(null);
			    	echo json_encode($BaseResponse, JSON_PRETTY_PRINT);    	
			    }
			}
			catch(PDOException $e)
			{
			    $BaseResponse = new BaseResponse();
			    $BaseResponse->setCode(404);
			    $BaseResponse->setResponse(null);
			    $BaseResponse->setError($e->getMessage());
		    	echo json_encode($BaseResponse, JSON_PRETTY_PRINT);
			}
		}
	}	
?>