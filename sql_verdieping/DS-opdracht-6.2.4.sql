SELECT
    dagen.jaar AS jaar,
    dagen.maand AS maand,
    COUNT(dagen.maand) AS aantal_aanmeldingen
FROM (SELECT MONTHNAME(joindate) AS maand, YEAR(joindate) AS jaar FROM mhl_suppliers) AS dagen
GROUP BY dagen.jaar, dagen.maand
;