<!DOCTYPE html>
@php($page = $page ?? 'home')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#090c12">
    <meta name="description" content="Portfolio Yogi: pengembangan web, eksplorasi desain antarmuka, proyek digital, teknologi, dan proses belajar yang berkelanjutan.">
    <title>{{ $pageTitle ?? 'Home' }} — Yogi Portfolio</title>
    <script>
        document.documentElement.classList.add('has-js');
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            color-scheme: dark;
            --bg: #090c12;
            --surface: #0e131d;
            --surface-raised: #121925;
            --line: rgba(179, 197, 226, .12);
            --text: #f3f6fc;
            --muted: #8d98aa;
            --blue: #5794ff;
            --cyan: #66e4ed;
            --font: "Manrope", sans-serif;
            --mono: "DM Mono", monospace;
        }

        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-behavior: smooth; scroll-padding-top: 100px; }
        body {
            min-width: 320px;
            margin: 0;
            background:
                radial-gradient(ellipse at 78% 6%, rgba(35, 83, 164, .12), transparent 32rem),
                var(--bg);
            color: var(--text);
            font-family: var(--font);
            -webkit-font-smoothing: antialiased;
        }
        a { color: inherit; text-decoration: none; }
        button, a { -webkit-tap-highlight-color: transparent; }
        button { font: inherit; }
        ::selection { color: #fff; background: #3478ed; }

        .shell { width: min(1120px, calc(100% - 48px)); margin-inline: auto; }
        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #aab8ce;
            font: 11px var(--mono);
            letter-spacing: .12em;
            text-transform: uppercase;
        }
        .eyebrow::before { width: 18px; height: 1px; background: var(--blue); content: ""; }
        .section { padding-block: 112px; }
        .section-heading {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 38px;
        }
        .section-heading h2 {
            margin: 15px 0 0;
            font-size: clamp(32px, 5vw, 48px);
            line-height: 1.1;
            letter-spacing: -.055em;
        }
        .section-heading > p { max-width: 330px; margin: 0; color: var(--muted); font-size: 14px; line-height: 1.8; }

        .site-header {
            position: sticky;
            z-index: 20;
            top: 14px;
            width: min(1120px, calc(100% - 32px));
            margin: 14px auto 0;
            border: 1px solid var(--line);
            border-radius: 17px;
            background: rgba(14, 19, 29, .84);
            backdrop-filter: blur(18px);
        }
        .nav-wrap { display: flex; min-height: 64px; align-items: center; justify-content: space-between; padding: 0 19px; }
        .brand { display: inline-flex; align-items: center; gap: 10px; font-size: 14px; font-weight: 800; letter-spacing: -.04em; }
        .brand-mark {
            display: grid;
            width: 31px;
            height: 31px;
            place-items: center;
            border: 1px solid rgba(87, 148, 255, .5);
            border-radius: 10px;
            background: rgba(87, 148, 255, .12);
            color: #8eb6ff;
            font: 13px var(--mono);
        }
        .nav-links { display: flex; align-items: center; gap: 31px; color: #a4afbf; font-size: 12px; }
        .nav-links a { transition: color .2s ease; }
        .nav-links a:hover, .nav-links a:focus-visible { color: #fff; }
        .nav-cta, .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: 1px solid rgba(87, 148, 255, .4);
            border-radius: 10px;
            background: rgba(87, 148, 255, .12);
            color: #c9dcff;
            font-size: 12px;
            font-weight: 700;
            transition: border-color .2s ease, background .2s ease, transform .2s ease;
        }
        .nav-cta { min-height: 38px; padding: 0 14px; }
        .button { min-height: 48px; padding: 0 19px; }
        .button-primary { border-color: #5794ff; background: #5794ff; color: #07101f; }
        .nav-cta:hover, .button:hover { transform: translateY(-2px); border-color: #8cb8ff; background-color: rgba(87, 148, 255, .2); }
        .button-primary:hover { background: #80aeff; }
        .arrow { font-size: 16px; line-height: 1; }

        .hero {
            display: grid;
            min-height: 650px;
            grid-template-columns: 1.1fr .9fr;
            align-items: center;
            gap: 70px;
            padding-block: 76px 86px;
        }
        .availability {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 8px 12px;
            border: 1px solid var(--line);
            border-radius: 999px;
            color: #bac6d8;
            font: 10px var(--mono);
            letter-spacing: .05em;
        }
        .availability span { width: 7px; height: 7px; border-radius: 50%; background: #61dfad; box-shadow: 0 0 12px #61dfad; }
        .hero h1 {
            max-width: 700px;
            margin: 24px 0 19px;
            font-size: clamp(48px, 7vw, 82px);
            font-weight: 700;
            line-height: 1.02;
            letter-spacing: -.075em;
        }
        .hero h1 em { color: #78a9ff; font-style: normal; }
        .hero-copy { max-width: 490px; margin: 0; color: var(--muted); font-size: 15px; line-height: 1.9; }
        .hero-actions { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 31px; }
        .button-quiet { border-color: var(--line); background: transparent; color: #d3dbea; }
        .hero-meta { display: flex; align-items: center; gap: 14px; margin-top: 43px; color: #8793a7; font: 10px var(--mono); letter-spacing: .06em; text-transform: uppercase; }
        .hero-meta::before { width: 31px; height: 1px; background: var(--line); content: ""; }

        .visual-wrap { position: relative; display: grid; min-height: 430px; place-items: center; }
        .visual-glow {
            position: absolute;
            width: min(100%, 400px);
            aspect-ratio: 1;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(53, 119, 239, .2), rgba(30, 70, 139, .08) 43%, transparent 70%);
            filter: blur(5px);
        }
        .lanyard {
            position: relative;
            z-index: 1;
            width: min(100%, 285px);
            height: 390px;
            transform-origin: 50% 12px;
            animation: lanyard-swing 3.8s ease-in-out infinite;
        }
        .lanyard-cord {
            position: absolute;
            top: -34px;
            left: calc(50% - 1px);
            width: 2px;
            height: 99px;
            background: linear-gradient(90deg, #25364e, #a2b8d7 45%, #32445e);
            transform-origin: top center;
        }
        .lanyard-cord::before {
            position: absolute;
            top: 76px;
            left: -7px;
            width: 14px;
            height: 14px;
            border: 2px solid #9db5d7;
            border-radius: 50%;
            content: "";
        }
        .id-card {
            position: absolute;
            top: 60px;
            left: 50%;
            width: 222px;
            height: 306px;
            padding: 0;
            border: 0;
            border-radius: 12px;
            background: transparent;
            color: inherit;
            cursor: pointer;
            perspective: 900px;
            transform: translateX(-50%);
            -webkit-tap-highlight-color: transparent;
        }
        .id-card:focus-visible { outline: 2px solid #8cb6ff; outline-offset: 6px; }
        .id-card-face {
            position: absolute;
            inset: 0;
            display: flex;
            overflow: hidden;
            flex-direction: column;
            border: 1px solid rgba(203, 222, 251, .58);
            border-radius: inherit;
            background: #111a28;
            box-shadow: 0 28px 65px rgba(0, 0, 0, .5), 0 0 35px rgba(68, 128, 226, .18);
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
        }
        .id-card.is-running .id-card-face { animation: id-card-run 1s cubic-bezier(.36,.07,.19,.97); }
        .id-card-face::before {
            position: absolute;
            z-index: 1;
            top: 0;
            right: 0;
            left: 0;
            height: 5px;
            background: linear-gradient(90deg, #5794ff, #66e4ed);
            content: "";
        }
        .portrait-image {
            width: 100%;
            height: 246px;
            flex: 1 1 auto;
            object-fit: cover;
            object-position: center 14%;
            transition: filter .55s ease, transform .7s cubic-bezier(.2,.7,.2,1), object-position .7s ease;
        }
        .id-card.view-1 .portrait-image { filter: saturate(.72) contrast(1.08); object-position: center 25%; transform: scale(1.13); }
        .id-card.view-2 .portrait-image { filter: sepia(.18) hue-rotate(166deg) saturate(1.25); object-position: 54% 17%; transform: scale(1.06); }
        .id-card-info {
            display: flex;
            min-height: 58px;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            padding: 8px 11px;
            border-top: 1px solid rgba(179, 197, 226, .18);
            background: linear-gradient(120deg, #111b2b, #0b111a);
        }
        .id-card-info strong {
            display: block;
            color: #f0f5ff;
            font-size: 13px;
            letter-spacing: .03em;
        }
        .id-card-info small {
            display: block;
            margin-top: 3px;
            color: #9cacc4;
            font: 8px var(--mono);
            letter-spacing: .05em;
            text-transform: uppercase;
        }
        .id-card-mark {
            display: grid;
            width: 30px;
            height: 30px;
            flex: 0 0 auto;
            place-items: center;
            border: 1px solid rgba(87, 148, 255, .35);
            border-radius: 8px;
            background: rgba(87, 148, 255, .11);
            color: #8cb6ff;
            font: 12px var(--mono);
        }
        .orbit {
            position: absolute;
            z-index: 2;
            top: 76px;
            right: -24px;
            display: grid;
            width: 74px;
            height: 74px;
            place-items: center;
            border: 1px solid rgba(116, 164, 242, .38);
            border-radius: 50%;
            background: rgba(16, 29, 49, .85);
            color: #83b1ff;
            font: 11px var(--mono);
            box-shadow: 0 10px 40px rgba(0, 0, 0, .35);
        }
        .visual-caption {
            position: absolute;
            right: 0;
            bottom: 34px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            border: 1px solid var(--line);
            border-radius: 12px;
            background: rgba(14, 19, 29, .92);
            color: #dce5f3;
            font-size: 11px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .25);
        }
        .visual-caption small { display: block; margin-top: 3px; color: var(--muted); font: 9px var(--mono); }
        .caption-icon { display: grid; width: 33px; height: 33px; place-items: center; border-radius: 10px; background: rgba(87, 148, 255, .13); color: #8cb6ff; }

        .about-grid { display: grid; grid-template-columns: .9fr 1.1fr; gap: 55px; }
        .about-copy { color: var(--muted); font-size: 14px; line-height: 1.95; }
        .about-copy p { margin: 0 0 17px; }
        .about-copy strong { color: #e8eef9; font-weight: 600; }
        .stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-top: 29px; }
        .stat { padding: 19px 15px; border: 1px solid var(--line); border-radius: 14px; background: rgba(15, 21, 31, .75); }
        .stat strong { display: block; color: #eaf1ff; font-size: 25px; letter-spacing: -.06em; }
        .stat span { display: block; margin-top: 6px; color: var(--muted); font: 9px var(--mono); line-height: 1.5; text-transform: uppercase; }
        .about-aside { display: flex; min-height: 100%; flex-direction: column; justify-content: space-between; padding: 27px; border: 1px solid var(--line); border-radius: 18px; background: linear-gradient(145deg, rgba(26, 40, 62, .8), rgba(14, 19, 29, .72)); }
        .aside-index { color: #718198; font: 10px var(--mono); }
        .aside-quote { max-width: 460px; margin: 30px 0; color: #e9f0fd; font-size: clamp(22px, 3vw, 33px); font-weight: 600; line-height: 1.42; letter-spacing: -.04em; }
        .aside-bottom { display: flex; align-items: center; justify-content: space-between; gap: 20px; color: #9daac0; font: 10px var(--mono); }
        .aside-bottom span:last-child { color: #79a8fb; }

        .projects { display: grid; grid-template-columns: repeat(3, 1fr); gap: 17px; }
        .project-card { overflow: hidden; border: 1px solid var(--line); border-radius: 17px; background: #0e131c; transition: transform .25s ease, border-color .25s ease; }
        .project-card:hover { transform: translateY(-5px); border-color: rgba(109, 161, 255, .42); }
        .project-art { position: relative; display: grid; height: 205px; overflow: hidden; place-items: center; border-bottom: 1px solid var(--line); background: #111b29; }
        .project-art::before { position: absolute; inset: 0; background: radial-gradient(ellipse at 55% 40%, rgba(65, 130, 229, .2), transparent 65%); content: ""; }
        .project-art-commerce { background: #1a1718; }
        .project-art-commerce::before { background: radial-gradient(ellipse at 55% 40%, rgba(212, 129, 83, .21), transparent 65%); }
        .project-art-brand { background: #141622; }
        .project-art-brand::before { background: radial-gradient(ellipse at 55% 40%, rgba(137, 111, 226, .23), transparent 65%); }
        .mock-window { position: relative; width: 78%; height: 72%; padding: 12px; border: 1px solid rgba(194, 214, 248, .2); border-radius: 10px; background: rgba(9, 14, 22, .83); box-shadow: 0 18px 36px rgba(0, 0, 0, .3); transform: rotate(-3deg); }
        .project-card:nth-child(2) .mock-window { transform: rotate(2deg); }
        .project-card:nth-child(3) .mock-window { transform: rotate(-1deg); }
        .mock-top { display: flex; gap: 4px; padding-bottom: 9px; border-bottom: 1px solid rgba(194, 214, 248, .12); }
        .mock-top i { width: 5px; height: 5px; border-radius: 50%; background: #71839c; }
        .mock-body { display: grid; height: calc(100% - 15px); grid-template-columns: 1fr 1.5fr; gap: 8px; padding-top: 10px; }
        .mock-sidebar { border-radius: 4px; background: linear-gradient(180deg, rgba(83, 139, 234, .5) 0 18%, rgba(141, 160, 190, .12) 18% 25%, transparent 25% 35%, rgba(141, 160, 190, .12) 35% 42%, transparent 42% 52%, rgba(141, 160, 190, .12) 52% 59%, transparent 59%); }
        .mock-content { display: grid; grid-template-rows: 1fr 1.3fr; gap: 7px; }
        .mock-chart { border-radius: 5px; background: linear-gradient(155deg, rgba(69, 125, 222, .27), rgba(69, 125, 222, .02)); }
        .mock-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 5px; }
        .mock-stats i { border-radius: 4px; background: rgba(149, 173, 211, .13); }
        .mock-product { position: relative; width: 120px; height: 145px; border-radius: 60px 60px 12px 12px; background: linear-gradient(145deg, #c9a487, #805d4f); box-shadow: 0 20px 45px rgba(0, 0, 0, .32); }
        .mock-product::before { position: absolute; top: 15px; left: 39px; width: 42px; height: 55px; border: 1px solid rgba(255,255,255,.2); border-radius: 50%; background: rgba(255,255,255,.14); content: ""; }
        .mock-poster { display: grid; width: 140px; height: 150px; place-items: center; border: 1px solid rgba(206, 194, 255, .25); background: linear-gradient(145deg, #26243d, #171827); color: #d8d0ff; font-size: 45px; font-weight: 800; letter-spacing: -.12em; transform: rotate(6deg); }
        .project-info { padding: 19px; }
        .project-topline { display: flex; align-items: center; justify-content: space-between; gap: 12px; color: #8290a5; font: 9px var(--mono); text-transform: uppercase; }
        .project-label { color: #84adf4; }
        .project-info h3 { margin: 14px 0 8px; font-size: 17px; letter-spacing: -.04em; }
        .project-info p { min-height: 43px; margin: 0; color: var(--muted); font-size: 11px; line-height: 1.8; }
        .tags { display: flex; flex-wrap: wrap; gap: 7px; margin-top: 16px; }
        .tags span { padding: 6px 8px; border: 1px solid var(--line); border-radius: 6px; color: #a7b3c5; font: 9px var(--mono); }

        .stack-panel { display: grid; grid-template-columns: .8fr 1.2fr; gap: 40px; padding: 31px; border: 1px solid var(--line); border-radius: 18px; background: linear-gradient(120deg, rgba(22, 32, 49, .8), rgba(13, 18, 27, .7)); }
        .stack-panel h3 { margin: 12px 0 0; font-size: 23px; letter-spacing: -.05em; }
        .stack-panel p { margin: 10px 0 0; color: var(--muted); font-size: 12px; line-height: 1.8; }
        .stack-list { display: flex; flex-wrap: wrap; align-content: center; gap: 10px; }
        .stack-chip { display: inline-flex; align-items: center; gap: 9px; padding: 11px 13px; border: 1px solid var(--line); border-radius: 10px; background: rgba(7, 11, 17, .45); color: #d0daea; font-size: 11px; }
        .stack-chip i { width: 7px; height: 7px; border-radius: 50%; background: var(--blue); box-shadow: 0 0 10px rgba(87, 148, 255, .7); }

        .contact-card { position: relative; overflow: hidden; padding: clamp(30px, 6vw, 66px); border: 1px solid rgba(110, 161, 255, .22); border-radius: 22px; background: radial-gradient(ellipse at 90% 15%, rgba(60, 113, 207, .2), transparent 38%), linear-gradient(135deg, #111b2b, #0d121b 70%); }
        .contact-card::after { position: absolute; top: -100px; right: 5%; width: 290px; height: 290px; border: 1px solid rgba(128, 170, 239, .1); border-radius: 50%; box-shadow: 0 0 0 35px rgba(128, 170, 239, .025), 0 0 0 70px rgba(128, 170, 239, .02); content: ""; pointer-events: none; }
        .contact-card h2 { position: relative; z-index: 1; max-width: 650px; margin: 16px 0; font-size: clamp(36px, 6vw, 62px); line-height: 1.08; letter-spacing: -.065em; }
        .contact-card > p { position: relative; z-index: 1; max-width: 500px; margin: 0; color: var(--muted); font-size: 13px; line-height: 1.8; }
        .contact-actions { position: relative; z-index: 1; display: flex; flex-wrap: wrap; align-items: center; gap: 15px; margin-top: 27px; }
        .email-link { color: #b6c8e5; font-size: 12px; }
        .email-link:hover { color: #fff; }
        .hero-socials { display: flex; gap: 9px; margin-top: 20px; }
        .social-chip { display: inline-flex; min-width: 34px; min-height: 34px; align-items: center; justify-content: center; padding: 0 10px; border: 1px solid var(--line); border-radius: 9px; color: #9cacc4; font: 10px var(--mono); transition: color .2s ease, border-color .2s ease, background .2s ease; }
        .social-chip:hover { border-color: rgba(87, 148, 255, .45); background: rgba(87, 148, 255, .1); color: #dce9ff; }

        .journey-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 28px; }
        .journey-column h3 { margin: 0 0 16px; font-size: 18px; letter-spacing: -.04em; }
        .journey-list { display: grid; gap: 10px; }
        .journey-item { display: flex; align-items: flex-start; gap: 13px; padding: 15px; border: 1px solid var(--line); border-radius: 13px; background: rgba(15, 21, 31, .75); }
        .journey-icon { display: grid; width: 35px; height: 35px; flex: 0 0 auto; place-items: center; border: 1px solid rgba(87, 148, 255, .22); border-radius: 10px; background: rgba(87, 148, 255, .1); color: #91b9ff; }
        .journey-item strong { display: block; color: #e6edf9; font-size: 12px; }
        .journey-item small { display: block; margin-top: 5px; color: var(--muted); font-size: 10px; line-height: 1.6; }
        .example-note { margin: 12px 0 0; color: #718198; font: 9px var(--mono); }

        .music-card { display: grid; grid-template-columns: .8fr 1.2fr; gap: 28px; align-items: center; padding: clamp(22px, 4vw, 36px); border: 1px solid var(--line); border-radius: 20px; background: linear-gradient(120deg, rgba(22, 32, 49, .85), rgba(13, 18, 27, .88)); }
        .music-copy h3 { max-width: 320px; margin: 13px 0 10px; font-size: clamp(27px, 4vw, 39px); line-height: 1.14; letter-spacing: -.06em; }
        .music-copy h3 em { color: #5794ff; font-style: normal; }
        .music-copy p { max-width: 330px; margin: 0; color: var(--muted); font-size: 12px; line-height: 1.8; }
        .music-link { display: inline-flex; align-items: center; gap: 9px; margin-top: 18px; color: #a9c7ff; font-size: 11px; }
        .music-link:hover { color: #fff; }
        .player { overflow: hidden; border: 1px solid rgba(179, 197, 226, .12); border-radius: 13px; background: #101114; box-shadow: 0 18px 45px rgba(0, 0, 0, .28); }
        .player-main { display: grid; grid-template-columns: 72px 1fr auto; align-items: center; gap: 14px; padding: 15px; }
        .album-art { display: grid; width: 72px; aspect-ratio: 1; grid-template-columns: 1fr 1fr; overflow: hidden; gap: 2px; padding: 3px; border-radius: 7px; background: #28252c; }
        .album-art i { border-radius: 3px; background: linear-gradient(145deg, #46688c, #172033 60%, #846051); }
        .album-art i:nth-child(2) { background: linear-gradient(145deg, #997a54, #2d2430); }
        .album-art i:nth-child(3) { background: linear-gradient(145deg, #6b7779, #272832); }
        .album-art i:nth-child(4) { background: linear-gradient(145deg, #af5b8c, #182544); }
        .player-title { color: #f0f0f2; font-size: 13px; font-weight: 700; }
        .player-author { margin-top: 5px; color: #9d9da2; font-size: 10px; }
        .player-save { margin-top: 8px; color: #b7b7bb; font-size: 9px; }
        .player-control { display: grid; width: 39px; height: 39px; place-items: center; border: 0; border-radius: 50%; background: #f4f4f5; color: #111; cursor: pointer; transition: transform .2s ease; }
        .player-control:hover { transform: scale(1.08); }
        .player-control span { margin-left: 2px; }
        .track-list { display: grid; gap: 1px; padding: 0 13px 9px; }
        .track { display: grid; grid-template-columns: 24px 1fr auto; align-items: center; gap: 7px; padding: 8px 7px; border-radius: 6px; color: #ececf0; font-size: 10px; }
        .track:hover { background: rgba(255,255,255,.07); }
        .track-number, .track-time { color: #93939b; font-size: 9px; }
        .track-artist { display: block; margin-top: 3px; color: #92929a; font-size: 9px; }

        .portfolio-tabs { display: flex; width: fit-content; max-width: 100%; gap: 5px; overflow-x: auto; margin: 0 auto 28px; padding: 6px; border: 1px solid var(--line); border-radius: 13px; background: rgba(12, 17, 26, .9); scrollbar-width: none; }
        .portfolio-tabs::-webkit-scrollbar { display: none; }
        .portfolio-tab { display: inline-flex; min-height: 41px; flex: 0 0 auto; align-items: center; gap: 8px; padding: 0 14px; border: 0; border-radius: 9px; background: transparent; color: #9daabd; cursor: pointer; font-size: 11px; font-weight: 700; transition: background .2s ease, color .2s ease, box-shadow .2s ease; }
        .portfolio-tab:hover { color: #fff; }
        .portfolio-tab[aria-current="page"] { background: #3478ed; color: #fff; box-shadow: 0 5px 18px rgba(52, 120, 237, .28); }
        .portfolio-panel { animation: panel-in .35s ease both; }
        .portfolio-panel[hidden] { display: none; }
        @keyframes panel-in { from { opacity: 0; transform: translateY(9px); } to { opacity: 1; transform: translateY(0); } }
        .projects { grid-template-columns: repeat(3, 1fr); }
        .project-open { display: inline-flex; align-items: center; gap: 7px; margin-top: 15px; padding: 8px 10px; border: 1px solid var(--line); border-radius: 8px; background: transparent; color: #cbd6e7; cursor: pointer; font-size: 10px; }
        .project-open:hover { border-color: rgba(87, 148, 255, .55); color: #fff; }
        .project-detail { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; align-items: center; margin-top: 17px; padding: 23px; border: 1px solid rgba(87, 148, 255, .25); border-radius: 15px; background: linear-gradient(120deg, rgba(18, 28, 44, .9), rgba(11, 16, 25, .92)); animation: panel-in .35s ease both; }
        .project-detail[hidden] { display: none; }
        .project-detail h3 { margin: 12px 0; font-size: clamp(24px, 4vw, 38px); letter-spacing: -.06em; }
        .project-detail p { color: #aab5c7; font-size: 12px; line-height: 1.85; }
        .detail-preview { display: grid; min-height: 195px; place-items: center; overflow: hidden; border: 1px solid var(--line); border-radius: 11px; background: radial-gradient(ellipse at 50% 40%, rgba(52, 120, 237, .22), transparent 65%), #090e17; }
        .detail-logo { color: #d6e5ff; font-size: clamp(32px, 6vw, 60px); font-weight: 800; letter-spacing: -.08em; text-shadow: 0 0 34px rgba(87, 148, 255, .6); }
        .credential-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; }
        .credential { min-height: 205px; padding: 21px; border: 1px solid rgba(179, 197, 226, .16); border-radius: 13px; background: linear-gradient(145deg, #f3f5f8, #dce4ef); color: #172131; box-shadow: 0 15px 35px rgba(0,0,0,.2); }
        .credential-mark { display: inline-grid; width: 29px; height: 29px; place-items: center; border-radius: 8px; background: #e3ecff; color: #3478ed; font-size: 14px; }
        .credential small { display: block; margin-top: 18px; color: #59687d; font: 8px var(--mono); text-transform: uppercase; }
        .credential h3 { margin: 8px 0; font-size: 17px; line-height: 1.3; letter-spacing: -.04em; }
        .credential p { margin: 0; color: #68768b; font-size: 9px; }
        .credential .example-note { color: #78869a; }
        .tech-grid { display: grid; grid-template-columns: repeat(6, 1fr); gap: 12px; }
        .tech-item { display: grid; min-height: 118px; place-items: center; gap: 10px; padding: 15px 8px; border: 1px solid var(--line); border-radius: 13px; background: linear-gradient(145deg, rgba(17, 25, 39, .92), rgba(12, 17, 26, .9)); color: #d8e1ef; text-align: center; transition: transform .25s ease, border-color .25s ease, box-shadow .25s ease; }
        .tech-item:hover { transform: translateY(-5px); border-color: rgba(87, 148, 255, .45); box-shadow: 0 12px 28px rgba(0,0,0,.2); }
        .tech-icon { display: grid; width: 42px; height: 42px; place-items: center; border: 1px solid rgba(87, 148, 255, .2); border-radius: 11px; background: rgba(87, 148, 255, .08); color: #9bc0ff; font: 12px var(--mono); }
        .tech-item span:last-child { font-size: 10px; font-weight: 600; }
        .contact-layout { display: grid; grid-template-columns: .82fr 1.18fr; gap: 20px; }
        .contact-form-card, .comments-card, .find-card { padding: 22px; border: 1px solid var(--line); border-radius: 15px; background: rgba(14, 19, 29, .86); }
        .contact-form-card h3, .comments-card h3, .find-card h3 { margin: 0 0 17px; font-size: 17px; letter-spacing: -.03em; }
        .field { display: grid; gap: 7px; margin-top: 13px; }
        .field label { color: #b6c1d1; font-size: 10px; }
        .field input, .field textarea { width: 100%; padding: 12px; border: 1px solid var(--line); border-radius: 9px; outline: none; background: #101723; color: #eef3fb; font: 11px var(--font); }
        .field input:focus, .field textarea:focus { border-color: rgba(87, 148, 255, .7); }
        .field textarea { min-height: 104px; resize: vertical; }
        .field input::placeholder, .field textarea::placeholder { color: #657187; }
        .form-submit { width: 100%; margin-top: 15px; }
        .comment-form { display: grid; gap: 11px; }
        .comment-form textarea { width: 100%; min-height: 108px; padding: 13px; border: 1px solid var(--line); border-radius: 9px; outline: none; background: #101723; color: #eef3fb; font: 11px var(--font); resize: vertical; }
        .comment-form textarea:focus { border-color: rgba(87, 148, 255, .7); }
        .comment-submit { min-height: 39px; border: 0; border-radius: 8px; background: #3478ed; color: #fff; cursor: pointer; font-size: 10px; font-weight: 700; }
        .comment-example { display: flex; gap: 10px; margin-top: 17px; padding-top: 15px; border-top: 1px solid var(--line); }
        .comment-avatar { display: grid; width: 32px; height: 32px; flex: 0 0 auto; place-items: center; border-radius: 50%; background: #1d2b42; color: #acd0ff; font: 10px var(--mono); }
        .comment-example strong { color: #dce5f2; font-size: 10px; }
        .comment-example p { margin: 5px 0 0; color: #a1adbf; font-size: 10px; line-height: 1.7; }
        .find-card { margin-top: 14px; }
        .find-link { display: flex; align-items: center; justify-content: space-between; gap: 14px; padding: 12px; border: 1px solid var(--line); border-radius: 10px; color: #d7e1ef; font-size: 10px; }
        .find-link:hover { border-color: rgba(87, 148, 255, .5); }
        .find-link small { display: block; margin-top: 4px; color: #8593a8; font: 9px var(--mono); }

        footer { padding-block: 24px 36px; border-top: 1px solid var(--line); }
        .footer-inner { display: flex; align-items: center; justify-content: space-between; gap: 18px; color: #78869a; font: 10px var(--mono); }
        .footer-social { display: flex; gap: 18px; }
        .footer-social a:hover { color: #c4d7f6; }

        .starfield {
            position: fixed;
            z-index: 0;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
            opacity: .46;
            background-image:
                radial-gradient(1px 1px at 8% 18%, #d7e5ff 99%, transparent),
                radial-gradient(1px 1px at 23% 73%, #91baff 99%, transparent),
                radial-gradient(1px 1px at 42% 32%, #d7e5ff 99%, transparent),
                radial-gradient(1px 1px at 61% 82%, #91baff 99%, transparent),
                radial-gradient(1px 1px at 78% 24%, #d7e5ff 99%, transparent),
                radial-gradient(1px 1px at 93% 61%, #91baff 99%, transparent);
            background-size: 390px 320px;
            animation: star-drift 70s linear infinite;
        }
        .starfield::before, .starfield::after {
            position: absolute;
            content: "";
            pointer-events: none;
        }
        .starfield::before {
            top: 13%;
            left: 74%;
            width: 115px;
            height: 1px;
            opacity: 0;
            background: linear-gradient(90deg, transparent, rgba(174, 207, 255, .85), transparent);
            box-shadow: 0 0 10px rgba(114, 169, 255, .8);
            transform: rotate(-35deg);
            animation: shooting-star 8s linear infinite;
        }
        .starfield::after {
            top: 29%;
            left: 19%;
            width: 2px;
            height: 2px;
            border-radius: 50%;
            background: #c9ddff;
            box-shadow: 0 0 8px 2px rgba(125, 174, 255, .45);
            animation: twinkle 2.8s ease-in-out infinite alternate;
        }
        .site-header, main, footer { position: relative; z-index: 1; }
        .page-content { animation: page-enter .65s cubic-bezier(.2,.7,.2,1) both; }
        @keyframes page-enter { from { opacity: 0; transform: translateY(14px); } to { opacity: 1; transform: translateY(0); } }
        .nav-links a[aria-current="page"] { color: #fff; }
        .nav-links a[aria-current="page"]::after { display: block; width: 5px; height: 5px; margin: 5px auto -10px; border-radius: 50%; background: var(--blue); content: ""; box-shadow: 0 0 8px var(--blue); }
        .home-links { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-top: 40px; }
        .home-link { padding: 17px; border: 1px solid var(--line); border-radius: 13px; background: rgba(15, 21, 31, .75); transition: transform .25s ease, border-color .25s ease; }
        .home-link:hover { transform: translateY(-4px); border-color: rgba(87, 148, 255, .5); }
        .home-link span { display: block; color: #8db4ff; font: 10px var(--mono); }
        .home-link strong { display: block; margin-top: 10px; font-size: 13px; }
        .page-heading { padding-top: 78px; }
        .page-heading h1 { margin: 16px 0 12px; font-size: clamp(42px, 7vw, 68px); letter-spacing: -.07em; line-height: 1.05; }
        .page-heading p { max-width: 620px; color: var(--muted); font-size: 14px; line-height: 1.8; }
        .page-main { min-height: 70vh; padding-bottom: 90px; }
        .detail-back { display: inline-flex; align-items: center; gap: 9px; color: #a9bad3; font-size: 11px; }
        .detail-back:hover { color: white; }
        .success-message { margin-bottom: 14px; padding: 11px 13px; border: 1px solid rgba(97, 223, 173, .25); border-radius: 9px; background: rgba(97, 223, 173, .08); color: #a6f1d0; font-size: 11px; }
        .validation-errors { margin-bottom: 14px; padding: 11px 13px; border: 1px solid rgba(255, 104, 104, .28); border-radius: 9px; background: rgba(255, 104, 104, .08); color: #ffb4b4; font-size: 11px; }
        .honeypot { position: absolute !important; left: -10000px !important; width: 1px !important; height: 1px !important; overflow: hidden !important; }
        .loader {
            position: fixed;
            z-index: 100;
            inset: 0;
            display: grid;
            place-items: center;
            background: #080a0f;
            opacity: 0;
            visibility: hidden;
            transition: opacity .55s ease, visibility .55s ease;
        }
        .has-js .loader { opacity: 1; visibility: visible; }
        .has-js .loader.is-active { opacity: 1; visibility: visible; }
        .loader.is-hidden { opacity: 0; visibility: hidden; }
        .loader-content { width: min(250px, calc(100% - 48px)); text-align: center; }
        .loader-percent { display: block; color: #f0f3f9; font: 500 52px var(--mono); letter-spacing: -.09em; }
        .loader-percent .loader-unit { color: #5794ff; font-size: 21px; }
        .loader-track { height: 2px; margin-top: 21px; overflow: hidden; background: rgba(179, 197, 226, .15); }
        .loader-progress { width: 0; height: 100%; background: linear-gradient(90deg, #5794ff, #78c8ff); box-shadow: 0 0 15px #5794ff; }
        .loader-label { display: block; margin-top: 11px; color: #768398; font: 9px var(--mono); letter-spacing: .14em; text-transform: uppercase; }
        .has-js .reveal { opacity: 0; transform: translateY(28px); transition: opacity .75s ease, transform .75s cubic-bezier(.2,.7,.2,1); }
        .has-js .reveal.is-visible { opacity: 1; transform: translateY(0); }
        .has-js .hero-copy.reveal { transition-delay: .08s; }
        .has-js .hero-actions.reveal { transition-delay: .16s; }
        .has-js .hero-meta.reveal { transition-delay: .22s; }
        .visual-glow { animation: glow-pulse 5s ease-in-out infinite alternate; }
        .orbit { animation: orbit-float 4s ease-in-out infinite; }
        .visual-caption { animation: caption-float 5s ease-in-out infinite; }
        .availability span { animation: status-pulse 1.8s ease-in-out infinite; }
        .mock-window, .mock-product, .mock-poster { transition: transform .45s cubic-bezier(.2,.7,.2,1); }
        .project-card:hover .mock-window { transform: rotate(0) scale(1.04); }
        .project-card:hover .mock-product { transform: translateY(-5px) rotate(4deg); }
        .project-card:hover .mock-poster { transform: rotate(0) scale(1.04); }
        @keyframes star-drift { to { transform: translate3d(-20px, 16px, 0); } }
        @keyframes lanyard-swing { 0%, 100% { transform: rotate(-8deg); } 50% { transform: rotate(8deg); } }
        @keyframes id-card-run {
            0%, 100% { transform: translate3d(0, 0, 0) rotate(0) scale(1); }
            14% { transform: translate3d(-8px, -10px, 0) rotate(-5deg) scale(1.025); }
            29% { transform: translate3d(8px, -2px, 0) rotate(5deg) scale(1.01); }
            44% { transform: translate3d(6px, -12px, 0) rotate(3deg) scale(1.03); }
            59% { transform: translate3d(-9px, -4px, 0) rotate(-6deg) scale(1.01); }
            74% { transform: translate3d(7px, -10px, 0) rotate(4deg) scale(1.025); }
            88% { transform: translate3d(-4px, -2px, 0) rotate(-3deg) scale(1.01); }
        }
        @keyframes glow-pulse { from { opacity: .55; transform: scale(.94); } to { opacity: 1; transform: scale(1.06); } }
        @keyframes orbit-float { 0%, 100% { transform: translateY(0) rotate(-7deg); } 50% { transform: translateY(-12px) rotate(9deg); } }
        @keyframes caption-float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-6px); } }
        @keyframes status-pulse { 50% { box-shadow: 0 0 0 5px rgba(97, 223, 173, .1), 0 0 16px #61dfad; } }
        @keyframes shooting-star {
            0%, 68% { opacity: 0; transform: translate3d(35vw, -12vh, 0) rotate(-35deg); }
            72% { opacity: .9; }
            82% { opacity: 0; transform: translate3d(-45vw, 22vh, 0) rotate(-35deg); }
            100% { opacity: 0; transform: translate3d(-45vw, 22vh, 0) rotate(-35deg); }
        }
        @keyframes twinkle { from { opacity: .25; transform: scale(.75); } to { opacity: 1; transform: scale(1.6); } }

        @media (max-width: 820px) {
            .hero { min-height: 0; grid-template-columns: 1fr .8fr; gap: 25px; padding-block: 80px 70px; }
            .hero h1 { font-size: clamp(45px, 8vw, 66px); }
            .visual-wrap { min-height: 350px; }
            .lanyard { width: 245px; height: 350px; }
            .id-card { width: 200px; height: 278px; }
            .portrait-image { height: 221px; }
            .projects { grid-template-columns: repeat(2, 1fr); }
            .home-links { grid-template-columns: repeat(2, 1fr); }
            .project-card:last-child { grid-column: span 2; }
            .project-card:last-child .project-art { height: 180px; }
            .about-grid { gap: 25px; }
            .tech-grid { grid-template-columns: repeat(4, 1fr); }
            .credential-grid { grid-template-columns: repeat(2, 1fr); }
            .section { padding-block: 85px; }
        }
        @media (max-width: 600px) {
            .shell { width: min(100% - 36px, 480px); }
            .site-header { width: calc(100% - 20px); top: 8px; margin-top: 8px; }
            .nav-wrap { min-height: 58px; padding-inline: 12px; }
            .nav-links { max-width: 54vw; gap: 18px; overflow-x: auto; scrollbar-width: none; white-space: nowrap; }
            .nav-links::-webkit-scrollbar { display: none; }
            .nav-links a { font-size: 10px; }
            .nav-cta { width: 36px; min-height: 36px; overflow: hidden; justify-content: center; padding: 0; font-size: 0; }
            .nav-cta .arrow { font-size: 17px; }
            .hero { grid-template-columns: 1fr; gap: 22px; padding-block: 78px 52px; }
            .hero h1 { max-width: 510px; font-size: clamp(49px, 13vw, 70px); }
            .hero-copy { font-size: 13px; }
            .hero-meta { margin-top: 27px; }
            .visual-wrap { min-height: 340px; }
            .lanyard { width: 220px; height: 325px; }
            .id-card { width: 186px; height: 258px; }
            .portrait-image { height: 202px; }
            .orbit { top: 52px; right: 2%; }
            .visual-caption { right: 1%; bottom: 14px; }
            .section { padding-block: 70px; }
            .section-heading { align-items: start; flex-direction: column; gap: 14px; margin-bottom: 25px; }
            .section-heading > p { max-width: 100%; font-size: 12px; }
            .about-grid, .stack-panel { grid-template-columns: 1fr; gap: 17px; }
            .journey-grid, .music-card, .contact-layout, .project-detail { grid-template-columns: 1fr; }
            .journey-grid { gap: 24px; }
            .tech-grid { grid-template-columns: repeat(3, 1fr); gap: 8px; }
            .tech-item { min-height: 96px; }
            .credential-grid { grid-template-columns: 1fr; }
            .credential { min-height: 165px; }
            .portfolio-tabs { width: 100%; justify-content: flex-start; }
            .portfolio-tab { padding-inline: 11px; font-size: 10px; }
            .project-detail { padding: 16px; }
            .player-main { grid-template-columns: 56px 1fr auto; gap: 10px; padding: 12px; }
            .album-art { width: 56px; }
            .about-copy { font-size: 13px; }
            .stats { gap: 8px; }
            .stat { padding: 15px 10px; }
            .stat strong { font-size: 22px; }
            .stat span { font-size: 8px; }
            .about-aside { min-height: 245px; padding: 21px; }
            .aside-quote { font-size: 25px; }
            .projects { grid-template-columns: 1fr; }
            .home-links { grid-template-columns: repeat(2, 1fr); gap: 8px; }
            .home-link { padding: 12px; }
            .project-card:last-child { grid-column: auto; }
            .project-card:last-child .project-art { height: 205px; }
            .stack-panel { padding: 23px; }
            .stack-list { gap: 8px; }
            .stack-chip { padding: 9px 10px; font-size: 10px; }
            .contact-card { padding: 29px 23px; }
            .contact-card h2 { font-size: 42px; }
            .contact-actions { align-items: flex-start; flex-direction: column; }
            .footer-inner { align-items: flex-start; flex-direction: column; }
        }
        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            *, *::before, *::after { animation-duration: .01ms !important; animation-iteration-count: 1 !important; scroll-behavior: auto !important; transition-duration: .01ms !important; }
        }
    </style>
</head>
<body>
    <div class="starfield" aria-hidden="true"></div>
    <div class="loader" aria-hidden="true">
        <div class="loader-content">
            <span class="loader-percent"><span class="loader-value">1</span><span class="loader-unit">%</span></span>
            <div class="loader-track"><div class="loader-progress"></div></div>
            <span class="loader-label">Preparing portfolio</span>
        </div>
    </div>
    <header class="site-header">
        <div class="nav-wrap">
            <a class="brand" href="{{ route('home') }}" aria-label="Yogi, ke halaman utama">
                <span class="brand-mark">Y.</span>
                <span>yogi<span style="color: var(--blue)">.</span></span>
            </a>
            <nav class="nav-links" aria-label="Navigasi utama">
                <a href="{{ route('home') }}" @if($page === 'home') aria-current="page" @endif>Beranda</a>
                <a href="{{ route('portfolio.page', 'about') }}" @if($page === 'about') aria-current="page" @endif>Tentang</a>
                <a href="{{ route('portfolio.page', 'music') }}" @if($page === 'music') aria-current="page" @endif>Inspirasi</a>
                <a href="{{ route('portfolio.page', 'projects') }}" @if(in_array($page, ['projects', 'project-detail'], true)) aria-current="page" @endif>Portfolio</a>
                <a href="{{ route('portfolio.page', 'contact') }}" @if($page === 'contact') aria-current="page" @endif>Kontak</a>
            </nav>
            <a class="nav-cta" href="{{ route('portfolio.page', 'contact') }}">
                Mari berdiskusi <span class="arrow" aria-hidden="true">↗</span>
            </a>
        </div>
    </header>

    <main class="page-content page-main">
        @if($page !== 'home')
            <header class="page-heading shell">
                <span class="eyebrow">{{ strtoupper($pageSection ?? $pageTitle) }}</span>
                <h1>{{ $pageTitle ?? 'Portfolio' }}</h1>
                <p>Kenali perjalanan, proses berkarya, dan eksplorasi digital yang saya lakukan.</p>
            </header>
        @endif
        @if($page === 'home')
        <section class="hero shell" id="home">
            <div>
                <span class="availability"><span aria-hidden="true"></span> TERBUKA UNTUK PELUANG</span>
                <p class="eyebrow" style="margin: 25px 0 0">PENGEMBANGAN WEB · DESAIN ANTARMUKA</p>
                <h1><em>Merancang ide.</em><br>Membangun pengalaman digital.</h1>
                <p class="hero-copy">
                    Halo, saya Yogi—seorang pengembang web yang tertarik pada perpaduan
                    antara teknologi, desain, dan pengalaman pengguna. Saya berfokus
                    mengubah ide menjadi antarmuka yang jelas, responsif, dan nyaman
                    digunakan. Di portfolio ini, Anda dapat melihat proyek, teknologi
                    yang saya pelajari, serta proses saya mengembangkan kemampuan.
                </p>
                <div class="hero-actions">
                    <a class="button button-primary" href="{{ route('portfolio.page', 'projects') }}">Jelajahi proyek <span class="arrow" aria-hidden="true">↘</span></a>
                    <a class="button button-quiet" href="{{ route('portfolio.page', 'contact') }}">Diskusikan kolaborasi <span class="arrow" aria-hidden="true">↗</span></a>
                </div>
                <div class="hero-socials" aria-label="Tautan sosial">
                    <a class="social-chip" href="mailto:yogiiindrasyahputra8@gmail.com" aria-label="Email">✉</a>
                    <a class="social-chip" href="{{ route('portfolio.page', 'projects') }}" aria-label="Lihat portfolio">GH</a>
                    <a class="social-chip" href="{{ route('portfolio.page', 'contact') }}" aria-label="Hubungi saya">↗</a>
                </div>
                <div class="hero-meta">WEB DEVELOPMENT · UI · CREATIVE TECHNOLOGY</div>
            </div>
            <div class="visual-wrap">
                <div class="visual-glow"></div>
                <div class="lanyard">
                    <span class="lanyard-cord" aria-hidden="true"></span>
                    <button class="id-card" type="button" aria-label="Ganti tampilan foto, 1 dari 3">
                        <span class="id-card-face">
                            <img class="portrait-image" src="{{ asset('images/yogi-portrait.jpeg') }}" alt="Potret Yogi mengenakan kemeja batik biru">
                            <span class="id-card-info">
                                <span><strong>YOGI</strong><small class="portrait-view-label">PORTRAIT / 01</small></span>
                                <span class="id-card-mark" aria-hidden="true">↻</span>
                            </span>
                        </span>
                    </button>
                </div>
                <span class="orbit" aria-hidden="true">✳</span>
                <div class="visual-caption">
                    <span class="caption-icon" aria-hidden="true">✳</span>
                    <span>Pengembang web<small>DESAIN × TEKNOLOGI</small></span>
                </div>
            </div>
        </section>
        <section class="shell" style="padding-bottom: 80px">
            <div class="home-links">
                <a class="home-link" href="{{ route('portfolio.page', 'about') }}"><span>01 / PROFIL</span><strong>Perjalanan saya ↗</strong></a>
                <a class="home-link" href="{{ route('portfolio.page', 'music') }}"><span>02 / INSPIRASI</span><strong>Ruang ide ↗</strong></a>
                <a class="home-link" href="{{ route('portfolio.page', 'projects') }}"><span>03 / KARYA</span><strong>Proyek pilihan ↗</strong></a>
                <a class="home-link" href="{{ route('portfolio.page', 'tech-stack') }}"><span>04 / TEKNOLOGI</span><strong>Perangkat kerja ↗</strong></a>
            </div>
        </section>
        @endif

        @if($page === 'about')
        <section class="section shell" id="about">
            <div class="section-heading">
                <div>
                    <span class="eyebrow">01 / PROFIL</span>
                    <h2>Mengenal Yogi.</h2>
                </div>
                <p>Perjalanan belajar, minat, dan cara saya mengembangkan sebuah ide menjadi karya digital.</p>
            </div>
            <div class="about-grid">
                <div>
                    <div class="about-copy">
                        <p>Saya menaruh minat pada pengembangan web dan desain antarmuka—terutama bagaimana struktur, visual, dan interaksi dapat bekerja bersama untuk menciptakan pengalaman yang mudah dipahami. <strong>Bagi saya, produk digital yang baik tidak hanya terlihat menarik, tetapi juga menjawab kebutuhan penggunanya.</strong></p>
                        <p>Dalam setiap latihan dan proyek, saya menikmati proses menyusun kebutuhan, mencoba pendekatan teknis, lalu menyempurnakan hasilnya melalui evaluasi. Saya terus mengembangkan pemahaman di sisi frontend maupun backend agar dapat melihat sebuah produk secara lebih menyeluruh.</p>
                        <p>Di luar proses coding, saya mengeksplorasi referensi desain dan perangkat baru untuk memperluas cara pandang. Portfolio ini menjadi catatan perjalanan tersebut—mulai dari eksperimen, pembelajaran, hingga karya yang terus saya kembangkan.</p>
                    </div>
                </div>
                <div class="about-aside">
                    <span class="aside-index">PRINSIP BERKARYA / 001</span>
                    <p class="aside-quote">“Terus belajar, membangun dengan tujuan, dan menyempurnakan setiap ide.”</p>
                    <div class="aside-bottom"><span>PENDEKATAN SAYA</span><span>PAHAMI · RANCANG · KEMBANGKAN</span></div>
                </div>
            </div>
            <div class="journey-grid" style="margin-top: 38px">
                <div class="journey-column">
                    <h3>Pendidikan & Pembelajaran</h3>
                    <div class="journey-list">
                        <article class="journey-item"><span class="journey-icon">⌂</span><span><strong>Dasar Komputer dan Pengembangan Web</strong><small>Pendidikan dan pembelajaran vokasi · 2020 — 2023</small></span></article>
                        <article class="journey-item"><span class="journey-icon">✦</span><span><strong>Pengembangan Web</strong><small>Belajar mandiri dan praktik langsung · 2023 — sekarang</small></span></article>
                    </div>
                </div>
                <div class="journey-column">
                    <h3>Pengalaman & Fokus</h3>
                    <div class="journey-list">
                        <article class="journey-item"><span class="journey-icon">⌘</span><span><strong>Praktik Proyek Web</strong><small>Membangun konsep antarmuka dan aplikasi web berskala kecil</small></span></article>
                        <article class="journey-item"><span class="journey-icon">↗</span><span><strong>Pengembangan Berkelanjutan</strong><small>Mengeksplorasi frontend, backend, dan teknologi kreatif</small></span></article>
                    </div>
                </div>
            </div>
            <div class="stats" aria-label="Ringkasan portfolio" style="margin-top: 24px">
                <div class="stat"><strong>03</strong><span>Proyek ditampilkan</span></div>
                <div class="stat"><strong>03</strong><span>Sertifikat contoh</span></div>
                <div class="stat"><strong>01</strong><span>Pencapaian contoh</span></div>
            </div>
            <p class="example-note">Informasi pendidikan, sertifikat, pencapaian, dan proyek perlu ditinjau agar selalu sesuai dengan pengalaman serta karya yang dapat diverifikasi.</p>
        </section>
        @endif

        @if($page === 'music')
        <section class="section shell" id="music">
            <div class="section-heading">
                <div>
                    <span class="eyebrow">02 / RUANG INSPIRASI</span>
                    <h2>Menjaga fokus.<br>Membuka ide.</h2>
                </div>
                <p>Musik menjadi teman untuk menjaga ritme, menemukan fokus, dan memberi ruang bagi ide-ide baru selama proses belajar maupun berkarya.</p>
            </div>
            <div class="music-card">
                <div class="music-copy">
                    <span class="eyebrow">MUSIK & PRODUKTIVITAS</span>
                    <h3>Ritme yang tepat.<br><em>Ide yang berkembang.</em></h3>
                    <p>Setiap orang memiliki cara sendiri untuk masuk ke dalam alur kerja. Pilihan lagu di halaman ini merupakan referensi awal untuk menemani sesi fokus dan dapat diputar melalui Spotify.</p>
                    <a class="music-link" href="https://open.spotify.com/search/NgodingTime" target="_blank" rel="noopener noreferrer">♫ Jelajahi playlist di Spotify <span class="arrow">↗</span></a>
                </div>
                <div class="player" aria-label="Referensi musik NgodingTime">
                    <div class="player-main">
                        <span class="album-art" aria-hidden="true"><i></i><i></i><i></i><i></i></span>
                        <span><span class="player-title">NgodingTime</span><span class="player-author">Pilihan musik untuk menemani proses kreatif</span><span class="player-save">♫ Referensi playlist</span></span>
                        <a class="player-control" href="https://open.spotify.com/search/NgodingTime" target="_blank" rel="noopener noreferrer" aria-label="Buka pencarian playlist di Spotify"><span>▶</span></a>
                    </div>
                    <div class="track-list">
                        <a class="track" href="https://open.spotify.com/search/Last%20Child%20Sekuat%20Hatimu" target="_blank" rel="noopener noreferrer"><span class="track-number">1</span><span>Sekuat Hatimu<small class="track-artist">Last Child</small></span><span class="track-time">04:43</span></a>
                        <a class="track" href="https://open.spotify.com/search/Tulus%20Teh%20Hijau" target="_blank" rel="noopener noreferrer"><span class="track-number">2</span><span>Teh Hijau<small class="track-artist">Tulus</small></span><span class="track-time">03:32</span></a>
                        <a class="track" href="https://open.spotify.com/search/Nuca%20Masa%20Ini%20Nanti" target="_blank" rel="noopener noreferrer"><span class="track-number">3</span><span>Masa Ini, Nanti, dan Masa Indah Lainnya<small class="track-artist">Nuca</small></span><span class="track-time">04:35</span></a>
                    </div>
                </div>
            </div>
        </section>
        @endif

        @if(in_array($page, ['projects', 'certificates', 'achievements', 'tech-stack'], true))
        <section class="section shell" id="portfolio">
            <div class="section-heading">
                <div>
                    <span class="eyebrow">03 / KARYA & KOMPETENSI</span>
                    <h2>{{ $pageTitle }}</h2>
                </div>
                <p>Rangkuman proyek, pembelajaran, pencapaian, dan teknologi yang menjadi bagian dari perjalanan saya di bidang pengembangan web.</p>
            </div>
            <nav class="portfolio-tabs" aria-label="Kategori portfolio">
                <a class="portfolio-tab" href="{{ route('portfolio.page', 'projects') }}" @if($page === 'projects') aria-current="page" @endif>⌘ Proyek</a>
                <a class="portfolio-tab" href="{{ route('portfolio.page', 'certificates') }}" @if($page === 'certificates') aria-current="page" @endif>♙ Sertifikat</a>
                <a class="portfolio-tab" href="{{ route('portfolio.page', 'achievements') }}" @if($page === 'achievements') aria-current="page" @endif>♜ Pencapaian</a>
                <a class="portfolio-tab" href="{{ route('portfolio.page', 'tech-stack') }}" @if($page === 'tech-stack') aria-current="page" @endif>▦ Teknologi</a>
            </nav>
            @if($page === 'projects')
            <div class="portfolio-panel page-transition">
                <div class="projects">
                    <article class="project-card">
                        <div class="project-art"><div class="mock-window" aria-hidden="true"><div class="mock-top"><i></i><i></i><i></i></div><div class="mock-body"><div class="mock-sidebar"></div><div class="mock-content"><div class="mock-chart"></div><div class="mock-stats"><i></i><i></i><i></i></div></div></div></div></div>
                        <div class="project-info"><div class="project-topline"><span>01 / PROYEK</span><span class="project-label">WEB APP</span></div><h3>Cyber GYZIN</h3><p>Eksplorasi konsep dashboard bertema cyber dengan hierarki informasi yang tegas, panel status, dan elemen visual interaktif. Fokusnya adalah membangun antarmuka yang terasa imersif namun tetap mudah dipindai.</p><div class="tags"><span>HTML</span><span>CSS</span><span>JavaScript</span></div><a class="project-open" href="{{ route('projects.show', 'cyber-gyzin') }}">Lihat ringkasan <span>↗</span></a></div>
                    </article>
                    <article class="project-card">
                        <div class="project-art project-art-brand"><div class="mock-poster" aria-hidden="true">AI</div></div>
                        <div class="project-info"><div class="project-topline"><span>02 / PROYEK</span><span class="project-label">AI TOOL</span></div><h3>Bot Generate Artikel</h3><p>Konsep alat bantu penulisan yang memanfaatkan topik dan kata kunci sebagai titik awal penyusunan draft. Hasilnya dirancang untuk ditinjau, disunting, dan disesuaikan kembali oleh pengguna.</p><div class="tags"><span>Python</span><span>Gemini</span><span>HTML/CSS</span></div><a class="project-open" href="{{ route('projects.show', 'bot-generate-artikel') }}">Lihat ringkasan <span>↗</span></a></div>
                    </article>
                    <article class="project-card">
                        <div class="project-art project-art-commerce"><div class="mock-window" aria-hidden="true"><div class="mock-top"><i></i><i></i><i></i></div><div class="mock-body"><div class="mock-sidebar"></div><div class="mock-content"><div class="mock-chart"></div><div class="mock-stats"><i></i><i></i><i></i></div></div></div></div></div>
                        <div class="project-info"><div class="project-topline"><span>03 / PROYEK</span><span class="project-label">PENDIDIKAN</span></div><h3>Database Siswa</h3><p>Konsep aplikasi administrasi sederhana untuk mengelola data siswa. Proyek ini mengeksplorasi alur pencatatan, peninjauan, pembaruan, dan penghapusan data melalui antarmuka yang terstruktur.</p><div class="tags"><span>PHP</span><span>MySQL</span><span>CRUD</span></div><a class="project-open" href="{{ route('projects.show', 'database-siswa') }}">Lihat ringkasan <span>↗</span></a></div>
                    </article>
                </div>
                <p class="example-note">Deskripsi ini merupakan ringkasan awal. Detail peran, proses, dan hasil proyek sebaiknya dilengkapi berdasarkan implementasi yang benar-benar dikerjakan.</p>
            </div>
            @endif
            @if($page === 'certificates')
            <div class="portfolio-panel page-transition">
                <div class="credential-grid">
                    <article class="credential"><span class="credential-mark">✦</span><small>Sertifikat / Contoh</small><h3>Praktik Kerja Lapangan</h3><p>Ruang untuk merangkum pengalaman praktik, kompetensi yang dikembangkan, dan pembelajaran yang relevan.</p><p class="example-note">Lengkapi dengan institusi dan periode yang sesuai.</p></article>
                    <article class="credential"><span class="credential-mark">✦</span><small>Udemy / Contoh</small><h3>CSS and JavaScript Crash Course</h3><p>Pembelajaran dasar untuk membangun tampilan web dan menambahkan interaksi pada antarmuka.</p></article>
                    <article class="credential"><span class="credential-mark">✦</span><small>Udemy / Contoh</small><h3>Ethically Hack the Planet — Part 2</h3><p>Contoh pembelajaran yang membahas pengenalan keamanan digital secara etis.</p></article>
                </div>
                <p class="example-note">Judul sertifikat di atas masih berupa contoh. Ganti dengan sertifikat yang benar-benar dimiliki dan tambahkan lembaga penerbit, tahun, serta bukti bila tersedia.</p>
            </div>
            @endif
            @if($page === 'achievements')
            <div class="portfolio-panel page-transition">
                <div class="credential-grid">
                    <article class="credential"><span class="credential-mark">♜</span><small>Pencapaian / Contoh</small><h3>Juara III</h3><p>Ruang untuk mencatat kompetisi atau penghargaan, termasuk kategori, penyelenggara, dan tahun pencapaiannya.</p></article>
                    <article class="credential"><span class="credential-mark">♜</span><small>Milestone / Contoh</small><h3>Presentasi Proyek</h3><p>Dokumentasikan proses menyelesaikan dan mempresentasikan karya digital beserta kontribusi yang diberikan.</p></article>
                </div>
                <p class="example-note">Informasi pencapaian di atas masih berupa contoh; hanya cantumkan prestasi dan milestone yang dapat Anda jelaskan atau verifikasi.</p>
            </div>
            @endif
            @if($page === 'tech-stack')
            <div class="portfolio-panel page-transition">
                <div class="tech-grid" aria-label="Teknologi yang dipelajari dan dieksplorasi">
                    <div class="tech-item"><span class="tech-icon">⚛</span><span>React</span></div>
                    <div class="tech-item"><span class="tech-icon">JS</span><span>JavaScript</span></div>
                    <div class="tech-item"><span class="tech-icon">5</span><span>HTML5</span></div>
                    <div class="tech-item"><span class="tech-icon">3</span><span>CSS3</span></div>
                    <div class="tech-item"><span class="tech-icon">FA</span><span>Font Awesome</span></div>
                    <div class="tech-item"><span class="tech-icon">Py</span><span>Python</span></div>
                    <div class="tech-item"><span class="tech-icon">PHP</span><span>PHP</span></div>
                    <div class="tech-item"><span class="tech-icon">SQL</span><span>MySQL</span></div>
                    <div class="tech-item"><span class="tech-icon">S</span><span>Supabase</span></div>
                    <div class="tech-item"><span class="tech-icon">F</span><span>Firebase</span></div>
                    <div class="tech-item"><span class="tech-icon">X</span><span>XAMPP</span></div>
                    <div class="tech-item"><span class="tech-icon">⌘</span><span>Git</span></div>
                    <div class="tech-item"><span class="tech-icon">GH</span><span>GitHub</span></div>
                    <div class="tech-item"><span class="tech-icon">ϟ</span><span>Vite</span></div>
                    <div class="tech-item"><span class="tech-icon">▲</span><span>Vercel</span></div>
                    <div class="tech-item"><span class="tech-icon">L</span><span>Laravel</span></div>
                    <div class="tech-item"><span class="tech-icon">VS</span><span>VS Code</span></div>
                    <div class="tech-item"><span class="tech-icon">AI</span><span>Gemini</span></div>
                </div>
                <p class="example-note">Daftar ini mencakup teknologi yang dipelajari dan dieksplorasi. Tingkat pengalaman tiap teknologi dapat berbeda dan terus berkembang melalui praktik.</p>
            </div>
            @endif
        </section>
        @endif

        @if($page === 'project-detail')
        <section class="section shell page-transition">
            <a class="detail-back" href="{{ route('portfolio.page', 'projects') }}">← &nbsp; Kembali ke proyek</a>
            <div class="project-detail" style="margin-top: 24px">
                <div>
                    <span class="eyebrow">{{ $project['category'] }}</span>
                    <h3>{{ $project['title'] }}</h3>
                    <p>{{ $project['description'] }}</p>
                    <h3 style="margin-top: 28px; font-size: 15px">Teknologi yang digunakan</h3>
                    <div class="tags">
                        @foreach($project['technologies'] as $technology)
                            <span>{{ $technology }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="detail-preview"><span class="detail-logo">{{ $project['mark'] }}</span></div>
            </div>
            <p class="example-note">Ringkasan ini merupakan gambaran awal. Informasi tentang tujuan, kontribusi, proses, dan hasil proyek dapat diperbarui agar mencerminkan implementasi sebenarnya.</p>
        </section>
        @endif

        @if($page === 'contact')
        <section class="section shell" id="contact">
            <div class="section-heading">
                <div><span class="eyebrow">04 / MARI TERHUBUNG</span><h2>Terbuka untuk berdiskusi.</h2></div>
                <p>Jika Anda memiliki pertanyaan, ingin bertukar ide, atau melihat peluang kolaborasi di bidang web dan teknologi, silakan kirim pesan. Saya akan berusaha merespons secepat mungkin.</p>
            </div>
            <div class="contact-layout">
                <div>
                    <form class="contact-form-card" id="contact-form">
                        <h3>Ceritakan kebutuhan Anda</h3>
                        <div class="field"><label for="contact-name">Nama</label><input id="contact-name" name="name" autocomplete="name" placeholder="Nama Anda" required></div>
                        <div class="field"><label for="contact-email">Email</label><input id="contact-email" name="email" type="email" autocomplete="email" placeholder="Email Anda" required></div>
                        <div class="field"><label for="contact-message">Pesan</label><textarea id="contact-message" name="message" placeholder="Pesan Anda" required></textarea></div>
                        <button class="button button-primary form-submit" type="submit">Mulai percakapan <span class="arrow">↗</span></button>
                    </form>
                    <div class="find-card"><h3>Informasi kontak</h3><a class="find-link" href="mailto:yogiiindrasyahputra8@gmail.com"><span>✉ &nbsp; Email<small>yogiiindrasyahputra8@gmail.com</small></span><span>↗</span></a></div>
                </div>
                <div class="comments-card">
                    <h3>Tinggalkan pesan</h3>
                    @if(session('status'))
                        <div class="success-message" role="status">{{ session('status') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="validation-errors" role="alert">
                            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                        </div>
                    @endif
                    <form class="comment-form" action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <label class="field"><span>Nama</span><input name="name" value="{{ old('name') }}" maxlength="80" autocomplete="name" placeholder="Nama Anda" required></label>
                        <label class="field"><span>Email (opsional)</span><input name="email" type="email" value="{{ old('email') }}" maxlength="254" autocomplete="email" placeholder="Email Anda"></label>
                        <label class="field"><span>Pesan</span><textarea name="message" minlength="2" maxlength="1000" placeholder="Tuliskan pesan atau masukan Anda..." required>{{ old('message') }}</textarea></label>
                        <label class="honeypot" aria-hidden="true">Website<input name="website" tabindex="-1" autocomplete="off"></label>
                        <button class="comment-submit" type="submit">Kirim pesan</button>
                    </form>
                    <div id="comment-list">
                        @forelse($comments as $comment)
                            <article class="comment-example">
                                <span class="comment-avatar">{{ strtoupper(substr($comment->name, 0, 1)) }}</span>
                                <span><strong>{{ $comment->name }}</strong><p>{{ $comment->message }}</p><small>{{ $comment->created_at->diffForHumans() }}</small></span>
                            </article>
                        @empty
                            <p class="example-note">Belum ada pesan. Silakan tinggalkan sapaan atau masukan untuk saya.</p>
                        @endforelse
                    </div>
                    <p class="example-note">Pesan yang dikirim akan ditampilkan di halaman ini dan dapat dibaca oleh pengunjung lain.</p>
                </div>
            </div>
        </section>
        @endif
    </main>

    <footer>
        <div class="footer-inner shell">
            <span>© {{ date('Y') }} YOGI. DIBANGUN DENGAN RASA INGIN TAHU.</span>
            <div class="footer-social">
                <a href="mailto:yogiiindrasyahputra8@gmail.com">KIRIM EMAIL ↗</a>
                <a href="{{ route('home') }}">KEMBALI KE BERANDA ↑</a>
            </div>
        </div>
    </footer>
<script>
    (() => {
        const loader = document.querySelector('.loader');
        const percent = document.querySelector('.loader-value');
        const progress = document.querySelector('.loader-progress');
        const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        let loaderValue = 1;
        let loaderStartedAt = performance.now();
        let loadingFinished = false;
        let loaderFinishTimer;
        const setLoaderProgress = value => {
            loaderValue = Math.max(1, Math.min(100, Math.round(value)));
            percent.textContent = String(loaderValue);
            progress.style.width = `${loaderValue}%`;
        };
        const tickLoader = now => {
            if (loadingFinished) return;
            const elapsed = now - loaderStartedAt;
            const value = Math.min(94, Math.floor(1 + 93 * (1 - Math.exp(-elapsed / 2200))));
            setLoaderProgress(Math.max(loaderValue, value));
            if (loaderValue < 94) requestAnimationFrame(tickLoader);
        };
        const startLoader = () => {
            window.clearTimeout(loaderFinishTimer);
            loadingFinished = false;
            loaderStartedAt = performance.now();
            setLoaderProgress(1);
            loader.classList.remove('is-hidden');
            loader.classList.add('is-active');
            requestAnimationFrame(tickLoader);
        };
        const revealItems = document.querySelectorAll(
            '.hero > div:first-child > *, .visual-wrap, .home-link, .page-heading, .section-heading, .about-copy, .stat, .about-aside, .journey-column, .music-card, .portfolio-tabs, .project-card, .credential, .tech-item, .contact-form-card, .comments-card, .find-card, .project-detail'
        );

        revealItems.forEach((item, index) => {
            item.classList.add('reveal');
            if (item.classList.contains('stat') || item.classList.contains('project-card')) {
                item.style.transitionDelay = `${(index % 3) * 90}ms`;
            }
        });

        document.querySelectorAll('.id-card').forEach(card => {
            card.addEventListener('click', () => {
                card.classList.remove('is-running');
                void card.offsetWidth;
                card.classList.add('is-running');

                const currentView = Number(card.dataset.view || 0);
                const nextView = (currentView + 1) % 3;
                card.dataset.view = String(nextView);
                card.classList.toggle('view-1', nextView === 1);
                card.classList.toggle('view-2', nextView === 2);
                card.setAttribute('aria-label', `Ganti tampilan foto, ${nextView + 1} dari 3`);
                card.querySelector('.portrait-view-label').textContent = `PORTRAIT / 0${nextView + 1}`;
            });
        });

        const contactForm = document.querySelector('#contact-form');
        if (contactForm) {
            contactForm.addEventListener('submit', event => {
                event.preventDefault();
                const form = new FormData(event.currentTarget);
                const subject = `Pesan portfolio dari ${form.get('name')}`;
                const body = `Nama: ${form.get('name')}\nEmail: ${form.get('email')}\n\n${form.get('message')}`;
                window.location.href = `mailto:yogiiindrasyahputra8@gmail.com?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
            });
        }

        document.addEventListener('click', event => {
            const link = event.target.closest('a[href]');
            if (!link || link.target || event.defaultPrevented || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;
            const destination = new URL(link.href, window.location.href);
            if (destination.origin !== window.location.origin || destination.hash && destination.pathname === window.location.pathname) return;
            event.preventDefault();
            if (reducedMotion) {
                window.location.assign(destination.href);
                return;
            }
            startLoader();
            window.setTimeout(() => window.location.assign(destination.href), 260);
        });

        const showAll = () => revealItems.forEach(item => item.classList.add('is-visible'));
        const animateStat = element => {
            if (reducedMotion) return;
            const counter = element.querySelector('strong');
            const match = counter?.textContent.trim().match(/^(\d+)(.*)$/);
            if (!match) return;
            const target = Number(match[1]);
            const suffix = match[2];
            const start = performance.now();
            const tick = now => {
                const progress = Math.min((now - start) / 950, 1);
                const eased = 1 - Math.pow(1 - progress, 3);
                const value = String(Math.round(target * eased)).padStart(match[1].length, '0');
                counter.textContent = `${value}${suffix}`;
                if (progress < 1) requestAnimationFrame(tick);
            };
            requestAnimationFrame(tick);
        };

        if (reducedMotion || !('IntersectionObserver' in window)) {
            showAll();
        } else {
            const observer = new IntersectionObserver((entries, currentObserver) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        if (entry.target.classList.contains('stat')) animateStat(entry.target);
                        currentObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.14, rootMargin: '0px 0px -35px 0px' });
            revealItems.forEach(item => observer.observe(item));
        }

        const finishLoading = () => {
            if (loadingFinished) return;
            loadingFinished = true;
            const elapsed = performance.now() - loaderStartedAt;
            const minimumDisplayTime = reducedMotion ? 0 : 650;
            loaderFinishTimer = window.setTimeout(() => {
                const completionStart = performance.now();
                const startValue = loaderValue;
                const completeLoader = now => {
                    const fraction = reducedMotion ? 1 : Math.min((now - completionStart) / 320, 1);
                    setLoaderProgress(startValue + (100 - startValue) * fraction);
                    if (fraction < 1) {
                        requestAnimationFrame(completeLoader);
                        return;
                    }
                    loaderFinishTimer = window.setTimeout(() => {
                        loader.classList.add('is-hidden');
                        document.documentElement.classList.add('is-ready');
                    }, reducedMotion ? 0 : 250);
                };
                requestAnimationFrame(completeLoader);
            }, Math.max(0, minimumDisplayTime - elapsed));
        };

        setLoaderProgress(1);
        if (document.readyState === 'complete') {
            finishLoading();
        } else {
            requestAnimationFrame(tickLoader);
            window.addEventListener('load', finishLoading, { once: true });
        }
    })();
</script>
</body>
</html>
