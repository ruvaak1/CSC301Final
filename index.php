<?php
include('config.php');

$isDM = isDM($player->get('classid'));
if($isDM == false)
{
	header ("location: class.php");
}

$sql = file_get_contents("sql/getClass.sql");
$params = array(
	'classid' => $player->get('classid')
);
$statement = $database->prepare($sql);
$statement->execute($params);
$classes = $statement->fetchAll(PDO::FETCH_ASSOC);
$class = $classes[0];
$cname = $class['name'];

if ($player->get('classid') == 13){
	$sql = file_get_contents('sql/getPlayers.sql');
	$statement = $database->prepare($sql);
	$statement->execute();
	$players = $statement->fetchAll(PDO::FETCH_ASSOC);
	
	$sql = file_get_contents('sql/getClasses.sql');
	$statement = $database->prepare($sql);
	$statement->execute();
	$classes = $statement->fetchAll(PDO::FETCH_ASSOC);
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
		<?php if ($player->get('classid') == 13) : ?>
			<h2>Players:</h2>
			<?php foreach($players as $playerL) : ?>
				<p><?php echo $playerL['name'] ?> <a href="playerEdit.php?action=edit&playerid=<?php echo $playerL['playerid'] ?>">Edit</a></p>
			<?php endforeach; ?>
		<?php else : ?>
			<p>Your class is: <a href="class.php" ><?php echo $class['name'] ?></a></p>
			<p><a href="spelllist.php">Spell List</a></p>
		<?php endif; ?>
	</div>
</body>
</html>