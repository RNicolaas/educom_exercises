SELECT 
	DATE_FORMAT(joindate, '%d/%m/%Y') AS join_date,
	id,
    DATEDIFF(CURRENT_TIMESTAMP, joindate) AS dagen_lid
FROM mhl_suppliers
ORDER BY dagen_lid ASC
;