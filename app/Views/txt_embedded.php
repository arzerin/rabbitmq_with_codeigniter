<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TXT Embedded</title>
    <style {csp-style-nonce}>
        :root {
            --bg: #d8d8db;
            --bar: #202226;
            --bar2: #1e2024;
            --text: #f3f4f6;
            --panel: #ffffff;
        }

        * { box-sizing: border-box; }

        html,
        body {
            margin: 0;
            height: 100%;
            background: var(--bg);
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .layout {
            height: 100%;
            display: grid;
            grid-template-rows: 63px 1fr;
        }

        .toolbar {
            background: linear-gradient(90deg, var(--bar) 0%, var(--bar2) 100%);
            color: var(--text);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 18px;
        }

        .label {
            font-size: 20px;
        }

        .download {
            color: var(--text);
            text-decoration: none;
            border: 1px solid rgba(255, 255, 255, 0.35);
            border-radius: 6px;
            padding: 7px 11px;
            font-size: 14px;
        }

        .download:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .body {
            padding: 22px;
            overflow: auto;
        }

        .text-box {
            background: var(--panel);
            color: #111827;
            border-radius: 4px;
            padding: 18px;
            min-height: 100%;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            white-space: pre-wrap;
            line-height: 1.5;
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.15);
        }

        .status {
            color: #6b7280;
        }
    </style>
</head>
<body>
<div class="layout">
    <div class="toolbar">
        <div class="label">file.txt</div>
        <a class="download" href="<?= esc(site_url('txt-source'), 'attr') ?>" download="file.txt">Download</a>
    </div>

    <div class="body">
        <div id="text" class="text-box status">Loading file.txt...</div>
    </div>
</div>

<script {csp-script-nonce}>
(async function () {
    const el = document.getElementById('text');
    try {
        const res = await fetch('<?= esc(site_url('txt-source'), 'js') ?>');
        if (!res.ok) {
            throw new Error('HTTP ' + res.status);
        }
        const txt = await res.text();
        el.textContent = txt || '(file.txt is empty)';
        el.classList.remove('status');
    } catch (e) {
        el.textContent = 'Failed to load file.txt: ' + (e.message || e);
    }
})();
</script>
</body>
</html>
