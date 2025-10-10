SELECT 
	s.name, 
	pt.name,
	CASE 
		WHEN content IS NULL THEN 'NOT SET'
		ELSE content
	END waarde 
FROM (
	SELECT s.id, s.name 
	FROM mhl_suppliers AS s 
	INNER JOIN mhl_cities AS c ON s.city_id = c.id
	WHERE c.name = 'Amsterdam'
) AS s
CROSS JOIN (
	SELECT * 
	FROM mhl_propertytypes 
	WHERE proptype = 'A'
) AS pt
LEFT JOIN mhl_yn_properties AS p ON p.supplier_ID = s.id AND p.propertytype_id = pt.id
;

