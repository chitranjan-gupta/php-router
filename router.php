<?php
//Hold the http request url
$file = $_SERVER["REQUEST_URI"];
$static = __DIR__.'/public/';
//compare with many routes
if($file == '/'){
	require $static.'index.php';
}elseif (preg_match('/\bindex.html\b/i', $file)){
	header("Content-Type: text/html");
	readfile($static.'index.html');
}elseif(preg_match('/\bindex.css\b/i', $file)){
	header("Content-Type: text/css");
	readfile($static.'index.css');
}elseif(preg_match('/\bindex.js\b/i', $file)){
	header("Content-Type: text/javascript");
	readfile($static.'index.js');
}elseif(preg_match('/\bfavicon.ico\b/i', $file)){
	header("Content-Type: image/x-icon");
	readfile($static.'favicon.ico');
}else { 
	header("HTTP/1.1 404 Not Found");
	//http_response_code(404);
	header("Content-Type: text/html");
	readfile($static.'404.html');
}
?>
