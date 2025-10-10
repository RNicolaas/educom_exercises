SELECT c.name, c.commune_ID
FROM mhl_cities as c
LEFT JOIN mhl_communes AS g ON c.commune_id = g.id
WHERE g.id IS NULL
;