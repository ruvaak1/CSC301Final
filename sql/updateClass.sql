UPDATE f_classes
SET name=:name, hitdie=:hitdie, description=:description, profArmor1=:profArmor1, profArmor2=:profArmor2, profArmor3=:profArmor3, profArmor4=:profArmor4,
	profWeapon1=:profWeapon1, profWeapon2=:profWeapon2, profWeapon3=:profWeapon3, profWeapon4=:profWeapon4, profWeapon5=:profWeapon5, profWeapon6=:profWeapon6,
	profTool1=:profTool1, profTool2=:profTool2, profSave1=:profSave1, profSave2=:profSave2, profSkill1=:profSkill1, profSkill2=:profSkill2, profSkill3=:profSkill3, profSkill4=:profSkill4,
	profSkill5=:profSkill5, profSkill6=:profSkill6, profSkillNum=:profSkillNum
WHERE classid=:classid