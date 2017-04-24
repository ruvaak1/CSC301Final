<?php
include('config.php');

$classid = get('classid');
$isDM = isDM($player->get('classid'));

$sql = file_get_contents('sql/getSpellList.sql');
$params = array(
	'classid' => $classid
);
$statement = $database->prepare($sql);
$statement->execute($params);
$spellList = $statement->fetchAll(PDO::FETCH_ASSOC);


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
		<?php if ($isDM) : ?><a href="spellListEdit.php?action=add&classid=<?php echo $classid ?>">Add</a><?php endif; ?>
		<?php foreach ($spellList as $spell) : ?>
			<h3><?php echo $spell['name'] ?></h3>
			<p><?php echo $spell['description'] ?></p>
			<hr />
		<?php endforeach; ?>
	</div>
</body>
</html>