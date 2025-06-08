@extends('layouts.layout')

@section('title', 'NEXUS | Editar Producto')
@section('header', 'MODIFICAR ELEMENTO')
@section('description', 'Sistema de actualización avanzado v2.0')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <!-- Formulario holográfico de edición -->
        <div class="holo-edit-container">
            <!-- Header del formulario con datos del producto -->
            <div class="cyber-edit-header">
                <div class="product-scanner">
                    <div class="scanner-line"></div>
                    <div class="product-id">
                        <span class="id-label">ID ELEMENTO:</span>
                        <span class="id-value">#{{ str_pad($producto->id_producto, 6, '0', STR_PAD_LEFT) }}</span>
                    </div>
                </div>
                <div class="cyber-edit-title">
                    <i class="fas fa-edit me-3 cyber-icon pulse-cyber"></i>
                    <span>MÓDULO DE ACTUALIZACIÓN</span>
                </div>
                <div class="cyber-edit-subtitle">
                    Configuración avanzada del elemento {{ strtoupper($producto->nombre) }}
                </div>
            </div>

            <!-- Status bar del producto -->
            <div class="product-status-bar">
                <div class="status-item">
                    <div class="status-indicator active"></div>
                    <span class="status-label">ELEMENTO ACTIVO</span>
                </div>
                <div class="status-item">
                    <div class="status-indicator 
                        @if($producto->stock > 50) high 
                        @elseif($producto->stock > 10) medium 
                        @else low @endif"></div>
                    <span class="status-label">STOCK: {{ $producto->stock }} UNIDADES</span>
                </div>
                <div class="status-item">
                    <div class="status-indicator financial"></div>
                    <span class="status-label">VALOR: S/ {{ number_format($producto->precio, 2) }}</span>
                </div>
            </div>

            <!-- Contenido del formulario de edición -->
            <div class="cyber-edit-content">
                <form action="{{ route('productos.update', $producto->id_producto) }}" method="POST" id="editProductForm" class="cyber-form">
                    @csrf
                    @method('PUT')
                    
                    <!-- Sección de datos principales -->
                    <div class="form-section">
                        <div class="section-header">
                            <h5 class="section-title">
                                <i class="fas fa-microchip me-2 text-cyber"></i>
                                PARÁMETROS PRINCIPALES
                            </h5>
                            <div class="section-line"></div>
                        </div>

                        <div class="row g-4">
                            <!-- Nombre del producto -->
                            <div class="col-12">
                                <div class="cyber-input-group">
                                    <label for="nombre" class="holo-form-label">
                                        <i class="fas fa-tag cyber-icon"></i>
                                        IDENTIFICADOR DEL ELEMENTO
                                        <span class="required-indicator">*</span>
                                    </label>
                                    <div class="input-wrapper">
                                        <input type="text" 
                                               class="holo-form-control @error('nombre') is-invalid @enderror" 
                                               id="nombre" 
                                               name="nombre" 
                                               value="{{ old('nombre', $producto->nombre) }}"
                                               placeholder="Nombre del elemento..."
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
                                               value="{{ old('marca', $producto->marca) }}"
                                               placeholder="Marca del elemento..."
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
                                                        {{ old('id_categoria', $producto->id_categoria) == $categoria->id_categoria ? 'selected' : '' }}>
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
                                CONFIGURACIÓN FINANCIERA
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
                                                   value="{{ old('precio', $producto->precio) }}"
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
                                </div>
                            </div>

                            <!-- Stock -->
                            <div class="col-md-6">
                                <div class="cyber-input-group">
                                    <label for="stock" class="holo-form-label">
                                        <i class="fas fa-warehouse cyber-icon"></i>
                                        INVENTARIO ACTUAL
                                        <span class="required-indicator">*</span>
                                    </label>
                                    <div class="input-wrapper">
                                        <input type="number" 
                                               class="holo-form-control @error('stock') is-invalid @enderror" 
                                               id="stock" 
                                               name="stock" 
                                               value="{{ old('stock', $producto->stock) }}"
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
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección opcional -->
                    <div class="form-section">
                        <div class="section-header">
                            <h5 class="section-title">
                                <i class="fas fa-cogs me-2 text-neon-purple"></i>
                                PARÁMETROS OPCIONALES
                            </h5>
                            <div class="section-line"></div>
                        </div>

                        <div class="cyber-input-group">
                            <label for="descripcion" class="holo-form-label">
                                <i class="fas fa-file-alt cyber-icon"></i>
                                DESCRIPCIÓN TÉCNICA
                            </label>
                            <div class="input-wrapper">
                                <textarea class="holo-form-control @error('descripcion') is-invalid @enderror" 
                                          id="descripcion" 
                                          name="descripcion" 
                                          rows="4" 
                                          placeholder="Especificaciones técnicas del elemento...">{{ old('descripcion', $producto->descripcion) }}</textarea>
                                <div class="input-glow"></div>
                            </div>
                            @error('descripcion')
                                <div class="cyber-error">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Análisis comparativo -->
                    <div class="cyber-analysis" id="analysisPanel">
                        <div class="analysis-header">
                            <h6 class="analysis-title">
                                <i class="fas fa-chart-bar me-2 text-cyber"></i>
                                ANÁLISIS COMPARATIVO
                            </h6>
                            <div class="analysis-scanner"></div>
                        </div>
                        <div class="analysis-content">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <div class="analysis-item">
                                        <span class="analysis-label">PRECIO ORIGINAL:</span>
                                        <span class="analysis-value original">S/ {{ number_format($producto->precio, 2) }}</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="analysis-item">
                                        <span class="analysis-label">PRECIO NUEVO:</span>
                                        <span class="analysis-value new" id="new-precio">S/ {{ number_format($producto->precio, 2) }}</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="analysis-item">
                                        <span class="analysis-label">STOCK ORIGINAL:</span>
                                        <span class="analysis-value original">{{ $producto->stock }} UND</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="analysis-item">
                                        <span class="analysis-label">STOCK NUEVO:</span>
                                        <span class="analysis-value new" id="new-stock">{{ $producto->stock }} UND</span>
                                    </div>
                                </div>
                            </div>
                            <div class="value-difference mt-3">
                                <div class="difference-item">
                                    <span class="difference-label">DIFERENCIA DE VALOR TOTAL:</span>
                                    <span class="difference-value" id="value-difference">S/ 0.00</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Nota de seguridad -->
                    <div class="cyber-security-panel">
                        <i class="fas fa-shield-alt me-2 cyber-icon"></i>
                        <span class="security-text">
                            SISTEMA DE SEGURIDAD: Todos los cambios quedarán registrados en el historial
                        </span>
                    </div>

                    <!-- Botones de acción -->
                    <div class="form-actions">
                        <div class="action-group">
                            <a href="{{ route('productos.show', $producto->id_producto) }}" 
                               class="holo-btn holo-btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                CANCELAR
                            </a>
                            <a href="{{ route('productos.index') }}" 
                               class="holo-btn holo-btn-info me-3">
                                <i class="fas fa-database me-2"></i>
                                LISTADO
                            </a>
                        </div>
                        
                        <div class="action-group">
                            <button type="button" 
                                    class="holo-btn holo-btn-warning me-3"
                                    onclick="resetForm()">
                                <i class="fas fa-undo me-2"></i>
                                RESETEAR
                            </button>
                            <button type="submit" class="holo-btn holo-btn-success">
                                <i class="fas fa-save me-2"></i>
                                ACTUALIZAR
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Contenedor principal de edición */
.holo-edit-container {
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

.holo-edit-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--neon-orange), var(--neon-purple), var(--neon-cyan), var(--neon-orange));
    animation: neon-flow 4s linear infinite;
}

/* Header de edición */
.cyber-edit-header {
    background: linear-gradient(135deg, 
        rgba(255, 102, 0, 0.1) 0%, 
        rgba(138, 43, 226, 0.1) 50%, 
        rgba(0, 245, 255, 0.1) 100%);
    padding: 3rem 2rem;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.cyber-edit-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="edit-grid" width="25" height="25" patternUnits="userSpaceOnUse"><path d="M 0 12.5 L 25 12.5 M 12.5 0 L 12.5 25" stroke="rgba(255,102,0,0.1)" stroke-width="1" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23edit-grid)"/></svg>');
    opacity: 0.3;
}

.product-scanner {
    position: relative;
    margin-bottom: 2rem;
    padding: 1rem;
    border: 1px solid var(--neon-orange);
    border-radius: 15px;
    background: rgba(255, 102, 0, 0.05);
    display: inline-block;
}

.scanner-line {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--neon-orange), transparent);
    animation: scan-edit 2s linear infinite;
}

@keyframes scan-edit {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

.product-id {
    font-family: 'Orbitron', monospace;
    z-index: 1;
    position: relative;
}

.id-label {
    color: var(--text-dim);
    font-size: 0.8rem;
    margin-right: 0.5rem;
}

.id-value {
    color: var(--neon-orange);
    font-weight: 900;
    font-size: 1.2rem;
    text-shadow: 0 0 10px var(--neon-orange);
}

.cyber-edit-title {
    font-family: 'Orbitron', monospace;
    font-size: 2rem;
    font-weight: 900;
    background: linear-gradient(45deg, var(--neon-orange), var(--neon-purple));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.5rem;
    position: relative;
    z-index: 1;
}

.cyber-edit-subtitle {
    color: var(--text-dim);
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    position: relative;
    z-index: 1;
}

/* Barra de estado del producto */
.product-status-bar {
    background: rgba(10, 10, 15, 0.8);
    padding: 1.5rem 2rem;
    display: flex;
    justify-content: space-around;
    align-items: center;
    border-bottom: 1px solid var(--glass-border);
    flex-wrap: wrap;
    gap: 1rem;
}

.status-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.status-indicator {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    position: relative;
    animation: pulse-status 2s infinite;
}

.status-indicator.active {
    background: var(--neon-green);
    box-shadow: 0 0 10px var(--neon-green);
}

.status-indicator.high {
    background: var(--neon-green);
    box-shadow: 0 0 10px var(--neon-green);
}

.status-indicator.medium {
    background: var(--neon-orange);
    box-shadow: 0 0 10px var(--neon-orange);
}

.status-indicator.low {
    background: var(--neon-pink);
    box-shadow: 0 0 10px var(--neon-pink);
}

.status-indicator.financial {
    background: var(--neon-cyan);
    box-shadow: 0 0 10px var(--neon-cyan);
}

@keyframes pulse-status {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.status-label {
    color: var(--text-dim);
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Contenido del formulario de edición */
.cyber-edit-content {
    padding: 3rem;
    background: rgba(26, 26, 46, 0.3);
    backdrop-filter: var(--blur-light);
}

/* Panel de análisis */
.cyber-analysis {
    background: var(--glass-bg);
    border: 1px solid var(--glass-border);
    border-radius: 20px;
    padding: 2rem;
    margin: 2rem 0;
    position: relative;
    overflow: hidden;
}

.cyber-analysis::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--neon-cyan), var(--neon-green));
}

.analysis-header {
    margin-bottom: 1.5rem;
    position: relative;
}

.analysis-title {
    font-family: 'Orbitron', monospace;
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--text-neon);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 1rem;
}

.analysis-scanner {
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--neon-cyan), transparent);
    animation: scan 3s linear infinite;
}

.analysis-content {
    color: var(--text-neon);
}

.analysis-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.75rem;
    padding: 0.75rem;
    background: rgba(255, 255, 255, 0.02);
    border-radius: 10px;
    border: 1px solid rgba(255, 255, 255, 0.05);
}

.analysis-label {
    font-weight: 600;
    color: var(--text-dim);
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.5px;
}

.analysis-value {
    font-weight: 700;
    font-family: 'Orbitron', monospace;
}

.analysis-value.original {
    color: var(--text-dim);
}

.analysis-value.new {
    color: var(--neon-cyan);
    text-shadow: 0 0 5px var(--neon-cyan);
}

.value-difference {
    padding: 1rem;
    background: rgba(57, 255, 20, 0.05);
    border: 1px solid rgba(57, 255, 20, 0.2);
    border-radius: 10px;
    text-align: center;
}

.difference-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.difference-label {
    font-weight: 600;
    color: var(--text-dim);
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 0.5px;
}

.difference-value {
    font-family: 'Orbitron', monospace;
    font-weight: 900;
    font-size: 1.2rem;
    color: var(--neon-green);
    text-shadow: 0 0 10px var(--neon-green);
}

/* Panel de seguridad */
.cyber-security-panel {
    background: rgba(138, 43, 226, 0.1);
    border: 1px solid rgba(138, 43, 226, 0.3);
    border-radius: 15px;
    padding: 1.5rem;
    margin: 2rem 0;
    display: flex;
    align-items: center;
    color: var(--text-dim);
}

.security-text {
    font-weight: 500;
    font-size: 0.9rem;
}

/* Botón secundario específico */
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

/* Textarea específico */
textarea.holo-form-control {
    resize: vertical;
    min-height: 120px;
}

/* Responsive específico para edición */
@media (max-width: 768px) {
    .product-status-bar {
        flex-direction: column;
        text-align: center;
    }
    
    .analysis-item {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
    }
    
    .difference-item {
        flex-direction: column;
        gap: 0.5rem;
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

/* Estados de comparación */
.value-increase {
    color: var(--neon-green) !important;
}

.value-decrease {
    color: var(--neon-pink) !important;
}

.value-equal {
    color: var(--neon-cyan) !important;
}

/* Animación para cambios detectados */
@keyframes change-detected {
    0% { background: rgba(0, 245, 255, 0.1); }
    50% { background: rgba(0, 245, 255, 0.3); }
    100% { background: rgba(0, 245, 255, 0.1); }
}

.change-detected {
    animation: change-detected 1s ease-in-out;
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('editProductForm');
    const inputs = form.querySelectorAll('input, select, textarea');
    
    // Valores originales
    const originalValues = {
        precio: {{ $producto->precio }},
        stock: {{ $producto->stock }},
        nombre: "{{ $producto->nombre }}",
        marca: "{{ $producto->marca ?? '' }}",
        descripcion: "{{ $producto->descripcion ?? '' }}"
    };

    // Validación y efectos en tiempo real
    inputs.forEach(input => {
        input.addEventListener('blur', validateField);
        input.addEventListener('input', function() {
            updateAnalysis();
            detectChanges(this);
        });
        
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

    function updateAnalysis() {
        const newPrecio = parseFloat(document.getElementById('precio').value) || 0;
        const newStock = parseInt(document.getElementById('stock').value) || 0;
        
        // Actualizar valores nuevos
        document.getElementById('new-precio').textContent = `S/ ${newPrecio.toFixed(2)}`;
        document.getElementById('new-stock').textContent = `${newStock} UND`;
        
        // Calcular diferencia de valor total
        const originalTotal = originalValues.precio * originalValues.stock;
        const newTotal = newPrecio * newStock;
        const difference = newTotal - originalTotal;
        
        const differenceElement = document.getElementById('value-difference');
        differenceElement.textContent = `S/ ${difference.toFixed(2)}`;
        
        // Cambiar color según la diferencia
        differenceElement.classList.remove('value-increase', 'value-decrease', 'value-equal');
        if (difference > 0) {
            differenceElement.classList.add('value-increase');
        } else if (difference < 0) {
            differenceElement.classList.add('value-decrease');
        } else {
            differenceElement.classList.add('value-equal');
        }
    }

    function detectChanges(element) {
        const fieldName = element.name;
        const currentValue = element.value;
        
        if (originalValues.hasOwnProperty(fieldName)) {
            if (currentValue != originalValues[fieldName]) {
                element.parentElement.classList.add('change-detected');
                setTimeout(() => {
                    element.parentElement.classList.remove('change-detected');
                }, 1000);
            }
        }
    }

    // Inicializar análisis
    updateAnalysis();
});

function resetForm() {
    if (confirm('⚠️ SISTEMA DE SEGURIDAD\n\n¿Confirmar reseteo de todos los campos?\n\nSe restaurarán los valores originales.')) {
        // Resetear a valores originales
        document.getElementById('nombre').value = "{{ $producto->nombre }}";
        document.getElementById('marca').value = "{{ $producto->marca ?? '' }}";
        document.getElementById('precio').value = "{{ $producto->precio }}";
        document.getElementById('stock').value = "{{ $producto->stock }}";
        document.getElementById('id_categoria').value = "{{ $producto->id_categoria }}";
        document.getElementById('descripcion').value = "{{ $producto->descripcion ?? '' }}";
        
        // Actualizar análisis
        const updateEvent = new Event('input');
        document.getElementById('precio').dispatchEvent(updateEvent);
        
        // Efecto visual
        const analysisPanel = document.getElementById('analysisPanel');
        analysisPanel.style.border = '2px solid var(--neon-orange)';
        analysisPanel.style.boxShadow = '0 0 20px rgba(255, 102, 0, 0.3)';
        
        setTimeout(() => {
            analysisPanel.style.border = '1px solid var(--glass-border)';
            analysisPanel.style.boxShadow = 'none';
        }, 2000);
    }
}

// Manejo del envío del formulario
document.getElementById('editProductForm').addEventListener('submit', function(e) {
    const submitBtn = this.querySelector('button[type="submit"]');
    submitBtn.innerHTML = '<i class="fas fa-sync fa-spin me-2"></i>ACTUALIZANDO...';
    submitBtn.disabled = true;
    submitBtn.style.background = 'rgba(57, 255, 20, 0.3)';
    submitBtn.style.borderColor = 'var(--neon-green)';
});

// Auto-formato del precio
document.getElementById('precio').addEventListener('blur', function(e) {
    let value = e.target.value;
    if (value && !isNaN(value)) {
        e.target.value = parseFloat(value).toFixed(2);
        const updateEvent = new Event('input');
        e.target.dispatchEvent(updateEvent);
    }
});

// Efectos de sonido simulados para botones
document.querySelectorAll('.holo-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        this.style.transform = 'scale(0.95)';
        setTimeout(() => {
            this.style.transform = '';
        }, 150);
    });
});

// Monitoreo de cambios en tiempo real
setInterval(() => {
    const hasChanges = document.querySelectorAll('.is-valid').length > 0;
    const analysisPanel = document.getElementById('analysisPanel');
    
    if (hasChanges) {
        analysisPanel.style.display = 'block';
    }
}, 1000);
</script>
@endsection