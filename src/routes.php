<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use \Firebase\JWT\JWT;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/[{name}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });
	$app->group('/api', function(App $app) {
		$app->post('/register', function (Request $request, Response $response, array $args) {
		    $input = $request->getParsedBody();
		    $name=trim(strip_tags($input['name']));
		    $email=trim(strip_tags($input['email']));
		    $hash=(trim(strip_tags($input['password'])));
		    $password=password_hash($hash, PASSWORD_DEFAULT);
		    $created_at=date('Y-m-d H:i:s');
		    $updated_at=date('Y-m-d H:i:s');
		    $sql = "INSERT INTO users(name, email, password, created_at, updated_at) 
		            VALUES(:name, :email, :password, :created_at, :updated_at)";
		    $sth = $this->db->prepare($sql);
		    $sth->bindParam("name", $name);             
		    $sth->bindParam("email", $email);            
		    $sth->bindParam("password", $password);                
		    $sth->bindParam("created_at", $created_at);      
		    $sth->bindParam("updated_at", $updated_at); 
		    $StatusInsert=$sth->execute();
		    if($StatusInsert){
		        $id=$this->db->lastInsertId();     
		        $settings = $this->get('settings'); 
		        $Users=array(
		            'name' =>  $name, 
		            'email' => $email,
		            'created_at' => $created_at,
		            'updated_at' => $updated_at,
		            'id' => $id,
	            );
		        return $this->response->withJson(['message' => 'Successfully registered','user'=>$Users]); 
		    } else {
		        return $this->response->withJson(['status' => 'error','message'=>'Error insert user.']); 
		    }
		});

		$app->post('/login', function (Request $request, Response $response, array $args) {
		    $input = $request->getParsedBody();
		    $sql = "SELECT * FROM users WHERE email= :email";
		    $sth = $this->db->prepare($sql);
		    $sth->bindParam("email", $input['email']);
		    $sth->execute();
		    $user = $sth->fetchObject();
		    // verify email address.
		    if(!$user) {
		        return $this->response->withJson(['error' => true, 'message' => 'These credentials do not match our records.']);  
		    }
		    // verify password.
		    if (!password_verify($input['password'],$user->password)) {
		        return $this->response->withJson(['error' => true, 'message' => 'These credentials do not match our records.']);  
		    }
		    $settings = $this->get('settings'); // get settings array.
		    //$token = JWT::encode(['id' => $user->id, 'email' => $user->email], $settings['jwt']['secret'], "HS256");
		    $token = JWT::encode([
			    	'id' => $user->id, 
			    	'name' => $user->name, 
			    	'email' => $user->email,
			    	'email_verified_at' => $user->email_verified_at,
			    	'created_at' => $user->created_at,
			    	'updated_at' => $user->updated_at
			    ],$settings['jwt']['secret'], "HS256");
		    return $this->response->withJson(['access_token' => $token]);
		});

	    $app->get('/profile',function(Request $request, Response $response, array $args) {
	        $data = $request->getAttribute('decoded_token_data');
		    return $this->response->withJson($data);
		    // return $this->response->withJson(['data' => $data]);
	    });
	   
	});
};