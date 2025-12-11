// resources/js/badge-editor.js
let canvas;

document.addEventListener('DOMContentLoaded', () => {
    // 1. Inicializar Canvas
    if(document.getElementById('badgeCanvas')) {
        initCanvas();
        setupEventListeners();
    }
});

function initCanvas() {
    canvas = new fabric.Canvas('badgeCanvas', {
        width: 400,
        height: 400,
        backgroundColor: null,
        preserveObjectStacking: true
    });

    // Eventos de FabricJS para actualizar capas
    canvas.on('object:added', updateLayersPanel);
    canvas.on('object:removed', updateLayersPanel);
    canvas.on('object:modified', updateLayersPanel);
    canvas.on('selection:created', highlightLayer);
    canvas.on('selection:updated', highlightLayer);
    canvas.on('selection:cleared', () => {
        document.querySelectorAll('.layer-item').forEach(el => el.classList.remove('active'));
    });
}

function setupEventListeners() {
    // Botón Fondo
    document.getElementById('btnBg').addEventListener('click', () => {
        document.getElementById('bgInput').click();
    });

    // Input File (Fondo)
    document.getElementById('bgInput').addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = (f) => {
            fabric.Image.fromURL(f.target.result, (img) => {
                img.scaleToWidth(400);
                img.set({ 
                    name: 'Fondo (' + file.name + ')',
                    left: 200, top: 200, originX: 'center', originY: 'center'
                });
                canvas.add(img);
                canvas.sendToBack(img);
                canvas.setActiveObject(img);
            });
        };
        reader.readAsDataURL(file);
        e.target.value = ''; // Reset
    });

    // Botón Texto
    document.getElementById('btnText').addEventListener('click', () => {
        const text = new fabric.IText('Texto', {
            left: 200, top: 200, originX: 'center', originY: 'center',
            fontFamily: 'Arial', fontSize: 30, fill: document.getElementById('colorPicker').value,
            name: 'Texto'
        });
        canvas.add(text);
        canvas.setActiveObject(text);
    });

    // Botón Eliminar
    document.getElementById('btnDelete').addEventListener('click', () => {
        const obj = canvas.getActiveObject();
        if (obj) canvas.remove(obj);
    });

    // Color Picker
    document.getElementById('colorPicker').addEventListener('input', (e) => {
        const obj = canvas.getActiveObject();
        if (obj) {
            if (obj.type === 'image' || obj.type === 'path') {
                obj.set('stroke', e.target.value); 
                // Nota: cambiar color a SVG complejos requiere filtros más avanzados
            } else {
                obj.set('fill', e.target.value);
            }
            canvas.requestRenderAll();
        }
    });

    // Botones de Assets (Iconos)
    document.querySelectorAll('.asset-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const type = btn.dataset.type;
            
            if (type === 'svg') {
                fabric.Image.fromURL(btn.src, (img) => {
                    img.scale(3);
                    img.set({ 
                        name: btn.dataset.name || 'Icono',
                        left: 200, top: 200, originX: 'center', originY: 'center' 
                    });
                    canvas.add(img);
                    canvas.setActiveObject(img);
                });
            } else if (type === 'rect') {
                const rect = new fabric.Rect({
                    width: 100, height: 100, fill: document.getElementById('colorPicker').value, name: 'Rectángulo',
                    left: 200, top: 200, originX: 'center', originY: 'center'
                });
                canvas.add(rect);
                canvas.setActiveObject(rect);
            } else if (type === 'circle') {
                const circ = new fabric.Circle({
                    radius: 50, fill: document.getElementById('colorPicker').value, name: 'Círculo',
                    left: 200, top: 200, originX: 'center', originY: 'center'
                });
                canvas.add(circ);
                canvas.setActiveObject(circ);
            }
        });
    });
}

// --- Gestión de Capas ---
function updateLayersPanel() {
    const container = document.getElementById('layersList');
    if(!container) return;
    
    container.innerHTML = '';
    const objects = canvas.getObjects().slice().reverse();

    if (objects.length === 0) {
        container.innerHTML = '<div class="empty-state" style="padding: 20px; font-size: 12px; text-align: center; color: #94a3b8;">Lienzo vacío</div>';
        return;
    }

    objects.forEach((obj) => {
        const div = document.createElement('div');
        div.className = 'layer-item';
        div.style.cssText = 'display: flex; align-items: center; padding: 8px; background: #fff; border: 1px solid #e2e8f0; margin-bottom: 4px; border-radius: 4px; cursor: pointer; transition: all 0.2s;';
        
        div.onclick = () => {
            canvas.setActiveObject(obj);
            canvas.renderAll();
        };

        const nameSpan = document.createElement('span');
        nameSpan.style.cssText = 'flex: 1; font-size: 12px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-weight: 500;';
        nameSpan.innerText = obj.name || obj.type;
        
        const controls = document.createElement('div');
        controls.style.cssText = 'display: flex; gap: 4px;';
        
        const createBtn = (html, title, color, action) => {
            const btn = document.createElement('button');
            btn.innerHTML = html;
            btn.title = title;
            btn.style.cssText = `background: none; border: none; cursor: pointer; padding: 2px; font-size: 12px; border-radius: 3px; ${color ? 'color:'+color : ''}`;
            btn.onclick = (e) => { e.stopPropagation(); action(); };
            return btn;
        };

        controls.appendChild(createBtn('⬆', 'Subir', null, () => { obj.bringForward(); canvas.renderAll(); updateLayersPanel(); }));
        controls.appendChild(createBtn('⬇', 'Bajar', null, () => { obj.sendBackwards(); canvas.renderAll(); updateLayersPanel(); }));
        controls.appendChild(createBtn('×', 'Eliminar', 'red', () => { canvas.remove(obj); }));

        div.appendChild(nameSpan);
        div.appendChild(controls);
        container.appendChild(div);
    });
    highlightLayer();
}

function highlightLayer() {
    const activeObj = canvas.getActiveObject();
    const items = document.querySelectorAll('.layer-item');
    items.forEach(i => {
        i.style.background = '#fff';
        i.style.borderColor = '#e2e8f0';
        i.style.borderLeft = '1px solid #e2e8f0';
    });
    
    if (!activeObj) return;
    const objects = canvas.getObjects().slice().reverse();
    const visualIndex = objects.indexOf(activeObj);
    
    if (visualIndex >= 0 && items[visualIndex]) {
        items[visualIndex].style.background = '#eff6ff';
        items[visualIndex].style.borderColor = '#3b82f6';
        items[visualIndex].style.borderLeft = '3px solid #3b82f6';
    }
}

// --- Guardado Global (necesitamos que sea global para el botón del formulario) ---
window.saveBadgeWithEditor = async function() {
    const name = document.getElementById('badgeName').value;
    const desc = document.getElementById('badgeDescription').value;
    const shape = document.getElementById('badgeShapeSelect').value;

    if(!name) { 
        alert('Ponle nombre al badge'); 
        return; 
    }

    // Aplicar recorte
    let clipPath;
    if (shape === 'circle') {
        clipPath = new fabric.Circle({ radius: 200, left: 200, top: 200, originX: 'center', originY: 'center' });
    } else if (shape === 'hexagon') {
        clipPath = new fabric.Polygon([
            {x: 100, y: 0}, {x: 300, y: 0}, {x: 400, y: 200},
            {x: 300, y: 400}, {x: 100, y: 400}, {x: 0, y: 200}
        ], { left: 200, top: 200, originX: 'center', originY: 'center' });
    }
    
    if(clipPath) {
        canvas.clipPath = clipPath;
        canvas.requestRenderAll();
    }

    // Exportar
    setTimeout(async () => {
        canvas.getElement().toBlob(async (blob) => {
            const formData = new FormData();
            formData.append('name', name);
            formData.append('description', desc);
            formData.append('criteria', 'Generado con Editor Web');
            formData.append('image_file', blob, 'badge.png');

            try {
                // Usamos API_BASE global si existe
                const apiBase = window.APP_CONFIG ? window.APP_CONFIG.API_BASE : '/api';
                const apiKey = localStorage.getItem('eduhive_api_key');
                
                const response = await fetch(`${apiBase}/badges/create`, {
                    method: 'POST',
                    headers: { 'Authorization': `Bearer ${apiKey}` },
                    body: formData
                });
                const data = await response.json();
                
                if(data.success) {
                    alert('¡Badge creado exitosamente!');
                    canvas.clear();
                    canvas.clipPath = null;
                    document.getElementById('createBadgeForm').reset();
                    updateLayersPanel();
                    // Recargar lista si estamos en la misma página
                    if(window.loadBadges) window.loadBadges();
                } else {
                    alert('Error: ' + (data.error || JSON.stringify(data)));
                }
            } catch(e) {
                console.error(e);
                alert('Error de conexión');
            }
            // Restaurar para seguir editando
            canvas.clipPath = null;
            canvas.requestRenderAll();
        });
    }, 100);
};