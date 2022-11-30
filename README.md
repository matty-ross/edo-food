# Edo Food

<img align="left" src="https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white" />
<img align="left" src="https://img.shields.io/badge/css3-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white" />
<img align="left" src="https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E" />
<img align="left" src="https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white" />
<img align="left" src="https://img.shields.io/badge/MariaDB-003545?style=for-the-badge&logo=mariadb&logoColor=white" />
<img src="https://img.shields.io/badge/python-3670A0?style=for-the-badge&logo=python&logoColor=ffdd54" />

Projekt k maturite 2023.

## Inštalácia
Na spustenie budete potrebovať webový server, ktorý podporuje PHP, napríklad Apache. Ďalej budete potrebovať databázový server s podporou MariaDB. Ja na testovanie používam server [XAMPP](https://www.apachefriends.org/), ktorý obsahuje všetko potrebné.

## Testovacie účty
(doména edofood.com neexistuje 😀)
- email: **admin@edofood.com** heslo: **admin**
- email: **tester@edofood.com** heslo: **tester**

## Databáza
Na vytvorenie potrebnej databázy spustite súbor [/db/create.sql](https://github.com/matty-ross/edo-food/blob/main/db/create.sql) ako SQL príkaz a databáza s potrebnými tabuľkami sa vytvorí.
Na vytvorenie testovacích dát spustite súbor [/db/testing_data.sql](https://github.com/matty-ross/edo-food/blob/main/db/testing_data.sql) ako SQL príkaz a dáta sa vložia do príslušných tabuliek.
Pripájanie na databázu prebieha v súbore [/web/functions/db.php](https://github.com/matty-ross/edo-food/blob/main/web/functions/db.php#L12). Tu sa dá zmeniť config, ak máte iné meno alebo heslo.
