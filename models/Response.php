<?php
	class BaseResponse {
		var $code;
		var $response;
		var $error;

		function getCode() {
			return $this->code;
		}

		function getResponse() {
			return $this->response;
		}

		function getError() {
			return $this->error;
		}

		function setCode($newCode) {
			$this->code = $newCode;
		}

		function setResponse($newResponse) {
			$this->response = $newResponse;
		}

		function setError($newError) {
			$this->error = $newError;
		}		

	}
?>