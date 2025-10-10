CREATE VIEW [IF NOT EXISTS] DIRECTIE
AS
SELECT c.supplier_id, c.name AS contact, c.contacttype AS functie, d.name AS department
FROM mhl_contacts c
INNER JOIN mhl_departments d ON c.department = d.id
WHERE c.department = 'Directie' OR c.contacttype LIKE '%directeur%'
;