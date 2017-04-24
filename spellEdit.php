<?php
include('config.php');

if (!isDM($player->get("classid")))
{
	header("Location: index.php");
}

$action = get('action');

$spellid = get('spellid');

$spell = null;

if (!empty($spellid)){
	$sql = file_get_contents('sql/getSpell.sql');
	$params = array(
		'spellid' => $spellid
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$spells = $statement->fetchAll(PDO::FETCH_ASSOC);
	$spell = $spells[0];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$name = $_POST['name'];
	$description = $_POST['description'];
	
	if($action == 'add'){
		$sql = file_get_contents('sql/addSpell.sql');
		$params = array(
			'name' => $name,
			'description' => $description
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
	}
	
	elseif($action == 'edit'){
		$sql = file_get_contents('sql/updateSpell.sql');
		$params = array(
			'spellid' => $spellid,
			'name' => $name,
			'description' => $description
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
	}
	//Redirect?
	header("location: spells.php");
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
				<label>Spell ID:</label>
				<?php if($action=='edit') : ?>
				<input readonly type="text" name="spellid" class="textbox" value="<?php echo $spell['spellid'] ?>" />
				<?php else : ?>
				<input type="text" name="spellid" class="textbox" value="" />
				<?php endif; ?>
			
				<label>Name:</label>
				<input type="text" name="name" class="textbox" value="<?php echo $spell['name'] ?>" />
		
				<label>Description:</label>
				<textarea rows="4" cols="25" name="description" maxlength="500" ><?php echo $spell['description'] ?></textarea>
				
				<input type="submit" class="button" id="button" />
				<input type="reset" class="button" id="button" />
		</form>
	</div>
</body>
</html>