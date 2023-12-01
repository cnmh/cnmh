<!-- TODO : Changer le nom du projet --> 
# cnmh2 

<!-- TODO : Introduction -->

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
        "maatwebsite/excel": "^3.1",
        "infyomlabs/adminlte-templates": "^6.0",
    },
  -  "autoload": {
        "files": [
            "app/Helpers/Helper.php"
        ]
    }

### Installation de l'application

- Creer un fichier env
  
```bash
  npm install
  composer install
```

<!-- TODO : Ajoutez des instruction d'installation de fichier d'environnement -->

<!-- TODO : migrate:fresh -> This database does not exist -->
```bash
  npm install
  composer install
  php artisan migrate:fresh
  php artisan db:seed
  npm run build
```


