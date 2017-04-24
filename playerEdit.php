<?php
include('config.php');

if (!isDM($player->get("classid")))
{
	header("Location: index.php");
}

$action = get('action');

$playeridE = get('playerid');

$playerE = null;

if (!empty($playeridE)){
	$sql = file_get_contents('sql/getPlayer.sql');
	$params = array(
		'playerid' => $playeridE
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$players = $statement->fetchAll(PDO::FETCH_ASSOC);
	$playerE = $players[0];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$name = $_POST['name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$classid = $_POST['classid'];
	
	if($action == 'add'){
		
	}
	
	elseif($action == 'edit'){
		$sql = file_get_contents('sql/updatePlayer.sql');
		$params = array(
			'playerid' => $playeridE,
			'name' => $name,
			'username' => $username,
			'password' => $password,
			'classid' => $classid
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
	}
	//Redirect?
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>Home</title>
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<nav>
	<ul>
		<li><?php echo $player->get('name') ?></li>
		<?php if($player->get('classid') == 13) : ?>
			<li><a href="index.php">Home</a></li>
			<li><a href="classes.php">Classes</a></li>
			<li><a href="spells.php">Spells</a></li>
			<li><a href="features.php">Features</a></li>
			<li><a href="logout.php">Logout</a></li>
		<?php else : ?>
			<li><a href="class.php">Home</a></li>
			<li><a href="spelllist.php?classid=<?php echo $player->get('classid') ?>">Spell List</a></li>
			<li><a href="logout.php">Logout</a></li>
		<?php endif ?>
	</ul>
	</nav>
	<div class="page">
	
		<form action="" method="POST">
				<label>Player ID:</label>
				<input readonly type="text" name="playerid" class="textbox" value="<?php echo $playerE['playerid'] ?>" />
		
				<label>Name:</label>
				<input type="text" name="name" class="textbox" value="<?php echo $playerE['name'] ?>" />
			
				<label>Username:</label>
				<input type="text" name="username" class="textbox" value="<?php echo $playerE['username'] ?>" />
			
				<label>Password:</label>
				<input type="text" name="password" class="textbox" value="<?php echo $playerE['password'] ?>" />
			
				<label>Class ID:</label>
				<input type="text" name="classid" class="textbox" value="<?php echo $playerE['classid'] ?>" />
			
				<input type="submit" class="button" id="button" />
				<input type="reset" class="button" id="button" />
		</form>
	</div>
</body>
</html>