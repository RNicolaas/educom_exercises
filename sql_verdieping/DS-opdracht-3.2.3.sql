SELECT 
	name,straat,huisnr,postcode 
FROM 
	mhl_suppliers 
WHERE 
	city_id = (
		SELECT 
			id 
		FROM 
			mhl_cities 
		WHERE 
			name = "Amsterdam"
	)
	AND
	city_id != p_city_ID
;