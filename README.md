<div align="center">

<h1>🔒 .envShare</h1>

<p><strong>Secure, zero-knowledge payload transfer for <code>.env</code> files, SSH configs, and API credentials.</strong><br/>
Encrypted, transient, and automatically destroyed after use.</p>

[![Live](https://img.shields.io/badge/🌐_Live-envshare--vault.onrender.com-brightgreen?style=for-the-badge)](https://envshare-vault.onrender.com)

![Laravel](https://img.shields.io/badge/Laravel_13-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![Vue.js](https://img.shields.io/badge/Vue.js_3-4FC08D?style=flat-square&logo=vue.js&logoColor=white)
![Inertia](https://img.shields.io/badge/Inertia.js-9553E9?style=flat-square&logo=inertia&logoColor=white)
![Tailwind](https://img.shields.io/badge/Tailwind_CSS_v4-38BDF8?style=flat-square&logo=tailwindcss&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-336791?style=flat-square&logo=postgresql&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-blue?style=flat-square)

</div>

---

## 💡 Core Philosophy

> In an era of accidental leaks and insecure communication, EnvShare provides a **"set-and-forget"** environment. Once a payload is generated, it exists only in an encrypted state, adhering to strict TTL and access threshold limits.

---

## ✨ Key Features

| | Feature | Description |
|---|---|---|
| 🕵️ | **Zero-Knowledge Architecture** | Data encrypted locally; server holds no plaintext |
| 🔥 | **Volatile Persistence** | Payloads self-destruct on expiry or max view threshold |
| ⏱️ | **Custom TTL Intervals** | Granular lifespan control from 5 minutes to 24 hours |
| 🔢 | **Access Thresholds** | Limit secret views to 1–5 times |
| 📊 | **Audit Telemetry** | Secure audit tokens track access without exposing secrets |
| 🛡️ | **AES-256-GCM Encryption** | High-security standard for all stored payloads |
| 📧 | **Automated Notifications** | Real-time email alerts via Mailtrap when payload is accessed |

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| **Framework** | Laravel 13 (PHP 8.4) |
| **Frontend** | Vue.js 3 + Inertia.js |
| **Styling** | Tailwind CSS v4 |
| **Database** | PostgreSQL (Supabase) |
| **Security** | AES-256, Bcrypt, Rate Limiting |
| **Mail** | Mailtrap SMTP |
| **Deployment** | Render (Docker) |

---

## ⚙️ Configuration Parameters

```env
# TTL Duration
TTL = 5m | 15m | 30m | 1h | 2h | 5h | 12h | 24h

# Access threshold
MAX_VIEWS = 1 | 2 | 3 | 4 | 5

# Optional cryptographic passphrase
PASSPHRASE = your_secret_passphrase

# Email de-allocation callback
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=587
```

---

## 🚀 Installation

```bash
# 1. Clone the repository
git clone https://github.com/mahmudpial/envshare.git
cd envshare

# 2. Install dependencies
composer install && npm install

# 3. Configure environment
cp .env.example .env

# 4. Generate app key
php artisan key:generate

# 5. Run migrations
php artisan migrate

# 6. Build frontend
npm run build

# 7. Serve the application
php artisan serve
```

---

## 🔐 Security Model

```
User Input ──► AES-256-GCM Encrypt ──► Encrypted Storage
                                              │
Recipient ──► Fetch Payload ──► Local Decrypt ──► Plaintext
                                      │
                          View Count++ ──► Max reached? ──► Auto-delete
                                      │
                          TTL expired? ──────────────────► Auto-delete
```

---

## 📄 License

**MIT License — Copyright © 2026 Pial Mahmud**

Permission is hereby granted, free of charge, to any person obtaining a copy of this software to deal in the Software without restriction, subject to the copyright notice appearing in all copies.

---

<div align="center">

**envShare — Secure · Volatile · Zero-Knowledge Payload Transfer**

Built with privacy by **[Pial Mahmud](https://github.com/mahmudpial)**

</div>
