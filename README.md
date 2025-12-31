
## Directory Structure

- `public/`  
  Entry point (`index.php`), static assets (`style.css`, `products.js`), and uploaded images (`uploads/`).

- `src/`  
  Application source code:
  - `config/` — Configuration files (e.g., `database.php`)
  - `Controller/` — Controllers (e.g., `ProductController.php`)
  - `Database/` — Database connection logic (`Database.php`)
  - `Helpers/` — Utility helpers (`RequestHelper.php`)
  - `Model/` — Data models (`Product.php`)
  - `views/` — Blade templates
    - `layouts/` — Main layout (`main.blade.php`)
    - `products/` — Product-related views

- `composer.json` / `composer.lock`  
  Dependency definitions and lock file.

- `.env.example`  
  Environment variables for configuration.

## Code Organization

- Follows MVC pattern: Controllers handle requests, Models interact with the database, Views render output.
- Uses Blade for templating.
- Configuration and environment separation via `.env` and `src/config/`.
