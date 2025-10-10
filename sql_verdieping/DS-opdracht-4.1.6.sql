SELECT h.hitcount, s.name AS leverancier, c.name AS stad, g.name AS gemeente, d.name AS provincie
FROM mhl_hitcount AS h
INNER JOIN mhl_suppliers AS s ON h.supplier_ID = s.id
INNER JOIN mhl_cities AS c ON s.city_ID = c.id
INNER JOIN mhl_communes AS g ON c.commune_ID = g.id
INNER JOIN mhl_districts AS d ON g.district_ID = d.id
WHERE h.year = 2014 AND h.month = 1 AND (d.name = 'Limburg' OR d.name = 'Zeeland' OR d.name = 'Noord-brabant')
;