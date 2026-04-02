<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPTX Viewer</title>
    <style {csp-style-nonce}>
        html,
        body {
            margin: 0;
            height: 100%;
            background: #0f1115;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .wrap {
            height: 100%;
            display: grid;
            grid-template-rows: 56px 1fr;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 16px;
            background: linear-gradient(90deg, #1d1f24 0%, #23252b 100%);
            color: #f3f4f6;
            border-bottom: 1px solid #30323a;
        }

        .title {
            font-size: 16px;
            letter-spacing: 0.2px;
        }

        .download {
            color: #f3f4f6;
            text-decoration: none;
            font-size: 14px;
            padding: 7px 10px;
            border: 1px solid #444854;
            border-radius: 6px;
        }

        .download:hover {
            background: rgba(255, 255, 255, 0.08);
        }

        .frame {
            width: 100%;
            height: 100%;
            border: 0;
            background: #0f1115;
        }
    </style>
</head>
<body>
<div class="wrap">
    <div class="topbar">
        <div class="title">PPTX Viewer</div>
        <a class="download" href="<?= esc(site_url('pptx-source'), 'attr') ?>" download="1.pptx">Download PPTX</a>
    </div>

    <iframe
        class="frame"
        src="<?= esc(site_url('pptx-embedded'), 'attr') ?>"
        title="PPTX Iframe Viewer"
        allowfullscreen
    ></iframe>
</div>
</body>
</html>
