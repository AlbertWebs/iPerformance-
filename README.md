# iPerformance Africa

Laravel-based CMS for iperformanceafrica.com — HR workshops, training calendar, certifications, reviews, contact, certificate verification, and services. All content is manageable from the admin panel.

## Requirements

- PHP 8.2+
- Composer
- Node.js & npm (for Tailwind/Vite)
- Database (MySQL, PostgreSQL, or SQLite)

## Setup

1. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

2. **Environment**
   - Copy `.env.example` to `.env` if needed.
   - Set `APP_KEY` (run `php artisan key:generate`).
   - Configure `DB_*` for your database.

3. **Database**
   ```bash
   php artisan migrate --force
   php artisan db:seed --force
   ```

4. **Storage link** (for uploads)
   ```bash
   php artisan storage:link
   ```

5. **Build assets**
   ```bash
   npm run build
   ```
   For development: `npm run dev`

6. **Run the app**
   ```bash
   php artisan serve
   ```

## Admin access

- **URL:** `/admin/login`
- **Email:** `admin@iperformanceafrica.com`
- **Password:** `password`  
Change the password after first login.

Only users with `is_admin = true` can access `/admin/*`.

## Features

- **HR Workshops** — Upcoming/past workshops, banner, date, location (Physical/Virtual), registration link.
- **Training Calendar** — Trainings with categories, dates, registration; filter by category.
- **HR Certifications** — Certifications with duration, accreditation, requirements, apply link; featured section.
- **Reviews / Testimonials** — Name, company, image, rating (1–5), content; slider on homepage.
- **Contact Us** — Form submissions stored in DB; read/unread in admin.
- **Verify** — Public certificate verification; search by certificate number; results and logs in admin.
- **Services** — Service pages with short/full description, icon/image; grid and detail pages.

All modules support active/inactive, sort order, and SEO meta (title/description) where applicable. Admin dashboard shows counts for workshops, trainings, certifications, reviews, pending contacts, and verification searches.

## Tech stack

- Laravel 12
- Tailwind CSS 4 (Vite)
- Alpine.js (admin dropdown)
- RESTful routes and form validation
