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
php artisan db:seed
php artisan key:generate
```

# Démonstration de l'application 

- Email : admin@gmail.com
  - Password : admin
  
- Email : social@gmail.com
  - Password : social

- Email : medecin@gmail.com
  - Password : medecin


## TO update js and css

```bash
npm run build
```