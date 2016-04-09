<?php
namespace Umeng\IOS;

use Umeng\Exception\UmengException;

class IOSCustomizedcast extends IOSNotification
{

	function __construct()
	{
		parent::__construct();
		$this->data["type"] = "customizedcast";
		$this->data["alias_type"] = null;
	}

	function isComplete()
	{
		parent::isComplete();
		if (!array_key_exists("alias", $this->data) && !array_key_exists("file_id", $this->data))
			throw new UmengException("You need to set alias or upload file for customizedcast!");
	}

	// Upload file with device_tokens or alias to Umeng
	function uploadContents($content)
	{
		if ($this->data["appkey"] == null)
			throw new UmengException("appkey should not be NULL!");
		if ($this->data["timestamp"] == null)
			throw new UmengException("timestamp should not be NULL!");
		if ($this->data["validation_token"] == null)
			throw new UmengException("validation_token should not be NULL!");
		if (!is_string($content))
			throw new UmengException("content should be a string!");

		$post = ["appkey"           => $this->data["appkey"],
				 "timestamp"        => strval(time()),
				 "validation_token" => $this->data["validation_token"],
				 "content"          => $content
		];

		$ch = curl_init($this->host . $this->uploadPath);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
		$result = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$curlErrNo = curl_errno($ch);
		$curlErr = curl_error($ch);
		curl_close($ch);
		print($result . "\r\n");
		if ($httpCode == "0") //time out
			throw new UmengException("Curl error number:" . $curlErrNo . " , Curl error details:" . $curlErr . "\r\n");
		else if ($httpCode != "200") //we did send the notifition out and got a non-200 response
			throw new UmengException("http code:" . $httpCode . "\r\n" . "details:" . $result . "\r\n");
		$returnData = json_decode($result);
		if ($returnData["ret"] == "FAIL")
			throw new UmengException("Failed to upload file, details:" . $result . "\r\n");
		else
			$this->data["file_id"] = $returnData["data"]["file_id"];
	}

	function getFileId()
	{
		if (array_key_exists("file_id", $this->data))
			return $this->data["file_id"];

		return null;
	}
}