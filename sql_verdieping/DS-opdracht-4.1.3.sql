SELECT s.name, s.straat, s.huisnr, s.postcode
FROM mhl_suppliers AS s
INNER JOIN mhl_cities AS c ON s.city_ID = c.id
INNER JOIN mhl_suppliers_mhl_rubriek_view AS link ON link.mhl_suppliers_ID = s.id
INNER JOIN mhl_rubrieken AS r ON link.mhl_rubriek_view_id =  r.id 

WHERE c.name = 'Amsterdam' 
	AND (
		r.name = 'drank' OR r.parent = (SELECT id FROM mhl_rubrieken WHERE name = 'drank' AND parent = 0)
	)
ORDER BY r.name, s.name
;