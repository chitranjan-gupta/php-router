<?php
//Hold the http request url
$file = $_SERVER["REQUEST_URI"];
//compare with many routes
if (preg_match('/\bindex.html\b/i', $file)) {
    return false; 
 }elseif(preg_match('/\bindex.css\b/i', $file)){
    return false;
 }elseif(preg_match('/\bindex.js\b/i', $file)){
    return false;
 }else { 
    //readfile('route.txt');
    //header("HTTP/1.1 404 Not Found");
    http_response_code(404);
 }
?>
