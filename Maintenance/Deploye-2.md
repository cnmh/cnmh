```bash
# Ajouter autorisation au service social pour entretien social

php artisan db:seed --class=Database\Seeders\Autorizations\Maintenance_1_2_0 

# Ajouter autorisation au medecin et dentiste

php artisan db:seed --class=Database\\Seeders\\Autorizations\\Maintenance_1_2_1


``````

## Install composer

- Modification d'installation laravel-debug