SELECT DISTINCT 
	c1.name AS c1name, 
	c2.name AS c2name, 
	LEAST(c1.id, c2.id) AS c1id,
	GREATEST(c2.id, c1.id) AS c2id,
	LEAST(c1.commune_ID, c2.commune_id) AS c1commune_id,
	GREATEST(c2.commune_id, c1.commune_ID) AS c2commune_id
FROM mhl_cities AS c1
INNER JOIN mhl_cities AS c2 ON c1.name = c2.name
WHERE c1.id != c2.id
ORDER BY c1.name
;