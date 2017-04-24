<?php
include('config.php');

if (!isDM($player->get("classid")))
{
	header("Location: index.php");
}
$term = get('search-term');

if(empty($term)){
	$sql = file_get_contents('sql/getSpells.sql');
	$statement = $database->prepare($sql);
	$statement->execute();
	$spells = $statement->fetchAll(PDO::FETCH_ASSOC);
}
else{
	$spells = searchSpells($term, $database);
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
		<form method="GET" id="smallForm">
			<input type="text" name="search-term" placeholder="Search..." />
			<input type="submit" class="button" />
		</form>
		<a href="spellEdit.php?action=add">Add</a>
		<?php foreach ($spells as $spell) : ?>
			<h3><?php echo $spell['name'] ?></h3>
			<p><?php echo $spell['description'] ?></p>
			<a href="spellEdit.php?action=edit&spellid=<?php echo $spell['spellid'] ?>">Edit</a>
		<?php endforeach; ?>
	</div>
</body>
</html>