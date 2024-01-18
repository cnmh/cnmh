```bash
# Ajouter autorisation au service social pour editer patient et consulter patient

php artisan db:seed --class=Database\Seeders\Autorizations\Maintenance_1_1_1

# Ajouter autorisation au root pour initialiser le mot de pass

php artisan db:seed --class=Database\Seeders\Autorizations\Maintenance_1_1_2

# Ajouter autorisation au service social pour editer le rendez vous

php artisan db:seed --class=Database\Seeders\Autorizations\Maintenance_1_1_3 

# Ajouter les prestations qui n'existent pas et modifier le nom des prestations existantes selon ceux utilisés par le medecin générale

php artisan db:seed --class=Database\Seeders\Autorizations\Maintenance_1_1_6

``` 

