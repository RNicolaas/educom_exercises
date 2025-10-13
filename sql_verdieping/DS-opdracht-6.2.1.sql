SELECT 
	DATE_FORMAT(joindate, '%d/%m/%Y') AS join_date,
	id
FROM mhl_suppliers
WHERE EXTRACT(MONTH FROM DATE_ADD(joindate, INTERVAL 7 DAY)) != EXTRACT(MONTH FROM joindate)
;