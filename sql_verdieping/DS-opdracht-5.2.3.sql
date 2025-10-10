SELECT 
	year AS Jaar,
	SUM(IF(month IN (1,2,3),hitcount,0)) AS Eerste_Kwartaal,
	SUM(IF(month IN (4,5,6),hitcount,0)) AS Tweede_Kwartaal,
	SUM(IF(month IN (7,8,9),hitcount,0)) AS Derde_Kwartaal,
	SUM(IF(month IN (10,11,12),hitcount,0)) AS Vierde_Kwartaal,
	SUM(hitcount) AS Totaal
FROM mhl_hitcount
GROUP BY year
ORDER BY year
;