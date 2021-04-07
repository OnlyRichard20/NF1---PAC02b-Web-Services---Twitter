<?php
require_once("abstract.databoundobject.php");
require_once("class.postgresLogger.php");

class Twitter extends DataBoundObject {

        protected $ID;
        protected $Fecha;
        protected $Usuario;
        protected $Tweet;

        protected function DefineTableName() {
                return("twitter");
        }

        protected function DefineRelationMap() {
                return(array(
                        "id" => "ID",
                        "fecha" => "Fecha",
                        "usuario" => "Usuario",
                        "tweet" => "Tweet"));
        }

}
?>
