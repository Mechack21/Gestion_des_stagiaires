<?php

    try{

        $pdo=new PDO("mysql:host=localhost;dbname=gestion_stage","root","");
    }catch(Exception $e){
        die('Erreur de connexion:' .$e->getMessage());

    }
 
    
    
    

?>