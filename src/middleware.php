<?php

use Slim\App;

return function (App $app) {
    // e.g: $app->add(new \Slim\Csrf\Guard);

    // A middleware for enabling CORS
	$app->add(function ($req, $res, $next) {
	    $response = $next($req, $res);
	    return $response
	        ->withHeader('Access-Control-Allow-Origin', '*')
	        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
	        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
	});

	$app->add(new \Tuupola\Middleware\JwtAuthentication([
	    "path" => "/api", /* or ["/api", "/admin"] */
	    "ignore" => ["/api/login", "/api/register"], /* or ["/api/token", "/admin/ping"],*/
	    "attribute" => "decoded_token_data",
	    "secret" => "supersecretkeyyoushouldnotcommittogithub",
	    "algorithm" => ["HS256"],
	    "error" => function ($response, $arguments) {
	        $data["status"] = "error";
	        $data["message"] = $arguments["message"];
	        return $response
	            ->withHeader("Content-Type", "application/json")
	            ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
	    }
	]));
};