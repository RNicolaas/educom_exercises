CREATE VIEW maanden(id,name)
AS
SELECT 1, 'Januari'
UNION SELECT 2, 'Februari'
UNION SELECT 3, 'Maart'
UNION SELECT 4, 'April'
UNION SELECT 5, 'Mei'
UNION SELECT 6, 'Juni'
UNION SELECT 7, 'Juli'
UNION SELECT 8, 'Augustus'
UNION SELECT 9, 'September'
UNION SELECT 10, 'Oktober'
UNION SELECT 11, 'November'
UNION SELECT 12, 'December';

SELECT 
	h.year AS jaar, 
	m.name AS maand, 
	COUNT(h.hitcount) AS 'aantal leveranciers', 
	SUM(h.hitcount) AS 'totaal aantal hits'
FROM mhl_hitcount AS h
INNER JOIN maanden AS m ON h.month = m.id
GROUP BY year DESC, h.month DESC
;