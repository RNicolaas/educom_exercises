SELECT 
	CASE 
		WHEN hr.name IS NULL THEN sr.name 
		ELSE hr.name
	END hoofdrubriek,
	CASE 
		WHEN hr.name IS NULL THEN '' 
		ELSE sr.name
	END subrubriek
FROM mhl_rubrieken AS sr
LEFT JOIN mhl_rubrieken AS hr ON sr.parent = hr.id
ORDER BY hoofdrubriek, subrubriek
;
