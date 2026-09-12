<?php
// index.php
// Simple router: /api/hello -> JSON; otherwise serve a small HTML page which will
// either redirect to a built frontend (frontend/dist) or fallback to a Vue CDN app.

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// API endpoint
if ($uri === '/api/hello') {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['message' => 'Hello from PHP API']);
    exit;
}

// Try to serve a built frontend if present at /frontend/dist (static files).
// If index.html exists under frontend/dist, redirect the browser there so the
// built assets are used by production deployments that serve static files.
if (file_exists(__DIR__ . '/frontend/dist/index.html')) {
    // Serve the built index.html directly
    readfile(__DIR__ . '/frontend/dist/index.html');
    exit;
}

// Fallback HTML - loads a small Vue app via CDN so the demo works without
// building the frontend.
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Simple PHP + Vue Demo</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body>
  <div id="app">Loading…</div>

  <script type="module">
  // Fallback: render a tiny Vue app from CDN that can call /api/hello
  import { createApp, h } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js';

  createApp({
    data() {
      return { msg: 'Hello World from Vue (CDN)', apiMessage: null };
    },
    methods: {
      async callApi() {
        try {
          const res = await fetch('/api/hello');
          const json = await res.json();
          this.apiMessage = json.message;
        } catch (e) {
          this.apiMessage = 'Error calling API';
        }
      }
    },
    template: `
      <div style="font-family:system-ui,Segoe UI,Roboto,Helvetica,Arial,sans-serif;padding:2rem">
        <h1>{{ msg }}</h1>
        <p><button @click="callApi">Call PHP API</button></p>
        <p v-if="apiMessage"><strong>API:</strong> {{ apiMessage }}</p>
        <p style="color:#666;font-size:0.9rem">Tip: run the frontend (frontend/) with npm run dev for a Vite-powered experience.</p>
      </div>
    `
  }).mount('#app');
  </script>
</body>
</html>
