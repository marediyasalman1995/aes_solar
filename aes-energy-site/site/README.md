# AES Energy — Website + Customer Dashboard

Multi-file HTML/CSS/JS prototype, split into separate pages/partials as requested.

## ⚠️ Important — how to open it

This site loads header/footer/pages via JavaScript `fetch()`, which browsers
block when you open a file directly by double-clicking it (`file://...`).
You must serve the folder over a local web server — takes 10 seconds:

**Option A — Python (already on most computers)**
```
cd aes-energy-site
python -m http.server 8000
```
Then open **http://localhost:8000/index.html** in your browser.

**Option B — VS Code**
Install the "Live Server" extension, right-click `index.html` → "Open with Live Server".

**Option C — Node**
```
npx serve .
```

Once uploaded to any real web host (Netlify, Vercel, GitHub Pages, cPanel, etc.)
it will work automatically — no server setup needed there.

## 📁 Folder structure

```
index.html                 → Public website shell (loads header/footer/pages)
login.html                 → Standalone customer login page
dashboard.html              → AES One dashboard shell (loads sidebar + sections)

partials/
  header.html               → Top announcement strip + navbar (Home/About/.../Login)
  footer.html                → Site footer

pages/                       → One file per public menu item
  home.html                  → Hero, Solar Plans, About/Solutions/Products/Services/
                                PM Surya Ghar previews, Testimonials, Contact preview
  about.html
  solutions.html
  products.html
  services.html
  suryaghar.html
  contact.html

dashboard-partials/
  sidebar.html                → Dashboard left menu (Dashboard, Wallet, Refer & Earn, etc.)

dashboard-pages/              → One file per dashboard menu item
  home.html                   → Reward balance card + stats + generation chart
  wallet.html                 → AES Reward Wallet + credit history
  refer.html                  → Referral code, share buttons, manual form, status, history
  service.html                → Raise / track service requests
  warranty.html                → Warranty & documents
  plant.html                  → My Solar Plant stats + generation trend
  profile.html                 → Customer profile
  notifications.html           → Notifications feed

css/
  frontend.css                → All shared styles (Poppins font, light-blue theme)

js/
  frontend.js                 → Partial loader, page/dashboard loaders, all interactivity

images/                       → All images used on the site (see below)
```

## 🖼️ About the images

All photos are saved locally in `/images` so the site works fully offline with
zero external dependencies. They're custom-generated, on-brand solar/rooftop
graphics (blue/amber palette matching the site) rather than hot-linked stock
photos — this guarantees they will never break, expire, or fail to load,
which was the recurring issue with external stock-photo links.

If you'd like to swap in your own real product/site photography later, just
replace the matching file in `/images` (same filename) — every page already
points at these local paths, so no HTML edits are needed.

## 🔗 How navigation works

- Public nav links call `loadPage('about')` etc. (defined in `js/frontend.js`),
  which fetches `pages/about.html` and injects it into `index.html`.
- Dashboard sidebar links call `loadDash('dash-wallet', this)`, which fetches
  `dashboard-pages/wallet.html` into `dashboard.html`.
- "Customer Login" links to `login.html`; submitting the login form sends the
  user to `dashboard.html`.
- Dashboard "Logout" sends the user back to `index.html`.

This is a front-end prototype — forms show a confirmation toast but don't hit
a real backend. Wire up `js/frontend.js`'s `submitReferral`, `submitService`,
`submitContact`, and `doLogin` functions to your API when ready.
