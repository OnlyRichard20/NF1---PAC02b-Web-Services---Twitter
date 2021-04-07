<?php

require_once("class.postgresLogger.php");
require_once("abstract.databoundobject.php");



class Conexion{
	public $fecha;
	public $usuario;
	public $tweet;

	function getTweets($user){
        ini_set('display_errors', 1);
        require_once('TwitterAPIExchange.php');

        $settings = array(
    		'oauth_access_token' => "1377014272203628546-GDCr2nfhky2238Y7nFgirAt3w8J925",
    		'oauth_access_token_secret' => "KNVOQuvHPFOMQWch9dk7zf6maTmoYZHBDHd2HUv33isVL",
    		'consumer_key' => "S1uNnAA7LNK7DXmhmx13pXfpD",
    		'consumer_secret' => "wmwhsJxx1QBPAFCY5kaCme5hx7sBmTAoRedS4lntxH7mY8GM9m"
		);

        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?screen_name='.$user.'&count=3';        
        $requestMethod = 'GET';
        $twitter = new TwitterAPIExchange($settings);
        $json =  $twitter->setGetfield($getfield)
                     ->buildOauth($url, $requestMethod)
                     ->performRequest();

        //Obtenemos json de los Tweets del usuario y filtramos información

        $data = json_decode($json);
        foreach ($data as $obj){
        	$fecha = $obj->created_at;
        	$usuario = $obj->user->screen_name;
        	$tweet = $obj->text;

        	
          //Generamos array para guardar los datos filtrados en la base de datos

        	$array = array(
  				  "fecha"=>$fecha,
  				  "usuario"=>$usuario,
  				  "tweet"=>$tweet
			    );
			    $url = "postgres://postgres:P@ssw0rd@localhost:5432/twitter";
			    $url = parse_url($url);

			    $postgres = new postgresLogger($url);
			    $postgres->writteMessage($array);
		}

	}

}

$twitterObject = new Conexion();
$jsonraw =  $twitterObject->getTweets("IbaiLlanos");

?>

