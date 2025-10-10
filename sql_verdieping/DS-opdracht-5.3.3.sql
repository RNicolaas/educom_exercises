SELECT 
	s.name,
	CASE 
		WHEN d.contact IS NULL THEN 't.a.v. de directie'
		ELSE d.contact
	END aanhef,
	v.adres,
	v.postcode,
	v.stad
FROM mhl_suppliers AS s
LEFT JOIN verzendlijst AS v ON v.id = s.id
LEFT JOIN directie AS d ON d.supplier_id = s.id
;