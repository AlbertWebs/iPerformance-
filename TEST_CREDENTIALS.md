# Test credentials

Use these to log in and test the system after running `php artisan db:seed`.

## Admin (backend)

- **URL:** `/admin/login`
- **Email:** `admin@iperformanceafrica.com`
- **Password:** `password`

After login you are redirected to the admin dashboard. You can manage workshops, trainings, certifications, reviews, services, users, bookings, contacts, certificates, verification logs, and SEO/page meta.

## User (student portal)

- **URL:** `/login` (or click **Login** in the main nav)
- **Email:** `user@iperformanceafrica.com`
- **Password:** `password`

After login you are redirected to the portal dashboard. You can view upcoming workshops and trainings, book courses with M-Pesa, and see your bookings.

---

**Security:** Change these passwords in production. The seeders use `updateOrCreate`, so re-running `php artisan db:seed` will reset the passwords to `password` if you have not changed them in the database.
