<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Secret Viewed</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #080c14;
            font-family: 'Helvetica Neue', Arial, sans-serif;
            padding: 40px 20px;
        }

        .container {
            max-width: 520px;
            margin: 0 auto;
        }

        .card {
            background: #0f1520;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            overflow: hidden;
        }

        .header {
            background: #111827;
            padding: 28px 32px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            width: 32px;
            height: 32px;
            background: #3b82f6;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-text {
            color: #fff;
            font-size: 16px;
            font-weight: 600;
        }

        .body {
            padding: 32px;
        }

        .alert-icon {
            width: 56px;
            height: 56px;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: 24px;
        }

        h1 {
            color: #f1f5f9;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 28px;
            line-height: 1.6;
        }

        .info-grid {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 24px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.04);
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #475569;
            font-size: 13px;
        }

        .info-value {
            color: #cbd5e1;
            font-size: 13px;
            font-weight: 500;
            font-family: monospace;
        }

        .badge {
            display: inline-block;
            background: rgba(239, 68, 68, 0.1);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-radius: 20px;
            padding: 4px 12px;
            font-size: 12px;
            font-weight: 500;
            margin-bottom: 24px;
        }

        .footer {
            padding: 20px 32px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            text-align: center;
        }

        .footer p {
            color: #1e293b;
            font-size: 12px;
        }

        .footer span {
            color: #3b82f6;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <div class="logo">
                    <div class="logo-icon">🔒</div>
                    <span class="logo-text">.envShare</span>
                </div>
            </div>
            <div class="body">
                <div class="alert-icon">🔥</div>
                <h1>Your secret was viewed</h1>
                <p class="subtitle">
                    Someone opened your one-time secret link. The content has been permanently deleted from our servers.
                </p>

                <div class="info-grid">
                    <div class="info-row">
                        <span class="info-label">🌐 IP Address</span>
                        <span class="info-value">{{ $ip }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">🕐 Viewed At</span>
                        <span class="info-value">{{ $viewedAt }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">🔑 Token</span>
                        <span class="info-value">{{ Str::limit($token, 16) }}...</span>
                    </div>
                </div>

                <span class="badge">🗑️ Secret permanently destroyed</span>

                <p style="color: #475569; font-size: 13px; line-height: 1.7;">
                    If this wasn't expected, your link may have been forwarded. Always share links only with trusted
                    recipients.
                </p>
            </div>
            <div class="footer">
                <p>Sent by <span>.envShare</span> · Secrets die so leaks don't have to.</p>
            </div>
        </div>
    </div>
</body>

</html>