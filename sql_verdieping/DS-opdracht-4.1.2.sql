SELECT s.name AS naam, s.straat, s.huisnr AS huisnummer, s.postcode, g.name AS plaatsnaam
FROM mhl_suppliers AS s
INNER JOIN mhl_cities AS c ON s.city_ID = c.id
INNER JOIN mhl_communes AS g ON g.id = c.commune_ID
WHERE g.name = 'Steenwijkerland'
;