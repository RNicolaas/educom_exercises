SELECT 
	c.name AS stad,
	COUNT(IF(m.name = 'Gold',1,NULL)) AS Gold,
	COUNT(IF(m.name = 'Silver',1,NULL)) AS Silver,
	COUNT(IF(m.name = 'Bronze',1,NULL)) AS Bronze,
	COUNT(IF(m.name NOT IN ('Gold','Silver','Bronze'),1,NULL)) AS Other
FROM mhl_suppliers s
INNER JOIN mhl_membertypes m ON s.membertype = m.id
INNER JOIN mhl_cities c ON s.city_id = c.id
GROUP BY c.name
ORDER BY Gold DESC, Silver DESC, Bronze DESC, Other DESC
;