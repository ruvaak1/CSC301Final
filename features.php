<?php
include('config.php');

if (!isDM($player->get("classid")))
{
	header("Location: index.php");
}

$sql = file_get_contents('sql/getFeatures.sql');
$statement = $database->prepare($sql);
$statement->execute();
$features = $statement->fetchAll(PDO::FETCH_ASSOC);
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
		<a href="featureEdit.php?action=add">Add</a>
		<?php foreach ($features as $feature) : ?>
			<h3><?php echo $feature['name'] ?></h3>
			<p><?php echo $feature['description'] ?></p>
			<a href="featureEdit.php?action=edit&featureid=<?php echo $feature['featureid'] ?>">Edit</a>
		<?php endforeach; ?>
	</div>
</body>
</html>