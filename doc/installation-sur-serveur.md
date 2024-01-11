# Installation de l'application sur le serveur 


1. clone main branch

```bash
git clone https://github.com/cnmh/app.git .
git checkout main
```

2. Installation manuel des packages npm et composer 


3. Création de fichier d'environnement .env

```bash
cp .env.example .env
php artisan key:generate
```

3. Création de la base de données 

```bash
php artisan migrate
```
4. Initialisation de la base de données 

<!-- TODO :  https://github.com/cnmh/app/issues/243 : Déploiement : Les mots de passe doit être privée -->

Modification de fichier UserSeeder.php pour changer les mots de passe

```bash
php artisan db:seed --class=AutorizationsSeeder
php artisan db:seed --class=ConfigSeeder
php artisan db:seed --class=ParametersSeeder
```

## Déterminer le le code de premier dossier 

<!-- TODO : ce code doit être configurable dans la partie root de l'application -->

## Test manul sur le serveur