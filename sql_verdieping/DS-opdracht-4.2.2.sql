SELECT 
	c.name, 
	CASE 
		WHEN g.name IS NULL THEN 'INVALID'
		ELSE g.name
	END commune_name
FROM mhl_cities as c
LEFT JOIN mhl_communes AS g ON c.commune_id = g.id
;