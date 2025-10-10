SELECT 
	name,straat,huisnr,postcode 
FROM 
	mhl_suppliers 
WHERE 
	membertype IN (
		SELECT 
			id 
		FROM 
			mhl_membertypes 
		WHERE 
			name IN ('Gold' , 'Silver' , 'Bronze' , 'GEEN INTERESSE')
	)
;