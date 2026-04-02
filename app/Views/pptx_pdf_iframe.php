<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPTX As PDF</title>
    <style {csp-style-nonce}>
        :root {
            --bg: #101114;
            --panel: #1b1d21;
            --text: #f3f4f6;
            --sub: #c5c9d3;
            --accent: #b04cc2;
        }

        * { box-sizing: border-box; }

        html, body {
            margin: 0;
            height: 100%;
            background: var(--bg);
            color: var(--text);
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .layout {
            display: grid;
            grid-template-columns: 58px 1fr;
            height: 100%;
        }

        .rail {
            background: #0b0c0f;
            border-right: 1px solid #23262d;
            display: flex;
            justify-content: center;
            padding-top: 18px;
        }

        .close {
            width: 34px;
            height: 34px;
            border-radius: 6px;
            border: 0;
            color: #fff;
            background: linear-gradient(180deg, #cb66df 0%, #9c40b0 100%);
            font-size: 22px;
            line-height: 1;
            cursor: pointer;
        }

        .content {
            display: grid;
            grid-template-rows: auto 1fr;
            min-width: 0;
        }

        .header {
            background: #fff;
            color: #1f2937;
            border-bottom: 1px solid #d8dbe2;
            padding: 20px 26px;
        }

        .header .small {
            font-size: 30px;
            line-height: 1.2;
            color: #4b5563;
            margin-bottom: 8px;
        }

        .header .title {
            font-size: 56px;
            line-height: 1.15;
            margin: 0;
            font-family: Georgia, "Times New Roman", serif;
            font-weight: 500;
        }

        .frame-wrap {
            background: var(--panel);
            padding: 22px;
            min-height: 0;
        }

        .frame {
            width: 100%;
            height: 100%;
            border: 0;
            background: #fff;
            border-radius: 4px;
        }

        @media (max-width: 900px) {
            .header .small { font-size: 16px; }
            .header .title { font-size: 34px; }
            .layout { grid-template-columns: 44px 1fr; }
            .frame-wrap { padding: 10px; }
        }
    </style>
</head>
<body>
<div class="layout">
    <aside class="rail">
        <button class="close" type="button" aria-label="Close">×</button>
    </aside>

    <main class="content">
        <header class="header">
            <div class="small">PowerPoint To PDF</div>
            <h1 class="title">1.pptx (Converted)</h1>
        </header>

        <section class="frame-wrap">
            <iframe
                class="frame"
                src="<?= esc(site_url('pptx-pdf-embedded'), 'attr') ?>"
                title="PPTX PDF Viewer"
            ></iframe>
        </section>
    </main>
</div>
</body>
</html>
