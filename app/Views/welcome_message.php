<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Embedded PDF Viewer</title>
    <style {csp-style-nonce}>
        :root {
            --bg: #d8d8db;
            --bar: #202226;
            --bar2: #1e2024;
            --text: #f3f4f6;
            --muted: #d4d7de;
            --chip: #06070a;
            --paper: #ffffff;
            --danger: #ff8a8a;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            height: 100%;
            background: var(--bg);
            color: var(--text);
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .viewer-shell {
            height: 100%;
            display: grid;
            grid-template-rows: 63px 1fr;
        }

        .toolbar {
            background: linear-gradient(90deg, var(--bar) 0%, var(--bar2) 100%);
            padding: 0 26px;
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 12px;
        }

        .toolbar-left,
        .toolbar-center,
        .toolbar-right {
            display: flex;
            align-items: center;
        }

        .toolbar-left {
            justify-content: flex-start;
            gap: 8px;
            min-width: 0;
        }

        .toolbar-center {
            justify-content: center;
            gap: 8px;
        }

        .toolbar-right {
            justify-content: flex-end;
        }

        .tool-btn,
        .download-link {
            width: 42px;
            height: 42px;
            border: 0;
            border-radius: 6px;
            background: transparent;
            color: var(--text);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            text-decoration: none;
        }

        .tool-btn svg,
        .download-link svg {
            width: 20px;
            height: 20px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .tool-btn:hover,
        .download-link:hover {
            background: rgba(255, 255, 255, 0.09);
        }

        .page-label,
        .of-label {
            color: var(--muted);
            font-size: 20px;
            line-height: 1;
            white-space: nowrap;
        }

        .page-input {
            width: 58px;
            height: 48px;
            border: 1px solid #0e1117;
            border-radius: 8px;
            background: var(--chip);
            color: #fff;
            text-align: center;
            font-size: 20px;
            outline: none;
        }

        .canvas-wrap {
            overflow: auto;
            padding: 30px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        #pdf-canvas {
            background: var(--paper);
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.2);
            max-width: 100%;
            height: auto;
        }

        .status {
            position: fixed;
            left: 12px;
            bottom: 10px;
            background: rgba(0, 0, 0, 0.76);
            color: #fff;
            padding: 6px 10px;
            border-radius: 4px;
            font-size: 14px;
        }

        .status.error {
            color: var(--danger);
        }

        @media (max-width: 1100px) {
            .viewer-shell {
                grid-template-rows: 56px 1fr;
            }

            .toolbar {
                padding: 0 10px;
            }

            .tool-btn,
            .download-link {
                width: 32px;
                height: 32px;
            }

            .tool-btn svg,
            .download-link svg {
                width: 18px;
                height: 18px;
            }

            .page-label,
            .of-label {
                font-size: 20px;
            }

            .page-input {
                width: 44px;
                height: 36px;
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
<?php
$downloadUrl = $downloadUrl ?? site_url('pdf-source');
$downloadName = $downloadName ?? '2.pdf';
$appScriptUrl = $appScriptUrl ?? site_url('pdf-app.js');
?>
<div class="viewer-shell">
    <div class="toolbar">
        <div class="toolbar-left">
            <button id="prev" type="button" class="tool-btn" aria-label="Previous page">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <polyline points="15 5 8 12 15 19"></polyline>
                </svg>
            </button>
            <span class="page-label">Page</span>
            <input id="page-current" class="page-input" type="text" value="1" inputmode="numeric" aria-label="Current page">
            <span class="of-label">of <span id="page-total">0</span></span>
            <button id="next" type="button" class="tool-btn" aria-label="Next page">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <polyline points="9 5 16 12 9 19"></polyline>
                </svg>
            </button>
        </div>

        <div class="toolbar-center">
            <button id="zoom-out" type="button" class="tool-btn" aria-label="Zoom out">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <line x1="6" y1="12" x2="18" y2="12"></line>
                </svg>
            </button>
            <button id="zoom-in" type="button" class="tool-btn" aria-label="Zoom in">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <line x1="12" y1="6" x2="12" y2="18"></line>
                    <line x1="6" y1="12" x2="18" y2="12"></line>
                </svg>
            </button>
            <button id="fullscreen" type="button" class="tool-btn" aria-label="Fullscreen">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <polyline points="9 3 3 3 3 9"></polyline>
                    <polyline points="15 3 21 3 21 9"></polyline>
                    <polyline points="3 15 3 21 9 21"></polyline>
                    <polyline points="21 15 21 21 15 21"></polyline>
                </svg>
            </button>
        </div>

        <div class="toolbar-right">
            <a
                class="download-link"
                href="<?= esc($downloadUrl, 'attr') ?>"
                download="<?= esc($downloadName, 'attr') ?>"
                aria-label="Download PDF"
            >
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 4v10"></path>
                    <polyline points="8 10 12 14 16 10"></polyline>
                    <path d="M5 14v5h14v-5"></path>
                </svg>
            </a>
        </div>
    </div>

    <div class="canvas-wrap">
        <canvas id="pdf-canvas"></canvas>
    </div>
</div>

<div id="status" class="status">Loading PDF...</div>
<script src="<?= esc($appScriptUrl, 'attr') ?>"></script>
</body>
</html>
