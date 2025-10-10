SELECT s.name AS leverancier, SUM(hitcount) AS total_hits, COUNT(hitcount) AS nr_months, AVG(hitcount) AS avghitspmonth
FROM mhl_hitcount as h
INNER JOIN mhl_suppliers AS s ON h.supplier_id = s.id
GROUP BY s.id
HAVING SUM(hitcount) > 100
ORDER BY avghitspmonth DESC
;