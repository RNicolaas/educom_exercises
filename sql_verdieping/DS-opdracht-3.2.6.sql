SELECT 
	name,straat,huisnr,postcode 
FROM 
	mhl_suppliers 
WHERE 
	huisnr BETWEEN 11 AND 19
	OR huisnr > 100
;