<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uh Corp</title>
    <meta name="view-transition" content="same-origin">
    <style>
        @font-face {
            font-family: 'Franklin Gothic Medium';
            src: url('font/framd.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Franklin Gothic Medium';
            src: url('font/framdit.ttf') format('truetype');
            font-weight: normal;
            font-style: italic;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background: #2a2a2a;
            display: flex;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            position: relative;
            overflow: hidden;
        }

        .gradient-bg {
            position: fixed;
            inset: 0;
            z-index: 0;
            background:
                radial-gradient(ellipse 80% 60% at 20% 30%, rgba(100, 60, 180, 0.15) 0%, transparent 60%),
                radial-gradient(ellipse 60% 80% at 80% 70%, rgba(60, 140, 200, 0.12) 0%, transparent 60%),
                radial-gradient(ellipse 70% 50% at 50% 50%, rgba(180, 80, 140, 0.08) 0%, transparent 60%);
            animation: gradientShift 12s ease-in-out infinite alternate;
        }

        @keyframes gradientShift {
            0%   { transform: scale(1) rotate(0deg); }
            50%  { transform: scale(1.1) rotate(2deg); }
            100% { transform: scale(1) rotate(-2deg); }
        }

        .blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.3;
            z-index: 0;
            animation: blobFloat 20s ease-in-out infinite;
        }

        .blob:nth-child(1) {
            width: 400px;
            height: 400px;
            background: rgba(120, 80, 200, 0.25);
            top: -10%;
            left: -5%;
            animation-duration: 22s;
            animation-delay: -2s;
        }

        .blob:nth-child(2) {
            width: 350px;
            height: 350px;
            background: rgba(60, 160, 220, 0.2);
            bottom: -8%;
            right: -5%;
            animation-duration: 18s;
            animation-delay: -5s;
        }

        .blob:nth-child(3) {
            width: 250px;
            height: 250px;
            background: rgba(200, 100, 160, 0.15);
            top: 50%;
            left: 60%;
            animation-duration: 25s;
            animation-delay: -8s;
        }

        .blob:nth-child(4) {
            width: 300px;
            height: 300px;
            background: rgba(80, 200, 180, 0.12);
            top: 20%;
            right: 10%;
            animation-duration: 20s;
            animation-delay: -12s;
        }

        @keyframes blobFloat {
            0%   { transform: translate(0, 0) scale(1); }
            25%  { transform: translate(40px, -60px) scale(1.1); }
            50%  { transform: translate(-30px, 40px) scale(0.9); }
            75%  { transform: translate(50px, 30px) scale(1.05); }
            100% { transform: translate(0, 0) scale(1); }
        }

        #morphCanvas {
            position: fixed;
            inset: 0;
            z-index: 1;
            pointer-events: none;
            opacity: 0.5;
        }

        .particle {
            position: fixed;
            width: 3px;
            height: 3px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            z-index: 1;
            pointer-events: none;
            animation: particleFloat linear infinite;
        }

        @keyframes particleFloat {
            0%   { transform: translateY(0) translateX(0); opacity: 0; }
            10%  { opacity: 0.6; }
            50%  { opacity: 0.6; }
            100% { transform: translateY(-100vh) translateX(80px); opacity: 0; }
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 240px;
            height: 100vh;
            z-index: 3;
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-right: 1px solid rgba(255, 255, 255, 0.06);
            display: flex;
            flex-direction: column;
            padding: 32px 24px;
        }

        .sidebar h2 {
            color: rgba(255, 255, 255, 0.5);
            font-weight: 300;
            font-size: 0.75rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            margin-bottom: 24px;
        }

        .sidebar .brand {
            color: rgba(255, 255, 255, 0.85);
            font-family: 'Franklin Gothic Medium', 'Segoe UI', system-ui, sans-serif;
            font-weight: normal;
            font-size: 1.8rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-bottom: 40px;
            padding-bottom: 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        .sidebar nav {
            display: flex;
            flex-direction: column;
            gap: 4px;
            flex: 1;
        }

        .sidebar nav a {
            color: rgba(255, 255, 255, 0.35);
            text-decoration: none;
            font-weight: 300;
            font-size: 0.9rem;
            padding: 10px 14px;
            border-radius: 8px;
            transition: all 0.3s ease;
            letter-spacing: 0.05em;
        }

        .sidebar nav a:hover {
            background: rgba(255, 255, 255, 0.04);
            color: rgba(255, 255, 255, 0.7);
        }

        .sidebar nav a.active {
            background: rgba(255, 255, 255, 0.06);
            color: rgba(255, 255, 255, 0.8);
        }

        .sidebar .footer {
            color: rgba(255, 255, 255, 0.2);
            font-size: 0.7rem;
            font-weight: 300;
            padding-top: 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
        }

        .main {
            margin-left: 240px;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 2;
            min-height: 100vh;
        }

        .frame {
            position: relative;
            width: 640px;
            max-width: 42vw;
            aspect-ratio: 16 / 10;
            border-radius: 32px;
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 40px;
            isolation: isolate;
            animation: fadeIn 0.5s ease-out;
        }

        .frame::before {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: 34px;
            border: 2px solid rgba(255, 255, 255, 0.25);
            mix-blend-mode: difference;
            pointer-events: none;
            z-index: -1;
        }

        .frame::after {
            content: '';
            position: absolute;
            inset: -1px;
            border-radius: 33px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            pointer-events: none;
            z-index: -1;
        }

        .frame h1 {
            color: rgba(255, 255, 255, 0.85);
            font-weight: 300;
            font-size: 2.5rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .frame p {
            color: rgba(255, 255, 255, 0.45);
            font-weight: 300;
            font-size: 1rem;
            letter-spacing: 0.08em;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.97); }
            to   { opacity: 1; transform: scale(1); }
        }

        @keyframes fadeOut {
            from { opacity: 1; transform: scale(1); }
            to   { opacity: 0; transform: scale(0.97); }
        }

        @view-transition {
            navigation: auto;
        }

        ::view-transition-old(root) {
            animation: 0.25s ease-out both fadeOut;
        }

        ::view-transition-new(root) {
            animation: 0.25s ease-in both fadeIn;
        }

        <?php
        for ($i = 0; $i < 40; $i++) {
            $left = rand(0, 100);
            $top = rand(0, 100);
            $delay = rand(0, 200) / 10;
            $dur = rand(15, 30);
            $size = rand(1, 3);
            echo ".p{$i} { left: {$left}%; top: {$top}%; width: {$size}px; height: {$size}px; animation-duration: {$dur}s; animation-delay: {$delay}s; }\n";
        }
        ?>
    </style>
</head>
<body>

    <div class="gradient-bg"></div>
    <div class="blob"></div>
    <div class="blob"></div>
    <div class="blob"></div>
    <div class="blob"></div>
    <canvas id="morphCanvas"></canvas>

    <?php for ($i = 0; $i < 40; $i++): ?>
        <div class="particle p<?= $i ?>"></div>
    <?php endfor; ?>
