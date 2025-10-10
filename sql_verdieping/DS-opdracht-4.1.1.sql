SELECT s.name, s.straat, s.huisnr, s.postcode
FROM mhl_suppliers AS s
INNER JOIN mhl_cities AS c
ON s.city_ID = c.id
WHERE c.name = 'Amsterdam';