# TrainUp Academy

Application Laravel 10 de gestion bilingue de formations, conforme au sujet:

- authentification complete
- roles et permissions avec Spatie
- CRUD utilisateurs, categories, formations, sessions, inscriptions et blog
- partie publique FR/EN avec slugs SEO
- formulaire de contact AJAX
- API REST publique et protegee avec Sanctum
- emails automatiques
- scheduler Laravel
- seeders et factories

## Stack

- Laravel 10
- Blade + Tailwind + Vite
- Laravel Breeze
- Laravel Sanctum
- Spatie Laravel Permission
- SQLite par defaut pour un demarrage rapide

## Installation

1. Installer les dependances PHP:

```bash
composer install
```

2. Installer les dependances front:

```bash
npm install
```

3. Copier l'environnement si besoin:

```bash
cp .env.example .env
```

4. Generer la cle d'application si necessaire:

```bash
php artisan key:generate
```

5. Executer les migrations et les seeders:

```bash
php artisan migrate:fresh --seed
```

Le fichier SQLite local sera cree automatiquement si besoin.

6. Generer les assets:

```bash
npm run build
```

7. Lier le stockage public:

```bash
php artisan storage:link
```

8. Lancer l'application:

```bash
php artisan serve
```

## Comptes de demo realistes

- Super Admin: `salma.bennani@trainup.ma` / `Salma@TrainUp26!`
- Admin: `karim.elmansouri@trainup.ma` / `Karim#Ops2026!`
- Trainer: `nora.kabbaj@trainup.ma` / `Nora@Trainer26!`
- Trainer: `youssef.idrissi@trainup.ma` / `Youssef#Skill26!`
- Participant: `amal.tazi@atlas-industries.ma` / `Amal@Atlas2026!`
- Participant: `omar.belghiti@novacore.ma` / `Omar#Nova2026!`
- Participant: `sara.lahlou@bluehorizon.ma` / `Sara@Blue2026!`
- Participant: `hamza.chaoui@northwind.ma` / `Hamza#North26!`

## Fonctionnalites principales

### Partie publique

- accueil bilingue FR/EN
- catalogue formations
- detail formation avec sessions et inscription
- blog public
- contact AJAX
- sitemap XML et robots.txt

### Tableau de bord

- gestion des utilisateurs
- gestion des categories
- gestion des formations
- gestion des sessions
- gestion des inscriptions avec changement de statut AJAX
- gestion du blog
- consultation des messages de contact

### Middleware personnalises

- `SetLocale`
- `EnsureUserIsActive`
- `TrackLastActivity`

### Scheduler

- `sessions:send-reminders`
- `trainings:archive-finished`

## API

### Publique

- `GET /api/trainings`
- `GET /api/trainings/{slug}`
- `GET /api/categories`

### Protegee

- `POST /api/login`
- `POST /api/logout`
- `GET /api/profile`
- `GET /api/enrollments`
- `POST /api/enrollments`

## Verification

Tests executes avec succes:

```bash
php artisan test
```
