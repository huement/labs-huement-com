<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LABS // Cookie Stuffing Test Bed</title>
    <style>
        body {
            background-color: #09090b;
            color: #00f0ff;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            padding: 2rem;
            max-width: 720px;
            margin: 0 auto;
        }

        h1 {
            color: #ff007f;
            text-shadow: 0 0 10px #ff007f;
            margin-bottom: 0.2rem;
        }

        .subtitle {
            color: #71717a;
            font-size: 0.85rem;
            margin-bottom: 2rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .card {
            background: #18181b;
            border: 1px solid #27272a;
            padding: 1.25rem;
            margin-bottom: 1rem;
            border-radius: 6px;
        }

        .card h3 {
            margin-top: 0;
            color: #f4f4f5;
            font-size: 1rem;
        }

        .card p {
            color: #a1a1aa;
            font-size: 0.85rem;
            line-height: 1.4;
        }

        button,
        a.btn {
            display: inline-block;
            background: #ff007f;
            color: #fff;
            border: none;
            padding: 0.6rem 1rem;
            font-family: inherit;
            font-size: 0.8rem;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            margin-top: 0.5rem;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(255, 0, 127, 0.3);
        }

        a.btn-green {
            background: #10b981;
            box-shadow: 0 0 10px rgba(16, 185, 129, 0.3);
        }

        .log {
            background: #000;
            color: #00f0ff;
            padding: 1rem;
            font-size: 11px;
            border-left: 3px solid #ff007f;
            margin-top: 1.5rem;
            word-break: break-all;
        }
    </style>
</head>

<body>

    <h1>LABS // HUEMENT</h1>
    <div class="subtitle">AEGIS Cookie Stuffing Threat Simulation Lab</div>

    <div class="card">
        <h3>01 // Unsolicited DOM/JS Cookie Injection</h3>
        <p>Simulates an embedded rogue script writing an affiliate cookie directly into <code>document.cookie</code>
            without user click intent.</p>
        <button onclick="triggerJsStuffing()">Execute JS Cookie Drop</button>
    </div>

    <div class="card">
        <h3>02 // Laravel Set-Cookie Response Header</h3>
        <p>Simulates a background fetch request receiving an unsolicited HTTP <code>Set-Cookie</code> header response
            directly from Laravel.</p>
        <button onclick="triggerHttpStuffing()">Fire Background Pixel Request</button>
    </div>

    <div class="card">
        <h3>03 // HTTP 302 Redirect Hop</h3>
        <p>Simulates bouncing the user through a background Laravel 302 redirect chain that drops an affiliate cookie
            mid-flight.</p>
        <a href="/cookie-test/api/redirect-hop" class="btn">Trigger Redirect Hop</a>
    </div>

    <div class="card">
        <h3>04 // Legitimate User Intent (Control)</h3>
        <p>Clicking an actual link. AEGIS registers <code>pointerdown</code> intent first, so AEGIS will
            <strong>ALLOW</strong> this cookie write.</p>
        <a href="javascript:void(0)" onclick="triggerLegitClick()" class="btn btn-green">Click Legitimate Link</a>
    </div>

    <div id="console" class="log">READY // Waiting for test execution...</div>

    <script>
        const logElem = document.getElementById('console');

        function log(msg) {
            logElem.innerText = `[${new Date().toLocaleTimeString()}] ${msg}`;
        }

        if (window.location.search.includes('redirect_executed=true')) {
            log(
            "REDIRECT COMPLETE: 'partner_tag=unsolicited_redirect_chain_777' set via 302 response headers. Check AEGIS extension!");
        }

        function triggerJsStuffing() {
            document.cookie = "aff_id=unsolicited_js_stuff_123; path=/; max-age=3600";
            log("DROPPED: 'aff_id=unsolicited_js_stuff_123' via JS DOM execution.");
        }

        function triggerHttpStuffing() {
            fetch('/cookie-test/api/stuff-http')
                .then(res => res.json())
                .then(data => {
                    log(`DROPPED: '${data.cookie}' via Laravel Set-Cookie Header.`);
                });
        }

        function triggerLegitClick() {
            setTimeout(() => {
                document.cookie = "aff_id=legitimate_user_click_456; path=/; max-age=3600";
                log("DROPPED: 'aff_id=legitimate_user_click_456' AFTER user intent was registered.");
            }, 100);
        }
    </script>
</body>

</html>
