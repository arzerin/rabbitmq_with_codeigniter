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
            --ink-soft: #345759;
            --cream: #fff9f1;
            --white: #ffffff;
            --shadow: 0 28px 80px rgba(16, 35, 37, 0.18);
            --radius-xl: 32px;
            --radius-lg: 24px;
            --radius-md: 18px;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--ink);
            font-family: "Instrument Sans", "Segoe UI", sans-serif;
            background:
                radial-gradient(circle at top left, rgba(52, 187, 167, 0.34), transparent 34%),
                radial-gradient(circle at 85% 15%, rgba(33, 157, 126, 0.18), transparent 26%),
                linear-gradient(180deg, #f4fffc 0%, #e7f8f3 52%, #f6fffb 100%);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .page-shell {
            width: min(1200px, calc(100% - 32px));
            margin: 0 auto;
            padding: 24px 0 56px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 10px 0 24px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 14px;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: var(--deep);
        }

        .brand-mark {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            font-size: 20px;
            color: var(--white);
            background: linear-gradient(135deg, var(--mint), var(--deep));
            box-shadow: 0 12px 24px rgba(33, 157, 126, 0.24);
        }

        .topbar-links {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--ink-soft);
            font-size: 0.96rem;
        }

        .topbar-links a,
        .ghost-link {
            padding: 10px 16px;
            border-radius: 999px;
            transition: transform 180ms ease, background 180ms ease;
        }

        .topbar-links a:hover,
        .ghost-link:hover {
            transform: translateY(-1px);
            background: rgba(44, 121, 114, 0.08);
        }

        .hero {
            position: relative;
            overflow: hidden;
            display: grid;
            grid-template-columns: minmax(0, 1.25fr) minmax(300px, 0.75fr);
            gap: 28px;
            padding: 34px;
            background: rgba(255, 255, 255, 0.74);
            border: 1px solid rgba(44, 121, 114, 0.12);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow);
            backdrop-filter: blur(10px);
        }

        .hero::before,
        .hero::after {
            content: "";
            position: absolute;
            border-radius: 999px;
            pointer-events: none;
        }

        .hero::before {
            width: 280px;
            height: 280px;
            right: -120px;
            top: -110px;
            background: radial-gradient(circle, rgba(52, 187, 167, 0.34), transparent 68%);
        }

        .hero::after {
            width: 260px;
            height: 260px;
            left: -120px;
            bottom: -150px;
            background: radial-gradient(circle, rgba(52, 187, 167, 0.24), transparent 70%);
        }

        .hero-copy,
        .hero-card {
            position: relative;
            z-index: 1;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 999px;
            background: rgba(33, 157, 126, 0.10);
            color: var(--teal);
            font-size: 0.88rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .eyebrow::before {
            content: "";
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--mint);
            box-shadow: 0 0 0 5px rgba(52, 187, 167, 0.16);
        }

        h1 {
            margin: 18px 0 16px;
            font-family: "Fraunces", Georgia, serif;
            font-size: clamp(3rem, 5vw, 5.2rem);
            line-height: 0.95;
            letter-spacing: -0.04em;
        }

        .hero-copy p {
            max-width: 62ch;
            margin: 0;
            color: var(--ink-soft);
            font-size: 1.08rem;
            line-height: 1.75;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 14px;
            margin-top: 28px;
        }

        .primary-btn,
        .secondary-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 54px;
            padding: 0 22px;
            border-radius: 18px;
            font-weight: 700;
            transition: transform 180ms ease, box-shadow 180ms ease, background 180ms ease;
        }

        .primary-btn {
            color: var(--white);
            background: linear-gradient(135deg, var(--teal), var(--mint));
            box-shadow: 0 18px 34px rgba(33, 157, 126, 0.28);
        }

        .secondary-btn {
            color: var(--deep);
            background: rgba(44, 121, 114, 0.08);
        }

        .primary-btn:hover,
        .secondary-btn:hover,
        .episode:hover,
        .stat-card:hover {
            transform: translateY(-2px);
        }

        .hero-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 22px;
        }

        .meta-pill {
            padding: 10px 14px;
            border-radius: 999px;
            background: rgba(237, 253, 248, 0.95);
            border: 1px solid rgba(44, 121, 114, 0.12);
            color: var(--ink-soft);
            font-size: 0.92rem;
        }

        .hero-card {
            display: grid;
            gap: 18px;
            align-content: start;
        }

        .cover-card {
            position: relative;
            overflow: hidden;
            min-height: 360px;
            padding: 26px;
            border-radius: 28px;
            color: var(--white);
            background:
                linear-gradient(160deg, rgba(52, 187, 167, 0.98) 0%, rgba(33, 157, 126, 0.98) 55%, rgba(44, 121, 114, 1) 100%);
            box-shadow: 0 24px 44px rgba(44, 121, 114, 0.26);
        }

        .cover-card::before,
        .cover-card::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.12);
        }

        .cover-card::before {
            width: 220px;
            height: 220px;
            top: -70px;
            right: -60px;
        }

        .cover-card::after {
            width: 170px;
            height: 170px;
            bottom: -60px;
            left: -45px;
        }

        .cover-label,
        .cover-title,
        .cover-detail {
            position: relative;
            z-index: 1;
        }

        .cover-label {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            font-size: 0.85rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .cover-title {
            margin: 20px 0 14px;
            font-family: "Fraunces", Georgia, serif;
            font-size: clamp(2.4rem, 4vw, 3.6rem);
            line-height: 0.94;
            letter-spacing: -0.04em;
        }

        .cover-detail {
            max-width: 18ch;
            margin: 0;
            font-size: 1rem;
            line-height: 1.7;
            color: rgba(255, 255, 255, 0.88);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .stat-card {
            padding: 18px;
            border-radius: 20px;
            background: rgba(244, 255, 251, 0.9);
            border: 1px solid rgba(44, 121, 114, 0.12);
            transition: transform 180ms ease, box-shadow 180ms ease;
        }

        .stat-card strong {
            display: block;
            font-size: 1.8rem;
            color: var(--deep);
        }

        .stat-card span {
            display: block;
            margin-top: 6px;
            color: var(--ink-soft);
            font-size: 0.92rem;
        }

        .content-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.1fr) minmax(280px, 0.55fr);
            gap: 24px;
            margin-top: 26px;
        }

        .panel {
            padding: 28px;
            border-radius: var(--radius-lg);
            background: rgba(252, 255, 254, 0.86);
            border: 1px solid rgba(44, 121, 114, 0.10);
            box-shadow: 0 18px 50px rgba(16, 35, 37, 0.08);
        }

        .panel h2 {
            margin: 0 0 8px;
            font-family: "Fraunces", Georgia, serif;
            font-size: 2rem;
            letter-spacing: -0.03em;
        }

        .panel-copy {
            margin: 0 0 22px;
            color: var(--ink-soft);
            line-height: 1.7;
        }

        .episode-list {
            display: grid;
            gap: 14px;
        }

        .episode {
            display: grid;
            grid-template-columns: auto minmax(0, 1fr) auto;
            gap: 18px;
            align-items: center;
            padding: 18px;
            border-radius: 20px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.98), rgba(236, 252, 247, 0.95));
            border: 1px solid rgba(44, 121, 114, 0.10);
            transition: transform 180ms ease, box-shadow 180ms ease, border-color 180ms ease;
        }

        .episode:hover {
            border-color: rgba(33, 157, 126, 0.28);
            box-shadow: 0 18px 28px rgba(33, 157, 126, 0.12);
        }

        .episode-number {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            display: grid;
            place-items: center;
            color: var(--deep);
            font-weight: 800;
            background: linear-gradient(135deg, rgba(52, 187, 167, 0.22), rgba(33, 157, 126, 0.12));
        }

        .episode h3 {
            margin: 0 0 6px;
            font-size: 1.04rem;
        }

        .episode p {
            margin: 0;
            color: var(--ink-soft);
            line-height: 1.6;
            font-size: 0.95rem;
        }

        .episode-time {
            white-space: nowrap;
            padding: 10px 12px;
            border-radius: 999px;
            background: rgba(33, 157, 126, 0.12);
            color: var(--deep);
            font-size: 0.86rem;
            font-weight: 700;
        }

        .sidebar-stack {
            display: grid;
            gap: 24px;
        }

        .feature-list,
        .detail-list {
            display: grid;
            gap: 12px;
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .feature-list li,
        .detail-list li {
            position: relative;
            padding-left: 20px;
            color: var(--ink-soft);
            line-height: 1.65;
        }

        .feature-list li::before,
        .detail-list li::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0.72em;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--mint), var(--apricot));
        }

        .cta-box {
            padding: 22px;
            border-radius: 24px;
            color: var(--white);
            background: linear-gradient(145deg, var(--deep), var(--mint));
        }

        .cta-box h3 {
            margin: 0 0 10px;
            font-size: 1.35rem;
        }

        .cta-box p {
            margin: 0 0 18px;
            color: rgba(255, 255, 255, 0.82);
            line-height: 1.7;
        }

        .cta-box a {
            display: inline-flex;
            min-height: 48px;
            align-items: center;
            padding: 0 18px;
            border-radius: 14px;
            font-weight: 700;
            color: var(--deep);
            background: #e8fff8;
        }

        @media (max-width: 980px) {
            .hero,
            .content-grid {
                grid-template-columns: 1fr;
            }

            .cover-card {
                min-height: 300px;
            }
        }

        @media (max-width: 720px) {
            .page-shell {
                width: min(100% - 20px, 1200px);
                padding-top: 14px;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .topbar-links {
                flex-wrap: wrap;
            }

            .hero,
            .panel {
                padding: 22px;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }

            .episode {
                grid-template-columns: auto 1fr;
            }

            .episode-time {
                grid-column: 2;
                justify-self: start;
            }

            h1 {
                font-size: clamp(2.5rem, 12vw, 4.1rem);
            }
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@500;600;700&family=Instrument+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="page-shell">
        <header class="topbar">
            <a href="#" class="brand" aria-label="Course home">
                <span class="brand-mark">L</span>
                <span>Learning Series</span>
            </a>

            <nav class="topbar-links" aria-label="Primary">
                <a href="#episodes">Episodes</a>
                <a href="#details">Details</a>
                <a href="#start" class="ghost-link">Start Watching</a>
            </nav>
        </header>

        <section class="hero">
            <div class="hero-copy">
                <span class="eyebrow">New Series • Practical Laravel</span>
                <h1>Laravel Cookbook</h1>
                <p>
                    A warm, fast-moving series of polished Laravel recipes for the real work:
                    elegant controllers, cleaner validation, smarter Eloquent queries, sharper
                    UI delivery, and the kind of small decisions that make an app feel premium.
                </p>

                <div class="hero-actions" id="start">
                    <a href="<?= esc(site_url('series/laravel-cookbook/episodes/1'), 'attr') ?>" class="primary-btn">Watch First Episode</a>
                    <a href="#details" class="secondary-btn">Explore the Syllabus</a>
                </div>

                <div class="hero-meta" aria-label="Series metadata">
                    <span class="meta-pill">12 concise episodes</span>
                    <span class="meta-pill">Intermediate friendly</span>
                    <span class="meta-pill">Focus on production patterns</span>
                </div>
            </div>

            <aside class="hero-card" aria-label="Series summary">
                <div class="cover-card">
                    <span class="cover-label">Featured Series</span>
                    <h2 class="cover-title">Cook smarter. Ship cleaner.</h2>
                    <p class="cover-detail">
                        Bite-sized lessons with rich visual hierarchy, curated pacing, and
                        examples you can apply to your next Laravel build immediately.
                    </p>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <strong>4h 20m</strong>
                        <span>Total watch time</span>
                    </div>
                    <div class="stat-card">
                        <strong>12</strong>
                        <span>Focused lessons</span>
                    </div>
                    <div class="stat-card">
                        <strong>8</strong>
                        <span>Production recipes</span>
                    </div>
                    <div class="stat-card">
                        <strong>100%</strong>
                        <span>Hands-on Laravel</span>
                    </div>
                </div>
            </aside>
        </section>

        <section class="content-grid">
            <div class="panel" id="episodes">
                <h2>Episode List</h2>
                <p class="panel-copy">
                    Each lesson is framed like a practical recipe: what problem we are solving,
                    why the technique matters, and the exact Laravel pattern worth keeping.
                </p>

                <div class="episode-list">
                    <article class="episode">
                        <div class="episode-number">01</div>
                        <div>
                            <h3><a href="<?= esc(site_url('series/laravel-cookbook/episodes/1'), 'attr') ?>">Designing a Clean Resource Flow</a></h3>
                            <p>Build a controller-action rhythm that feels minimal, readable, and easy to grow.</p>
                        </div>
                        <span class="episode-time">18 min</span>
                    </article>

                    <article class="episode">
                        <div class="episode-number">02</div>
                        <div>
                            <h3>Validation Recipes You Will Reuse</h3>
                            <p>Turn repetitive request validation into expressive patterns with better messages and structure.</p>
                        </div>
                        <span class="episode-time">21 min</span>
                    </article>

                    <article class="episode">
                        <div class="episode-number">03</div>
                        <div>
                            <h3>Eloquent Queries That Stay Beautiful</h3>
                            <p>Compose eager loading, scopes, and filters without making your query layer hard to trust.</p>
                        </div>
                        <span class="episode-time">24 min</span>
                    </article>

                    <article class="episode">
                        <div class="episode-number">04</div>
                        <div>
                            <h3>Reusable Blade Patterns for Real Teams</h3>
                            <p>Shape components and layouts so your frontend feels intentional instead of accidental.</p>
                        </div>
                        <span class="episode-time">17 min</span>
                    </article>

                    <article class="episode">
                        <div class="episode-number">05</div>
                        <div>
                            <h3>Queues, Mail, and Background Workflows</h3>
                            <p>Choose the right abstractions for tasks that must feel reliable behind the scenes.</p>
                        </div>
                        <span class="episode-time">26 min</span>
                    </article>

                    <article class="episode">
                        <div class="episode-number">06</div>
                        <div>
                            <h3>Polishing the Last 10 Percent</h3>
                            <p>Apply the small UI and DX refinements that make the final product feel expertly finished.</p>
                        </div>
                        <span class="episode-time">19 min</span>
                    </article>
                </div>
            </div>

            <aside class="sidebar-stack" id="details">
                <section class="panel">
                    <h2>Why It Works</h2>
                    <p class="panel-copy">
                        The page borrows the feel of a premium course landing experience, then translates it
                        into a softer editorial style with your chosen palette.
                    </p>
                    <ul class="feature-list">
                        <li>Large serif headline for a confident hero moment</li>
                        <li>Bright course-card gradient built from the Fresh Vibrancy palette</li>
                        <li>Modular lesson rows that can easily expand into a real series page</li>
                        <li>Responsive layout that holds its shape well on mobile screens</li>
                    </ul>
                </section>

                <section class="panel">
                    <h2>Series Details</h2>
                    <ul class="detail-list">
                        <li>Best for developers comfortable with basic routing, models, and Blade</li>
                        <li>Examples focus on maintainability, not just getting code to pass</li>
                        <li>Great fit for SaaS dashboards, internal tools, and productized apps</li>
                    </ul>
                </section>

                <section class="cta-box">
                    <h3>Ready to start?</h3>
                    <p>
                        The layout is now wired to your site root, so this page can act as a polished
                        course homepage or the base for a bigger content hub.
                    </p>
                    <a href="#episodes">Jump into Episode One</a>
                </section>
            </aside>
        </section>
    </div>
</body>
</html>
