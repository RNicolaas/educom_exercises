SELECT
    c.name AS ingevoerde_naam,
    CASE 
        WHEN c.name LIKE '''% %' THEN 
            CONCAT(
                LEFT(c.name, LOCATE(' ', c.name)),
                UCASE(LEFT(SUBSTRING_INDEX(c.name, ' ', -1), 1)),
                SUBSTRING(SUBSTRING_INDEX(c.name, ' ', -1), 2)
            )
        ELSE 
            CONCAT(UCASE(LEFT(c.name, 1)), SUBSTRING(c.name, 2))
    END AS mooie_naam
FROM mhl_cities as c
ORDER BY ingevoerde_naam
;