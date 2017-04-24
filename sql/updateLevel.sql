UPDATE f_levels
SET profBonus = :profBonus, cantrips = :cantrips, mana = :mana, maxSpell = :maxSpell, features = :features
WHERE classid=:classid AND level = :level