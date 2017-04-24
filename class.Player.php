<?php

class Player {
	private $playerid;
	private $name;
	private $database;
	private $classid;
	
	function __construct($playerid, $database){
		$sql = file_get_contents('sql/getPlayer.sql');
		$params = array(
			'playerid' => $playerid
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
		$players = $statement->fetchAll(PDO::FETCH_ASSOC);
		$playerInfo = $players[0];
		$this->playerid = $playerInfo['playerid'];
		$this->name = $playerInfo['name'];
		$this->classid = $playerInfo['classid'];
	}
	
	function get($key){
		return $this->$key;
	}
}
?>