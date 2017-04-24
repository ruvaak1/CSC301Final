<?php
include('config.php');

if (!isDM($player->get("classid")))
{
	header("Location: index.php");
}

$action = get('action');

$classid = get('classid');
$levelid = get('level');

$level = null;

if (!empty($classid) && !empty($levelid)){
	$sql = file_get_contents('sql/getLevel.sql');
	$params = array(
		'classid' => $classid,
		'level' => $levelid
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$levels = $statement->fetchAll(PDO::FETCH_ASSOC);
	$level = $levels[0];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$levelid = $_POST['level'];
	$profBonus = $_POST['profBonus'];
	$features = $_POST['features'];
	$cantrips = $_POST['cantrips'];
	$mana = $_POST['mana'];
	$maxSpell = $_POST['maxSpell'];
	
	if($action == 'add'){
		$sql = file_get_contents('sql/addLevel.sql');
		$params = array(
			'classid' => $classid,
			'level' => $levelid,
			'profBonus' => $profBonus,
			'features' => $features,
			'cantrips' => $cantrips,
			'mana' => $mana,
			'maxSpell' => $maxSpell
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
	}
	
	elseif($action == 'edit'){
		$sql = file_get_contents('sql/updateLevel.sql');
		$params = array(
			'classid' => $classid,
			'level' => $levelid,
			'profBonus' => $profBonus,
			'features' => $features,
			'cantrips' => $cantrips,
			'mana' => $mana,
			'maxSpell' => $maxSpell
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
	}
	//Redirect?
	header("location: class.php?classid=" . $classid);
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

				<label>Level:</label>
				<?php if($action == 'edit') : ?>
					<input readonly type="text" name="level" class="textbox" value="<?php echo $level['level'] ?>" />
				<?php else : ?>
					<input type="text" name="level" class="textbox" value="<?php echo $level['level'] ?>" />
				<?php endif; ?>

				<label>Proficiency Bonus:</label>
				<input type="text" name="profBonus" class="textbox" value="<?php echo $level['profBonus'] ?>" />

				<label>Features:</label>
				<input type="text" name="features" class="textbox" value="<?php echo $level['features'] ?>" maxlength="100" />

				<label>Cantrips:</label>
				<input type="text" name="cantrips" class="textbox" value="<?php echo $level['cantrips'] ?>" />

				<label>Mana:</label>
				<input type="text" name="mana" class="textbox" value="<?php echo $level['mana'] ?>" />

				<label>Max Spell Level:</label>
				<input type="text" name="maxSpell" class="textbox" value="<?php echo $level['maxSpell'] ?>" />
			
				<input type="submit" class="button" id="button"/>
				<input type="reset" class="button" id="button"/>
			
		</form>
	</div>
</body>
</html>