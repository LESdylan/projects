SELECT
    id,
    category_id,
    qty,
    qty_unit,
    price_per_item,
    price_unit,
    ROUND(CASE 
        WHEN qty_unit = 'gram' AND qty_unit >= 1000 AND price_unit = 'kg' THEN (qty / 1000) * price_per_item
        WHEN qty_unit = 'unit' AND price_unit = 'unit' THEN qty * price_per_item
        WHEN qty_unit = 'gram' AND qty_unit >= 100 AND price_unit = 'kg' THEN qty * price_per_item
        ELSE NULL  -- Option pour gérer les unités sans correspondance
    END,2) AS total_euros
FROM expenses_by_items;


SELECT ABS(-3); -- Retourne 3
SELECT ROUND(3.4), ROUND(3.6); -- Retourne 3 et 4
SELECT FLOOR(3.4), FLOOR(3.6); -- Retourne 3 et 3
SELECT CEIL(3.4), CEIL(3.6); -- Retourne 4 et 4
SELECT SIGN(3.4), SIGN(-3.4), SIGN(0); -- Retourne 1, -1 et 0
SELECT SQRT(4), SQRT(2); -- Retourne 2 et 1.414213562...
SELECT CONCAT('Un texte', 'à concaténer'); -- Retourne "Un texteà concaténer"
SELECT CONCAT_WS(' ', 'Un texte', 'à concaténer'); -- Retourne "Un texte à concaténer"
SELECT LEFT('Un long texte', 5), RIGHT('Un long texte', 5); -- Retourne "Un lo" et "texte"
SELECT MID('Un long texte', 4, 6); -- Retourne "long t"
SELECT SUBSTRING_INDEX('Un long texte', ' ', 1), SUBSTRING_INDEX('Un long texte', ' ', 2); -- Retourne "Un" et "Un long"SELECT LEFT();
SELECT LENGTH('Un long texte'); -- Retourne 13
SELECT LOCATE('texte', 'Un long texte'); -- Retourne 9
SELECT 'Un long texte' LIKE '%texte%'; -- Retourne 1
SELECT UPPER('Du texte en minuscule'); -- Retourne "DU TEXTE EN MINUSCULE"
SELECT LOWER('Du texte en MAJUSCULE'); -- Retourne "du texte en majuscule"
SELECT TRIM('    4 espaces au début et 3 à la fin   '); -- Retourne "4 espaces au début et 3 à la fin"
SELECT REPLACE('ici et mà', 'm', 'l'); -- Retourne "ici et là"
-- CREATE A TRIGRAM 
SELECT(UPPER(CONCAT(LEFT(JOHN,1), LEFT(DOE,1), RIGHT(DOE))));
SELECT NOW(); -- Retourne la date du jour, typée au format date
SELECT MAKEDATE(2030, 45); -- Retourne la date 2030-02-14
SELECT MAKETIME(16, 45, 10); -- Retourne l'heure 16:45:10
SELECT STR_TO_DATE('2030-5-15', '%Y-%m-%d'); -- Retourne la date 2030-05-15, typée au format date
SELECT ADDDATE('2030-05-15', 5); -- Retourne 2030-05-20
SELECT DATE_ADD('2030-05-15', INTERVAL 5 DAY); -- Retourne 2030-05-20
SELECT DATE_ADD('2030-05-15', INTERVAL 5 WEEK); -- Retourne 2030-06-19
SELECT DATEDIFF('2030-05-15', '2030-04-28'); -- Retourne 17
SELECT YEAR('2030-05-15'); -- Retourne 2030
SELECT MONTH('2030-05-15'); -- Retourne 5
SELECT DAY('2030-05-15'); -- Retourne 15
SELECT DAYOFYEAR('2030-05-15'); -- Retourne 135
SELECT WEEKOFYEAR('2030-05-15'); -- Retourne 20

SELECT CAST('2030' AS INT); -- Retourne l'entier 2030
SELECT CONVERT('2030', INT); -- Retourne l'entier 2030

SELECT CAST(2030 AS VARCHAR(10)); -- Retourne la chaîne de caractères '2030'
SELECT CAST(2030 AS VARCHAR(3)); -- Retourne la chaîne de caractères '203', tronquée car la taille maximum est 3

SELECT CAST('2030-05-15' AS DATE); -- Retourne la date 2030-05-15
SELECT CAST('15-05-2030' AS DATE); -- Retourne NULL, le SGBD ne sait pas convertir nativement cette date
SELECT CAST('05-15-2030' AS DATE); -- Retourne NULL, le SGBD ne sait pas convertir nativement cette date

SELECT CAST('2030-05-15' AS INT); -- Retourne 2030, le SGBD essaye de convertir ce qu'il peut en nombre, puis s'arrête au premier caractère non numérique

SELECT FORMAT(123.456, 1); -- Retourne '123.5'
SELECT DATE_FORMAT('2020-05-15', '%d/%m/%Y'); -- Retourne '15/05/2020'

-- PRINT THE CODE PRODUCT WITH THE YEAR REFERENCED
SELECT CONCAT(CAST(YEAR(NOW()) AS VARCHAR(4)), '_', 'ABC123');


SELECT COUNT(Id) FROM Product; -- Retourne le nombre de produits, donc 3
SELECT SUM(Price) FROM Product; -- Retourne la somme de tous les prix, donc 130.20
SELECT AVG(Price) FROM Product; -- Retourne le prix moyen, donc 43.400000
SELECT MAX(Price) FROM Product; -- Retourne le prix maximum, donc 80.00
SELECT MIN(Price) FROM Product; -- Retourne le prix minimum, donc 10.20

-- dont mix up CONCAT WITH GROUP_CONCAT WHICH IS AN AGREGATE FUNCTION
SELECT GROUP_CONCAT(Code) FROM Product; -- Retourne la concaténation de tous les codes produit, donc 'CHAISE,TABLE,BANC'


mysql -u root -pMO3848seven_36 -e "SELECT CONCAT(CAST(YEAR(NOW()) AS VARCHAR(4)), '_', 'ABC123');" -D management

--EXERCICE

CREATE TABLE AnalyseVentes
(
    Id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    NomVendeur varchar(50) NOT NULL,
    PrenomVendeur varchar(50) NOT NULL,
    Exercice int,
    TotalVentes decimal(15,2),
    ObjectifAnnuel decimal(15,2)
)
;
SELECT
CONCAT(PrenomVendeur, ' ', UPPER(NomVendeur)) AS Vendeur,
MAKEDATE(Exercice, 1) AS DateDebutExercice,
DATE_ADD(MAKEDATE(Exercice + 1, 1), INTERVAL -1 DAY) AS DateFinExercice,
TotalVentes,
ObjectifAnnuel,
--Calcul de l'écart avec ABS pour garantir qu'il est toujours positif
ABS(TotalVentes - ObjectifAnnuel) AS EcartPositif,
--Indicateur d'objectif atteint
CASE
WHEN TotalVentes >= ObjectifAnnuel THEN 'Oui'
ELSE 'Non'
END AS ObjectifAtteint
FROM 
AnalyseVentes;