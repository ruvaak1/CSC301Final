<?php
include('config.php');

$isDM = isDM($player->get('classid'));

if ($isDM == true){
	$classid = get('classid');
}
else {
	$classid = $player->get('classid');
}


$sql = file_get_contents("sql/getClass.sql");
$params = array(
	'classid' => $classid
);
$statement = $database->prepare($sql);
$statement->execute($params);
$classes = $statement->fetchAll(PDO::FETCH_ASSOC);
$class = $classes[0];

$sql = file_get_contents("sql/getLevels.sql");
$statement = $database->prepare($sql);
$statement->execute($params);
$levels = $statement->fetchAll(PDO::FETCH_ASSOC);

$sql = file_get_contents("sql/getClassFeatures.sql");
$statement = $database->prepare($sql);
$statement->execute($params);
$features = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>Class</title>
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
		<h1><?php echo $class['name'] ?></h1>
		<hr />
		<p><?php echo $class['description'] ?></p>
		<?php if ($isDM == true) : ?>
		<p><a href="levelEdit.php?action=add&classid=<?php echo $classid ?>">Add Level</a></p>
		<?php endif; ?>
		<table>
			<tr>
				<th>Level</th>
				<th>Prof Bonus</th>
				<th>Features</th>
				<th>Cantrips</th>
				<th>Mana</th>
				<th>Max Spell Level</th>
				<?php if ($isDM == true) : ?>
					<th>Edit</th>
				<?php endif; ?>
			</tr>
			<?php if ($isDM == true) : ?>
			<?php foreach($levels as $level) : ?>
			<tr>
				<th><?php echo $level['level'] ?></th>
				<th>+<?php echo $level['profBonus'] ?></th>
				<th><?php echo $level['features'] ?></th>
				<th><?php echo $level['cantrips'] ?></th>
				<th><?php echo $level['mana'] ?></th>
				<th><?php echo $level['maxSpell'] ?></th>
				<th><a href="levelEdit.php?action=edit&classid=<?php echo $classid ?>&level=<?php echo $level['level'] ?>">Edit</a></th>
			</tr>
			<?php endforeach; ?>
			<?php else : ?>
			<?php foreach($levels as $level) : ?>
			<tr>
				<th><?php echo $level['level'] ?></th>
				<th>+<?php echo $level['profBonus'] ?></th>
				<th><?php echo $level['features'] ?></th>
				<th><?php echo $level['cantrips'] ?></th>
				<th><?php echo $level['mana'] ?></th>
				<th><?php echo $level['maxSpell'] ?></th>
			</tr>
			<?php endforeach; ?>
			<?php endif; ?>
		</table>
		<p><strong>Hit Die:</strong> <?php echo $class['hitdie'] ?></p>
		
		
		<h2>Proficiencies</h2>
		<p><strong>Armor:</strong>
			<?php echo $class['profArmor1'] ?> 
			<?php echo $class['profArmor2'] ?> 
			<?php echo $class['profArmor3'] ?> 
			<?php echo $class['profArmor4'] ?>
			</p>
		<p><strong>Weapons:</strong> 
			<?php echo $class['profWeapon1'] ?> 
			<?php echo $class['profWeapon2'] ?> 
			<?php echo $class['profWeapon3'] ?> 
			<?php echo $class['profWeapon4'] ?> 
			<?php echo $class['profWeapon5'] ?> 
			<?php echo $class['profWeapon6'] ?>
			</p>
		<p><strong>Tools:</strong> 
			<?php echo $class['profTool1'] ?> 
			<?php echo $class['profTool2'] ?>
			</p>
		<p><strong>Saves:</strong> 
			<?php echo $class['profSave1'] ?> 
			<?php echo $class['profSave2'] ?>
			</p>
		<p><strong>Skills (choose <?php echo $class['profSkillNum'] ?>):</strong> 
			<?php echo $class['profSkill1'] ?> 
			<?php echo $class['profSkill2'] ?> 
			<?php echo $class['profSkill3'] ?> 
			<?php echo $class['profSkill4'] ?> 
			<?php echo $class['profSkill5'] ?> 
			<?php echo $class['profSkill6'] ?>
			</p>
		
		<?php if($isDM == false) : ?>
		<h2>Spell List</h2>
		<p><a href="spelllist.php?classid=<?php echo $player->get('classid') ?>">Spell List</a></p>
		<?php endif; ?>
		
		<h2>Features</h2>
		<?php foreach($features as $feature) : ?>
			<h3><?php echo $feature['name'] ?></h3>
			<p><?php echo $feature['description'] ?></p>
			<hr>
		<?php endforeach; ?>
	</div>
</body>
</html>