# EnvShare-Vault

**EnvShare** is a secure, zero-knowledge payload transfer application designed for the volatile sharing of sensitive information, such as `.env` files, SSH configurations, and API credentials. Built with a focus on privacy, it ensures that your data is encrypted, transient, and automatically destroyed after use.

## Core Philosophy
In an era of accidental leaks and insecure communication, EnvShare provides a "set-and-forget" environment. Once a payload is generated, it exists only in an encrypted state, adhering to strict TTL (Time-To-Live) and access threshold limits.

## Key Features
* **Zero-Knowledge Architecture:** Data is encrypted locally before storage; the server holds no plaintext.
* **Volatile Persistence:** Payloads automatically self-destruct upon expiration or reaching the maximum view threshold.
* **Custom TTL Intervals:** Granular control over the lifespan of your secret (from 5 minutes to 24 hours).
* **Access Thresholds:** Strictly limit the number of times a secret can be viewed.
* **Audit Telemetry:** Secure audit tokens for tracking access without compromising the underlying secret.
* **AES-256-GCM Encryption:** High-security standard for all stored data.
* **Automated Notifications:** Real-time email alerts via Mailtrap/SMTP when a payload is accessed.

## Tech Stack
* **Framework:** Laravel (PHP)
* **Frontend:** Vue.js 3 with Inertia.js
* **Styling:** Tailwind CSS
* **Security:** AES-256 Encryption, Bcrypt, Rate Limiting
* **Mail Service:** Mailtrap (Integration verified and configured)

## Configuration Parameters
EnvShare-Vault allows for precise control over your secure sessions:
* **TTL Duration:** Configurable intervals (5m, 15m, 30m, 1h, 2h, 5h, 12h, 24h).
* **Access Threshold:** Restrict usage to 1–5 views.
* **Cryptographic Passphrase:** Optional secondary layer of protection for every payload.
* **De-allocation Callbacks:** Automated email notifications via Mailtrap when a secure session is accessed.

## Installation
1. Clone the repository: `git clone https://github.com/yourusername/envshare.git`
2. Install dependencies: `composer install && npm install`
3. Configure your environment: `cp .env.example .env`
4. Set Mailtrap credentials in `.env`
5. Run migrations: `php artisan migrate`
6. Serve the application:` php artisan serve`

## MIT License

Copyright (c) 2026 Pial Mahmud

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

### EnvShare — Secure, Volatile, Zero-Knowledge Payload Transfer.
### Built with privacy by *Pial Mahmud*.
