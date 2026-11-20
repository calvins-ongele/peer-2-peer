<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head> 
<?php require 'public/includes/header.inc.php' ?>
    <style>
        :root {
            --bg-primary: #0e1015;
            --bg-secondary: #151821;
            --bg-card: #1b1f2b;
            --bg-card-hover: #232838;
            --border-subtle: rgba(255, 255, 255, 0.08);
            --accent-red: #e50914;
            --accent-crimson: #ff2a5f;
            --accent-green: #00e676;
            --accent-green-dark: #00b248;
            --accent-amber: #ff9800;
            --text-muted: #8a93a6;
        }

        * {
            box-sizing: border-box;
            user-select: none;
        }

        body {
            background-color: var(--bg-primary);
            color: #ffffff;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .mono-font {
            font-family: 'JetBrains Mono', monospace;
        }

        /* Navbar */
        .navbar-aviator {
            background-color: var(--bg-secondary);
            border-bottom: 1px solid var(--border-subtle);
            padding: 0.6rem 1rem;
            z-index: 1030;
        }

        .brand-logo {
            font-weight: 900;
            font-style: italic;
            font-size: 1.5rem;
            letter-spacing: -0.5px;
            background: linear-gradient(90deg, #ff2a5f 0%, #e50914 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: flex;
            align-items: center;
            gap: 0.45rem;
            text-decoration: none;
        }

        .brand-icon {
            color: #ff2a5f;
            -webkit-text-fill-color: initial;
            transform: rotate(-15deg);
        }

        .balance-pill {
            background: rgba(0, 230, 118, 0.12);
            border: 1px solid rgba(0, 230, 118, 0.35);
            color: var(--accent-green);
            padding: 0.35rem 0.9rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.45rem;
            transition: transform 0.15s ease, background-color 0.2s ease;
        }

        .balance-pill.bump {
            transform: scale(1.07);
            background: rgba(0, 230, 118, 0.25);
        }

        /* Multiplier History Strip */
        .history-bar-container {
            background-color: var(--bg-secondary);
            border-bottom: 1px solid var(--border-subtle);
            padding: 0.45rem 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            position: relative;
        }

        .history-list {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            overflow-x: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
            flex-grow: 1;
        }

        .history-list::-webkit-scrollbar {
            display: none;
        }

        .multiplier-badge {
            padding: 0.22rem 0.65rem;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 700;
            font-family: 'JetBrains Mono', monospace;
            white-space: nowrap;
            animation: popIn 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes popIn {
            0% { transform: scale(0.6); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }

        .mult-low {
            background: rgba(52, 152, 219, 0.16);
            color: #5dade2;
            border: 1px solid rgba(52, 152, 219, 0.35);
        }

        .mult-mid {
            background: rgba(155, 89, 182, 0.2);
            color: #c39bd3;
            border: 1px solid rgba(155, 89, 182, 0.42);
        }

        .mult-high {
            background: linear-gradient(135deg, rgba(255, 42, 95, 0.28), rgba(255, 170, 0, 0.28));
            color: #ffbe0b;
            border: 1px solid rgba(255, 190, 11, 0.55);
            box-shadow: 0 0 10px rgba(255, 42, 95, 0.22);
        }

        .history-dropdown-panel {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background-color: rgba(21, 24, 33, 0.98);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-subtle);
            padding: 0.85rem 1rem;
            z-index: 1020;
            display: none;
            box-shadow: 0 14px 30px rgba(0, 0, 0, 0.6);
        }

        .history-dropdown-panel.open {
            display: block;
        }

        /* Main Grid */
        .main-wrapper {
            flex-grow: 1;
            padding: 0.75rem;
            max-width: 1620px;
            margin: 0 auto;
            width: 100%;
        }

        /* Sidebar Feed */
        .sidebar-card {
            background-color: var(--bg-secondary);
            border: 1px solid var(--border-subtle);
            border-radius: 16px;
            height: 100%;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .nav-pills-custom {
            background-color: var(--bg-primary);
            padding: 0.25rem;
            border-radius: 50px;
            display: inline-flex;
        }

        .nav-pills-custom .nav-link {
            color: var(--text-muted);
            border-radius: 50px;
            padding: 0.28rem 0.9rem;
            font-size: 0.78rem;
            font-weight: 600;
            transition: all 0.2s;
            border: none;
        }

        .nav-pills-custom .nav-link.active {
            background-color: var(--bg-card-hover);
            color: #ffffff;
        }

        .bets-table-wrapper {
            flex-grow: 1;
            overflow-y: auto;
            max-height: 640px;
            padding: 0 0.5rem 0.5rem;
        }

        .bets-table-wrapper::-webkit-scrollbar {
            width: 5px;
        }

        .bets-table-wrapper::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.16);
            border-radius: 10px;
        }

        .bet-row {
            display: grid;
            grid-template-columns: 1.45fr 0.9fr 0.8fr 1fr;
            align-items: center;
            padding: 0.42rem 0.65rem;
            margin-bottom: 0.28rem;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.02);
            font-size: 0.79rem;
            transition: background-color 0.2s ease, border-color 0.2s ease;
            border: 1px solid transparent;
        }

        .bet-row.cashed-out {
            background-color: rgba(0, 230, 118, 0.11);
            border-color: rgba(0, 230, 118, 0.35);
        }

        .bet-row.is-me {
            border-left: 3px solid var(--accent-crimson);
        }

        .avatar-circle {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.66rem;
            font-weight: 700;
            margin-right: 0.45rem;
            flex-shrink: 0;
            color: #fff;
        }

        /* Canvas Stage */
        .stage-container {
            position: relative;
            background: radial-gradient(circle at 18% 85%, #2a1424 0%, #151924 46%, #0e1015 100%);
            border: 1px solid var(--border-subtle);
            border-radius: 18px;
            overflow: hidden;
            height: 330px;
            min-height: 320px;
            width: 100%;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.45);
        }

        @media (min-width: 768px) {
            .stage-container {
                height: 390px;
            }
        }

        @media (min-width: 1200px) {
            .stage-container {
                height: 430px;
            }
        }

        #aviatorCanvas {
            display: block;
            width: 100%;
            height: 100%;
        }

        .stage-overlay {
            position: absolute;
            inset: 0;
            pointer-events: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 10;
            padding: 1rem;
            text-align: center;
        }

        .multiplier-display {
            font-family: 'JetBrains Mono', monospace;
            font-size: clamp(3.3rem, 7.2vw, 5.4rem);
            font-weight: 800;
            line-height: 1;
            letter-spacing: -2px;
            text-shadow: 0 4px 26px rgba(0, 0, 0, 0.75);
            transition: color 0.15s ease;
        }

        .multiplier-display.flying {
            color: #ffffff;
        }

        .multiplier-display.cashed {
            color: var(--accent-green);
            text-shadow: 0 0 28px rgba(0, 230, 118, 0.55);
        }

        .multiplier-display.crashed {
            color: var(--accent-crimson);
            text-shadow: 0 0 30px rgba(255, 42, 95, 0.65);
        }

        .status-banner {
            font-size: 1.05rem;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 0.45rem;
            padding: 0.25rem 0.95rem;
            border-radius: 50px;
        }

        .status-crashed {
            background: rgba(255, 42, 95, 0.22);
            color: var(--accent-crimson);
            border: 1px solid rgba(255, 42, 95, 0.45);
        }

        .waiting-box {
            background: rgba(14, 16, 21, 0.85);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            padding: 1.4rem 2rem;
            border-radius: 18px;
            max-width: 350px;
            width: 92%;
        }

        .propeller-spinner {
            font-size: 2.2rem;
            color: var(--accent-crimson);
            display: inline-block;
            animation: spinSlow 2.2s linear infinite;
        }

        @keyframes spinSlow {
            100% { transform: rotate(360deg); }
        }

        .countdown-track {
            width: 100%;
            height: 6px;
            background: rgba(255, 255, 255, 0.12);
            border-radius: 10px;
            overflow: hidden;
            margin-top: 0.75rem;
        }

        .countdown-fill {
            height: 100%;
            background: linear-gradient(90deg, #ff2a5f, #e50914);
            width: 100%;
            border-radius: 10px;
        }

        /* Toast Notifications */
        .toast-container-custom {
            position: absolute;
            top: 14px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 25;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            pointer-events: none;
            width: max-content;
            max-width: 92%;
        }

        .cashout-toast {
            background: linear-gradient(135deg, rgba(16, 46, 30, 0.96), rgba(14, 34, 24, 0.96));
            border: 1px solid var(--accent-green);
            color: #fff;
            padding: 0.5rem 1.15rem;
            border-radius: 50px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.55);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.86rem;
            animation: slideDownFade 0.25s ease forwards;
        }

        @keyframes slideDownFade {
            0% { opacity: 0; transform: translateY(-12px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* Betting Control Panels */
        .bet-panel-card {
            background-color: var(--bg-secondary);
            border: 1px solid var(--border-subtle);
            border-radius: 18px;
            padding: 1rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .bet-panel-card.active-bet {
            border-color: rgba(255, 152, 0, 0.55);
            box-shadow: 0 0 22px rgba(255, 152, 0, 0.1);
        }

        .bet-panel-card.queued-bet {
            border-color: rgba(255, 42, 95, 0.55);
        }

        .bet-input-group {
            background-color: var(--bg-primary);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 50px;
            padding: 0.25rem 0.45rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .bet-input-group input {
            background: transparent;
            border: none;
            color: #fff;
            font-family: 'JetBrains Mono', monospace;
            font-weight: 700;
            font-size: 1.05rem;
            text-align: center;
            width: 100%;
            outline: none;
        }

        .bet-input-group input:disabled {
            opacity: 0.55;
        }

        .btn-circle-step {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.15);
            background: var(--bg-card);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
            flex-shrink: 0;
            transition: background 0.15s;
        }

        .btn-circle-step:hover:not(:disabled) {
            background: var(--bg-card-hover);
        }

        .btn-quick-chip {
            background-color: var(--bg-primary);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: #cbd5e1;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            font-family: 'JetBrains Mono', monospace;
            padding: 0.25rem 0.4rem;
            transition: all 0.15s;
        }

        .btn-quick-chip:hover:not(:disabled) {
            background-color: var(--bg-card-hover);
            color: #fff;
            border-color: rgba(255, 255, 255, 0.25);
        }

        .btn-action-main {
            width: 100%;
            height: 100%;
            min-height: 78px;
            border-radius: 16px;
            border: none;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: transform 0.1s ease, filter 0.15s ease;
            cursor: pointer;
        }

        .btn-action-main:active:not(:disabled) {
            transform: scale(0.97);
        }

        .btn-state-bet {
            background: linear-gradient(180deg, #00e676 0%, #00b248 100%);
            color: #071b0e;
            box-shadow: 0 6px 20px rgba(0, 230, 118, 0.32);
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        .btn-state-bet:hover {
            filter: brightness(1.07);
        }

        .btn-state-cancel {
            background: linear-gradient(180deg, #ff2a5f 0%, #c8102e 100%);
            color: #ffffff;
            box-shadow: 0 6px 20px rgba(255, 42, 95, 0.35);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-state-cashout {
            background: linear-gradient(180deg, #ffb300 0%, #f57c00 100%);
            color: #140b00;
            box-shadow: 0 6px 24px rgba(255, 152, 0, 0.45);
            border: 1px solid rgba(255, 255, 255, 0.35);
        }

        .btn-state-cashout:hover {
            filter: brightness(1.07);
        }

        .btn-state-disabled {
            background: #232836;
            color: #6c7589;
            cursor: not-allowed;
            border: 1px solid rgba(255, 255, 255, 0.06);
        }

        .auto-controls-row {
            border-top: 1px solid var(--border-subtle);
            padding-top: 0.65rem;
            margin-top: 0.65rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.65rem;
            flex-wrap: wrap;
        }

        .auto-mult-input {
            background-color: var(--bg-primary);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 50px;
            color: #fff;
            font-family: 'JetBrains Mono', monospace;
            font-weight: 700;
            font-size: 0.84rem;
            width: 80px;
            padding: 0.2rem 0.55rem;
            text-align: center;
        }

        .form-check-input:checked {
            background-color: var(--accent-green);
            border-color: var(--accent-green);
        }

        .modal-content {
            background-color: var(--bg-secondary);
            border: 1px solid var(--border-subtle);
            border-radius: 18px;
        }
        /* Qualified Popup Modal Styling */
        .congrats-modal-header {
            background: linear-gradient(135deg, var(--body-primary-background) 0%, var(--accent-color) 100%);
            color: white;
            border-radius: 1rem 1rem 0 0;
            padding: 2.5rem 1.5rem 1.5rem 1.5rem;
            text-align: center;
            position: relative;
        }

        .congrats-badge-icon {
            width: 70px;
            height: 70px;
            background: #ffffff;
            color: var(--body-primary-background);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            margin: 0 auto 1rem auto;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body>

    <!-- Top Navbar -->
    <nav class="navbar navbar-aviator sticky-top">
        <div class="container-fluid px-1 px-md-3">
            <div class="d-flex align-items-center gap-3">
                <a class="brand-logo m-0" href="#top">
                    <i class="bi bi-airplane-fill brand-icon"></i>
                    <span>AVIATOR</span>
                </a>
                <span class="badge rounded-pill bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 d-none d-sm-inline-block">
                    PROVABLY FAIR
                </span>
            </div>

            <div class="d-flex align-items-center gap-2 gap-md-3">
                <!-- Wallet Balance Pill -->
                <div class="balance-pill" id="balanceDisplayWrapper" title="Simulated Balance">
                    <i class="bi bi-wallet2"></i>
                    <span class="mono-font" id="userBalance">$1,000.00</span>
                    <button type="button" class="btn btn-sm btn-success rounded-pill py-0 px-2 ms-1 fw-bold" id="topUpBalanceBtn" style="display: none; font-size: 0.72rem;">
                        + Top Up
                    </button>
                </div>

                <!-- Sound Toggle -->
                <button type="button" class="btn btn-outline-secondary btn-sm rounded-circle d-flex align-items-center justify-content-center"
                        id="soundToggleBtn" style="width: 36px; height: 36px;" title="Mute / Unmute Sound">
                    <i class="bi bi-volume-up-fill fs-6" id="soundIcon"></i>
                </button>

                <!-- How to Play Modal Trigger -->
                <button type="button" class="btn btn-outline-warning btn-sm rounded-pill px-3 fw-semibold d-flex align-items-center gap-1"
                        data-bs-toggle="modal" data-bs-target="#howToPlayModal">
                    <i class="bi bi-question-circle"></i>
                    <span class="d-none d-sm-inline">How to Play</span>
                </button>
            </div>
        </div>
    </nav>

    <!-- Recent Multipliers History Bar -->
    <div class="history-bar-container">
        <span class="text-uppercase fw-bold text-secondary small d-flex align-items-center gap-1" style="font-size: 0.72rem; letter-spacing: 0.5px;">
            <i class="bi bi-clock-history"></i> History
        </span>
        <div class="history-list" id="historyStrip"></div>
        <button type="button" class="btn btn-dark btn-sm rounded-pill border border-secondary border-opacity-25 px-2 py-0 d-flex align-items-center gap-1" id="toggleHistoryDropdownBtn" title="Expand Round History">
            <i class="bi bi-chevron-down small" id="historyDropdownIcon"></i>
        </button>

        <!-- Expandable History Dropdown -->
        <div class="history-dropdown-panel" id="historyDropdownPanel">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="small fw-bold text-uppercase text-secondary">Recent 30 Rounds History</span>
                <span class="small text-secondary">Blue: &lt;2x • Purple: 2x–9.99x • Gold: 10x+</span>
            </div>
            <div class="d-flex flex-wrap gap-2" id="expandedHistoryGrid"></div>
        </div>
    </div>

    <!-- Main Game Content -->
    <div class="main-wrapper">
        <div class="row g-3">

            <!-- Left Sidebar: All Bets / My Bets / Top -->
            <div class="col-12 col-lg-4 col-xl-3 order-2 order-lg-1">
                <div class="sidebar-card">
                    <div class="p-3 border-bottom border-secondary border-opacity-25">
                        <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap gap-1">
                            <ul class="nav nav-pills-custom" id="sidebarTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="all-bets-tab" data-bs-toggle="pill" data-bs-target="#all-bets-pane" type="button" role="tab">
                                        All Bets
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="my-bets-tab" data-bs-toggle="pill" data-bs-target="#my-bets-pane" type="button" role="tab">
                                        My Bets <span class="badge bg-danger rounded-pill ms-1" id="myBetsCount">0</span>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="top-bets-tab" data-bs-toggle="pill" data-bs-target="#top-bets-pane" type="button" role="tab">
                                        Top
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <div class="d-flex justify-content-between align-items-center bg-dark bg-opacity-50 rounded-3 px-2 py-1">
                            <span class="small text-secondary" style="font-size: 0.74rem;">
                                Players: <strong class="text-white mono-font" id="liveTotalPlayers">0</strong>
                            </span>
                            <span class="small text-secondary" style="font-size: 0.74rem;">
                                Pool: <strong class="mono-font text-success" id="liveTotalPool">$0.00</strong>
                            </span>
                        </div>
                    </div>

                    <div class="tab-content flex-grow-1 d-flex flex-column">
                        <!-- Tab 1: All Live Bets -->
                        <div class="tab-pane fade show active flex-grow-1" id="all-bets-pane" role="tabpanel">
                            <div class="px-3 py-2 d-grid text-secondary fw-semibold" style="grid-template-columns: 1.45fr 0.9fr 0.8fr 1fr; font-size: 0.72rem;">
                                <span>PLAYER</span>
                                <span class="text-end">BET</span>
                                <span class="text-center">MULT</span>
                                <span class="text-end">CASH OUT</span>
                            </div>
                            <div class="bets-table-wrapper" id="liveBetsList"></div>
                        </div>

                        <!-- Tab 2: My Bets -->
                        <div class="tab-pane fade flex-grow-1" id="my-bets-pane" role="tabpanel">
                            <div class="px-3 py-2 d-grid text-secondary fw-semibold" style="grid-template-columns: 1fr 0.9fr 0.8fr 1fr; font-size: 0.72rem;">
                                <span>TIME</span>
                                <span class="text-end">BET</span>
                                <span class="text-center">MULT</span>
                                <span class="text-end">WIN</span>
                            </div>
                            <div class="bets-table-wrapper" id="myBetsList">
                                <div class="text-center text-secondary py-5 small">
                                    <i class="bi bi-ticket-perforated fs-3 d-block mb-2 opacity-50"></i>
                                    No bets placed yet.<br>Place a bet below to take off!
                                </div>
                            </div>
                        </div>

                        <!-- Tab 3: Top Multipliers -->
                        <div class="tab-pane fade flex-grow-1" id="top-bets-pane" role="tabpanel">
                            <div class="px-3 py-2 d-grid text-secondary fw-semibold" style="grid-template-columns: 1.4fr 0.9fr 0.8fr 1fr; font-size: 0.72rem;">
                                <span>PLAYER</span>
                                <span class="text-end">BET</span>
                                <span class="text-center">MULT</span>
                                <span class="text-end">PAYOUT</span>
                            </div>
                            <div class="bets-table-wrapper" id="topBetsList"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right/Center Flight Stage & Dual Betting Controls -->
            <div class="col-12 col-lg-8 col-xl-9 order-1 order-lg-2 d-flex flex-column gap-3">

                <!-- HTML5 Canvas Flight Stage -->
                <div class="stage-container" id="stageContainer">
                    <canvas id="aviatorCanvas"></canvas>

                    <!-- Cashout Toast Notifications -->
                    <div class="toast-container-custom" id="toastContainer"></div>

                    <!-- Center Overlay Readout -->
                    <div class="stage-overlay">
                        <!-- Waiting Countdown Overlay -->
                        <div class="waiting-box" id="waitingOverlay" style="display: none;">
                            <div class="propeller-spinner mb-2">
                                <i class="bi bi-fan"></i>
                            </div>
                            <h6 class="fw-bold text-uppercase mb-1">Waiting for Next Round</h6>
                            <div class="small text-secondary mb-2">
                                Place your bets before takeoff (<span class="mono-font text-white" id="countdownSecondsText">5.0s</span>)
                            </div>
                            <div class="countdown-track">
                                <div class="countdown-fill" id="countdownProgressBar"></div>
                            </div>
                        </div>

                        <!-- Active Flight / Crash Multiplier Readout -->
                        <div id="flightOverlay">
                            <div class="status-banner status-crashed mb-2" id="flewAwayBanner" style="display: none;">
                                FLEW AWAY!
                            </div>
                            <div class="multiplier-display flying" id="mainMultiplierText">1.00x</div>
                        </div>
                    </div>

                    <!-- Bottom Left Provably Fair Hash Pill -->
                    <div class="position-absolute bottom-0 start-0 p-2 px-3 d-none d-sm-flex align-items-center gap-2 opacity-50" style="font-size: 0.7rem; pointer-events: none;">
                        <i class="bi bi-shield-check text-success"></i>
                        <span class="mono-font" id="roundHashLabel">ROUND #10482 • SHA256 VERIFIED</span>
                    </div>
                </div>

                <!-- Dual Independent Betting Panels -->
                <div class="row g-3">
                    <!-- Panel 1 -->
                    <div class="col-12 col-md-6">
                        <div class="bet-panel-card" id="betPanel1">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="nav nav-pills-custom">
                                    <button class="nav-link active py-1 px-3" type="button" data-panel="1" data-mode="manual">Bet</button>
                                    <button class="nav-link py-1 px-3" type="button" data-panel="1" data-mode="auto">Auto</button>
                                </div>
                                <span class="badge bg-dark text-secondary border border-secondary border-opacity-25 mono-font" style="font-size: 0.7rem;">PANEL 1</span>
                            </div>

                            <div class="row g-2 align-items-stretch">
                                <div class="col-6 d-flex flex-column justify-content-between gap-2">
                                    <div class="bet-input-group">
                                        <button class="btn-circle-step" type="button" data-action="step" data-panel="1" data-delta="-5">−</button>
                                        <input type="number" id="betAmount1" data-panel="1" value="10.00" min="1" max="10000" step="1">
                                        <button class="btn-circle-step" type="button" data-action="step" data-panel="1" data-delta="5">+</button>
                                    </div>
                                    <div class="row g-1">
                                        <div class="col-4"><button class="btn-quick-chip w-100" type="button" data-action="add" data-panel="1" data-amount="10">+10</button></div>
                                        <div class="col-4"><button class="btn-quick-chip w-100" type="button" data-action="add" data-panel="1" data-amount="50">+50</button></div>
                                        <div class="col-4"><button class="btn-quick-chip w-100" type="button" data-action="add" data-panel="1" data-amount="100">+100</button></div>
                                        <div class="col-4"><button class="btn-quick-chip w-100" type="button" data-action="add" data-panel="1" data-amount="500">+500</button></div>
                                        <div class="col-4"><button class="btn-quick-chip w-100" type="button" data-action="mult" data-panel="1" data-factor="0.5">½</button></div>
                                        <div class="col-4"><button class="btn-quick-chip w-100" type="button" data-action="mult" data-panel="1" data-factor="2">2x</button></div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <button type="button" class="btn-action-main btn-state-bet" id="actionBtn1" data-action="primary" data-panel="1">
                                        <span class="fs-5" id="actionTitle1">BET</span>
                                        <span class="mono-font small opacity-90" id="actionSub1">$10.00</span>
                                    </button>
                                </div>
                            </div>

                            <div class="auto-controls-row">
                                <div class="d-flex align-items-center gap-3 flex-wrap">
                                    <div class="form-check form-switch m-0 d-flex align-items-center gap-2">
                                        <input class="form-check-input mt-0" type="checkbox" role="switch" id="autoCashoutSwitch1">
                                        <label class="form-check-label small text-secondary fw-medium" for="autoCashoutSwitch1">Auto Cash Out</label>
                                    </div>
                                    <div class="form-check form-switch m-0 d-none align-items-center gap-2" id="autoBetWrapper1">
                                        <input class="form-check-input mt-0" type="checkbox" role="switch" id="autoBetSwitch1" data-panel="1">
                                        <label class="form-check-label small text-info fw-medium" for="autoBetSwitch1">Auto Bet</label>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <input type="number" class="auto-mult-input" id="autoCashoutTarget1" value="2.00" min="1.01" max="1000" step="0.10">
                                    <span class="text-secondary fw-bold small">x</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Panel 2 -->
                    <div class="col-12 col-md-6">
                        <div class="bet-panel-card" id="betPanel2">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="nav nav-pills-custom">
                                    <button class="nav-link active py-1 px-3" type="button" data-panel="2" data-mode="manual">Bet</button>
                                    <button class="nav-link py-1 px-3" type="button" data-panel="2" data-mode="auto">Auto</button>
                                </div>
                                <span class="badge bg-dark text-secondary border border-secondary border-opacity-25 mono-font" style="font-size: 0.7rem;">PANEL 2</span>
                            </div>

                            <div class="row g-2 align-items-stretch">
                                <div class="col-6 d-flex flex-column justify-content-between gap-2">
                                    <div class="bet-input-group">
                                        <button class="btn-circle-step" type="button" data-action="step" data-panel="2" data-delta="-5">−</button>
                                        <input type="number" id="betAmount2" data-panel="2" value="25.00" min="1" max="10000" step="1">
                                        <button class="btn-circle-step" type="button" data-action="step" data-panel="2" data-delta="5">+</button>
                                    </div>
                                    <div class="row g-1">
                                        <div class="col-4"><button class="btn-quick-chip w-100" type="button" data-action="add" data-panel="2" data-amount="10">+10</button></div>
                                        <div class="col-4"><button class="btn-quick-chip w-100" type="button" data-action="add" data-panel="2" data-amount="50">+50</button></div>
                                        <div class="col-4"><button class="btn-quick-chip w-100" type="button" data-action="add" data-panel="2" data-amount="100">+100</button></div>
                                        <div class="col-4"><button class="btn-quick-chip w-100" type="button" data-action="add" data-panel="2" data-amount="500">+500</button></div>
                                        <div class="col-4"><button class="btn-quick-chip w-100" type="button" data-action="mult" data-panel="2" data-factor="0.5">½</button></div>
                                        <div class="col-4"><button class="btn-quick-chip w-100" type="button" data-action="mult" data-panel="2" data-factor="2">2x</button></div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <button type="button" class="btn-action-main btn-state-bet" id="actionBtn2" data-action="primary" data-panel="2">
                                        <span class="fs-5" id="actionTitle2">BET</span>
                                        <span class="mono-font small opacity-90" id="actionSub2">$25.00</span>
                                    </button>
                                </div>
                            </div>

                            <div class="auto-controls-row">
                                <div class="d-flex align-items-center gap-3 flex-wrap">
                                    <div class="form-check form-switch m-0 d-flex align-items-center gap-2">
                                        <input class="form-check-input mt-0" type="checkbox" role="switch" id="autoCashoutSwitch2" checked>
                                        <label class="form-check-label small text-secondary fw-medium" for="autoCashoutSwitch2">Auto Cash Out</label>
                                    </div>
                                    <div class="form-check form-switch m-0 d-none align-items-center gap-2" id="autoBetWrapper2">
                                        <input class="form-check-input mt-0" type="checkbox" role="switch" id="autoBetSwitch2" data-panel="2">
                                        <label class="form-check-label small text-info fw-medium" for="autoBetSwitch2">Auto Bet</label>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <input type="number" class="auto-mult-input" id="autoCashoutTarget2" value="1.50" min="1.01" max="1000" step="0.10">
                                    <span class="text-secondary fw-bold small">x</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- How to Play Modal -->
    <div class="modal fade" id="howToPlayModal" tabindex="-1" aria-labelledby="howToPlayLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-secondary border-opacity-25">
                    <h5 class="modal-title fw-bold d-flex align-items-center gap-2" id="howToPlayLabel">
                        <i class="bi bi-airplane-engines text-danger"></i> How to Play Aviator
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-light small">
                    <div class="d-flex gap-3 mb-3 align-items-start">
                        <span class="badge bg-danger rounded-circle p-2 fs-6">1</span>
                        <div>
                            <h6 class="fw-bold mb-1">Place Your Bet(s)</h6>
                            <p class="text-secondary mb-0">Choose your stake on one or both panels before takeoff, or queue your bet during an active flight for the upcoming round.</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3 mb-3 align-items-start">
                        <span class="badge bg-warning text-dark rounded-circle p-2 fs-6">2</span>
                        <div>
                            <h6 class="fw-bold mb-1">Watch the Multiplier Climb</h6>
                            <p class="text-secondary mb-0">As the red plane climbs into the sky, the win multiplier rises from <strong>1.00x</strong> upward.</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3 mb-2 align-items-start">
                        <span class="badge bg-success rounded-circle p-2 fs-6">3</span>
                        <div>
                            <h6 class="fw-bold mb-1">Cash Out Before It Flies Away!</h6>
                            <p class="text-secondary mb-0">Hit <strong>CASH OUT</strong> (or enable <strong>Auto Cash Out</strong>) before the plane flies away to lock in your bet multiplied by the current odds.</p>
                        </div>
                    </div>
                    <hr class="border-secondary border-opacity-25 my-3">
                    <div class="bg-dark bg-opacity-50 p-3 rounded-3 border border-secondary border-opacity-25">
                        <div class="d-flex align-items-center gap-2 text-success fw-bold mb-1">
                            <i class="bi bi-shield-lock-fill"></i> Provably Fair Engine
                        </div>
                        <p class="text-secondary mb-2" style="font-size: 0.78rem;">
                            Every round's crash multiplier is generated before takeoff using a cryptographic SHA-256 hash seed.
                        </p>
                        <div class="mono-font text-light bg-black bg-opacity-50 p-2 rounded text-truncate" style="font-size: 0.72rem;" id="modalSeedHash">
                            Round #10482 Seed: 9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-secondary border-opacity-25">
                    <button type="button" class="btn btn-danger rounded-pill px-4 fw-semibold" data-bs-dismiss="modal">Got It, Let's Fly!</button>
                </div>
            </div>
        </div>
    </div>


    
       <!-- COLORFUL CONGRATULATIONS RESULT MODAL -->
        <div class="modal fade" id="loginNededModal" tabindex="-1"  data-bs-backdrop="static" data-bs-keyboard="false"  aria-hidden="true">
    
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg overflow-hidden" style="border-radius: 1rem;">
                <div class="congrats-modal-header">
                    <div class="congrats-badge-icon">
                        <i class="bi bi-person"></i>
                    </div>
                    <h3 class="fw-extrabold mb-1">Heads Up!</h3>
                    <p class="mb-0 opacity-90 small">You need to login to continue</p>
                </div>
                <div class="modal-body text-center p-4"> 

                    <a href="/account?return=<?= urlencode('/aviator') ?>" class=" btn btn-action btn-warning w-100 justify-content-center py-3 fs-6"
                      >
                        Login Now <i class="bi bi-arrow-right-circle-fill"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
 
    <?php require 'public/includes/footer.inc.php' ?>
    <!-- Clean Single-Block Game Engine -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            /**
             * 1. WEB AUDIO API PROCEDURAL SOUND SYNTHESIZER
             */
            class SoundEngine {
                constructor() {
                    this.ctx = null;
                    this.enabled = true;
                    this.turbineOsc = null;
                    this.turbineGain = null;
                }

                init() {
                    if (!this.ctx) {
                        const AudioCtx = window.AudioContext || window.webkitAudioContext;
                        if (AudioCtx) {
                            this.ctx = new AudioCtx();
                        }
                    }
                    if (this.ctx && this.ctx.state === 'suspended') {
                        this.ctx.resume().catch(() => {});
                    }
                }

                toggle() {
                    this.enabled = !this.enabled;
                    if (!this.enabled) {
                        this.stopTurbineHum();
                    }
                    return this.enabled;
                }

                playClick() {
                    if (!this.enabled) return;
                    this.init();
                    if (!this.ctx) return;

                    const now = this.ctx.currentTime;
                    const osc = this.ctx.createOscillator();
                    const gain = this.ctx.createGain();
                    osc.type = 'triangle';
                    osc.frequency.setValueAtTime(520, now);
                    osc.frequency.exponentialRampToValueAtTime(790, now + 0.08);

                    gain.gain.setValueAtTime(0.14, now);
                    gain.gain.exponentialRampToValueAtTime(0.001, now + 0.09);

                    osc.connect(gain);
                    gain.connect(this.ctx.destination);
                    osc.start(now);
                    osc.stop(now + 0.09);
                }

                startTurbineHum() {
                    if (!this.enabled) return;
                    this.init();
                    if (!this.ctx || this.turbineOsc) return;

                    const now = this.ctx.currentTime;
                    const osc = this.ctx.createOscillator();
                    const filter = this.ctx.createBiquadFilter();
                    const gain = this.ctx.createGain();

                    osc.type = 'sawtooth';
                    osc.frequency.setValueAtTime(95, now);

                    filter.type = 'lowpass';
                    filter.frequency.setValueAtTime(340, now);

                    gain.gain.setValueAtTime(0.001, now);
                    gain.gain.linearRampToValueAtTime(0.045, now + 0.35);

                    osc.connect(filter);
                    filter.connect(gain);
                    gain.connect(this.ctx.destination);
                    osc.start(now);

                    this.turbineOsc = osc;
                    this.turbineGain = gain;
                }

                updateTurbinePitch(multiplier) {
                    if (!this.ctx || !this.turbineOsc || !this.enabled) return;
                    const pitch = Math.min(260, 95 + (multiplier - 1) * 14);
                    this.turbineOsc.frequency.setTargetAtTime(pitch, this.ctx.currentTime, 0.1);
                }

                stopTurbineHum() {
                    if (this.turbineOsc) {
                        try {
                            this.turbineOsc.stop();
                            this.turbineOsc.disconnect();
                        } catch (e) {}
                        this.turbineOsc = null;
                        this.turbineGain = null;
                    }
                }

                playCashout() {
                    if (!this.enabled) return;
                    this.init();
                    if (!this.ctx) return;

                    const now = this.ctx.currentTime;
                    const notes = [587.33, 880, 1174.66];
                    notes.forEach((freq, idx) => {
                        const osc = this.ctx.createOscillator();
                        const gain = this.ctx.createGain();
                        osc.type = 'sine';
                        osc.frequency.setValueAtTime(freq, now + idx * 0.06);

                        gain.gain.setValueAtTime(0.16, now + idx * 0.06);
                        gain.gain.exponentialRampToValueAtTime(0.001, now + idx * 0.06 + 0.32);

                        osc.connect(gain);
                        gain.connect(this.ctx.destination);
                        osc.start(now + idx * 0.06);
                        osc.stop(now + idx * 0.06 + 0.32);
                    });
                }

                playFlyAway() {
                    this.stopTurbineHum();
                    if (!this.enabled) return;
                    this.init();
                    if (!this.ctx) return;

                    const now = this.ctx.currentTime;
                    const osc = this.ctx.createOscillator();
                    const gain = this.ctx.createGain();
                    const filter = this.ctx.createBiquadFilter();

                    osc.type = 'sawtooth';
                    osc.frequency.setValueAtTime(350, now);
                    osc.frequency.exponentialRampToValueAtTime(65, now + 0.55);

                    filter.type = 'lowpass';
                    filter.frequency.setValueAtTime(850, now);
                    filter.frequency.exponentialRampToValueAtTime(140, now + 0.55);

                    gain.gain.setValueAtTime(0.18, now);
                    gain.gain.exponentialRampToValueAtTime(0.001, now + 0.58);

                    osc.connect(filter);
                    filter.connect(gain);
                    gain.connect(this.ctx.destination);
                    osc.start(now);
                    osc.stop(now + 0.58);
                }
            }

            const sound = new SoundEngine();

            /**
             * 2. DOM REFERENCES & GAME STATE
             */
            const GAME_PHASE = {
                WAITING: 'WAITING',
                FLYING: 'FLYING',
                CRASHED: 'CRASHED'
            };

            const dom = {
                userBalance: document.getElementById('userBalance'),
                balanceWrapper: document.getElementById('balanceDisplayWrapper'),
                topUpBtn: document.getElementById('topUpBalanceBtn'),
                soundBtn: document.getElementById('soundToggleBtn'),
                soundIcon: document.getElementById('soundIcon'),
                historyStrip: document.getElementById('historyStrip'),
                toggleHistoryBtn: document.getElementById('toggleHistoryDropdownBtn'),
                historyDropdownIcon: document.getElementById('historyDropdownIcon'),
                historyDropdownPanel: document.getElementById('historyDropdownPanel'),
                expandedHistoryGrid: document.getElementById('expandedHistoryGrid'),
                stageContainer: document.getElementById('stageContainer'),
                canvas: document.getElementById('aviatorCanvas'),
                toastContainer: document.getElementById('toastContainer'),
                waitingOverlay: document.getElementById('waitingOverlay'),
                countdownSeconds: document.getElementById('countdownSecondsText'),
                countdownBar: document.getElementById('countdownProgressBar'),
                flightOverlay: document.getElementById('flightOverlay'),
                flewAwayBanner: document.getElementById('flewAwayBanner'),
                mainMultiplier: document.getElementById('mainMultiplierText'),
                roundHashLabel: document.getElementById('roundHashLabel'),
                modalSeedHash: document.getElementById('modalSeedHash'),
                liveTotalPlayers: document.getElementById('liveTotalPlayers'),
                liveTotalPool: document.getElementById('liveTotalPool'),
                liveBetsList: document.getElementById('liveBetsList'),
                myBetsCount: document.getElementById('myBetsCount'),
                myBetsList: document.getElementById('myBetsList'),
                topBetsList: document.getElementById('topBetsList'),
                loginNededModal: new bootstrap.Modal(document.getElementById('loginNededModal'))
            };

            const isLoggedIn = parseInt(`<?= (Session::get('userid') !== null) ? 1 : 0 ?>`);
            if (isLoggedIn !== 1) {
                dom.loginNededModal.show();
            }

            
            const ctx = dom.canvas.getContext('2d');

            const state = {
                balance: Number(`<?= $this->_me['user_balance'] ?>`),
                phase: GAME_PHASE.FLYING,
                roundId: 10482,
                currentMultiplier: 1.00,
                crashPoint: 4.50,
                flightElapsedSec: 0,
                waitingDurationMs: 5000,
                waitingRemainingMs: 0,
                crashedRemainingMs: 0,
                lastFrameTime: 0,
                history: [
                    1.45, 3.82, 1.04, 12.60, 2.15, 1.88, 5.40, 1.12, 24.30, 1.67,
                    2.95, 1.00, 4.18, 8.75, 1.33, 6.40, 1.92, 15.20, 2.48, 1.18,
                    3.10, 1.54, 11.05, 2.75, 1.08, 4.90, 2.02, 7.65, 1.41, 18.90
                ],
                myBetsHistory: [],
                simulatedBots: [],
                topRecords: [
                    { name: 'CryptoAce', bet: 250, mult: 48.20, payout: 12050.00, color: '#e50914' },
                    { name: 'SkyKing_99', bet: 150, mult: 34.50, payout: 5175.00, color: '#8e44ad' },
                    { name: 'NairobiJet', bet: 200, mult: 24.30, payout: 4860.00, color: '#16a085' },
                    { name: 'MaverickX', bet: 100, mult: 29.80, payout: 2980.00, color: '#2980b9' },
                    { name: 'RedBaron', bet: 75, mult: 21.40, payout: 1605.00, color: '#d35400' },
                    { name: 'LunaStar', bet: 50, mult: 18.90, payout: 945.00, color: '#27ae60' }
                ],
                panels: {
                    1: {
                        mode: 'manual',
                        autoBetEnabled: false,
                        betAmount: 10.00,
                        status: 'IDLE', // 'IDLE' | 'QUEUED' | 'ACTIVE' | 'CASHED_OUT'
                        activeBetAmount: 0,
                        cashedOutAt: 0
                    },
                    2: {
                        mode: 'manual',
                        autoBetEnabled: false,
                        betAmount: 25.00,
                        status: 'IDLE',
                        activeBetAmount: 0,
                        cashedOutAt: 0
                    }
                }
            };

            // Single, unique canvasState declaration
            const canvasState = {
                width: 800,
                height: 360,
                particles: [],
                clouds: [],
                gridOffsetX: 0,
                gridOffsetY: 0,
                planeX: 60,
                planeY: 300,
                planeAngle: -0.25,
                propellerPhase: 0
            };

            const BOT_NAMES = [
                'SkyKing_99', 'AlexV', 'CryptoAce', 'NairobiJet', 'MaverickX', 'LunaStar',
                'RedBaron', 'TurboBet', 'Viper_07', 'LuckyStrike', 'JetStream', 'NovaPilot',
                'ApexGamer', 'ShadowFox', 'GoldRush', 'FalconEye', 'ZeroGravity', 'BlazeRunner',
                'StormRider', 'PixelPro', 'HighFlyer', 'AceHigh', 'DriftKing', 'CosmoBet'
            ];

            const AVATAR_COLORS = ['#e50914', '#8e44ad', '#2980b9', '#16a085', '#d35400', '#c0392b', '#27ae60'];

            /**
             * 3. CRASH POINT GENERATOR & CANVAS SIZING
             */
            function generateCrashPoint(minFloor = 1.00) {
                const r = Math.random();
                if (minFloor <= 1.00 && r < 0.05) {
                    return Number((1.00 + Math.random() * 0.06).toFixed(2));
                }
                const raw = 0.96 / (1 - r);
                const clamped = Math.min(raw, 150.00);
                return Number(Math.max(minFloor, clamped).toFixed(2));
            }

            function initClouds() {
                canvasState.clouds = Array.from({ length: 6 }, (_, i) => ({
                    x: (i / 6) * canvasState.width + Math.random() * 120,
                    y: 40 + Math.random() * (canvasState.height * 0.55),
                    scale: 0.65 + Math.random() * 0.75,
                    speed: 18 + Math.random() * 24,
                    alpha: 0.05 + Math.random() * 0.06
                }));
            }

            function resizeCanvas() {
                const rect = dom.stageContainer.getBoundingClientRect();
                const width = Math.max(300, Math.floor(rect.width || dom.stageContainer.clientWidth || 800));
                const height = Math.max(320, Math.floor(rect.height || dom.stageContainer.clientHeight || 360));
                const dpr = Math.min(window.devicePixelRatio || 1, 2);

                canvasState.width = width;
                canvasState.height = height;
                dom.canvas.width = width * dpr;
                dom.canvas.height = height * dpr;
                ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
            }

            window.addEventListener('resize', resizeCanvas);
            if (typeof ResizeObserver !== 'undefined') {
                const ro = new ResizeObserver(() => resizeCanvas());
                ro.observe(dom.stageContainer);
            }

            /**
             * 4. UI RENDERERS (BALANCE, HISTORY, TOASTS, SIDEBAR)
             */
            function updateBalanceUI(bump = false) {
                dom.userBalance.textContent = `$${state.balance.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                })}`;
                dom.topUpBtn.style.display = state.balance < 25 ? 'inline-block' : 'none';

                if (bump) {
                    dom.balanceWrapper.classList.remove('bump');
                    void dom.balanceWrapper.offsetWidth;
                    dom.balanceWrapper.classList.add('bump');
                }
            }

            function createMultiplierBadge(val) {
                const badge = document.createElement('span');
                let tierClass = 'mult-low';
                if (val >= 10) tierClass = 'mult-high';
                else if (val >= 2) tierClass = 'mult-mid';
                badge.className = `multiplier-badge ${tierClass}`;
                badge.textContent = `${val.toFixed(2)}x`;
                return badge;
            }

            function renderHistoryStrip() {
                dom.historyStrip.innerHTML = '';
                state.history.slice(0, 18).forEach(val => {
                    dom.historyStrip.appendChild(createMultiplierBadge(val));
                });

                dom.expandedHistoryGrid.innerHTML = '';
                state.history.slice(0, 30).forEach(val => {
                    dom.expandedHistoryGrid.appendChild(createMultiplierBadge(val));
                });
            }

            function showCashoutToast(mult, winAmount) {
                const toast = document.createElement('div');
                toast.className = 'cashout-toast';
                toast.innerHTML = `
                    <i class="bi bi-check-circle-fill text-success fs-5"></i>
                    <div>
                        <div class="small text-secondary" style="font-size: 0.72rem;">Cashed out @ <strong class="text-white">${mult.toFixed(2)}x</strong></div>
                        <div class="fw-bold mono-font text-success">+$${winAmount.toFixed(2)}</div>
                    </div>
                `;
                dom.toastContainer.appendChild(toast);
                setTimeout(() => {
                    toast.style.opacity = '0';
                    toast.style.transition = 'opacity 0.25s ease';
                    setTimeout(() => toast.remove(), 260);
                }, 3000);
            }

            function generateSimulatedBots() {
                const count = 22;
                const shuffled = [...BOT_NAMES].sort(() => 0.5 - Math.random()).slice(0, count);

                state.simulatedBots = shuffled.map((name, idx) => {
                    const bet = [5, 10, 15, 20, 25, 50, 75, 100, 150, 250][Math.floor(Math.random() * 10)];  
                    const r = Math.random();
                    let targetMult;
                    if (r < 0.45) targetMult = 1.15 + Math.random() * 0.85;
                    else if (r < 0.80) targetMult = 2.00 + Math.random() * 3.00;
                    else targetMult = 5.00 + Math.random() * 14.00;

                    const similatedbet = {
                        name: maskString(name, 2, 6),
                        avatarColor: AVATAR_COLORS[idx % AVATAR_COLORS.length],
                        bet: bet + (Math.random() + 100),
                        targetMult: Number(targetMult.toFixed(2)),
                        cashedOut: false,
                        cashoutMult: null,
                        winAmount: 0
                    };

                    console.log(similatedbet);
                    return similatedbet;
                });

                renderLiveBetsFeed();
            }

            function maskString(str, start = 0, end = 4, maskChar = '*') {
                if (start < 0 || end > str.length || start >= end ) return str;
                return str.slice(0, start) + maskChar.repeat(3) + str.slice(end);
            }

            function updateSimulatedBotsDuringFlight(currentMult) {
                let changed = false;
                state.simulatedBots.forEach(bot => {
                    if (!bot.cashedOut && currentMult >= bot.targetMult) {
                        bot.cashedOut = true;
                        bot.cashoutMult = bot.targetMult;
                        bot.winAmount = Number((bot.bet * bot.targetMult).toFixed(2));
                        changed = true;

                        if (bot.targetMult >= 12.0) {
                            state.topRecords.unshift({
                                name: bot.name,
                                bet: bot.bet,
                                mult: bot.targetMult,
                                payout: bot.winAmount,
                                color: bot.avatarColor
                            });
                            state.topRecords.sort((a, b) => b.mult - a.mult);
                            state.topRecords = state.topRecords.slice(0, 15);
                            renderTopBetsList();
                        }
                    }
                });
                if (changed) {
                    renderLiveBetsFeed();
                }
            }

            function renderLiveBetsFeed() {
                const rows = [];
                let poolSum = 0;

                [1, 2].forEach(pId => {
                    const p = state.panels[pId];
                    if (p.status === 'ACTIVE' || p.status === 'CASHED_OUT' || (state.phase === GAME_PHASE.WAITING && p.status === 'QUEUED')) {
                        const amt = p.status === 'QUEUED' ? p.betAmount : p.activeBetAmount;
                        poolSum += amt;
                        rows.push({
                            name: `You (Panel ${pId})`,
                            avatarColor: '#ff2a5f',
                            bet: amt,
                            cashedOut: p.status === 'CASHED_OUT',
                            cashoutMult: p.cashedOutAt,
                            winAmount: amt * p.cashedOutAt,
                            isMe: true
                        });
                    }
                });

                state.simulatedBots.forEach(bot => {
                    poolSum += bot.bet;
                    rows.push({ ...bot, isMe: false });
                });

                rows.sort((a, b) => {
                    if (a.isMe !== b.isMe) return a.isMe ? -1 : 1;
                    if (a.cashedOut !== b.cashedOut) return a.cashedOut ? -1 : 1;
                    return b.bet - a.bet;
                });

                dom.liveTotalPlayers.textContent = rows.length;
                dom.liveTotalPool.textContent = `$${poolSum.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;

                dom.liveBetsList.innerHTML = rows.map(row => {
                    const multBadge = row.cashedOut
                        ? `<span class="badge rounded-pill ${row.cashoutMult >= 10 ? 'bg-warning text-dark' : ''}" style="background-color: ${row.cashoutMult >= 10 ? '' : '#7d3c98'};">${row.cashoutMult.toFixed(2)}x</span>`
                        : `<span class="text-secondary">-</span>`;

                    const winText = row.cashedOut
                        ? `<span class="text-success fw-bold mono-font">$${row.winAmount.toFixed(2)}</span>`
                        : `<span class="text-secondary mono-font">-</span>`;

                    return `
                        <div class="bet-row ${row.cashedOut ? 'cashed-out' : ''} ${row.isMe ? 'is-me' : ''}">
                            <div class="d-flex align-items-center text-truncate">
                                <span class="avatar-circle" style="background-color: ${row.avatarColor};">${row.name.substring(0, 2).toUpperCase()}</span>
                                <span class="text-truncate ${row.isMe ? 'fw-bold text-white' : 'text-light'}">${row.name}</span>
                            </div>
                            <div class="text-end mono-font text-light">$${row.bet.toFixed(2)}</div>
                            <div class="text-center mono-font">${multBadge}</div>
                            <div class="text-end">${winText}</div>
                        </div>
                    `;
                }).join('');
            }

            function recordMyBetHistory(betAmount, mult, won) {
                const now = new Date();
                const timeStr = now.toTimeString().slice(0, 5);
                const winAmount = won ? Number((betAmount * mult).toFixed(2)) : 0;

                state.myBetsHistory.unshift({
                    time: timeStr,
                    bet: betAmount,
                    mult,
                    win: winAmount,
                    won
                });

                if (won && mult >= 2.0) {
                    state.topRecords.unshift({
                        name: 'You',
                        bet: betAmount,
                        mult,
                        payout: winAmount,
                        color: '#ff2a5f'
                    });
                    state.topRecords.sort((a, b) => b.mult - a.mult);
                    state.topRecords = state.topRecords.slice(0, 15);
                    renderTopBetsList();
                }

                dom.myBetsCount.textContent = state.myBetsHistory.length;
                dom.myBetsList.innerHTML = state.myBetsHistory.map(item => `
                    <div class="bet-row ${item.won ? 'cashed-out' : ''}" style="grid-template-columns: 1fr 0.9fr 0.8fr 1fr;">
                        <div class="mono-font text-secondary">${item.time}</div>
                        <div class="text-end mono-font text-light">$${item.bet.toFixed(2)}</div>
                        <div class="text-center mono-font">
                            ${item.won ? `<span class="badge bg-success bg-opacity-25 text-success">${item.mult.toFixed(2)}x</span>` : `<span class="text-danger">${item.mult.toFixed(2)}x</span>`}
                        </div>
                        <div class="text-end mono-font fw-bold ${item.won ? 'text-success' : 'text-secondary'}">
                            ${item.won ? `+$${item.win.toFixed(2)}` : '$0.00'}
                        </div>
                    </div>
                `).join('');
            }

            function renderTopBetsList() {
                dom.topBetsList.innerHTML = state.topRecords.map(rec => `
                    <div class="bet-row cashed-out">
                        <div class="d-flex align-items-center text-truncate">
                            <span class="avatar-circle" style="background-color: ${rec.color};">${rec.name.substring(0, 2).toUpperCase()}</span>
                            <span class="text-truncate fw-semibold text-white">${rec.name}</span>
                        </div>
                        <div class="text-end mono-font text-light">$${rec.bet.toFixed(0)}</div>
                        <div class="text-center mono-font">
                            <span class="badge rounded-pill bg-warning text-dark">${rec.mult.toFixed(2)}x</span>
                        </div>
                        <div class="text-end text-success fw-bold mono-font">$${rec.payout.toFixed(2)}</div>
                    </div>
                `).join('');
            }

            /**
             * 5. DUAL BETTING PANELS CONTROLLER
             */
            function updateAllPanelButtons() {
                [1, 2].forEach(panelId => {
                    const panel = state.panels[panelId];
                    const btn = document.getElementById(`actionBtn${panelId}`);
                    const title = document.getElementById(`actionTitle${panelId}`);
                    const sub = document.getElementById(`actionSub${panelId}`);
                    const card = document.getElementById(`betPanel${panelId}`);
                    const input = document.getElementById(`betAmount${panelId}`);

                    card.classList.remove('active-bet', 'queued-bet');
                    btn.className = 'btn-action-main';
                    btn.disabled = false;
                    input.disabled = panel.status !== 'IDLE';

                    if (panel.status === 'IDLE') {
                        if (panel.betAmount > state.balance) {
                            btn.classList.add('btn-state-disabled');
                            btn.disabled = true;
                            title.textContent = 'INSUFFICIENT';
                            sub.textContent = `$${panel.betAmount.toFixed(2)}`;
                        } else {
                            btn.classList.add('btn-state-bet');
                            title.textContent = 'BET';
                            sub.textContent = state.phase === GAME_PHASE.WAITING
                                ? `$${panel.betAmount.toFixed(2)}`
                                : `$${panel.betAmount.toFixed(2)} (Next Round)`;
                        }
                    } else if (panel.status === 'QUEUED') {
                        btn.classList.add('btn-state-cancel');
                        card.classList.add('queued-bet');
                        title.textContent = 'CANCEL';
                        sub.textContent = state.phase === GAME_PHASE.WAITING ? 'Bet Placed' : 'Waiting for next round...';
                    } else if (panel.status === 'ACTIVE') {
                        const liveWin = panel.activeBetAmount * state.currentMultiplier;
                        btn.classList.add('btn-state-cashout');
                        card.classList.add('active-bet');
                        title.textContent = 'CASH OUT';
                        sub.textContent = `$${liveWin.toFixed(2)}`;
                    } else if (panel.status === 'CASHED_OUT') {
                        btn.classList.add('btn-state-disabled');
                        btn.disabled = true;
                        title.textContent = 'CASHED OUT';
                        sub.textContent = `$${(panel.activeBetAmount * panel.cashedOutAt).toFixed(2)} (${panel.cashedOutAt.toFixed(2)}x)`;
                    }
                });
            }

            function placeOrQueueBet(panelId) {
                const panel = state.panels[panelId];
                const input = document.getElementById(`betAmount${panelId}`);
                const amount = Number(parseFloat(input.value).toFixed(2));
                if (isNaN(amount) || amount <= 0 || amount > state.balance) return;

                state.balance = Number((state.balance - amount).toFixed(2));
                panel.betAmount = amount;
                panel.status = 'QUEUED';
                sound.playClick();

                updateBalanceUI();
                updateAllPanelButtons();
                renderLiveBetsFeed();
            }

            function cancelQueuedBet(panelId) {
                const panel = state.panels[panelId];
                if (panel.status !== 'QUEUED') return;

                state.balance = Number((state.balance + panel.betAmount).toFixed(2));
                panel.status = 'IDLE';
                sound.playClick();

                updateBalanceUI();
                updateAllPanelButtons();
                renderLiveBetsFeed();
            }

            function executeCashOut(panelId) {
                const panel = state.panels[panelId];
                if (panel.status !== 'ACTIVE' || state.phase !== GAME_PHASE.FLYING) return;

                const cashoutMult = state.currentMultiplier;
                const winAmount = Number((panel.activeBetAmount * cashoutMult).toFixed(2));

                state.balance = Number((state.balance + winAmount).toFixed(2));
                panel.status = 'CASHED_OUT';
                panel.cashedOutAt = cashoutMult;

                sound.playCashout();
                updateBalanceUI(true);
                showCashoutToast(cashoutMult, winAmount);
                recordMyBetHistory(panel.activeBetAmount, cashoutMult, true);
                renderLiveBetsFeed();
                updateAllPanelButtons();

                dom.mainMultiplier.classList.remove('flying');
                dom.mainMultiplier.classList.add('cashed');
            }

            /**
             * 6. CLEAN EVENT LISTENERS (ZERO INLINE ONCLICK ATTRIBUTES)
             */
            dom.soundBtn.addEventListener('click', () => {
                const isOn = sound.toggle();
                dom.soundIcon.className = isOn ? 'bi bi-volume-up-fill fs-6' : 'bi bi-volume-mute-fill fs-6 text-danger';
            });

            dom.topUpBtn.addEventListener('click', () => {
                window.location.href=`/user/balance`;
                return;
                state.balance = Number((state.balance + 1000).toFixed(2));
                sound.playCashout();
                updateBalanceUI(true);
                updateAllPanelButtons();
            });

            dom.toggleHistoryBtn.addEventListener('click', () => {
                const isOpen = dom.historyDropdownPanel.classList.toggle('open');
                dom.historyDropdownIcon.className = isOpen ? 'bi bi-chevron-up small' : 'bi bi-chevron-down small';
            });

            // Mode Tabs (Bet / Auto)
            document.querySelectorAll('[data-panel][data-mode]').forEach(btn => {
                btn.addEventListener('click', () => {
                    const panelId = Number(btn.dataset.panel);
                    const mode = btn.dataset.mode;
                    state.panels[panelId].mode = mode;

                    btn.parentElement.querySelectorAll('.nav-link').forEach(el => el.classList.remove('active'));
                    btn.classList.add('active');

                    const autoBetWrap = document.getElementById(`autoBetWrapper${panelId}`);
                    if (mode === 'auto') {
                        autoBetWrap.classList.remove('d-none');
                        autoBetWrap.classList.add('d-flex');
                    } else {
                        autoBetWrap.classList.remove('d-flex');
                        autoBetWrap.classList.add('d-none');
                        state.panels[panelId].autoBetEnabled = false;
                        document.getElementById(`autoBetSwitch${panelId}`).checked = false;
                    }
                    updateAllPanelButtons();
                });
            });

            // Auto Bet Switch
            [1, 2].forEach(panelId => {
                const autoBetSwitch = document.getElementById(`autoBetSwitch${panelId}`);
                autoBetSwitch.addEventListener('change', () => {
                    state.panels[panelId].autoBetEnabled = autoBetSwitch.checked;
                    if (autoBetSwitch.checked && state.phase === GAME_PHASE.WAITING && state.panels[panelId].status === 'IDLE') {
                        placeOrQueueBet(panelId);
                    }
                });

                const amountInput = document.getElementById(`betAmount${panelId}`);
                amountInput.addEventListener('input', () => {
                    let val = parseFloat(amountInput.value);
                    if (isNaN(val) || val < 1) val = 1;
                    if (val > 10000) val = 10000;
                    state.panels[panelId].betAmount = val;
                    updateAllPanelButtons();
                });
                amountInput.addEventListener('blur', () => {
                    amountInput.value = state.panels[panelId].betAmount.toFixed(2);
                });
            });

            // Event Delegation for Stepper, Quick Chips & Primary Action Buttons
            document.addEventListener('click', (e) => {
                const actionEl = e.target.closest('[data-action]');
                if (!actionEl) return;

                const action = actionEl.dataset.action;
                const panelId = Number(actionEl.dataset.panel);
                const panel = state.panels[panelId];
                if (!panel) return;

                sound.init();

                if (action === 'step') {
                    if (panel.status !== 'IDLE') return;
                    const delta = Number(actionEl.dataset.delta);
                    panel.betAmount = Math.max(1, Math.min(10000, panel.betAmount + delta));
                    document.getElementById(`betAmount${panelId}`).value = panel.betAmount.toFixed(2);
                    updateAllPanelButtons();
                } else if (action === 'add') {
                    if (panel.status !== 'IDLE') return;
                    const addVal = Number(actionEl.dataset.amount);
                    panel.betAmount = Math.min(10000, panel.betAmount + addVal);
                    document.getElementById(`betAmount${panelId}`).value = panel.betAmount.toFixed(2);
                    updateAllPanelButtons();
                } else if (action === 'mult') {
                    if (panel.status !== 'IDLE') return;
                    const factor = Number(actionEl.dataset.factor);
                    panel.betAmount = Math.max(1, Math.min(10000, Number((panel.betAmount * factor).toFixed(2))));
                    document.getElementById(`betAmount${panelId}`).value = panel.betAmount.toFixed(2);
                    updateAllPanelButtons();
                } else if (action === 'primary') {
                    if (panel.status === 'IDLE') {
                        placeOrQueueBet(panelId);
                    } else if (panel.status === 'QUEUED') {
                        cancelQueuedBet(panelId);
                    } else if (panel.status === 'ACTIVE' && state.phase === GAME_PHASE.FLYING) {
                        executeCashOut(panelId);
                    }
                }
            });

            /**
             * 7. GAME LIFECYCLE STATE MACHINE
             */
            function startWaitingPhase() {
                state.phase = GAME_PHASE.WAITING;
                state.currentMultiplier = 1.00;
                state.waitingRemainingMs = state.waitingDurationMs;
                state.roundId++;

                const hash = Array.from({ length: 16 }, () => Math.floor(Math.random() * 16).toString(16)).join('');
                dom.roundHashLabel.textContent = `ROUND #${state.roundId} • SHA256: ${hash}...`;
                dom.modalSeedHash.textContent = `Round #${state.roundId} Seed: ${hash}${hash}${hash}${hash}`;

                dom.waitingOverlay.style.display = 'block';
                dom.flightOverlay.style.display = 'none';
                dom.flewAwayBanner.style.display = 'none';
                dom.mainMultiplier.className = 'multiplier-display flying';

                canvasState.particles = [];

                [1, 2].forEach(panelId => {
                    const panel = state.panels[panelId];
                    if (panel.status !== 'QUEUED') {
                        panel.status = 'IDLE';
                        panel.activeBetAmount = 0;
                        panel.cashedOutAt = 0;
                    }
                    if (panel.autoBetEnabled && panel.status === 'IDLE') {
                        placeOrQueueBet(panelId);
                    }
                });

                generateSimulatedBots();
                updateAllPanelButtons();
            }

            function startFlyingPhase(forcedCrashPoint = null) {
                state.phase = GAME_PHASE.FLYING;
                state.flightElapsedSec = 0;
                state.crashPoint = forcedCrashPoint !== null ? forcedCrashPoint : generateCrashPoint(1.00);
                state.currentMultiplier = 1.00;

                sound.startTurbineHum();

                [1, 2].forEach(panelId => {
                    const panel = state.panels[panelId];
                    if (panel.status === 'QUEUED') {
                        panel.status = 'ACTIVE';
                        panel.activeBetAmount = panel.betAmount;
                        panel.cashedOutAt = 0;
                    }
                });

                dom.waitingOverlay.style.display = 'none';
                dom.flightOverlay.style.display = 'block';
                dom.flewAwayBanner.style.display = 'none';
                dom.mainMultiplier.className = 'multiplier-display flying';
                dom.mainMultiplier.textContent = '1.00x';

                renderLiveBetsFeed();
                updateAllPanelButtons();

                if (state.crashPoint <= 1.00) {
                    triggerCrash();
                }
            }

            function triggerCrash() {
                state.phase = GAME_PHASE.CRASHED;
                state.currentMultiplier = state.crashPoint;
                state.crashedRemainingMs = 2800;

                sound.playFlyAway();

                dom.flewAwayBanner.style.display = 'inline-block';
                dom.mainMultiplier.textContent = `${state.crashPoint.toFixed(2)}x`;
                dom.mainMultiplier.className = 'multiplier-display crashed';

                state.history.unshift(state.crashPoint);
                if (state.history.length > 30) state.history.pop();
                renderHistoryStrip();

                [1, 2].forEach(panelId => {
                    const panel = state.panels[panelId];
                    if (panel.status === 'ACTIVE') {
                        recordMyBetHistory(panel.activeBetAmount, state.crashPoint, false);
                        panel.status = 'IDLE';
                        panel.activeBetAmount = 0;
                    }
                });

                updateAllPanelButtons();
            }

            /**
             * 8. HTML5 CANVAS FLIGHT & VECTOR PLANE RENDERER
             */
            function drawCloud(x, y, scale, alpha) {
                ctx.save();
                ctx.translate(x, y);
                ctx.scale(scale, scale);
                ctx.fillStyle = `rgba(255, 255, 255, ${alpha})`;
                ctx.beginPath();
                ctx.arc(0, 0, 22, 0, Math.PI * 2);
                ctx.arc(20, -6, 26, 0, Math.PI * 2);
                ctx.arc(42, 0, 20, 0, Math.PI * 2);
                ctx.arc(20, 8, 22, 0, Math.PI * 2);
                ctx.fill();
                ctx.restore();
            }

            function drawPlaneVector(x, y, angleRad, isFlying) {
                ctx.save();
                ctx.translate(x, y);
                ctx.rotate(angleRad);

                // Afterburner Exhaust Flame
                if (isFlying) {
                    const flameLen = 28 + Math.random() * 18;
                    const flameGrad = ctx.createLinearGradient(-18, 0, -18 - flameLen, 0);
                    flameGrad.addColorStop(0, '#ffffff');
                    flameGrad.addColorStop(0.3, '#ffbe0b');
                    flameGrad.addColorStop(0.7, '#ff2a5f');
                    flameGrad.addColorStop(1, 'rgba(255, 42, 95, 0)');

                    ctx.fillStyle = flameGrad;
                    ctx.beginPath();
                    ctx.moveTo(-18, -5);
                    ctx.lineTo(-18 - flameLen, 0);
                    ctx.lineTo(-18, 5);
                    ctx.closePath();
                    ctx.fill();
                }

                // Neon Crimson Glow
                ctx.shadowColor = 'rgba(255, 42, 95, 0.92)';
                ctx.shadowBlur = 20;

                // Back Upper Wing
                ctx.fillStyle = '#9b0b22';
                ctx.beginPath();
                ctx.moveTo(4, -3);
                ctx.lineTo(-12, -18);
                ctx.lineTo(-18, -16);
                ctx.lineTo(-8, -3);
                ctx.closePath();
                ctx.fill();

                // Main Crimson Fuselage
                const bodyGrad = ctx.createLinearGradient(-24, -12, 32, 10);
                bodyGrad.addColorStop(0, '#c8102e');
                bodyGrad.addColorStop(0.55, '#ff2a5f');
                bodyGrad.addColorStop(1, '#ff5c82');

                ctx.fillStyle = bodyGrad;
                ctx.strokeStyle = '#ffffff';
                ctx.lineWidth = 1.6;

                ctx.beginPath();
                ctx.moveTo(32, 1);
                ctx.quadraticCurveTo(14, -9, -12, -7);
                ctx.lineTo(-26, -18);
                ctx.lineTo(-22, -3);
                ctx.lineTo(-26, 5);
                ctx.lineTo(-10, 8);
                ctx.quadraticCurveTo(14, 8, 32, 1);
                ctx.closePath();
                ctx.fill();
                ctx.stroke();

                // White Racing Stripe
                ctx.shadowBlur = 0;
                ctx.strokeStyle = 'rgba(255, 255, 255, 0.9)';
                ctx.lineWidth = 2;
                ctx.beginPath();
                ctx.moveTo(-18, 1);
                ctx.lineTo(18, 1);
                ctx.stroke();

                // Foreground Delta Wing
                ctx.fillStyle = '#e50914';
                ctx.strokeStyle = '#ffffff';
                ctx.lineWidth = 1.3;
                ctx.beginPath();
                ctx.moveTo(6, 2);
                ctx.lineTo(-14, 17);
                ctx.lineTo(-20, 15);
                ctx.lineTo(-9, 2);
                ctx.closePath();
                ctx.fill();
                ctx.stroke();

                // Cockpit Canopy
                ctx.fillStyle = '#72efdd';
                ctx.beginPath();
                ctx.ellipse(9, -3.5, 8, 2.8, -0.12, 0, Math.PI * 2);
                ctx.fill();

                // Spinning Nose Propeller
                const propRadius = 11 + Math.sin(canvasState.propellerPhase) * 3.5;
                ctx.strokeStyle = 'rgba(255, 255, 255, 0.88)';
                ctx.lineWidth = 2.2;
                ctx.beginPath();
                ctx.moveTo(33, -propRadius);
                ctx.lineTo(33, propRadius);
                ctx.stroke();

                ctx.restore();
            }

            function spawnExhaustParticle(x, y, angleRad) {
                const spread = (Math.random() - 0.5) * 0.45;
                const speed = 1.8 + Math.random() * 2.4;
                canvasState.particles.push({
                    x: x - Math.cos(angleRad) * 20,
                    y: y - Math.sin(angleRad) * 20,
                    vx: -Math.cos(angleRad + spread) * speed,
                    vy: -Math.sin(angleRad + spread) * speed,
                    alpha: 0.9,
                    size: 2.8 + Math.random() * 3.2,
                    color: Math.random() > 0.35 ? '#ff2a5f' : '#ffbe0b'
                });
            }

            function renderCanvas(dtSec) {
                const width = canvasState.width;
                const height = canvasState.height;

                ctx.clearRect(0, 0, width, height);

                // Radial Radar Glow
                const radialGlow = ctx.createRadialGradient(0, height, 10, 0, height, Math.max(width, height) * 0.9);
                radialGlow.addColorStop(0, 'rgba(229, 9, 20, 0.24)');
                radialGlow.addColorStop(0.5, 'rgba(255, 42, 95, 0.06)');
                radialGlow.addColorStop(1, 'rgba(14, 16, 21, 0)');
                ctx.fillStyle = radialGlow;
                ctx.fillRect(0, 0, width, height);

                // Drifting Clouds
                canvasState.clouds.forEach(cloud => {
                    if (state.phase === GAME_PHASE.FLYING) {
                        cloud.x -= cloud.speed * dtSec * (1 + (state.currentMultiplier - 1) * 0.15);
                        if (cloud.x < -80) {
                            cloud.x = width + 80;
                            cloud.y = 35 + Math.random() * (height * 0.55);
                        }
                    }
                    drawCloud(cloud.x, cloud.y, cloud.scale, cloud.alpha);
                });

                // Parallax Tactical Grid
                const gridSize = 46;
                canvasState.propellerPhase += dtSec * 48;

                if (state.phase === GAME_PHASE.FLYING) {
                    const speedFactor = Math.min(280, 95 + (state.currentMultiplier - 1) * 28);
                    canvasState.gridOffsetX = (canvasState.gridOffsetX - speedFactor * dtSec) % gridSize;
                    canvasState.gridOffsetY = (canvasState.gridOffsetY + speedFactor * 0.45 * dtSec) % gridSize;
                }

                ctx.strokeStyle = 'rgba(255, 255, 255, 0.055)';
                ctx.lineWidth = 1;
                ctx.beginPath();
                for (let x = canvasState.gridOffsetX; x < width; x += gridSize) {
                    ctx.moveTo(x, 0);
                    ctx.lineTo(x, height);
                }
                for (let y = canvasState.gridOffsetY; y < height; y += gridSize) {
                    ctx.moveTo(0, y);
                    ctx.lineTo(width, y);
                }
                ctx.stroke();

                // Axis Lines
                const originX = 34;
                const originY = height - 34;
                ctx.strokeStyle = 'rgba(255, 255, 255, 0.16)';
                ctx.lineWidth = 2;
                ctx.beginPath();
                ctx.moveTo(originX, 18);
                ctx.lineTo(originX, originY);
                ctx.lineTo(width - 18, originY);
                ctx.stroke();

                // Flight Trajectory Curve & Plane
                if (state.phase === GAME_PHASE.FLYING) {
                    const elapsedSec = state.flightElapsedSec;
                    const climbProgress = Math.min(1, elapsedSec / 3.8);
                    const easeOut = 1 - Math.pow(1 - climbProgress, 2.1);

                    const hoverOscX = climbProgress >= 1 ? Math.sin(elapsedSec * 2.4) * 16 : 0;
                    const hoverOscY = climbProgress >= 1 ? Math.cos(elapsedSec * 3.1) * 14 : 0;

                    const targetX = originX + (width - 105) * easeOut + hoverOscX;
                    const targetY = originY - (height - 95) * Math.pow(easeOut, 1.3) + hoverOscY;

                    canvasState.planeX = targetX;
                    canvasState.planeY = targetY;

                    const ctrlX = originX + (targetX - originX) * 0.56;
                    const ctrlY = originY;

                    // Crimson Gradient Underfill
                    const areaGrad = ctx.createLinearGradient(0, targetY, 0, originY);
                    areaGrad.addColorStop(0, 'rgba(255, 42, 95, 0.38)');
                    areaGrad.addColorStop(1, 'rgba(229, 9, 20, 0.02)');

                    ctx.fillStyle = areaGrad;
                    ctx.beginPath();
                    ctx.moveTo(originX, originY);
                    ctx.quadraticCurveTo(ctrlX, ctrlY, targetX, targetY);
                    ctx.lineTo(targetX, originY);
                    ctx.closePath();
                    ctx.fill();

                    // Glowing Bezier Trajectory Curve
                    ctx.save();
                    ctx.shadowColor = '#ff2a5f';
                    ctx.shadowBlur = 16;
                    ctx.strokeStyle = '#ff2a5f';
                    ctx.lineWidth = 4.5;
                    ctx.lineCap = 'round';
                    ctx.beginPath();
                    ctx.moveTo(originX, originY);
                    ctx.quadraticCurveTo(ctrlX, ctrlY, targetX, targetY);
                    ctx.stroke();
                    ctx.restore();

                    const dx = Math.max(1, targetX - ctrlX);
                    const dy = targetY - ctrlY;
                    const angle = Math.atan2(dy, dx);
                    canvasState.planeAngle = angle;

                    if (Math.random() < 0.85) {
                        spawnExhaustParticle(targetX, targetY, angle);
                    }

                    drawPlaneVector(targetX, targetY, angle, true);

                } else if (state.phase === GAME_PHASE.CRASHED) {
                    const zoomSpeed = 950 * dtSec;
                    canvasState.planeX += Math.cos(canvasState.planeAngle) * zoomSpeed;
                    canvasState.planeY += Math.sin(canvasState.planeAngle) * zoomSpeed - 220 * dtSec;

                    if (canvasState.planeX < width + 100 && canvasState.planeY > -100) {
                        spawnExhaustParticle(canvasState.planeX, canvasState.planeY, canvasState.planeAngle);
                        drawPlaneVector(canvasState.planeX, canvasState.planeY, canvasState.planeAngle - 0.12, true);
                    }
                } else if (state.phase === GAME_PHASE.WAITING) {
                    const idleBob = Math.sin(performance.now() / 220) * 2;
                    drawPlaneVector(originX + 26, originY - 16 + idleBob, -0.14, false);
                }

                // Exhaust Particles
                for (let i = canvasState.particles.length - 1; i >= 0; i--) {
                    const p = canvasState.particles[i];
                    p.x += p.vx * (dtSec * 60);
                    p.y += p.vy * (dtSec * 60);
                    p.alpha -= 1.5 * dtSec;
                    p.size *= Math.pow(0.25, dtSec);

                    if (p.alpha <= 0) {
                        canvasState.particles.splice(i, 1);
                        continue;
                    }

                    ctx.save();
                    ctx.globalAlpha = Math.max(0, p.alpha);
                    ctx.fillStyle = p.color;
                    ctx.beginPath();
                    ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
                    ctx.fill();
                    ctx.restore();
                }
            }

            /**
             * 9. MAIN 60FPS ANIMATION LOOP
             */
            function gameLoop(now) {
                if (!state.lastFrameTime) state.lastFrameTime = now;
                const dtMs = Math.min(100, Math.max(0, now - state.lastFrameTime));
                const dtSec = dtMs / 1000;
                state.lastFrameTime = now;

                if (state.phase === GAME_PHASE.WAITING) {
                    state.waitingRemainingMs = Math.max(0, state.waitingRemainingMs - dtMs);
                    const pct = (state.waitingRemainingMs / state.waitingDurationMs) * 100;
                    dom.countdownBar.style.width = `${pct}%`;
                    dom.countdownSeconds.textContent = `${(state.waitingRemainingMs / 1000).toFixed(1)}s`;

                    if (state.waitingRemainingMs <= 0) {
                        startFlyingPhase();
                    }
                } else if (state.phase === GAME_PHASE.FLYING) {
                    state.flightElapsedSec += dtSec;
                    const t = state.flightElapsedSec;

                    const nextMult = Math.pow(Math.E, 0.08 * t + 0.0055 * t * t);
                    state.currentMultiplier = Number(nextMult.toFixed(2));
                    sound.updateTurbinePitch(state.currentMultiplier);

                    if (state.currentMultiplier >= state.crashPoint) {
                        triggerCrash();
                    } else {
                        dom.mainMultiplier.textContent = `${state.currentMultiplier.toFixed(2)}x`;

                        // Auto Cash Out check
                        [1, 2].forEach(panelId => {
                            const panel = state.panels[panelId];
                            const autoEnabled = document.getElementById(`autoCashoutSwitch${panelId}`).checked;
                            const targetMult = parseFloat(document.getElementById(`autoCashoutTarget${panelId}`).value);

                            if (panel.status === 'ACTIVE' && autoEnabled && !isNaN(targetMult) && targetMult >= 1.01) {
                                if (state.currentMultiplier >= targetMult) {
                                    state.currentMultiplier = targetMult;
                                    executeCashOut(panelId);
                                }
                            }
                        });

                        updateSimulatedBotsDuringFlight(state.currentMultiplier);
                        updateAllPanelButtons();
                    }
                } else if (state.phase === GAME_PHASE.CRASHED) {
                    state.crashedRemainingMs -= dtMs;
                    if (state.crashedRemainingMs <= 0) {
                        startWaitingPhase();
                    }
                }

                renderCanvas(dtSec);
                requestAnimationFrame(gameLoop);
            }

            /**
             * 10. BOOTSTRAP INITIALIZATION
             */
            resizeCanvas();
            initClouds();
            updateBalanceUI();
            renderHistoryStrip();
            renderTopBetsList();
            generateSimulatedBots();

            // Start immediately in FLYING state with guaranteed >= 3.20x initial flight
            const initialFlightCrash = generateCrashPoint(3.40);
            startFlyingPhase(initialFlightCrash);

            state.lastFrameTime = performance.now();
            requestAnimationFrame(gameLoop);
        });
    </script>
</body>
</html>


