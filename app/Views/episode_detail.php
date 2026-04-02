<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Cookbook</title>
    <style {csp-style-nonce}>
        :root {
            --mint: #34bba7;
            --teal: #219d7e;
            --deep: #2c7972;
            --apricot: #faa542;
            --sand: #fbc07a;
            --ink: #102325;
            --ink-soft: #4a6c6f;
            --shell: #f4fffc;
            --panel: rgba(255, 255, 255, 0.84);
            --line: rgba(44, 121, 114, 0.12);
            --shadow: 0 24px 70px rgba(16, 35, 37, 0.14);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            color: var(--ink);
            font-family: "Instrument Sans", "Segoe UI", sans-serif;
            background:
                radial-gradient(circle at 10% 0%, rgba(52, 187, 167, 0.28), transparent 28%),
                radial-gradient(circle at 90% 15%, rgba(251, 192, 122, 0.20), transparent 20%),
                linear-gradient(180deg, #f5fffd 0%, #eaf8f4 50%, #f8fffc 100%);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .shell {
            width: min(1240px, calc(100% - 28px));
            margin: 0 auto;
            padding: 22px 0 44px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 20px;
        }

        .brand,
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            color: var(--deep);
            font-weight: 700;
        }

        .brand-mark {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            border-radius: 14px;
            color: #fff;
            background: linear-gradient(135deg, var(--mint), var(--deep));
        }

        .breadcrumbs {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 18px;
            color: var(--ink-soft);
            font-size: 0.94rem;
        }

        .breadcrumbs span {
            opacity: 0.55;
        }

        .layout {
            display: grid;
            grid-template-columns: minmax(0, 1.15fr) minmax(290px, 0.5fr);
            gap: 24px;
        }

        .stack {
            display: grid;
            gap: 24px;
        }

        .card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 28px;
            box-shadow: var(--shadow);
            backdrop-filter: blur(10px);
        }

        .lesson-hero {
            overflow: hidden;
        }

        .player {
            position: relative;
            min-height: 440px;
            padding: 32px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            background:
                linear-gradient(145deg, rgba(16, 35, 37, 0.16), rgba(16, 35, 37, 0.08)),
                linear-gradient(135deg, rgba(52, 187, 167, 0.98) 0%, rgba(33, 157, 126, 0.96) 52%, rgba(44, 121, 114, 1) 100%);
        }

        .player::before,
        .player::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.10);
        }

        .player::before {
            width: 280px;
            height: 280px;
            top: -80px;
            right: -70px;
        }

        .player::after {
            width: 190px;
            height: 190px;
            bottom: -55px;
            left: -30px;
        }

        .play-button,
        .player-copy {
            position: relative;
            z-index: 1;
        }

        .play-button {
            width: 86px;
            height: 86px;
            margin-bottom: auto;
            border: 0;
            border-radius: 50%;
            color: var(--deep);
            background: rgba(255, 255, 255, 0.92);
            box-shadow: 0 22px 45px rgba(16, 35, 37, 0.24);
            cursor: pointer;
        }

        .play-button::before {
            content: "";
            display: inline-block;
            margin-left: 6px;
            border-top: 12px solid transparent;
            border-bottom: 12px solid transparent;
            border-left: 20px solid var(--deep);
        }

        .episode-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 14px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.16);
            color: rgba(255, 255, 255, 0.92);
            font-size: 0.86rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .episode-pill::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--sand);
        }

        h1 {
            margin: 16px 0 12px;
            color: #fff;
            font-family: "Fraunces", Georgia, serif;
            font-size: clamp(2.4rem, 4vw, 4.2rem);
            line-height: 0.98;
            letter-spacing: -0.04em;
        }

        .player-copy p {
            max-width: 58ch;
            margin: 0;
            color: rgba(255, 255, 255, 0.84);
            font-size: 1.02rem;
            line-height: 1.75;
        }

        .lesson-toolbar {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            padding: 18px 22px 22px;
            border-top: 1px solid rgba(255, 255, 255, 0.10);
            background: rgba(255, 255, 255, 0.70);
        }

        .toolbar-pill,
        .toolbar-link {
            display: inline-flex;
            align-items: center;
            min-height: 44px;
            padding: 0 16px;
            border-radius: 999px;
            color: var(--deep);
            background: rgba(33, 157, 126, 0.10);
            font-weight: 700;
        }

        .content-card {
            padding: 28px;
        }

        .content-card h2,
        .side-card h2 {
            margin: 0 0 10px;
            font-family: "Fraunces", Georgia, serif;
            font-size: 1.9rem;
            letter-spacing: -0.03em;
        }

        .content-card p,
        .side-card p {
            margin: 0;
            color: var(--ink-soft);
            line-height: 1.78;
        }

        .transcript {
            display: grid;
            gap: 18px;
            margin-top: 22px;
        }

        .transcript-block {
            padding: 18px 18px 18px 20px;
            border-left: 4px solid rgba(52, 187, 167, 0.5);
            border-radius: 0 18px 18px 0;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.92), rgba(240, 254, 250, 0.96));
        }

        .transcript-block strong {
            display: inline-block;
            margin-bottom: 8px;
            color: var(--deep);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .side-stack {
            display: grid;
            gap: 20px;
            align-content: start;
        }

        .side-card {
            padding: 24px;
        }

        .meta-list,
        .resource-list,
        .up-next {
            display: grid;
            gap: 14px;
            padding: 0;
            margin: 18px 0 0;
            list-style: none;
        }

        .meta-list li,
        .resource-list li,
        .up-next li {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            color: var(--ink-soft);
            padding-bottom: 14px;
            border-bottom: 1px solid rgba(44, 121, 114, 0.10);
        }

        .meta-list li:last-child,
        .resource-list li:last-child,
        .up-next li:last-child {
            padding-bottom: 0;
            border-bottom: 0;
        }

        .meta-list strong,
        .resource-list a,
        .up-next a {
            color: var(--ink);
            font-weight: 700;
        }

        .note {
            margin-top: 18px;
            padding: 16px 18px;
            border-radius: 18px;
            background: rgba(250, 165, 66, 0.12);
            color: #865512;
            line-height: 1.65;
        }

        @media (max-width: 980px) {
            .layout {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .shell {
                width: min(100% - 18px, 1240px);
                padding-top: 14px;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .player {
                min-height: 360px;
                padding: 24px;
            }

            .content-card,
            .side-card {
                padding: 22px;
            }
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@500;600;700&family=Instrument+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
<?php
$episodeNumber = (int) ($episode['number'] ?? 1);
$nextEpisodeUrl = site_url('series/laravel-cookbook/episodes/' . ($episodeNumber + 1));
?>
    <div class="shell">
        <header class="topbar">
            <a href="<?= esc(site_url('/'), 'attr') ?>" class="brand">
                <span class="brand-mark">L</span>
                <span>Laravel Cookbook</span>
            </a>
            <a href="<?= esc(site_url('/'), 'attr') ?>" class="back-link">Back to Series</a>
        </header>

        <nav class="breadcrumbs" aria-label="Breadcrumb">
            <a href="<?= esc(site_url('/'), 'attr') ?>">Series</a>
            <span>/</span>
            <a href="<?= esc(site_url('/'), 'attr') ?>">Laravel Cookbook</a>
            <span>/</span>
            <a href="<?= esc(site_url('series/laravel-cookbook/episodes/' . $episodeNumber), 'attr') ?>">Episode <?= esc((string) $episodeNumber) ?></a>
        </nav>

        <main class="layout">
            <section class="stack">
                <article class="card lesson-hero">
                    <div class="player">
                        <button class="play-button" type="button" aria-label="Play lesson"></button>
                        <div class="player-copy">
                            <span class="episode-pill"><?= esc($episode['category']) ?> • <?= esc($episode['duration']) ?></span>
                            <h1><?= esc($episode['title']) ?></h1>
                            <p><?= esc($episode['summary']) ?></p>
                        </div>
                    </div>
                    <div class="lesson-toolbar">
                        <span class="toolbar-pill">Premium lesson</span>
                        <span class="toolbar-pill">Practical walkthrough</span>
                        <a href="<?= esc($nextEpisodeUrl, 'attr') ?>" class="toolbar-link">Next episode</a>
                    </div>
                </article>

                <article class="card content-card">
                    <h2>Lesson Notes</h2>
                    <p>
                        This episode focuses on the full request lifecycle for a clean Laravel resource.
                        We establish a route shape, narrow the controller surface area, push validation
                        concerns to the edges, and make sure the view or response layer stays intentional.
                    </p>

                    <div class="transcript">
                        <section class="transcript-block">
                            <strong>Opening idea</strong>
                            <p>
                                Good Laravel code often feels simple because each layer has a single job.
                                The route introduces intent, the controller coordinates, and the model or
                                action layer handles the real work.
                            </p>
                        </section>

                        <section class="transcript-block">
                            <strong>Recipe focus</strong>
                            <p>
                                We replace bulky controller methods with smaller flows: index for discovery,
                                store for creation, update for refinement, and a response shape that stays
                                consistent whether the endpoint renders Blade or JSON.
                            </p>
                        </section>

                        <section class="transcript-block">
                            <strong>Takeaway</strong>
                            <p>
                                The goal is not abstraction for its own sake. It is a resource structure
                                that reads clearly six weeks later when the feature changes again.
                            </p>
                        </section>
                    </div>
                </article>
            </section>

            <aside class="side-stack">
                <section class="card side-card">
                    <h2>Episode Info</h2>
                    <ul class="meta-list">
                        <li><span>Duration</span><strong><?= esc($episode['duration']) ?></strong></li>
                        <li><span>Level</span><strong>Intermediate</strong></li>
                        <li><span>Category</span><strong>Architecture</strong></li>
                        <li><span>Series</span><strong>Laravel Cookbook</strong></li>
                    </ul>
                </section>

                <section class="card side-card">
                    <h2>Resources</h2>
                    <p>Useful companions for the lesson and the next steps in the series.</p>
                    <ul class="resource-list">
                        <li><a href="#">Controller checklist</a><span>PDF</span></li>
                        <li><a href="#">Sample route map</a><span>Blade</span></li>
                        <li><a href="#">Validation starter kit</a><span>Code</span></li>
                    </ul>
                    <div class="note">
                        Keep the orange accent as a signal color for important notes and supporting resources.
                    </div>
                </section>

                <section class="card side-card">
                    <h2>Up Next</h2>
                    <ul class="up-next">
                        <li><a href="<?= esc(site_url('series/laravel-cookbook/episodes/2'), 'attr') ?>">Validation Recipes You Will Reuse</a><span>21 min</span></li>
                        <li><a href="<?= esc(site_url('series/laravel-cookbook/episodes/3'), 'attr') ?>">Eloquent Queries That Stay Beautiful</a><span>24 min</span></li>
                        <li><a href="<?= esc(site_url('series/laravel-cookbook/episodes/4'), 'attr') ?>">Reusable Blade Patterns for Real Teams</a><span>17 min</span></li>
                    </ul>
                </section>
            </aside>
        </main>
    </div>
</body>
</html>
