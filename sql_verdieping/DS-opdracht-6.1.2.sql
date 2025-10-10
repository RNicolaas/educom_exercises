SELECT
	a.gemeente,
	s.name as leverancier,
	SUM(h.hitcount) as total_hitcount,
	a.average_hitcount
FROM mhl_suppliers AS s
INNER JOIN mhl_cities AS c ON s.city_id = c.id
INNER JOIN mhl_hitcount AS h ON s.id = h.supplier_id
INNER JOIN (
	SELECT 
		g.id AS g_id,
		g.name AS gemeente,
		AVG(h.hitcount) AS average_hitcount
	FROM mhl_suppliers AS s
	INNER JOIN mhl_cities AS c ON s.city_id = c.id
	INNER JOIN mhl_communes AS g ON g.id = c.commune_id
	INNER JOIN mhl_hitcount AS h ON s.id = h.supplier_id
	GROUP BY g.id
) AS a ON c.commune_id = a.g_id
GROUP BY a.gemeente, s.id
HAVING total_hitcount > a.average_hitcount
ORDER BY a.gemeente, total_hitcount DESC
;
