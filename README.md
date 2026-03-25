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

## Comptes de demo

- Super Admin: `admin@trainup.test` / `password`
- Trainer: `trainer@trainup.test` / `password`
- Participant: `participant@trainup.test` / `password`

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
