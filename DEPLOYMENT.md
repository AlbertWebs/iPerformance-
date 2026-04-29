# Deployment

## Vite / front-end assets

Laravel uses [Vite](https://vitejs.dev/) for CSS and JS. In production the app expects built assets at `public/build/`. If you see:

```text
ViteManifestNotFoundException: Vite manifest not found at: .../public/build/manifest.json
```

you need to **build assets** before or during deployment.

### Option A: Build on the server (recommended)

On the server, from the project root (e.g. `/home/winenotc/ip.livenetsolutions.com`):

```bash
# Install dependencies (use npm ci if you commit package-lock.json)
npm install

# Build for production (creates public/build/manifest.json and assets)
npm run build
```

Run these after every deploy (e.g. after `git pull`). The server must have **Node.js** (v18+) and **npm** installed.

### Option B: Build locally and upload

1. Locally run:
   ```bash
   npm run build
   ```
2. Upload the contents of `public/build/` to the server at `public/build/` (e.g. via rsync or your deploy tool).

### One-time fix on current server

SSH into the server, go to the project directory, then:

```bash
cd /home/winenotc/ip.livenetsolutions.com
npm install
npm run build
```

Ensure the web server can read `public/build/` (same permissions as the rest of `public/`).
