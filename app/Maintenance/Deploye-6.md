# Commande pour deploye 6

```bash
php artisan migrate

## Update name de couverture medical ne sais pas to aucune

php artisan db:seed --class=Database\Seeders\Autorizations\Maintenance_1_2_3

## Update type dans le consultation en utilisent sql

UPDATE `consultations` SET type = "Médecin-général" WHERE type = "medecinGeneral"

```
