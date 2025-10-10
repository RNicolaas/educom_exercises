SELECT s.name, s.straat, s.huisnr, s.postcode
FROM mhl_yn_properties AS link
INNER JOIN mhl_suppliers AS s ON link.supplier_ID = s.id
INNER JOIN mhl_propertytypes AS p ON link.propertytype_ID = p.id 
WHERE p.name = 'specialistische leverancier'
	OR p.name = 'ook voor particulieren'
;