<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open Badges System - EduHive</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/badge-editor.css', 'resources/js/badge-editor.js'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.5;
            background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
            min-height: 100vh;
        }
        
        .header {
            background-color: white;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
            border-bottom: 1px solid #e5e7eb;
        }
        
        .header-content {
            max-width: 1280px;
            margin: 0 auto;
            padding: 16px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .logo-box {
            background-color: #4f46e5;
            padding: 8px;
            border-radius: 8px;
        }
        
        .logo-box svg {
            display: block;
        }
        
        h1 {
            font-size: 24px;
            font-weight: bold;
            color: #1f2937;
        }
        
        .subtitle {
            font-size: 13px;
            color: #6b7280;
        }
        
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 24px;
        }
        
        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #6ee7b7;
        }
        
        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }
        
        .alert-info {
            background-color: #dbeafe;
            color: #1e40af;
            border: 1px solid #93c5fd;
        }
        
        .tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 24px;
            overflow-x: auto;
            padding-bottom: 8px;
        }
        
        .tab {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 6px;
            border: none;
            font-weight: 500;
            cursor: pointer;
            font-size: 14px;
            white-space: nowrap;
            background-color: white;
            color: #4b5563;
            transition: all 0.2s;
        }
        
        .tab:hover {
            background-color: #f3f4f6;
        }
        
        .tab.active {
            background-color: #4f46e5;
            color: white;
        }
        
        .tab.active:hover {
            background-color: #4338ca;
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }
        
        .stat-card {
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 24px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .stat-card.purple {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
        }
        
        .stat-card.green {
            background: linear-gradient(135deg, #16a34a 0%, #22c55e 100%);
        }
        
        .stat-card.violet {
            background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%);
        }
        
        .stat-value {
            font-size: 32px;
            font-weight: bold;
        }
        
        .stat-label {
            font-size: 13px;
            opacity: 0.8;
        }
        
        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            padding: 24px;
            margin-bottom: 24px;
        }
        
        .card-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 16px;
            color: #1f2937;
        }
        
        .form-group {
            margin-bottom: 16px;
        }
        
        label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 4px;
        }
        
        input, textarea, select {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
        }
        
        textarea {
            resize: vertical;
        }
        
        button {
            padding: 10px 16px;
            border-radius: 6px;
            border: none;
            font-weight: 500;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s;
        }
        
        .btn-primary {
            background-color: #4f46e5;
            color: white;
            width: 100%;
        }
        
        .btn-primary:hover {
            background-color: #4338ca;
        }
        
        .btn-success {
            background-color: #16a34a;
            color: white;
            width: 100%;
        }
        
        .btn-success:hover {
            background-color: #15803d;
        }
        
        .btn-secondary {
            background-color: #e5e7eb;
            color: #1f2937;
        }
        
        .btn-secondary:hover {
            background-color: #d1d5db;
        }
        
        .badge-list, .recipient-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        
        .badge-item, .recipient-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
        }
        
        .badge-image {
            width: 48px;
            height: 48px;
            border-radius: 4px;
            object-fit: cover;
        }
        
        .badge-info {
            flex: 1;
            min-width: 0; /* Importante para el text-overflow */
        }
        
        .badge-name {
            font-weight: 500;
            color: #1f2937;
            margin-bottom: 2px;
        }
        
        .badge-desc {
            font-size: 13px;
            color: #6b7280;
        }
        
        .loader {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        .hidden {
            display: none !important;
        }
        
        .flex {
            display: flex;
            gap: 8px;
        }
        
        .grid-2 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 24px;
        }
        
        pre {
            background-color: #1f2937;
            color: #f3f4f6;
            padding: 16px;
            border-radius: 6px;
            overflow-x: auto;
            font-size: 12px;
        }
        
        .endpoint {
            padding: 8px 16px;
            background-color: #f9fafb;
            margin-bottom: 12px;
        }
        
        .endpoint.post {
            border-left: 4px solid #16a34a;
        }
        
        .endpoint.get {
            border-left: 4px solid #3b82f6;
        }
        
        .endpoint-method {
            font-family: monospace;
            font-size: 13px;
            margin-bottom: 4px;
        }
        
        .endpoint-desc {
            font-size: 13px;
            color: #4b5563;
        }
        
        .info-box {
            background-color: #dbeafe;
            border: 1px solid #93c5fd;
            border-radius: 6px;
            padding: 16px;
            margin-top: 24px;
        }
        
        .info-box h4 {
            color: #1e40af;
            margin-bottom: 8px;
        }
        
        .info-box p, .info-box li {
            font-size: 13px;
            color: #1e3a8a;
        }
        
        .info-box ul {
            padding-left: 20px;
        }
        
        .warning-box {
            background-color: #fef3c7;
            border: 1px solid #fcd34d;
            border-radius: 6px;
            padding: 16px;
            margin-top: 16px;
        }
        
        .warning-box h4 {
            color: #92400e;
            margin-bottom: 8px;
        }
        
        .empty-state {
            text-align: center;
            padding: 32px 0;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <div class="logo-box">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                    <circle cx="12" cy="8" r="7"></circle>
                    <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                </svg>
            </div>
            <div>
                <h1>Open Badges System - EduHive</h1>
                <p class="subtitle">Sistema de emisión y gestión de badges digitales</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div id="alertContainer"></div>

        <div class="tabs">
            <button class="tab active" onclick="showTab('dashboard')">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="8" r="7"></circle>
                    <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                </svg>
                Dashboard
            </button>
            <button class="tab" onclick="showTab('create')">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="8" r="7"></circle>
                    <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                </svg>
                Crear Badge
            </button>
            <button class="tab" onclick="showTab('issue')">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="22" y1="2" x2="11" y2="13"></line>
                    <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                </svg>
                Emitir Badge
            </button>
            <button class="tab" onclick="showTab('api')">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path>
                </svg>
                API & Integración
            </button>
        </div>

        <div id="dashboard" class="tab-content active">
            <div class="stats-grid">
                <div class="stat-card purple">
                    <div>
                        <p class="stat-label">Total Badges</p>
                        <p class="stat-value" id="totalBadges">0</p>
                    </div>
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="opacity: 0.8">
                        <circle cx="12" cy="8" r="7"></circle>
                        <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                    </svg>
                </div>
                <div class="stat-card green">
                    <div>
                        <p class="stat-label">Badges Emitidos</p>
                        <p class="stat-value" id="totalIssued">0</p>
                    </div>
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="opacity: 0.8">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                </div>
                <div class="stat-card violet">
                    <div>
                        <p class="stat-label">Destinatarios</p>
                        <p class="stat-value" id="totalRecipients">0</p>
                    </div>
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="opacity: 0.8">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
            </div>

            <div class="grid-2">
                <div class="card">
                    <h3 class="card-title">Badges Disponibles</h3>
                    <div id="badgesList" class="badge-list"></div>
                </div>
                <div class="card">
                    <h3 class="card-title">Emisiones Recientes</h3>
                    <div id="recipientsList" class="recipient-list"></div>
                </div>
            </div>
        </div>
<!-- Crear Badge Tab -->        
        <div id="create" class="tab-content">
        <div class="card" style="max-width: 1100px; margin: 0 auto;">
            <h3 class="card-title">Diseñador de Badges</h3>
            
            <div class="grid-2" style="grid-template-columns: 300px 1fr; gap: 20px;">
                <div style="border-right: 1px solid #e5e7eb; padding-right: 20px;">
                    <form id="createBadgeForm">
                        <div class="form-group">
                            <label>Nombre del Badge *</label>
                            <input type="text" id="badgeName" required placeholder="Ej: Certificado Avanzado">
                        </div>
                        <div class="form-group">
                            <label>Descripción</label>
                            <textarea id="badgeDescription" required rows="2" style="font-size: 13px;"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Forma de Recorte</label>
                            <select id="badgeShapeSelect" class="w-full p-2 border rounded">
                                <option value="square">Cuadrado (Original)</option>
                                <option value="circle">Círculo</option>
                                <option value="hexagon">Hexágono</option>
                                <option value="octagon">Octágono</option> 
                                <option value="shield">Escudo</option>
                            </select>
                        </div>
                        
                        <div class="info-box" style="margin-top: 20px; font-size: 12px;">
                            <p>💡 Tip: Usa el panel de capas a la derecha para organizar los elementos.</p>
                        </div>

                        <button type="button" onclick="saveBadgeWithEditor()" class="btn-primary" style="margin-top: 20px; width: 100%;">
                            💾 Guardar y Crear
                        </button>
                    </form>
                </div>

                <div>
                    <div style="background: #f8fafc; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px 8px 0 0; display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                        <button type="button" class="btn-secondary" id="btnBg" title="Subir imagen de fondo">🖼️ Fondo</button>
                        <input type="file" id="bgInput" hidden accept="image/*">
                        
                        <button type="button" class="btn-secondary" id="btnText" title="Agregar texto">Aa Texto</button>
                        
                        <div style="border-left: 1px solid #cbd5e1; height: 24px; margin: 0 5px;"></div>
                        
                        <input type="color" id="colorPicker" value="#4f46e5" title="Color del objeto" style="height: 30px; width: 40px; cursor: pointer;">
                        
                        <button type="button" class="btn-secondary" id="btnDelete" title="Eliminar seleccionado" style="color: #ef4444;">🗑️</button>
                    </div>

                    <div style="display: flex; height: 450px; border: 1px solid #e2e8f0; border-top: none;">
                        <div style="flex: 1; background: #e5e7eb; display: flex; align-items: center; justify-content: center; overflow: hidden; position: relative;">
                            <div style="position: absolute; inset: 0; background-image: linear-gradient(45deg, #ccc 25%, transparent 25%), linear-gradient(-45deg, #ccc 25%, transparent 25%), linear-gradient(45deg, transparent 75%, #ccc 75%), linear-gradient(-45deg, transparent 75%, #ccc 75%); background-size: 20px 20px; opacity: 0.2; pointer-events: none;"></div>
                            <canvas id="badgeCanvas"></canvas>
                        </div>

                        <div style="width: 200px; background: white; border-left: 1px solid #e2e8f0; display: flex; flex-direction: column;">
                            <div style="padding: 8px 12px; background: #f1f5f9; border-bottom: 1px solid #e2e8f0; font-weight: 600; font-size: 13px; color: #475569;">
                                Capas
                            </div>
                            <div id="layersList" style="flex: 1; overflow-y: auto; padding: 5px;">
                                <div class="empty-state" style="padding: 20px; font-size: 12px; text-align: center; color: #94a3b8;">Lienzo vacío</div>
                            </div>
                            
                            <div style="padding: 10px; border-top: 1px solid #e2e8f0; background: #f8fafc;">
                                <div style="font-size: 11px; color: #64748b; margin-bottom: 5px;">Librería de Assets:</div>
                            <div style="display: flex; gap: 5px; flex-wrap: wrap; max-height: 100px; overflow-y: auto;">
                                <button class="asset-btn" data-type="rect" title="Cuadrado" style="background: white;">⬜</button>
                                <button class="asset-btn" data-type="circle" title="Círculo" style="background: white;">⚪</button>
                                <button class="asset-btn" data-type="triangle" title="Triángulo" style="background: white;">🔺</button>

                                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iI2ZiYmYyNCIgc3Ryb2tlPSIjYjQ1MzA5IiBzdHJva2Utd2lkdGg9IjIiPjxjaXJjbGUgY3g9IjEyIiBjeT0iOCIgcj0iNyIvPjxwb2x5bGluZSBwb2ludHM9IjguMjEgMTMuODkgNyAyMyAxMiAyMCAxNyAyMyAxNS43OSAxMy44OCIvPjwvc3ZnPg==" 
                                    class="asset-btn" data-type="svg" data-name="Cinta" title="Cinta">
                                
                                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iI2ZiYmYyNCIgc3Ryb2tlPSIjYjQ1MzA5IiBzdHJva2Utd2lkdGg9IjIiPjxwb2x5Z29uIHBvaW50cz0iMTIgMiAxNS4wOSA4LjI2IDIyIDkuMjcgMTcgMTQuMTQgMTguMTggMjEuMDIgMTIgMTcuNzcgNS44MiAyMS4wMiA3IDE0LjE0IDIgOS4yNyA4LjkxIDguMjYgMTIgMiIvPjwvc3ZnPg==" 
                                    class="asset-btn" data-type="svg" data-name="Estrella" title="Estrella">

                                <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/PgoKCjwhLS0gTGljZW5zZTogUEQuIE1hZGUgYnkgaWNvbnM4OiBodHRwczovL2dpdGh1Yi5jb20vaWNvbnM4L3dpbmRvd3MtMTAtaWNvbnMgLS0+CjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgCgkgdmlld0JveD0iMCAwIDMyIDMyIiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPHBhdGggaWQ9IlhNTElEXzQ1MF8iIHN0eWxlPSJmaWxsOm5vbmU7c3Ryb2tlOiMwMDAwMDA7c3Ryb2tlLXdpZHRoOjI7c3Ryb2tlLWxpbmVqb2luOnJvdW5kO3N0cm9rZS1taXRlcmxpbWl0OjEwOyIgZD0iTTIyLjc4Niw2CgljMCwwLDAuNzE1LTEsMi4yMTQtMWMxLjM3NywwLDMsMS4wNSwzLDNjMCwzLjIxLTUsNC4yNDItNSw4YzAsMC45ODIsMSwxLjk5MywxLDEuOTkzIi8+CjxwYXRoIGlkPSJYTUxJRF8zNjVfIiBzdHlsZT0iZmlsbDpub25lO3N0cm9rZTojMDAwMDAwO3N0cm9rZS13aWR0aDoyO3N0cm9rZS1saW5lam9pbjpyb3VuZDtzdHJva2UtbWl0ZXJsaW1pdDoxMDsiIGQ9Ik04LDE3Ljk5MwoJYzAsMCwxLTEuMDExLDEtMS45OTNjMC0zLjc1OC01LTQuNzktNS04YzAtMS45NSwxLjYyMy0zLDMtM2MxLjQ5OCwwLDIuMjE0LDEsMi4yMTQsMSIvPgo8cGF0aCBpZD0iWE1MSURfNDM1XyIgc3R5bGU9ImZpbGw6bm9uZTtzdHJva2U6IzAwMDAwMDtzdHJva2Utd2lkdGg6MjtzdHJva2UtbWl0ZXJsaW1pdDoxMDsiIGQ9Ik05LDZjMCw2LjUyOCwzLjY4OSwxNyw2Ljk4MywxNwoJUzIzLDEyLjU2OCwyMyw2SDl6Ii8+CjxwYXRoIGlkPSJYTUxJRF8zNzdfIiBzdHlsZT0iZmlsbDpub25lO3N0cm9rZTojMDAwMDAwO3N0cm9rZS13aWR0aDoyO3N0cm9rZS1taXRlcmxpbWl0OjEwOyIgZD0iTTE4LDI0aC00Yy0xLjY1NywwLTMsMS4zNDMtMywzdjAKCWgxMHYwQzIxLDI1LjM0MywxOS42NTcsMjQsMTgsMjR6Ii8+CjxsaW5lIGlkPSJYTUxJRF8zNzhfIiBzdHlsZT0iZmlsbDpub25lO3N0cm9rZTojMDAwMDAwO3N0cm9rZS13aWR0aDoyO3N0cm9rZS1taXRlcmxpbWl0OjEwOyIgeDE9IjE2IiB5MT0iMTUiIHgyPSIxNiIgeTI9IjEwIi8+Cjwvc3ZnPg==" 
                                    class="asset-btn" data-type="svg" data-name="Trofeo" title="Trofeo">

                                <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPCEtLSBMaWNlbnNlOiBNSVQuIE1hZGUgYnkgTHVjaWRlIENvbnRyaWJ1dG9yczogaHR0cHM6Ly9sdWNpZGUuZGV2LyAtLT4KPHN2ZyAKICB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciCiAgd2lkdGg9IjI0IgogIGhlaWdodD0iMjQiCiAgdmlld0JveD0iMCAwIDI0IDI0IgogIGZpbGw9Im5vbmUiCiAgc3Ryb2tlPSIjMDAwMDAwIgogIHN0cm9rZS13aWR0aD0iMiIKICBzdHJva2UtbGluZWNhcD0icm91bmQiCiAgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIKPgogIDxwYXRoIGQ9Ik0yIDRsMyAxMmgxNGwzLTEyLTYgNy00LTctNCA3LTYtN3ptMyAxNmgxNCIgLz4KPC9zdmc+" 
                                    class="asset-btn" data-type="svg" data-name="Corona" title="Corona">

                                <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPCEtLSBMaWNlbnNlOiBNSVQuIE1hZGUgYnkgZGVzaWdubW9kbzogaHR0cHM6Ly9naXRodWIuY29tL2Rlc2lnbm1vZG8vRmxhdC1VSSAtLT4KPHN2ZyB3aWR0aD0iODAwcHgiIGhlaWdodD0iODAwcHgiIHZpZXdCb3g9Ii04IDAgMTAwIDEwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBmaWxsPSIjMjk4MEI5IiBkPSJNMjcgMEgwbDMwIDYwaDI3TDI3IDB6Ii8+PHBhdGggZmlsbD0iIzM0OThEQiIgZD0iTTU3IDBoMjdMNTQgNjBIMjdMNTcgMHoiLz48cGF0aCBmaWxsPSIjRjFDNDBFIiBkPSJNNDIgNDBjMTYuNTY4IDAgMzAgMTMuNDM0IDMwIDMwIDAgMTYuNTY4LTEzLjQzMiAzMC0zMCAzMC0xNi41NjcgMC0zMC0xMy40MzItMzAtMzBzMTMuNDMxLTMwIDMwLTMweiIvPjxwYXRoIGZpbGw9IiNEOEIwMEMiIGQ9Ik00MiA0NmMtMTMuMjU1IDAtMjQgMTAuNzQ1LTI0IDI0czEwLjc0NSAyNCAyNCAyNCAyNC0xMC43NDUgMjQtMjQtMTAuNzQ1LTI0LTI0LTI0em0wIDQ2Yy0xMi4xNDkgMC0yMi05Ljg1LTIyLTIyIDAtMTIuMTQ4IDkuODUxLTIyIDIyLTIyIDEyLjE1IDAgMjIgOS44NTIgMjIgMjIgMCAxMi4xNS05Ljg1IDIyLTIyIDIyeiIvPjxwYXRoIGZpbGw9IiNDREE3MEMiIGQ9Ik0xNi4zNzcgODUuNjA5YzMuOTM1IDYuNDQzIDEwLjIzNCAxMS4yODMgMTcuNjkgMTMuMzIyTDUxIDgybC01LTE5LTYuMDA0LTEuMDExLTIzLjYxOSAyMy42MnoiLz48cGF0aCBmaWxsPSIjQjg5NjBBIiBkPSJNMzkuMTczIDkzLjgyOWwxLjg1My0xLjg1NGMtOC4yNDMtLjM1OS0xNS4zMDgtNS4yNTYtMTguNzYxLTEyLjI1NGwtMS40ODYgMS40ODVjMy42MDcgNi44MTcgMTAuMzk4IDExLjY4MyAxOC4zOTQgMTIuNjIzeiIvPjxwYXRoIGZpbGw9IiNGRkY1NUMiIGQ9Ik00NS45ODggODEuOThWNjUuOTczaC01Ljk5MlY2MS45OWMuODg4LjAyMSAxLjc0Ny4wOSAyLjU3NC0uMDc1IDEuMDIxLS4yMDMgMS4zMTItLjI3OCAxLjk0OS0uNzEyIDEuMTA5LS43NDkgMS4zNzMtMS4yMyAxLjc2OS0xLjkyNi41NTgtLjk3OS41MDctMS4zMTEuNjQ5LTIuMjc5aDQuMDY4VjgxLjk4aC01LjAxN3oiLz48L3N2Zz4=" 
                                    class="asset-btn" data-type="svg" data-name="Medalla" title="Medalla">

                                <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PgoKPCEtLSBMaWNlbnNlOiBDQzAgTGljZW5zZS4gTWFkZSBieSBTVkcgUmVwbzogaHR0cHM6Ly93d3cuc3ZncmVwby5jb20vc3ZnLzM4MDkyOS9ncmFkdWF0aW9uLXVuaXZlcnNpdHktY2VyZW1vbnktZWR1Y2F0aW9uLWdyYWR1YXRlIC0tPgo8c3ZnIGZpbGw9IiMwMDAwMDAiIHdpZHRoPSIyNTBweCIgaGVpZ2h0PSIyNTBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+Cgo8ZyBpZD0iR3JhZHVhdGlvbiI+Cgo8cG9seWdvbiBwb2ludHM9IjQ0NS4wNTUgMzg0Ljc5NCA0NDUuMDU1IDIyMS44NjQgNDE4LjgwNSAyMzQuOTg5IDQxOC44MDUgMzg0Ljc3NyA0MDEuMzAxIDQyOS43ODUgNDYyLjU1MSA0MjkuNzg1IDQ0NS4wNTUgMzg0Ljc5NCIvPgoKPHBhdGggZD0iTTIyOS4wNjQ4LDMwNi4zNzA4bC0xMDcuNzY0My01My44OHY1My43NzU0YzAsMzYuMjQzMyw1OC43NjM0LDY1LjYyNSwxMzEuMjUsNjUuNjI1LDcyLjQ4ODcsMCwxMzEuMjUtMjkuMzgxNywxMzEuMjUtNjUuNjI1VjI1Mi40OUwyNzYuMDI3NywzMDYuMzc0MUMyNTcuNTgxMywzMTMuNjgxLDI0Ny41MTMzLDMxMy42Nzg5LDIyOS4wNjQ4LDMwNi4zNzA4WiIvPgoKPHBhdGggZD0iTTI2NC4yOTEyLDI4Mi44OTY5bDE4Ni41MjA3LTkzLjI2YzYuNDU3OS0zLjIyODksNi40NTc5LTguNTEwNywwLTExLjc0bC0xODYuNTIwNy05My4yNmMtNi40NTU2LTMuMjI4OS0xNy4wMjE0LTMuMjI4OS0yMy40NzkzLDBsLTE4Ni41MjA3LDkzLjI2Yy02LjQ1NTYsMy4yMjg5LTYuNDU1Niw4LjUxMDcsMCwxMS43NGwxODYuNTIwNyw5My4yNkMyNDcuMjcsMjg2LjEyNTgsMjU3LjgzNTYsMjg2LjEyNTgsMjY0LjI5MTIsMjgyLjg5NjlaIi8+Cgo8L2c+Cgo8L3N2Zz4=" 
                                    class="asset-btn" data-type="svg" data-name="Graduación" title="Graduación">

                                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iI2ZjOGEwNSIgc3Ryb2tlPSIjZmM4YTA1IiBzdHJva2Utd2lkdGg9IjIiPjxwb2x5Z29uIHBvaW50cz0iMTMgMiAzIDE0IDEyIDE0IDExIDIyIDIxIDEwIDEyIDEwIDEzIDIiLz48L3N2Zz4=" 
                                    class="asset-btn" data-type="svg" data-name="Rayo" title="Rayo">

                                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iIzIyYzU1ZSIgc3Ryb2tlPSIjZmZmIiBzdHJva2Utd2lkdGg9IjIiPjxwYXRoIGQ9Ik0yMiAxMS4wOFYxMmExMCAxMCAwIDEgMS01LjkzLTkuMTQiLz48cG9seWxpbmUgcG9pbnRzPSIyMiA0IDEyIDE0LjAxIDkgMTEuMDEiLz48L3N2Zz4=" 
                                    class="asset-btn" data-type="svg" data-name="Verificado" title="Verificado">
                            </div>

                            <div style="margin-top: 10px;">
                                <div style="font-size: 11px; color: #64748b; margin-bottom: 5px;">Pegar SVG (Base64):</div>
                                <textarea id="b64SvgInput" rows="2" style="width: 100%; font-size: 10px; font-family: monospace;" placeholder="data:image/svg+xml;base64,..."></textarea>
                                <button id="btnAddB64Svg" class="btn-secondary" style="width: 100%; margin-top: 5px; font-size: 12px; padding: 5px;">Añadir SVG</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<!-- Crear Badge Tab -->
        <div id="issue" class="tab-content">
            <div class="card" style="max-width: 600px; margin: 0 auto;">
                <h3 class="card-title">Emitir Badge</h3>
                <form id="issueBadgeForm" onsubmit="issueBadge(event)">
                    <div class="form-group">
                        <label>Seleccionar Badge *</label>
                        <select id="badgeSelect" required>
                            <option value="">-- Selecciona un badge --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nombre del Destinatario *</label>
                        <input type="text" id="recipientName" required placeholder="Juan Pérez">
                    </div>
                    <div class="form-group">
                        <label>Email del Destinatario *</label>
                        <input type="email" id="recipientEmail" required placeholder="juan@ejemplo.com">
                    </div>
                    <div class="form-group">
                        <label>Evidencia (URL opcional)</label>
                        <input type="url" id="evidence" placeholder="https://ejemplo.com/certificado/123">
                    </div>
                    <button type="submit" class="btn-success">Emitir Badge</button>
                </form>
            </div>
        </div>

        <div id="api" class="tab-content">
            <div class="card" style="max-width: 900px; margin: 0 auto;">
                <h3 class="card-title">Documentación de API</h3>
                
                <div class="form-group">
                    <label>Configurar API Key</label>
                    <p style="font-size: 13px; color: #6b7280; margin-bottom: 8px;">
                        Ingresa la API Key que obtuviste al ejecutar install.php en el servidor
                    </p>
                    <div class="flex">
                        <input type="password" id="apiKeyInput" placeholder="obapi_xxxxxxxxxxxxxxxxxx" style="flex: 1; font-family: monospace;">
                        <button type="button" onclick="toggleApiKey()" class="btn-secondary">👁️ Mostrar</button>
                        <button type="button" onclick="saveApiKey()" class="btn-primary" style="width: auto;">💾 Guardar</button>
                    </div>
                </div>

                <h4 style="font-weight: 600; margin: 24px 0 8px;">Endpoints Disponibles</h4>
                
                <div class="endpoint post">
                    <div class="endpoint-method" style="color: #15803d;">POST /api/badges/issue.php</div>
                    <p class="endpoint-desc">Emite un badge a un destinatario</p>
                </div>
                
                <div class="endpoint get">
                    <div class="endpoint-method" style="color: #1d4ed8;">GET /api/badges/index.php</div>
                    <p class="endpoint-desc">Lista todos los badges disponibles</p>
                </div>
                
                <div class="endpoint post">
                    <div class="endpoint-method" style="color: #b45309;">POST /api/badges/create.php</div>
                    <p class="endpoint-desc">Crea un nuevo badge</p>
                </div>

                <h4 style="font-weight: 600; margin: 24px 0 8px;">Ejemplo de Petición</h4>
                <pre id="exampleRequest">POST https://badges.eduhive.cl/api/badges/issue.php
Content-Type: application/json
Authorization: Bearer TU_API_KEY

{
  "badgeId": "1",
  "recipient": {
    "name": "Juan Pérez",
    "email": "juan@ejemplo.com"
  },
  "evidence": "https://lms.ejemplo.com/curso/123"
}</pre>

                <div class="info-box">
                    <h4>🔗 Integración con LMS</h4>
                    <p style="margin-bottom: 8px;">Para integrar con tu LMS (Moodle, Canvas, etc.), utiliza webhooks o plugins:</p>
                    <ul>
                        <li>Endpoint: <code>https://badges.eduhive.cl/api/badges/issue.php</code></li>
                        <li>Header: <code>Authorization: Bearer TU_API_KEY</code></li>
                        <li>Método: POST</li>
                        <li>Content-Type: application/json</li>
                    </ul>
                </div>

                <div class="warning-box">
                    <h4>⚠️ Importante</h4>
                    <ul>
                        <li>Guarda tu API Key de forma segura</li>
                        <li>No compartas tu API Key públicamente</li>
                        <li>Verifica que tu backend tenga SSL (HTTPS) configurado</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="config.js"></script>
    <script>
    if (!window.APP_CONFIG) {
        window.APP_CONFIG = {
            API_BASE: 'https://badges.eduhive.cl/api' // URL por defecto (Producción)
        };
    }
    </script>
    <script>
        const API_BASE = window.APP_CONFIG.API_BASE; 
        console.log('Usando API_BASE:', API_BASE);   
        let badges = [];
        let recipients = [];
        let apiKey = localStorage.getItem('eduhive_api_key') || '';

        // Cargar API Key guardada
        if (apiKey) {
            document.getElementById('apiKeyInput').value = apiKey;
        }

        // Inicializar
        document.addEventListener('DOMContentLoaded', function() {
            loadBadges();
            loadRecipients();
            updateStats();
        });

        function showTab(tabName) {
            // Ocultar todos los tabs
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            document.querySelectorAll('.tab').forEach(btn => {
                btn.classList.remove('active');
            });

            // Mostrar tab seleccionado
            document.getElementById(tabName).classList.add('active');
            event.target.closest('.tab').classList.add('active');

            // Actualizar select de badges si es necesario
            if (tabName === 'issue') {
                updateBadgeSelect();
            }
        }

        function showAlert(message, type = 'info') {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type}`;
            alertDiv.innerHTML = `
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <span>${message}</span>
            `;
            
            const container = document.getElementById('alertContainer');
            container.appendChild(alertDiv);
            
            setTimeout(() => {
                alertDiv.remove();
            }, 5000);
        }

        async function loadBadges() {
            try {
                let ruta=API_BASE+"/badges"; 
                console.log('Cargando badges desde:', ruta);
                const response = await fetch(ruta);
                const data = await response.json();
                
                if (data.success && data.badges) {
                    badges = data.badges;
                    renderBadges();
                    updateStats();
                }
            } catch (error) {
                console.error('Error cargando badges:', error);
            }
        }

        function loadRecipients() {
            const saved = localStorage.getItem('eduhive_recipients');
            if (saved) {
                recipients = JSON.parse(saved);
                renderRecipients();
                updateStats();
            }
        }

        function renderBadges() {
            const container = document.getElementById('badgesList');
            
            if (badges.length === 0) {
                container.innerHTML = '<div class="empty-state">No hay badges creados aún</div>';
                return;
            }

            container.innerHTML = badges.slice(0, 5).map(badge => `
                <div class="badge-item">
                    <img src="${badge.image}" alt="${badge.name}" class="badge-image">
                    <div class="badge-info">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div class="badge-name">${badge.name}</div>
                            <span style="font-size: 11px; background-color: #f3f4f6; padding: 2px 6px; border-radius: 4px; color: #6b7280; font-family: monospace;">ID: ${badge.id}</span>
                        </div>
                        <div class="badge-desc">${badge.description.substring(0, 50)}${badge.description.length > 50 ? '...' : ''}</div>
                    </div>
                </div>
            `).join('');
        }

        function renderRecipients() {
            const container = document.getElementById('recipientsList');
            
            if (recipients.length === 0) {
                container.innerHTML = '<div class="empty-state">No hay badges emitidos aún</div>';
                return;
            }

            container.innerHTML = recipients.slice(-5).reverse().map(r => `
                <div class="recipient-item">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    <div class="badge-info">
                        <div class="badge-name">${r.recipientName}</div>
                        <div class="badge-desc">${r.badge.name}</div>
                        <div style="font-size: 10px; color: #6b7280; font-family: monospace; margin-bottom: 2px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="${r.id}">ID: ${r.id}</div>
                        <div style="font-size: 12px; color: #9ca3af;">${new Date(r.issuedOn).toLocaleDateString('es-CL')}</div>
                    </div>
                </div>
            `).join('');
        }

        function updateStats() {
            document.getElementById('totalBadges').textContent = badges.length;
            document.getElementById('totalIssued').textContent = recipients.length;
            
            const uniqueRecipients = new Set(recipients.map(r => r.recipientEmail));
            document.getElementById('totalRecipients').textContent = uniqueRecipients.size;
        }

        function updateBadgeSelect() {
            const select = document.getElementById('badgeSelect');
            select.innerHTML = '<option value="">-- Selecciona un badge --</option>' +
                badges.map(b => `<option value="${b.id}">${b.name}</option>`).join('');
        }

        async function createBadge(event) {
            event.preventDefault();

            if (!apiKey) {
                showAlert('Por favor configura tu API Key en la pestaña API & Integración', 'error');
                return;
            }

            const formData = {
                name: document.getElementById('badgeName').value,
                description: document.getElementById('badgeDescription').value,
                criteria: document.getElementById('badgeCriteria').value,
                imageUrl: document.getElementById('badgeImage').value,
                issuer: 'EduHive'
            };

            try {
                const response = await fetch(`${API_BASE}/badges/create.php`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${apiKey}`
                    },
                    body: JSON.stringify(formData)
                });

                const data = await response.json();

                if (data.success) {
                    showAlert('Badge creado exitosamente', 'success');
                    document.getElementById('createBadgeForm').reset();
                    await loadBadges();
                } else {
                    showAlert(data.error || 'Error al crear badge', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showAlert('Error de conexión al crear badge', 'error');
            }
        }

        async function issueBadge(event) {
            event.preventDefault();

            if (!apiKey) {
                showAlert('Por favor configura tu API Key en la pestaña API & Integración', 'error');
                return;
            }

            const badgeId = document.getElementById('badgeSelect').value;
            const recipientName = document.getElementById('recipientName').value;
            const recipientEmail = document.getElementById('recipientEmail').value;
            const evidence = document.getElementById('evidence').value;

            const selectedBadge = badges.find(b => b.id == badgeId);
            if (!selectedBadge) {
                showAlert('Por favor selecciona un badge', 'error');
                return;
            }

            try {
                const response = await fetch(`${API_BASE}/badges/issue.php`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${apiKey}`
                    },
                    body: JSON.stringify({
                        badgeId: badgeId,
                        recipient: {
                            name: recipientName,
                            email: recipientEmail
                        },
                        evidence: evidence || undefined
                    })
                });

                const data = await response.json();

                if (data.success) {
                    showAlert(`Badge emitido exitosamente a ${recipientName}`, 'success');
                    
                    // Guardar en localStorage
                    recipients.push(data.assertion);
                    localStorage.setItem('eduhive_recipients', JSON.stringify(recipients));
                    
                    renderRecipients();
                    updateStats();
                    
                    document.getElementById('issueBadgeForm').reset();
                } else {
                    showAlert(data.error || 'Error al emitir badge', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showAlert('Error de conexión al emitir badge', 'error');
            }
        }

        function toggleApiKey() {
            const input = document.getElementById('apiKeyInput');
            const btn = event.target;
            
            if (input.type === 'password') {
                input.type = 'text';
                btn.textContent = '👁️ Ocultar';
            } else {
                input.type = 'password';
                btn.textContent = '👁️ Mostrar';
            }
        }

        function saveApiKey() {
            const input = document.getElementById('apiKeyInput');
            apiKey = input.value.trim();
            
            if (apiKey) {
                localStorage.setItem('eduhive_api_key', apiKey);
                showAlert('API Key guardada exitosamente', 'success');
                
                // Actualizar ejemplo
                document.getElementById('exampleRequest').textContent = 
`POST https://badges.eduhive.cl/api/badges/issue.php
Content-Type: application/json
Authorization: Bearer ${apiKey}

{
  "badgeId": "1",
  "recipient": {
    "name": "Juan Pérez",
    "email": "juan@ejemplo.com"
  },
  "evidence": "https://lms.ejemplo.com/curso/123"
}`;
            } else {
                showAlert('Por favor ingresa una API Key válida', 'error');
            }
        }
    </script>
</body>
</html>