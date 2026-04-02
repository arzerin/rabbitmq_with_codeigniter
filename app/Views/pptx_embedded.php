<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPTX Embedded</title>
    <style {csp-style-nonce}>
        :root {
            --bg: #17191e;
            --bar: #202228;
            --text: #f3f4f6;
            --muted: #c9ced8;
            --paper: #ffffff;
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
            height: 100%;
            display: grid;
            grid-template-rows: 63px 1fr;
        }

        .toolbar {
            background: linear-gradient(90deg, #1f2126 0%, #23252b 100%);
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            padding: 0 18px;
        }

        .left, .center, .right {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .center { justify-content: center; }
        .right { justify-content: flex-end; }

        .btn,
        .download {
            width: 38px;
            height: 38px;
            border: 0;
            border-radius: 6px;
            background: transparent;
            color: var(--text);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 22px;
        }

        .btn:hover,
        .download:hover { background: rgba(255, 255, 255, 0.09); }

        .label,
        .meta,
        .page-input {
            font-size: 20px;
            color: var(--muted);
        }

        .page-input {
            width: 54px;
            height: 40px;
            border: 1px solid #0f1218;
            border-radius: 8px;
            background: #07090d;
            color: #fff;
            text-align: center;
        }

        .viewport {
            padding: 24px;
            overflow: auto;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .slide {
            width: min(1100px, 100%);
            min-height: 620px;
            background: var(--paper);
            color: #101114;
            border-radius: 4px;
            box-shadow: 0 16px 36px rgba(0, 0, 0, 0.28);
            padding: 42px 52px;
            white-space: pre-wrap;
            line-height: 1.5;
            font-size: 20px;
        }

        .slide-title {
            margin: 0 0 16px;
            font-size: 30px;
            line-height: 1.2;
        }

        .status {
            position: fixed;
            left: 10px;
            bottom: 8px;
            background: rgba(0, 0, 0, 0.7);
            padding: 6px 10px;
            border-radius: 4px;
            font-size: 13px;
        }
    </style>
</head>
<body>
<div class="layout">
    <div class="toolbar">
        <div class="left">
            <button id="prev" class="btn" type="button" aria-label="Previous">&#8249;</button>
            <span class="label">Slide</span>
            <input id="current" class="page-input" type="text" value="1" inputmode="numeric" aria-label="Current slide">
            <span class="meta">of <span id="total">0</span></span>
            <button id="next" class="btn" type="button" aria-label="Next">&#8250;</button>
        </div>

        <div class="center"></div>

        <div class="right">
            <a class="download" href="<?= esc(site_url('pptx-source'), 'attr') ?>" download="1.pptx" aria-label="Download">&#10515;</a>
        </div>
    </div>

    <div class="viewport">
        <article id="slide" class="slide">
            <h1 id="slide-title" class="slide-title">Loading...</h1>
            <div id="slide-content"></div>
        </article>
    </div>
</div>

<div id="status" class="status">Loading PPTX...</div>

<script {csp-script-nonce}>
(function () {
    const statusEl = document.getElementById('status');
    const currentEl = document.getElementById('current');
    const totalEl = document.getElementById('total');
    const titleEl = document.getElementById('slide-title');
    const contentEl = document.getElementById('slide-content');
    const prevBtn = document.getElementById('prev');
    const nextBtn = document.getElementById('next');

    let slides = [];
    let current = 1;

    function setStatus(msg) {
        statusEl.textContent = msg;
    }

    function render() {
        if (!slides.length) {
            titleEl.textContent = 'No slides';
            contentEl.textContent = '';
            totalEl.textContent = '0';
            currentEl.value = '1';
            return;
        }

        current = Math.max(1, Math.min(current, slides.length));
        const slide = slides[current - 1];

        currentEl.value = String(current);
        totalEl.textContent = String(slides.length);
        titleEl.textContent = slide.title || ('Slide ' + current);
        contentEl.textContent = slide.content || '(No textual content found on this slide)';
        setStatus('Slide ' + current + ' / ' + slides.length);
    }

    function goPrev() {
        if (current > 1) {
            current -= 1;
            render();
        }
    }

    function goNext() {
        if (current < slides.length) {
            current += 1;
            render();
        }
    }

    function jump() {
        const v = parseInt(currentEl.value, 10);
        if (Number.isNaN(v)) {
            currentEl.value = String(current);
            return;
        }
        current = v;
        render();
    }

    prevBtn.addEventListener('click', goPrev);
    nextBtn.addEventListener('click', goNext);
    currentEl.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') jump();
    });
    currentEl.addEventListener('blur', jump);

    fetch('<?= esc(site_url('pptx-slides'), 'js') ?>', { headers: { Accept: 'application/json' } })
        .then(function (res) {
            if (!res.ok) {
                throw new Error('HTTP ' + res.status);
            }
            return res.json();
        })
        .then(function (data) {
            slides = Array.isArray(data.slides) ? data.slides : [];
            current = 1;
            render();
        })
        .catch(function (err) {
            setStatus('Failed to load PPTX: ' + err.message);
            titleEl.textContent = 'Error';
            contentEl.textContent = 'Unable to load slides from this PPTX.';
        });
})();
</script>
</body>
</html>
