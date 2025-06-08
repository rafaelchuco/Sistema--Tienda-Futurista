@extends('layouts.layout')

@section('title', 'NEXUS | Crear Producto')
@section('header', 'CREAR NUEVO PRODUCTO')
@section('description', 'Agrega un nuevo elemento al sistema NEXUS')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <!-- Formulario holográfico principal -->
        <div class="holo-form-container">
            <!-- Header del formulario -->
            <div class="cyber-form-header">
                <div class="cyber-form-title">
                    <i class="fas fa-plus-hexagon me-3 cyber-icon pulse-cyber"></i>
                    <span>INICIALIZAR NUEVO PRODUCTO</span>
                </div>
                <div class="cyber-form-subtitle">
                    Sistema de registro avanzado v2.0
                </div>
            </div>

            <!-- Contenido del formulario -->
            <div class="cyber-form-content">
                <form action="{{ route('productos.store') }}" method="POST" id="createProductForm" class="cyber-form">
                    @csrf
                    
                    <!-- Sección de datos principales -->
                    <div class="form-section">
                        <div class="section-header">
                            <h5 class="section-title">
                                <i class="fas fa-microchip me-2 text-cyber"></i>
                                DATOS PRINCIPALES
                            </h5>
                            <div class="section-line"></div>
                        </div>

                        <div class="row g-4">
                            <!-- Nombre del producto -->
                            <div class="col-12">
                                <div class="cyber-input-group">
                                    <label for="nombre" class="holo-form-label">
                                        <i class="fas fa-tag cyber-icon"></i>
                                        IDENTIFICADOR DEL PRODUCTO
                                        <span class="required-indicator">*</span>
                                    </label>
                                    <div class="input-wrapper">
                                        <input type="text" 
                                               class="holo-form-control @error('nombre') is-invalid @enderror" 
                                               id="nombre" 
                                               name="nombre" 
                                               value="{{ old('nombre') }}"
                                               placeholder="Ingrese el nombre del producto..."
                                               autocomplete="off" 
                                               required>
                                        <div class="input-glow"></div>
                                    </div>
                                    @error('nombre')
                                        <div class="cyber-error">
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Marca y Categoría -->
                            <div class="col-md-6">
                                <div class="cyber-input-group">
                                    <label for="marca" class="holo-form-label">
                                        <i class="fas fa-industry cyber-icon"></i>
                                        FABRICANTE
                                    </label>
                                    <div class="input-wrapper">
                                        <input type="text" 
                                               class="holo-form-control @error('marca') is-invalid @enderror" 
                                               id="marca" 
                                               name="marca" 
                                               value="{{ old('marca') }}"
                                               placeholder="Marca del producto..."
                                               autocomplete="off">
                                        <div class="input-glow"></div>
                                    </div>
                                    @error('marca')
                                        <div class="cyber-error">
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="cyber-input-group">
                                    <label for="id_categoria" class="holo-form-label">
                                        <i class="fas fa-sitemap cyber-icon"></i>
                                        CLASIFICACIÓN
                                        <span class="required-indicator">*</span>
                                    </label>
                                    <div class="input-wrapper">
                                        <select class="holo-form-select @error('id_categoria') is-invalid @enderror" 
                                                id="id_categoria" 
                                                name="id_categoria" 
                                                required>
                                            <option value="">[ SELECCIONAR CATEGORÍA ]</option>
                                            @foreach($categorias as $categoria)
                                                <option value="{{ $categoria->id_categoria }}" 
                                                        {{ old('id_categoria') == $categoria->id_categoria ? 'selected' : '' }}>
                                                    {{ strtoupper($categoria->descripcion) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="input-glow"></div>
                                    </div>
                                    @error('id_categoria')
                                        <div class="cyber-error">
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección de datos económicos -->
                    <div class="form-section">
                        <div class="section-header">
                            <h5 class="section-title">
                                <i class="fas fa-chart-line me-2 text-neon-green"></i>
                                PARÁMETROS ECONÓMICOS
                            </h5>
                            <div class="section-line"></div>
                        </div>

                        <div class="row g-4">
                            <!-- Precio -->
                            <div class="col-md-6">
                                <div class="cyber-input-group">
                                    <label for="precio" class="holo-form-label">
                                        <i class="fas fa-coins cyber-icon"></i>
                                        VALOR UNITARIO (PEN)
                                        <span class="required-indicator">*</span>
                                    </label>
                                    <div class="input-wrapper">
                                        <div class="input-group cyber-input-group-addon">
                                            <span class="cyber-input-addon">S/</span>
                                            <input type="number" 
                                                   class="holo-form-control @error('precio') is-invalid @enderror" 
                                                   id="precio" 
                                                   name="precio" 
                                                   value="{{ old('precio') }}"
                                                   placeholder="0.00"
                                                   step="0.01" 
                                                   min="0"
                                                   autocomplete="off" 
                                                   required>
                                        </div>
                                        <div class="input-glow"></div>
                                    </div>
                                    @error('precio')
                                        <div class="cyber-error">
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="cyber-help-text">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Precio en soles peruanos
                                    </div>
                                </div>
                            </div>

                            <!-- Stock -->
                            <div class="col-md-6">
                                <div class="cyber-input-group">
                                    <label for="stock" class="holo-form-label">
                                        <i class="fas fa-warehouse cyber-icon"></i>
                                        INVENTARIO INICIAL
                                        <span class="required-indicator">*</span>
                                    </label>
                                    <div class="input-wrapper">
                                        <input type="number" 
                                               class="holo-form-control @error('stock') is-invalid @enderror" 
                                               id="stock" 
                                               name="stock" 
                                               value="{{ old('stock', 0) }}"
                                               placeholder="0"
                                               min="0"
                                               autocomplete="off" 
                                               required>
                                        <div class="input-glow"></div>
                                    </div>
                                    @error('stock')
                                        <div class="cyber-error">
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="cyber-help-text">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Unidades disponibles
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Preview del producto -->
                    <div class="cyber-preview" id="productPreview" style="display: none;">
                        <div class="preview-header">
                            <h6 class="preview-title">
                                <i class="fas fa-scanner me-2 text-cyber"></i>
                                ANÁLISIS DEL PRODUCTO
                            </h6>
                            <div class="scanning-line"></div>
                        </div>
                        <div class="preview-content">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="preview-item">
                                        <span class="preview-label">IDENTIFICADOR:</span>
                                        <span class="preview-value" id="preview-nombre">-</span>
                                    </div>
                                    <div class="preview-item">
                                        <span class="preview-label">FABRICANTE:</span>
                                        <span class="preview-value" id="preview-marca">-</span>
                                    </div>
                                    <div class="preview-item">
                                        <span class="preview-label">CATEGORÍA:</span>
                                        <span class="preview-value" id="preview-categoria">-</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="preview-item">
                                        <span class="preview-label">PRECIO:</span>
                                        <span class="preview-value text-neon-green" id="preview-precio">-</span>
                                    </div>
                                    <div class="preview-item">
                                        <span class="preview-label">STOCK:</span>
                                        <span class="preview-value" id="preview-stock">-</span>
                                    </div>
                                    <div class="preview-item">
                                        <span class="preview-label">ESTADO:</span>
                                        <span class="status-badge active">ACTIVO</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Nota informativa -->
                    <div class="cyber-info-panel">
                        <i class="fas fa-shield-alt me-2 cyber-icon"></i>
                        <span class="info-text">
                            Los campos marcados con <span class="required-indicator">*</span> son requeridos por el sistema
                        </span>
                    </div>

                    <!-- Botones de acción -->
                    <div class="form-actions">
                        <div class="action-group">
                            <a href="{{ route('productos.index') }}" class="holo-btn holo-btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                CANCELAR
                            </a>
                        </div>
                        
                        <div class="action-group">
                            <button type="button" 
                                    class="holo-btn holo-btn-info me-3"
                                    onclick="togglePreview()">
                                <i class="fas fa-eye me-2"></i>
                                PREVIEW
                            </button>
                            <button type="submit" class="holo-btn holo-btn-success">
                                <i class="fas fa-save me-2"></i>
                                REGISTRAR
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Contenedor principal del formulario */
.holo-form-container {
    background: var(--glass-bg);
    backdrop-filter: var(--blur-medium);
    border: 1px solid var(--glass-border);
    border-radius: 25px;
    overflow: hidden;
    box-shadow: 
        0 8px 32px rgba(0, 0, 0, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
    position: relative;
}

.holo-form-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--neon-cyan), var(--neon-purple), var(--neon-green), var(--neon-cyan));
    animation: neon-flow 4s linear infinite;
}

/* Header del formulario */
.cyber-form-header {
    background: linear-gradient(135deg, 
        rgba(0, 245, 255, 0.1) 0%, 
        rgba(138, 43, 226, 0.1) 50%, 
        rgba(57, 255, 20, 0.1) 100%);
    padding: 3rem 2rem;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.cyber-form-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="circuit" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 0 10 L 10 10 M 10 0 L 10 20 M 10 10 L 20 10" stroke="rgba(0,245,255,0.1)" stroke-width="1" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23circuit)"/></svg>');
    opacity: 0.3;
}

.cyber-form-title {
    font-family: 'Orbitron', monospace;
    font-size: 2rem;
    font-weight: 900;
    background: linear-gradient(45deg, var(--neon-cyan), var(--neon-purple));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.5rem;
    position: relative;
    z-index: 1;
}

.cyber-form-subtitle {
    color: var(--text-dim);
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    position: relative;
    z-index: 1;
}

/* Contenido del formulario */
.cyber-form-content {
    padding: 3rem;
    background: rgba(26, 26, 46, 0.3);
    backdrop-filter: var(--blur-light);
}

/* Secciones del formulario */
.form-section {
    margin-bottom: 3rem;
    padding: 2rem;
    background: var(--glass-bg);
    border: 1px solid var(--glass-border);
    border-radius: 20px;
    position: relative;
}

.section-header {
    margin-bottom: 2rem;
    position: relative;
}

.section-title {
    font-family: 'Orbitron', monospace;
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--text-neon);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 1rem;
}

.section-line {
    height: 2px;
    background: linear-gradient(90deg, var(--neon-cyan), transparent);
    border-radius: 1px;
}

/* Grupos de input */
.cyber-input-group {
    position: relative;
    margin-bottom: 1.5rem;
}

.input-wrapper {
    position: relative;
}

.holo-form-control,
.holo-form-select {
    background: rgba(15, 23, 42, 0.5);
    backdrop-filter: var(--blur-light);
    border: 2px solid var(--glass-border);
    border-radius: 15px;
    color: var(--text-neon);
    padding: 1rem 1.5rem;
    font-size: 1rem;
    transition: all 0.3s ease;
    width: 100%;
    font-family: 'Exo 2', monospace;
}

.holo-form-control:focus,
.holo-form-select:focus {
    background: rgba(0, 245, 255, 0.05);
    border-color: var(--neon-cyan);
    box-shadow: var(--glow-cyan);
    color: var(--text-neon);
    transform: translateY(-2px);
    outline: none;
}

.holo-form-control::placeholder {
    color: var(--text-dark);
    opacity: 0.7;
}

.input-glow {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    border-radius: 15px;
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
    background: linear-gradient(45deg, transparent, rgba(0, 245, 255, 0.1), transparent);
}

.holo-form-control:focus + .input-glow,
.holo-form-select:focus + .input-glow {
    opacity: 1;
}

/* Input group con addon */
.cyber-input-group-addon {
    display: flex;
    align-items: stretch;
}

.cyber-input-addon {
    background: rgba(0, 245, 255, 0.1);
    border: 2px solid var(--glass-border);
    border-right: none;
    border-radius: 15px 0 0 15px;
    color: var(--neon-cyan);
    display: flex;
    align-items: center;
    padding: 0 1rem;
    font-weight: 700;
    font-family: 'Orbitron', monospace;
}

.cyber-input-group-addon .holo-form-control {
    border-radius: 0 15px 15px 0;
    border-left: none;
}

/* Required indicator */
.required-indicator {
    color: var(--neon-pink);
    font-weight: 900;
    margin-left: 0.5rem;
    text-shadow: 0 0 5px var(--neon-pink);
}

/* Error messages */
.cyber-error {
    color: var(--neon-pink);
    font-size: 0.875rem;
    margin-top: 0.5rem;
    font-weight: 500;
    display: flex;
    align-items: center;
}

/* Help text */
.cyber-help-text {
    color: var(--text-dark);
    font-size: 0.8rem;
    margin-top: 0.5rem;
    display: flex;
    align-items: center;
}

/* Preview del producto */
.cyber-preview {
    background: var(--glass-bg);
    border: 1px solid var(--glass-border);
    border-radius: 20px;
    padding: 2rem;
    margin: 2rem 0;
    position: relative;
    overflow: hidden;
}

.cyber-preview::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--neon-green), var(--neon-cyan));
}

.preview-header {
    margin-bottom: 1.5rem;
    position: relative;
}

.preview-title {
    font-family: 'Orbitron', monospace;
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--text-neon);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 1rem;
}

.scanning-line {
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--neon-green), transparent);
    animation: scan 2s linear infinite;
}

@keyframes scan {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

.preview-content {
    color: var(--text-neon);
}

.preview-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.75rem;
    padding: 0.5rem 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.preview-label {
    font-weight: 600;
    color: var(--text-dim);
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 0.5px;
}

.preview-value {
    color: var(--text-neon);
    font-weight: 500;
    font-family: 'Orbitron', monospace;
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-badge.active {
    background: linear-gradient(135deg, var(--neon-green), rgba(57, 255, 20, 0.7));
    color: var(--dark-void);
}

/* Panel informativo */
.cyber-info-panel {
    background: rgba(138, 43, 226, 0.1);
    border: 1px solid rgba(138, 43, 226, 0.3);
    border-radius: 15px;
    padding: 1.5rem;
    margin: 2rem 0;
    display: flex;
    align-items: center;
    color: var(--text-dim);
}

.info-text {
    font-weight: 500;
}

/* Botones de acción */
.form-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 1px solid var(--glass-border);
}

.action-group {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.holo-btn-secondary {
    color: var(--text-dim);
    border-color: var(--glass-border);
}

.holo-btn-secondary:hover {
    color: var(--text-neon);
    background: rgba(255, 255, 255, 0.05);
    border-color: var(--text-dim);
    transform: translateY(-2px);
}

/* Validación visual */
.holo-form-control.is-valid,
.holo-form-select.is-valid {
    border-color: var(--neon-green);
    box-shadow: 0 0 10px rgba(57, 255, 20, 0.3);
}

.holo-form-control.is-invalid,
.holo-form-select.is-invalid {
    border-color: var(--neon-pink);
    box-shadow: 0 0 10px rgba(255, 20, 147, 0.3);
}

/* Responsive */
@media (max-width: 768px) {
    .cyber-form-content {
        padding: 2rem 1.5rem;
    }
    
    .form-section {
        padding: 1.5rem;
    }
    
    .cyber-form-title {
        font-size: 1.5rem;
    }
    
    .form-actions {
        flex-direction: column;
        gap: 1rem;
    }
    
    .action-group {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('createProductForm');
    const inputs = form.querySelectorAll('input, select');
    
    // Validación en tiempo real
    inputs.forEach(input => {
        input.addEventListener('blur', validateField);
        input.addEventListener('input', updatePreview);
        
        // Efecto de enfoque
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });

    function validateField(e) {
        const field = e.target;
        const value = field.value.trim();
        
        field.classList.remove('is-valid', 'is-invalid');
        
        if (field.hasAttribute('required') && !value) {
            field.classList.add('is-invalid');
            return;
        }
        
        switch(field.name) {
            case 'precio':
                if (value && (isNaN(value) || parseFloat(value) < 0)) {
                    field.classList.add('is-invalid');
                    return;
                }
                break;
            case 'stock':
                if (value && (isNaN(value) || parseInt(value) < 0)) {
                    field.classList.add('is-invalid');
                    return;
                }
                break;
        }
        
        if (value) {
            field.classList.add('is-valid');
        }
    }

    function updatePreview() {
        const nombre = document.getElementById('nombre').value;
        const marca = document.getElementById('marca').value || 'SIN ESPECIFICAR';
        const precio = document.getElementById('precio').value;
        const stock = document.getElementById('stock').value;
        const categoriaSelect = document.getElementById('id_categoria');
        const categoria = categoriaSelect.options[categoriaSelect.selectedIndex].text;

        if (nombre || marca !== 'SIN ESPECIFICAR' || precio || stock) {
            document.getElementById('preview-nombre').textContent = nombre.toUpperCase() || '-';
            document.getElementById('preview-marca').textContent = marca.toUpperCase();
            document.getElementById('preview-categoria').textContent = categoria === '[ SELECCIONAR CATEGORÍA ]' ? '-' : categoria;
            document.getElementById('preview-precio').textContent = precio ? `S/ ${parseFloat(precio).toFixed(2)}` : '-';
            document.getElementById('preview-stock').textContent = stock ? `${stock} UNIDADES` : '-';
        }
    }
});

function togglePreview() {
    const preview = document.getElementById('productPreview');
    const btn = document.querySelector('[onclick="togglePreview()"]');
    
    if (preview.style.display === 'none') {
        preview.style.display = 'block';
        btn.innerHTML = '<i class="fas fa-eye-slash me-2"></i>OCULTAR';
        
        // Simular efecto de escaneo
        const scanLine = preview.querySelector('.scanning-line');
        scanLine.style.animation = 'scan 0.5s linear';
        
        setTimeout(() => {
            scanLine.style.animation = 'scan 2s linear infinite';
        }, 500);
    } else {
        preview.style.display = 'none';
        btn.innerHTML = '<i class="fas fa-eye me-2"></i>PREVIEW';
    }
    
    // Actualizar contenido del preview
    const updateEvent = new Event('input');
    document.getElementById('nombre').dispatchEvent(updateEvent);
}

// Manejo del envío del formulario
document.getElementById('createProductForm').addEventListener('submit', function(e) {
    const submitBtn = this.querySelector('button[type="submit"]');
    submitBtn.innerHTML = '<i class="fas fa-sync fa-spin me-2"></i>PROCESANDO...';
    submitBtn.disabled = true;
    submitBtn.style.background = 'rgba(57, 255, 20, 0.3)';
    submitBtn.style.borderColor = 'var(--neon-green)';
});

// Auto-formato del precio
document.getElementById('precio').addEventListener('blur', function(e) {
    let value = e.target.value;
    if (value && !isNaN(value)) {
        e.target.value = parseFloat(value).toFixed(2);
    }
});

// Efectos de sonido simulados (opcional)
document.querySelectorAll('.holo-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        // Simular feedback táctil/visual
        this.style.transform = 'scale(0.95)';
        setTimeout(() => {
            this.style.transform = '';
        }, 150);
    });
});

// Animación de typing para placeholders
function typewriterPlaceholder(element, text, speed = 100) {
    let i = 0;
    element.placeholder = '';
    const timer = setInterval(() => {
        element.placeholder += text.charAt(i);
        i++;
        if (i >= text.length) {
            clearInterval(timer);
        }
    }, speed);
}

// Aplicar efecto typewriter a algunos inputs
setTimeout(() => {
    const nombreInput = document.getElementById('nombre');
    if (nombreInput && !nombreInput.value) {
        typewriterPlaceholder(nombreInput, 'Ingrese el nombre del producto...', 50);
    }
}, 1000);
</script>
@endsection