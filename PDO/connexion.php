<?php
  $connexion = new PDO('mysql:host=localhost;dbname=futuroid;charset=utf8','root','',array(
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //manière d'afficher les erreurs sous forme d'exception
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, // recupère les données sous la forme d'un objet
      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES'UTF8'", // évite les problemes d'accentuation
    ));
