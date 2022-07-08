1.
SELECT
    name
FROM
    countries
;
2.
SELECT
    *
FROM
    countries
WHERE
    continent = 'Europe'
;
3.
SELECT
    *
FROM
    countries
WHERE
    NOT continent = 'Europe'
;
4.
SELECT
    *
FROM
    countries
WHERE
    population >= 100000
;
5.
SELECT
    *
FROM
    countries
WHERE
    life_expectancy BETWEEN 56 AND 76
;
6.
SELECT
    *
FROM
    cities
WHERE
    country_code IN('NLB', 'ALB', 'DZA')
;
7.
SELECT
    *
FROM
    countries
WHERE
    indep_year IS NULL
;
8.
SELECT
    *
FROM
    countries
WHERE
    NOT indep_year IS NULL
;
10.
SELECT
    *
FROM
    countries
WHERE
    name LIKE '%st%'
;
11.
SELECT
    *
FROM
    countries
WHERE
    name LIKE 'an%'
;
12.
SELECT
    *
FROM
    countries
WHERE
    indep_year < 1990
OR  population > 100000
;
13.
SELECT
    *
FROM
    countries
WHERE
    code IN('DZA', 'ALB')
AND indep_year <= 1990
;
14.
SELECT
    region
FROM
    countries
;
15.
SELECT
    CONCAT(name, 'の人口は', population, '人です') AS 'POPULATION'
FROM
    countries
;
16.
SELECT
    name,
    life_expectancy
FROM
    countries
WHERE
    life_expectancy IS NOT NULL
ORDER BY
    life_expectancy ASC
;
17.
SELECT
    name,
    life_expectancy
FROM
    countries
WHERE
    life_expectancy IS NOT NULL
ORDER BY
    life_expectancy DESC
;
18.
SELECT
    name,
    life_expectancy,
    indep_year
FROM
    countries
ORDER BY
    life_expectancy DESC,
    indep_year DESC
;
19.
SELECT
    SUBSTRING(code, 1, 1),
    name
FROM
    countries
;
20.
SELECT
    name,
    CHARACTER_LENGTH(name)
FROM
    countries
ORDER BY
    CHARACTER_LENGTH(name) DESC
;
21.
SELECT
    region,
    AVG(life_expectancy) as 'Average life_expectancy',
    AVG(population) as 'Average population'
FROM
    countries
GROUP BY
    region
;
22.
SELECT
    region,
    MAX(life_expectancy),
    MAX(population)
FROM
    countries
GROUP BY
    region
;
23.
SELECT
    MIN(surface_area)
FROM
    countries
WHERE
    continent = 'Asia'
;
24.
SELECT
    SUM(surface_area)
FROM
    countries
WHERE
    continent = 'Asia'
;
25.
SELECT
    countries.name,
    countrylanguages.language
FROM
    countries
    INNER JOIN
        countrylanguages
    ON  countries.code = countrylanguages.country_code
;
26.
SELECT
    countries.name,
    cities.name,
    countrylanguages.language
FROM
    countries
LEFT OUTER JOIN
    cities
ON  countries.code = cities.country_code
LEFT OUTER JOIN
    countrylanguages
ON  countries.code = countrylanguages.country_code
;
27.
SELECT
    celebrities.name,
    countries.name
FROM
    celebrities
LEFT OUTER JOIN
    countries
ON  celebrities.country_code = countries.code
;
28.
SELECT
    celebrities.name,
    countries.name,
    countrylanguages.language
FROM
    celebrities
LEFT OUTER JOIN
    countries
ON  celebrities.country_code = countries.code
LEFT OUTER JOIN
    countrylanguages
ON  celebrities.country_code = countrylanguages.country_code
WHERE
    countrylanguages.is_official = 'T'
;
29.
SELECT
    celebrities.name,
    countries.name
FROM
    celebrities,
    countries
WHERE
    celebrities.country_code = countries.code
;
30.
SELECT
    country_code,
    MAX(age),
    MIN(age)
FROM
    celebrities
GROUP BY
    country_code
HAVING MAX(age) >= 50
AND MIN(age) <= 30
;
31.
SELECT
    '1980' AS '誕生年',
    COUNT(id)
FROM
    celebrities
WHERE
    birth BETWEEN '1981-1-1' AND '1981-12-31'
UNION
SELECT
    '1991',
    COUNT(id)
FROM
    celebrities
WHERE
    birth BETWEEN '1991-1-1' AND '1991-12-31'
;
32.
SELECT
    countries.name AS '国名',
    AVG(age)
FROM
    countries
LEFT OUTER JOIN
    celebrities
ON  countries.code = celebrities.country_code
GROUP BY
    countries.name,
    celebrities.country_code
ORDER BY
    AVG(age) DESC
;