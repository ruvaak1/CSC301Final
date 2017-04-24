<?php
include('config.php');

if (!isDM($player->get("classid")))
{
	header("Location: index.php");
}

$action = get('action');

$classid = get('classid');
$spellid = get('spellid');

$spell = null;

if ($action == 'edit')
{
	if (!empty($classid)){
		$sql = file_get_contents('sql/getSpellListItem.sql');
		$params = array(
			'classid' => $classid,
			'playerid' => $spellid
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
		$spells = $statement->fetchAll(PDO::FETCH_ASSOC);
		$spell = $spells[0];
	}
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$classid = $_POST['classid'];
	$spellid = $_POST['spellid'];
	
	if($action == 'add'){
		$sql = file_get_contents('sql/addSpellListItem.sql');
		$params = array(
			'classid' => $classid,
			'spellid' => $spellid
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
	}
	
	/*
	elseif($action == 'edit'){
		$sql = file_get_contents('sql/updateSpellListItem.sql');
		$params = array(
			'classid' => $classid,
			'spellid' => $spellid
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
	}*/
	//Redirect?
	header("location: spelllist.php?classid=" . $classid);
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
				<label>Class ID:</label>
				<input readonly type="text" name="classid" class="textbox" value="<?php echo $classid ?>" />
			
				<label>Spell ID:</label>
				<input type="text" name="spellid" class="textbox" value="" />
			
				<input type="submit" class="button" id="button" />
				<input type="reset" class="button" id="button" />
		</form>
	</div>
</body>
</html>