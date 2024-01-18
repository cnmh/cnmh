```bash
# Ajouter autorisation au service social pour entretien social

php artisan db:seed --class=Database\Seeders\Autorizations\Maintenance_1_2_0 

# Ajouter autorisation au medecin et dentiste et orthophoniste

php artisan db:seed --class=Database\Seeders\Autorizations\Maintenance_1_2_1

php artisan db:seed --class=Database\Seeders\Autorizations\Maintenance_1_1_6


``````

## Install composer

- Modification d'installation laravel-debug