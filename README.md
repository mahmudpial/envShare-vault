<div align="center">

<img src="https://img.shields.io/badge/status-live-brightgreen?style=flat-square" />
<img src="https://img.shields.io/badge/encryption-AES--256--GCM-blue?style=flat-square" />
<img src="https://img.shields.io/badge/architecture-zero--knowledge-blue?style=flat-square" />
<img src="https://img.shields.io/badge/persistence-self--destructing-orange?style=flat-square" />
<img src="https://img.shields.io/badge/license-MIT-blue?style=flat-square" />

<br /><br />

# 🔒 .envShare

**Secure, zero-knowledge payload transfer for `.env` files, SSH configs, and API credentials.**  
Encrypted, transient, and automatically destroyed after use.

### 🌐 [envshare-vault.onrender.com](https://envshare-vault.onrender.com)

</div>

---

## 💡 Core Philosophy

In an era of accidental leaks and insecure communication, EnvShare provides a "set-and-forget" environment. Once a payload is generated, it exists only in an encrypted state, adhering to strict TTL (Time-To-Live) and access threshold limits.

---

## ✨ Key Features

| Feature | Description |
|---|---|
| 🕵️ **Zero-Knowledge Architecture** | Data is encrypted locally before storage; the server holds no plaintext |
| 🔥 **Volatile Persistence** | Payloads self-destruct upon expiration or reaching the max view threshold |
| ⏱️ **Custom TTL Intervals** | Granular lifespan control from 5 minutes to 24 hours |
| 🔢 **Access Thresholds** | Strictly limit the number of times a secret can be viewed (1–5) |
| 📊 **Audit Telemetry** | Secure audit tokens track access without exposing the underlying secret |
| 🛡️ **AES-256-GCM Encryption** | High-security standard for all stored payloads |
| 📧 **Automated Notifications** | Real-time email alerts via Mailtrap/SMTP when a payload is accessed |

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| **Framework** | Laravel 13 (PHP) |
| **Frontend** | Vue.js 3 + Inertia.js |
| **Styling** | Tailwind CSS v4 |
| **Database** | PostgreSQL (Supabase) |
| **Security** | AES-256 Encryption, Bcrypt, Rate Limiting |
| **Mail Service** | Mailtrap SMTP |
| **Deployment** | Render (Docker) |

---

## ⚙️ Configuration Parameters

```env
# TTL Duration options
TTL = 5m | 15m | 30m | 1h | 2h | 5h | 12h | 24h

# Access threshold
MAX_VIEWS = 1 | 2 | 3 | 4 | 5

# Optional cryptographic passphrase
PASSPHRASE = your_secret_passphrase

# De-allocation email callback
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

# 4. Set your APP_KEY
php artisan key:generate

# 5. Set Mailtrap credentials in .env
# MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD

# 6. Run migrations
php artisan migrate

# 7. Build frontend assets
npm run build

# 8. Serve the application
php artisan serve
```

---

## 📁 Project Structure

```
envshare/
├── app/
│   ├── Http/Controllers/     # SecretController, AuditController
│   ├── Models/               # Secret, AuditLog
│   └── Services/             # EncryptionService, NotificationService
├── resources/
│   └── js/
│       └── Pages/            # Vue 3 SPA pages (Inertia.js)
├── database/migrations/      # Secret & audit trail migrations
├── routes/web.php            # Application routes
└── Dockerfile                # Docker config for Render
```

---

## 🔐 Security Model

```
User Input → AES-256-GCM Encryption (client-side key) → Encrypted Storage
                                                              ↓
Recipient → Fetch Encrypted Payload → Local Decryption → Plaintext
                                            ↓
                              View Count++ → Max reached? → Auto-delete
                                            ↓
                              TTL expired? → Auto-delete
```

---

## 📄 License

**MIT License — Copyright © 2026 Pial Mahmud**

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.

---

<div align="center">

**envShare — Secure · Volatile · Zero-Knowledge Payload Transfer**

Built with privacy by **[Pial Mahmud](https://github.com/mahmudpial)**

</div>
