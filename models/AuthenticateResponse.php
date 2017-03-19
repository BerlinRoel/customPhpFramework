<?php
	class AuthenticateResponse {
		var $first_name;
		var $last_name;
		var $middle_name;
		var $user_id;
		var $profile_code;

		function getFirstName() {
			return $this->first_name;
		}

		function getLastName() {
			return $this->last_name;
		}

		function getMiddleName() {
			return $this->middle_name;
		}

		function getProfileCode() {
			return $this->profile_code;
		}		

		function setFirstName($newFirstName) {
			$this->first_name = $newFirstName;
		}

		function setLastName($newLastName) {
			$this->last_name = $newLastName;
		}

		function setMiddleName($newMiddleName) {
			$this->middle_name = $newMiddleName;
		}		

		function setUserId($newUserId) {
			$this->user_id = $newUserId;
		}

		function setProfileCode($newProfileCode) {
			$this->profile_code = $newProfileCode;
		}
	}
?>