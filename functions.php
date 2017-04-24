<?php

function isDM($classid) {
	if ($classid == 13)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function get($key) {
	if(isset($_GET[$key]))
	{
		return $_GET[$key];
	}
	else
	{
		return '';
	}
}

function searchSpells($term, $database) {
	$term = $term . '%';
	$sql = file_get_contents('sql/searchSpells.sql');
	$params = array(
		'term' => $term
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$spells = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $spells;
}
?>