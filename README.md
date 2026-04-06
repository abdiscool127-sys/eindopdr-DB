# Royal Food Corner Weert - Klantenbeheer

## Wat is dit?
Dit is een simpele webapp voor Royal Food Corner Weert, gemaakt met PHP + MySQL om klanten te beheren.
Je kan klanten toevoegen, aanpassen, verwijderen en gewoon snel zoeken op naam.

## Wat kan de app?
- Overzicht van klanten met aantal resultaten
- Zoeken op naam
- Nieuwe klant toevoegen
- Klant bewerken
- Klant verwijderen (met bevestiging, dus niet per ongeluk)
- Output wordt ge-escaped met `h()`
- Persoonsgegevens worden deels gemaskeerd met `mask_pii()`

## Gebruikte dingen
- PHP
- MySQL (`mysqli`)
- Bootstrap 5 + Bootstrap Icons
- Eigen CSS in `stylesheets/php.css`

## Mappen / bestanden
```text
klantenbeheer/
|-- pages/
|   |-- index.php         # overzicht + zoeken
|   |-- toevoegen.php     # nieuwe klant
|   |-- bewerken.php      # klant aanpassen
|   |-- verwijderen.php   # klant verwijderen
|   |-- db.php            # database connectie
|   |-- includes.php      # gedeelde includes
|   |-- functions.php     # helpers (h, mask_pii)
|   |-- header.php
|   |-- footer.php
|   |-- README.md
|-- stylesheets/
|   |-- php.css
```

## Installeren met XAMPP
1. Zet de map `klantenbeheer` in `C:\xampp\htdocs\`.
2. Start Apache en MySQL in XAMPP.
3. Maak in phpMyAdmin een database aan met naam `klanten_db`.
4. Run de SQL hieronder.
5. Open: `http://localhost/klantenbeheer/pages/index.php`

## SQL
```sql
CREATE DATABASE IF NOT EXISTS klanten_db;
USE klanten_db;

CREATE TABLE IF NOT EXISTS klanten (
  id INT AUTO_INCREMENT PRIMARY KEY,
  naam VARCHAR(100) NOT NULL,
  adres VARCHAR(255) NOT NULL,
  woonplaats VARCHAR(100) NOT NULL,
  datum_toegevoegd TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## Database instellingen
Als het niet werkt, check `pages/db.php`:
- host: `localhost`
- user: `root`
- password: leeg (standaard XAMPP)
- database: `klanten_db`

## Eerlijk puntje
De app gebruikt nu nog dynamische SQL met `real_escape_string` + `intval`.
Dat werkt, maar beter is om alles later om te zetten naar prepared statements.

## Later nog doen
- Alles naar prepared statements
- Betere validatie op invoer
- Paginering bij veel klanten
- Taal in de hele app gelijk trekken (nu NL + EN door elkaar)
