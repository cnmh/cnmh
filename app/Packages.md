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


