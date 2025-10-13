DELIMITER //

CREATE FUNCTION html_decode(str TEXT) 
RETURNS TEXT DETERMINISTIC
BEGIN
    -- Basic entities
    SET str = REPLACE(str, '&amp;', '&');
    SET str = REPLACE(str, '&lt;', '<');
    SET str = REPLACE(str, '&gt;', '>');
    SET str = REPLACE(str, '&quot;', '"');
    SET str = REPLACE(str, '&apos;', "'");

    -- German / Western European letters
    SET str = REPLACE(str, '&Auml;', 'Ä');
    SET str = REPLACE(str, '&Ouml;', 'Ö');
    SET str = REPLACE(str, '&Uuml;', 'Ü');
    SET str = REPLACE(str, '&auml;', 'ä');
    SET str = REPLACE(str, '&ouml;', 'ö');
    SET str = REPLACE(str, '&uuml;', 'ü');
    SET str = REPLACE(str, '&szlig;', 'ß');

    -- Accented vowels
    SET str = REPLACE(str, '&Agrave;', 'À');
    SET str = REPLACE(str, '&Aacute;', 'Á');
    SET str = REPLACE(str, '&Acirc;', 'Â');
    SET str = REPLACE(str, '&Atilde;', 'Ã');
    SET str = REPLACE(str, '&Aring;', 'Å');
    SET str = REPLACE(str, '&agrave;', 'à');
    SET str = REPLACE(str, '&aacute;', 'á');
    SET str = REPLACE(str, '&acirc;', 'â');
    SET str = REPLACE(str, '&atilde;', 'ã');
    SET str = REPLACE(str, '&aring;', 'å');

    SET str = REPLACE(str, '&Egrave;', 'È');
    SET str = REPLACE(str, '&Eacute;', 'É');
    SET str = REPLACE(str, '&Ecirc;', 'Ê');
    SET str = REPLACE(str, '&Euml;', 'Ë');
    SET str = REPLACE(str, '&egrave;', 'è');
    SET str = REPLACE(str, '&eacute;', 'é');
    SET str = REPLACE(str, '&ecirc;', 'ê');
    SET str = REPLACE(str, '&euml;', 'ë');

    SET str = REPLACE(str, '&Igrave;', 'Ì');
    SET str = REPLACE(str, '&Iacute;', 'Í');
    SET str = REPLACE(str, '&Icirc;', 'Î');
    SET str = REPLACE(str, '&Iuml;', 'Ï');
    SET str = REPLACE(str, '&igrave;', 'ì');
    SET str = REPLACE(str, '&iacute;', 'í');
    SET str = REPLACE(str, '&icirc;', 'î');
    SET str = REPLACE(str, '&iuml;', 'ï');

    SET str = REPLACE(str, '&Ograve;', 'Ò');
    SET str = REPLACE(str, '&Oacute;', 'Ó');
    SET str = REPLACE(str, '&Ocirc;', 'Ô');
    SET str = REPLACE(str, '&Otilde;', 'Õ');
    SET str = REPLACE(str, '&oslash;', 'ø');
    SET str = REPLACE(str, '&ograve;', 'ò');
    SET str = REPLACE(str, '&oacute;', 'ó');
    SET str = REPLACE(str, '&ocirc;', 'ô');
    SET str = REPLACE(str, '&otilde;', 'õ');
    SET str = REPLACE(str, '&Oslash;', 'Ø');

    SET str = REPLACE(str, '&Ugrave;', 'Ù');
    SET str = REPLACE(str, '&Uacute;', 'Ú');
    SET str = REPLACE(str, '&Ucirc;', 'Û');
    SET str = REPLACE(str, '&ugrave;', 'ù');
    SET str = REPLACE(str, '&uacute;', 'ú');
    SET str = REPLACE(str, '&ucirc;', 'û');

    -- French / Spanish / Portuguese extras
    SET str = REPLACE(str, '&Ccedil;', 'Ç');
    SET str = REPLACE(str, '&ccedil;', 'ç');
    SET str = REPLACE(str, '&Ntilde;', 'Ñ');
    SET str = REPLACE(str, '&ntilde;', 'ñ');
    SET str = REPLACE(str, '&Yacute;', 'Ý');
    SET str = REPLACE(str, '&yacute;', 'ý');
    SET str = REPLACE(str, '&yuml;', 'ÿ');

    RETURN str;
END //

DELIMITER ;

SELECT 
    html_decode(s.name)
FROM mhl_suppliers AS s
WHERE s.name LIKE '%&%;%'
LIMIT 25
;