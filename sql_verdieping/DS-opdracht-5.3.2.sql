CREATE VIEW VERZENDLIJST
AS
SELECT 
	sp.id,
	sp.adres,
	sp.postcode,
	c.name AS stad
FROM (
	SELECT 
		s.id, 
		CASE
			WHEN s.p_address IS NULL OR p_address = '' THEN s.city_id
			ELSE s.p_city_id
		END city_id, 
		CASE
			WHEN s.p_address IS NULL OR p_address = '' THEN CONCAT(s.straat, ' ', s.huisnr)
			ELSE s.p_address
		END adres,
		CASE
			WHEN s.p_address IS NULL OR p_address = '' THEN s.postcode
			ELSE s.p_postcode
		END postcode 
	FROM mhl_suppliers AS s
) AS sp
LEFT JOIN mhl_cities AS c ON sp.city_id = c.id
WHERE NOT sp.adres = ''
;