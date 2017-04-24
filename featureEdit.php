<?php
include('config.php');

if (!isDM($player->get("classid")))
{
	header("Location: index.php");
}

$action = get('action');

$featureid = get('featureid');

$feature = null;

if (!empty($featureid)){
	$sql = file_get_contents('sql/getFeature.sql');
	$params = array(
		'featureid' => $featureid
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$features = $statement->fetchAll(PDO::FETCH_ASSOC);
	$feature = $features[0];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$classid = $_POST['classid'];
	$name = $_POST['name'];
	$description = $_POST['description'];
	
	if($action == 'add'){
		$sql = file_get_contents('sql/addFeature.sql');
		$params = array(
			'classid' => $classid,
			'name' => $name,
			'description' => $description
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
	}
	
	elseif($action == 'edit'){
		$sql = file_get_contents('sql/updateFeature.sql');
		$params = array(
			'featureid' => $featureid,
			'classid' => $classid,
			'name' => $name,
			'description' => $description
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
	}
	//Redirect?
	header("location: features.php");
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
				<label>Feature ID:</label>
				<input readonly type="text" name="featureid" class="textbox" value="<?php echo $feature['featureid'] ?>" />
			
				<label>Class ID:</label>
				<input type="text" name="classid" class="textbox" value="<?php echo $feature['classid'] ?>" />
			
				<label>Name:</label>
				<input type="text" name="name" class="textbox" value="<?php echo $feature['name'] ?>" />
			
				<label>Description:</label>
				<textarea rows="4" cols="25" name="description" maxlength="500" ><?php echo $feature['description'] ?></textarea>
			
				<input type="submit" class="button" id="button" />
				<input type="reset" class="button" id="button" />
		</form>
	</div>
</body>
</html>