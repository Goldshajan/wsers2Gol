use Gold;
create view peopleWithCountries as SELECT * FROM ppl
join countries on ppl.Nationality = countries.COUNTRY_ID