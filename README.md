# CNMH

Notre projet vise à moderniser la gestion des dossiers patients au Centre National Mohammed VI des Handicapés (CNMH). En passant de la documentation papier à la digitalisation.

### Installation de l'application

```bash
  npm install
  composer install
```

#### Utilisation des données initiales

- Creer un fichier env

```bash
cp .env.example .env
```

- Commande pour ajouter des tables dans une base de données

```bash
php artisan migrate
```

- commande pour l'autorisation
```bash
  php artisan db:seed --class=AuthorisationSeeder 
```
- commande pour les paramètres de l'application

```bash
  php artisan db:seed --class=ParamaitresSeeder
```

# Démonstration de l'application 

- Email : admin@gmail.com
  - Password : admin
  
- Email : social@gmail.com
  - Password : social

- Email : medecin@gmail.com
  - Password : medecin
  - 

# Maintenance 

##  Mise à jour des autorisations
