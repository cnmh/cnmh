<!-- TODO fixed : Changer le nom du projet -->
# cnmh2 

<!-- TODO fixed: Introduction -->
Notre projet vise à moderniser la gestion des dossiers patients au Centre National Mohammed VI des Handicapés (CNMH). En passant de la documentation papier à la digitalisation, nous résolvons les problèmes de collecte et d'analyse des données, permettant ainsi une gestion plus efficace et une analyse statistique améliorée

### Installation de l'application

```bash
  npm install
  composer install
```

<!-- TODO fixed: Ajoutez des instruction d'installation de fichier d'environnement -->

<!-- TODO fixed: migrate:fresh -> This database does not exist -->
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
## Les composants de l'application

<!-- Introduction -->

- app
  - Exports
  - Helpers
  - Http
    - Controllers
    - Middleware
      - ConsultationMidddleware.PHP
    - Request
  - Imports
  - Models
  - Policies
  - Providers
    - AppServiceProvider.php
    - AuthServiceProvider.php
    - RouteServiceProvider.php
  - Repositories
- config
  - app.php
  - excel.php+
- database
  - factories
  - migrations
  - seeders
- lang 
- resources
  - views
    - auth
      - Login.blade.php
    - **tous les vues**
- Routes
  - web.php

<!-- TODO : Vérifiez que maatwebsite/excel est installé dans lab-laraver-starter -->
- composer.json
  -  "require": {
        "maatwebsite/excel": "^3.1"
    },
  -  "autoload": {
        "files": [
            "app/Helpers/Helper.php"
        ]
    }



# Maintenance 

##  Mise à jour des permissions

1. Clean Table permission

```sql
Delete FROM laravel.model_has_permissions;
```

2. Ajouter les persmission par la commande suivant : 
```bash
  php artisan db:seed --class=AuthorisationSeeder 
```