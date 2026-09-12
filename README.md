# simple-php

Simple PHP + Vue demo app (Hello World)

Backend: PHP (index.php) exposing /api/hello and serving the frontend if built.
Frontend: Vue 3 + Vite in the `frontend/` folder.

Quickstart (backend only)
1. Start PHP built-in server:
   php -S 0.0.0.0:8000
2. Open http://localhost:8000

Frontend dev (requires Node.js + npm)
1. cd frontend
2. npm install
3. npm run dev
4. Open http://localhost:5173 (dev server) — the Vue app will call the backend API at /api/hello if you run both servers on the same host.

Build frontend for production
1. cd frontend
2. npm run build
3. The build artifacts will appear in frontend/dist — index.php will serve the built frontend automatically when present.

Notes
- Composer is scaffolded (composer.json). Run composer install if you add PHP packages.
- This demo intentionally keeps the PHP side minimal so you can extend it with frameworks, routing, or DB as desired.
