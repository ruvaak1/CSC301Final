<?php
include('config.php');

$isDM = isDM($player->get('classid'));

$sql = file_get_contents("sql/getClass.sql");
$params = array(
	'classid' => $player->get('classid')
);
$statement = $database->prepare($sql);
$statement->execute($params);
$classes = $statement->fetchAll(PDO::FETCH_ASSOC);
$class = $classes[0];
$cname = $class['name'];

if ($isDM == true){
	$sql = file_get_contents('sql/getPlayers.sql');
	$statement = $database->prepare($sql);
	$statement->execute();
	$players = $statement->fetchAll(PDO::FETCH_ASSOC);
	
	$sql = file_get_contents('sql/getClasses.sql');
	$statement = $database->prepare($sql);
	$statement->execute();
	$classes = $statement->fetchAll(PDO::FETCH_ASSOC);
}
else{
	header("Location: index.php");
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
			<h2>Classes:</h2>
			<?php foreach($classes as $class) : ?>
				<p><?php echo $class['name'] ?> 
					<a href="class.php?classid=<?php echo $class['classid'] ?>">View</a>
					<a href="classEdit.php?action=edit&classid=<?php echo $class['classid'] ?>">Edit</a>
					<a href="spellList.php?classid=<?php echo $class['classid'] ?>">Spell List</a></p>
			<?php endforeach; ?>
	</div>
</body>
</html>