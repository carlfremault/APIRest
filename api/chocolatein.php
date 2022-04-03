<?php
header('Content-Type: application/json');

include_once("Controle.php");

$controle = new Controle();

// récupération des données
// Nom de la table au format string
$table = filter_input(INPUT_GET, 'table', FILTER_SANITIZE_STRING) ??
         filter_input(INPUT_POST, 'table', FILTER_SANITIZE_STRING);
// id de l'enregistrement au format int
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT) ??
      filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
// nom et valeur des champs au format json
$contenu = filter_input(INPUT_GET, 'contenu', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES) ??
           filter_input(INPUT_POST, 'contenu', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
$contenu = json_decode($contenu, true);

// traitement suivant le verbe HTTP utilisé
if($_SERVER['REQUEST_METHOD'] === 'GET'){
	$controle->get($table, $id);
}else if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$controle->post($table, $contenu);
}else if($_SERVER['REQUEST_METHOD'] === 'PUT'){
	echo '$table';
	$controle->put($table, $id, $contenu);
}else if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
	$controle->delete($table, $id);
}
