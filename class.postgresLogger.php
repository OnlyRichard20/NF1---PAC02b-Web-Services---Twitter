<?php
 require_once("class.pdofactory.php");
 require_once("abstract.databoundobject.php");
 require_once("class.Twitter.php");

class postgresLogger {

  public $url;
  public $message;
  public $objeto;

  public function __construct($url) {
    $this->url = $url;
    $this->connection();
  }

  public function connection(){
    $strDSN = "pgsql:dbname=postgres;host=localhost;port=5432;";
    $objPDO = PDOFactory::GetPDO($strDSN, "postgres", "P@ssw0rd", 
        array());
    $objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->objeto = new Twitter($objPDO);
  }

  public function writteMessage($message){
    $this->message = $message;
    $this->objeto->setFecha($this->message["fecha"])->setUsuario($this->message["usuario"])->setTweet($this->message["tweet"]);
    $this->objeto->save();
    print "<br/>La fecha es: " . $this->objeto->getFecha(). "<br/>";
    print "<br/>El usuario es: " . $this->objeto->getUsuario(). "<br/>";
    print "<br/>El tweet es: " . $this->objeto->getTweet() . "<br/>";
  }

}
?>
