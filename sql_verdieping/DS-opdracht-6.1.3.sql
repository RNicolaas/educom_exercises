SELECT
	CASE
		WHEN subrubriek = '' THEN hoofdrubriek
		ELSE CONCAT(hoofdrubriek,'  -  ',subrubriek)
	END rubriek,
	COUNT(r.id) AS leveranciers
FROM mhl_suppliers_mhl_rubriek_view as v
INNER JOIN (
	SELECT 
		sr.id,
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
) AS r ON r.id = v.mhl_rubriek_view_id
GROUP BY r.id
ORDER BY rubriek
;