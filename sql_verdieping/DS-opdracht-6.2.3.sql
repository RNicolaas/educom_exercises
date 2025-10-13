SELECT
    dagen.dag AS dag,
    COUNT(dagen.dag) AS aantal_aanmeldingen
FROM (SELECT DAYNAME(joindate) AS dag FROM mhl_suppliers) AS dagen
GROUP BY dagen.dag
;