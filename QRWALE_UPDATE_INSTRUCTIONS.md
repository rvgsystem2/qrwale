# QRWale Template Manager Update

## Server commands

Run these after uploading the updated project:

```bash
composer install --no-dev --optimize-autoloader
php artisan storage:link
php artisan migrate --force
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

The production frontend bundle is already built in `public/build`.

## What was added

- Super Admin Template Manager with create, edit, preview, activate, default and delete controls.
- Unlimited database-backed reusable templates.
- Safe layout/color/card-style builder; no executable Blade/PHP is stored in the database.
- Three starter templates are inserted automatically.
- Business create/edit supports template selection and expanded profile details.
- Responsive public profile renders the selected template and hides empty fields.
- QR is SVG-based and embeds the uploaded logo in its centre.
- Business cards provide profile preview and QR download.
- Scan and social action tracking use consistent JSON casts.
- Ownership checks and DELETE requests are enforced.

## Template access

Log in as **Super Admin**, then open **Templates** in the navigation bar.

Default templates cannot be deleted. A template used by a business also cannot be deleted until those businesses are moved to another template.
