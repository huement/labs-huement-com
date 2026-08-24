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
            <strong>ALLOW</strong> this cookie write.
        </p>
        <a href="javascript:void(0)" onclick="triggerLegitClick()" class="btn btn-green">Click Legitimate Link</a>
    </div>

    <!-- 05 // Early Timing Test Card -->
    <div class="card">
        <h3>05 // Immediate Page-Load Drop (Early Timing &lt; 500ms)</h3>
        <p>Fires automatically on DOM load without user interaction to verify the Early Timing score penalty.</p>
        <div id="onload-status" style="color: #eab308; font-size: 0.8rem;">Executing on load...</div>
    </div>

    <!-- 06 // Ad-Tech Suppression Test Card -->
    <div class="card">
        <h3>06 // Programmatic Ad-Tech Pixel (Suppression Control)</h3>
        <p>Simulates a display ad exchange cookie sync (e.g. DoubleClick/The Trade Desk). Should <strong>NOT</strong>
            trigger a commission fraud alert.</p>
        <button onclick="triggerAdTechSync()">Fire Ad-Tech Sync</button>
    </div>

    <!-- 07 // LZ Novelty (Cross-Domain) Instructions -->
    <div class="card">
        <h3>07 // LZ Novelty Test (Cross-Domain)</h3>
        <p>Load an external tracking image from a domain not in your navigation history:</p>
        <button onclick="triggerNoveltyPixel()">Inject Third-Party Pixel</button>
    </div>

    <div id="console" class="log">READY // Waiting for test execution...</div>

    <script>
        const logElem = document.getElementById('console');

        function log(msg, details) {
            console.log(msg, details);
            let logMsg = `[${new Date().toLocaleTimeString()}] ${msg}`;
            if (details) {
                logMsg += `\n${JSON.stringify(details, null, 2)}`;
            }
            logElem.innerText = logMsg;
        }

        if (window.location.search.includes('redirect_executed=true')) {
            log(
                "REDIRECT COMPLETE: 'partner_tag=unsolicited_redirect_chain_777' set via 302 response headers. Check AEGIS extension!"
            );
        }

        function triggerJsStuffing() {
            log("Executing Unsolicited JS Cookie Drop via API...");
            fetch('/cookie-test/api/stuff-js')
                .then(res => res.json())
                .then(data => {
                    log(`DROPPED: '${data.cookie}' via JS-initiated Set-Cookie Header.`, data);
                })
                .catch(err => {
                    log("ERROR: Could not execute JS stuffing test.", err);
                });
        }

        function triggerHttpStuffing() {
            log("Executing Background Pixel Request via API...");
            fetch('/cookie-test/api/stuff-http')
                .then(res => res.json())
                .then(data => {
                    log(`DROPPED: '${data.cookie}' via Laravel Set-Cookie Header.`, data);
                })
                .catch(err => {
                    log("ERROR: Could not execute HTTP stuffing test.", err);
                });
        }

        function triggerLegitClick() {
            log("Simulating legitimate click and API call...");
            setTimeout(() => {
                fetch('/cookie-test/api/stuff-legit')
                    .then(res => res.json())
                    .then(data => {
                        log(`DROPPED: '${data.cookie}' AFTER user intent was registered.`, data);
                    })
                    .catch(err => {
                        log("ERROR: Could not execute legit click test.", err);
                    });
            }, 100);
        }

        // 1. AUTOMATED ON-LOAD TRIGGER (Tests Early Timing < 500ms)
        window.addEventListener('DOMContentLoaded', () => {
            fetch('/cookie-test/api/stuff-onload')
                .then(res => res.json())
                .then(data => {
                    document.getElementById('onload-status').innerText = "AUTOMATED DROP FIRED AT < 500ms";
                    log("ON-LOAD DROP EXECUTED: Check extension for 'Early timing' reason code.", data);
                });
        });

        // 2. AD-TECH SUPPRESSION TRIGGER
        function triggerAdTechSync() {
            fetch('/cookie-test/api/adtech-sync')
                .then(res => res.json())
                .then(data => {
                    log("AD-TECH SYNC DROPPED: Should be suppressed from commission fraud alerts.", data);
                });
        }

        // 3. LZ NOVELTY (CROSS-DOMAIN) TRIGGER
        function triggerNoveltyPixel() {
            const img = new Image();
            // Point this to an unvisited local domain (e.g. http://novel-tracker.test) or external URL
            img.src = "https://www.doubleclick.net/favicon.ico?affid=999&t=" + Date.now();
            log("INJECTED NOVEL DOMAIN PIXEL: Domain not in navDict.");
        }
    </script>
</body>

</html>
