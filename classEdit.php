<?php
include('config.php');

if (!isDM($player->get("classid")))
{
	header("Location: index.php");
}

$action = get('action');

$classid = get('classid');

$class = null;

if (!empty($classid)){
	$sql = file_get_contents('sql/getClass.sql');
	$params = array(
		'classid' => $classid
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$classes = $statement->fetchAll(PDO::FETCH_ASSOC);
	$class = $classes[0];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$name = $_POST['name'];
	$hitdie = $_POST['hitdie'];
	$description = $_POST['description'];
	$profArmor1 = $_POST['profArmor1'];
	$profArmor2 = $_POST['profArmor2'];
	$profArmor3 = $_POST['profArmor3'];
	$profArmor4 = $_POST['profArmor4'];
	$profWeapon1 = $_POST['profWeapon1'];
	$profWeapon2 = $_POST['profWeapon2'];
	$profWeapon3 = $_POST['profWeapon3'];
	$profWeapon4 = $_POST['profWeapon4'];
	$profWeapon5 = $_POST['profWeapon5'];
	$profWeapon6 = $_POST['profWeapon6'];
	$profTool1 = $_POST['profTool1'];
	$profTool2 = $_POST['profTool2'];
	$profSave1 = $_POST['profSave1'];
	$profSave2 = $_POST['profSave2'];
	$profSkill1 = $_POST['profSkill1'];
	$profSkill2 = $_POST['profSkill2'];
	$profSkill3 = $_POST['profSkill3'];
	$profSkill4 = $_POST['profSkill4'];
	$profSkill5 = $_POST['profSkill5'];
	$profSkill6 = $_POST['profSkill6'];
	$profSkillNum = $_POST['profSkillNum'];
	
	if($action == 'add'){
		
	}
	
	elseif($action == 'edit'){
		$sql = file_get_contents('sql/updateClass.sql');
		$params = array(
			'classid' => $classid,
			'name' => $name,
			'hitdie' => $hitdie,
			'description' => $description,
			'profArmor1' => $profArmor1,
			'profArmor2' => $profArmor2,
			'profArmor3' => $profArmor3,
			'profArmor4' => $profArmor4,
			'profWeapon1' => $profWeapon1,
			'profWeapon2' => $profWeapon2,
			'profWeapon3' => $profWeapon3,
			'profWeapon4' => $profWeapon4,
			'profWeapon5' => $profWeapon5,
			'profWeapon6' => $profWeapon6,
			'profTool1' => $profTool1,
			'profTool2' => $profTool2,
			'profSave1' => $profSave1,
			'profSave2' => $profSave2,
			'profSkill1' => $profSkill1,
			'profSkill2' => $profSkill2,
			'profSkill3' => $profSkill3,
			'profSkill4' => $profSkill4,
			'profSkill5' => $profSkill5,
			'profSkill6' => $profSkill6,
			'profSkillNum' => $profSkillNum
		);
		$statement = $database->prepare($sql);
		$statement->execute($params);
	}
	//Redirect?
	header("location: classes.php");
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
				<input readonly type="text" name="classid" class="textbox" value="<?php echo $class['classid'] ?>" />
			
				<label>Name:</label>
				<input type="text" name="name" class="textbox" value="<?php echo $class['name'] ?>" />
			
				<label>Hit Die:</label>
				<input type="text" name="hitdie" class="textbox" value="<?php echo $class['hitdie'] ?>" />
			
				<label>Description:</label>
				<textarea rows="4" cols="25" name="description" maxlength="500" ><?php echo $class['description'] ?></textarea>
			
				<label>Armor Proficiencies:</label>
				<div id="inputGroup">
				<input type="text" name="profArmor1" class="textbox" value="<?php echo $class['profArmor1'] ?>" />
				<input type="text" name="profArmor2" class="textbox" value="<?php echo $class['profArmor2'] ?>" />
				<input type="text" name="profArmor3" class="textbox" value="<?php echo $class['profArmor3'] ?>" />
				<input type="text" name="profArmor4" class="textbox" value="<?php echo $class['profArmor4'] ?>" />
				</div>
				
				<label>Weapon Proficiencies:</label>
				<div id="inputGroup">
				<input type="text" name="profWeapon1" class="textbox" value="<?php echo $class['profWeapon1'] ?>" />
				<input type="text" name="profWeapon2" class="textbox" value="<?php echo $class['profWeapon2'] ?>" />
				<input type="text" name="profWeapon3" class="textbox" value="<?php echo $class['profWeapon3'] ?>" />
				<input type="text" name="profWeapon4" class="textbox" value="<?php echo $class['profWeapon4'] ?>" />
				<input type="text" name="profWeapon5" class="textbox" value="<?php echo $class['profWeapon5'] ?>" />
				<input type="text" name="profWeapon6" class="textbox" value="<?php echo $class['profWeapon6'] ?>" />
				</div>

				<label>Tool Proficiencies:</label>
				<div id="inputGroup">
				<input type="text" name="profTool1" class="textbox" value="<?php echo $class['profTool1'] ?>" />
				<input type="text" name="profTool2" class="textbox" value="<?php echo $class['profTool2'] ?>" />
				</div>
			
				<label>Save Proficiencies:</label>
				<div id="inputGroup">
				<input type="text" name="profSave1" class="textbox" value="<?php echo $class['profSave1'] ?>" />
				<input type="text" name="profSave2" class="textbox" value="<?php echo $class['profSave2'] ?>" />
				</div>
			
				<label>Number of Skill Profs:</label>
				<input type="text" name="profSkillNum" class="textbox" value="<?php echo $class['profSkillNum'] ?>" />

				<label>Skill Proficiencies:</label>
				<div id="inputGroup">
				<input type="text" name="profSkill1" class="textbox" value="<?php echo $class['profSkill1'] ?>" />
				<input type="text" name="profSkill2" class="textbox" value="<?php echo $class['profSkill2'] ?>" />
				<input type="text" name="profSkill3" class="textbox" value="<?php echo $class['profSkill3'] ?>" />
				<input type="text" name="profSkill4" class="textbox" value="<?php echo $class['profSkill4'] ?>" />
				<input type="text" name="profSkill5" class="textbox" value="<?php echo $class['profSkill5'] ?>" />
				<input type="text" name="profSkill6" class="textbox" value="<?php echo $class['profSkill6'] ?>" />
				</div>
			
				<input type="submit" class="button" id="button"/>
				<input type="reset" class="button" id="button"/>
		</form>
	</div>
</body>
</html>