<?php
//Hold the http request method
$method = $_SERVER["REQUEST_METHOD"];
//Hold the http request url
$url = $_SERVER["REQUEST_URI"];
//Hold the static directory
$static = __DIR__.'/public/';
//Hold the http request query
$query = (isset($_SERVER["QUERY_STRING"]))?$_SERVER["QUERY_STRING"]:"";
//Hold the http request query paramter
$params = [];
if(strlen($query) > 1){
	parse_str($query, $params);
}
//Hold the http request Content-Type
$contentType = (isset($_SERVER["CONTENT_TYPE"]))?$_SERVER["CONTENT_TYPE"]:"";
//Hold the http request Content-Length
$contentlength = strlen($contentType);
//Hold the http request body
$body = file_get_contents('php://input');
//Enable Cross-Origin-Resource-Sharing
function cors(){
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
	header("Access-Control-Allow-Headers: Content-Type");
}
cors();
//Enable http methods
if($method === "GET"){
	//compare with many routes
	if($url == '/'){
		require $static.'index.php';
	}elseif (preg_match('/\bindex.html\b/i', $url)){
		header("Content-Type: text/html");
		readfile($static.'index.html');
	}elseif(preg_match('/\bindex.css\b/i', $url)){
		header("Content-Type: text/css");
		readfile($static.'index.css');
	}elseif(preg_match('/\bindex.js\b/i', $url)){
		header("Content-Type: text/javascript");
		readfile($static.'index.js');
	}elseif(preg_match('/\bfavicon.ico\b/i', $url)){
		header("Content-Type: image/x-icon");
		readfile($static.'favicon.ico');
	}else {
		header("HTTP/1.1 404 Not Found");
		header("Content-Type: text/html");
		readfile($static.'404.html');
	}
}elseif($method === "POST"){
	switch($url){
		case "/":{
			if(strpos($contentType,'application/json') === 0){
				$data = json_decode($body, true);
				header("Content-Type: application/json");
				$res = array("message" => "Hello ".$data["name"]);
				echo json_encode($res);
			}elseif(strpos($contentType,'multipart/form-data') === 0){
				$data = $_POST["name"];
				header("Content-Type: text/plain");
				echo "Hello ".$data;
			}else{
				echo $body;
			}
			break;
		}
		default:{
			header("HTTP/1.1 404 Not Found");
			header("Content-Type: text/html");
			readfile($static.'404.html');
			break;
		}
	}
}else{
	http_response_code(405);
}
?>
