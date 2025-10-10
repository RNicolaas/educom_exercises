SELECT 
	sp.leverancier,
	CASE 
		WHEN con.name IS NULL THEN 't.a.v. de directie'
		ELSE con.name
	END aanhef,
	sp.adres,
	sp.postcode,
	c.name AS stad,
	d.name AS provincie
FROM (
	SELECT 
		s.id, 
		s.name AS leverancier, 
		CASE
			WHEN s.p_address IS NULL OR p_address = '' THEN s.city_id
			ELSE s.p_city_id
		END city_id, 
		CASE
			WHEN s.p_address IS NULL OR p_address = '' THEN CONCAT(s.straat, ' ', s.huisnr)
			ELSE s.p_address
		END adres,
		CASE
			WHEN s.p_address IS NULL OR p_address = '' THEN s.postcode
			ELSE s.p_postcode
		END postcode 
	FROM mhl_suppliers AS s
) AS sp
LEFT JOIN mhl_contacts AS con ON sp.id = con.supplier_id AND con.department = 3
LEFT JOIN mhl_cities AS c ON sp.city_id = c.id
LEFT JOIN mhl_communes AS g ON c.commune_id = g.id
LEFT JOIN mhl_districts AS d ON g.district_id = d.id
WHERE NOT sp.adres = ''
ORDER BY provincie, stad, leverancier
;