@extends('layouts.layout')

@section('title', 'NEXUS | Análisis de Elemento')
@section('header', 'ANÁLISIS DETALLADO')
@section('description', 'Sistema de inspección holográfica avanzada')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <!-- Scanner de producto principal -->
        <div class="cyber-scanner-container">
            <div class="scanner-header">
                <div class="element-id-display">
                    <span class="id-prefix">ID ELEMENTO:</span>
                    <span class="id-value">#{{ str_pad($producto->id_producto, 6, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="scanner-line"></div>
            </div>
            
            <div class="product-title-section">
                <h1 class="product-name">{{ strtoupper($producto->nombre) }}</h1>
                <div class="product-status">
                    @if($producto->stock > 0)
                        <span class="status-active">
                            <i class="fas fa-check-circle me-2"></i>
                            ELEMENTO ACTIVO
                        </span>
                    @else
                        <span class="status-inactive">
                            <i class="fas fa-times-circle me-2"></i>
                            ELEMENTO INACTIVO
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Datos holográficos principales -->
        <div class="row g-4 mb-4">
            <div class="col-lg-8">
                <!-- Panel de información técnica -->
                <div class="holo-info-panel">
                    <div class="panel-header">
                        <h3 class="panel-title">
                            <i class="fas fa-microchip me-2 cyber-icon"></i>
                            ESPECIFICACIONES TÉCNICAS
                        </h3>
                        <div class="panel-scanner"></div>
                    </div>

                    <div class="panel-content">
                        <div class="row g-4">
                            <!-- Identificador -->
                            <div class="col-12">
                                <div class="data-field">
                                    <label class="field-label">
                                        <i class="fas fa-tag cyber-icon"></i>
                                        IDENTIFICADOR PRIMARIO
                                    </label>
                                    <div class="field-value primary">
                                        {{ strtoupper($producto->nombre) }}
                                    </div>
                                </div>
                            </div>

                            <!-- Fabricante y Categoría -->
                            <div class="col-md-6">
                                <div class="data-field">
                                    <label class="field-label">
                                        <i class="fas fa-industry cyber-icon"></i>
                                        FABRICANTE
                                    </label>
                                    <div class="field-value">
                                        @if($producto->marca)
                                            <span class="manufacturer-badge">{{ strtoupper($producto->marca) }}</span>
                                        @else
                                            <span class="no-data">SIN ESPECIFICAR</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="data-field">
                                    <label class="field-label">
                                        <i class="fas fa-sitemap cyber-icon"></i>
                                        CLASIFICACIÓN
                                    </label>
                                    <div class="field-value">
                                        @if($producto->categoria)
                                            <span class="category-badge">
                                                {{ strtoupper($producto->categoria->descripcion) }}
                                            </span>
                                        @else
                                            <span class="no-data">SIN CLASIFICAR</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Valor y Stock -->
                            <div class="col-md-6">
                                <div class="data-field">
                                    <label class="field-label">
                                        <i class="fas fa-coins cyber-icon"></i>
                                        VALOR UNITARIO
                                    </label>
                                    <div class="field-value financial">
                                        S/ {{ number_format($producto->precio, 2) }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="data-field">
                                    <label class="field-label">
                                        <i class="fas fa-warehouse cyber-icon"></i>
                                        INVENTARIO DISPONIBLE
                                    </label>
                                    <div class="field-value stock">
                                        @if($producto->stock > 50)
                                            <span class="stock-high">
                                                <i class="fas fa-check-circle me-2"></i>
                                                {{ $producto->stock }} UNIDADES
                                            </span>
                                        @elseif($producto->stock > 10)
                                            <span class="stock-medium">
                                                <i class="fas fa-exclamation-triangle me-2"></i>
                                                {{ $producto->stock }} UNIDADES
                                            </span>
                                        @else
                                            <span class="stock-low">
                                                <i class="fas fa-times-circle me-2"></i>
                                                {{ $producto->stock }} UNIDADES
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Descripción técnica -->
                            @if($producto->descripcion)
                            <div class="col-12">
                                <div class="data-field">
                                    <label class="field-label">
                                        <i class="fas fa-file-alt cyber-icon"></i>
                                        DESCRIPCIÓN TÉCNICA
                                    </label>
                                    <div class="field-value description">
                                        {{ $producto->descripcion }}
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Panel de control y acciones -->
                <div class="holo-control-panel">
                    <div class="panel-header">
                        <h3 class="panel-title">
                            <i class="fas fa-cogs me-2 cyber-icon"></i>
                            PANEL DE CONTROL
                        </h3>
                        <div class="panel-scanner"></div>
                    </div>

                    <div class="panel-content">
                        <div class="control-actions">
                            <a href="{{ route('productos.edit', $producto->id_producto) }}" 
                               class="holo-btn holo-btn-warning w-100 mb-3">
                                <i class="fas fa-edit me-2"></i>
                                MODIFICAR ELEMENTO
                            </a>

                            <a href="{{ route('productos.index') }}" 
                               class="holo-btn holo-btn-info w-100 mb-3">
                                <i class="fas fa-database me-2"></i>
                                VOLVER AL LISTADO
                            </a>

                            <form action="{{ route('productos.destroy', $producto->id_producto) }}" 
                                  method="POST" 
                                  onsubmit="return confirmDelete('{{ $producto->nombre }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="holo-btn holo-btn-danger w-100">
                                    <i class="fas fa-trash me-2"></i>
                                    ELIMINAR ELEMENTO
                                </button>
                            </form>
                        </div>

                        <!-- Análisis financiero -->
                        <div class="financial-analysis mt-4">
                            <h6 class="analysis-title">
                                <i class="fas fa-chart-line me-2 cyber-icon"></i>
                                ANÁLISIS FINANCIERO
                            </h6>
                            <div class="analysis-grid">
                                <div class="analysis-item">
                                    <span class="analysis-label">VALOR TOTAL:</span>
                                    <span class="analysis-value financial">
                                        S/ {{ number_format($producto->precio * $producto->stock, 2) }}
                                    </span>
                                </div>
                                <div class="analysis-item">
                                    <span class="analysis-label">VALOR PROMEDIO:</span>
                                    <span class="analysis-value">
                                        S/ {{ number_format($producto->precio, 2) }}
                                    </span>
                                </div>
                                <div class="analysis-item">
                                    <span class="analysis-label">ROTACIÓN:</span>
                                    <span class="analysis-value success">
                                        @if($producto->stock > 30) ALTA
                                        @elseif($producto->stock > 10) MEDIA
                                        @else BAJA @endif
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Estado del sistema -->
                        <div class="system-status mt-4">
                            <h6 class="status-title">
                                <i class="fas fa-shield-alt me-2 cyber-icon"></i>
                                ESTADO DEL SISTEMA
                            </h6>
                            <div class="status-indicators">
                                <div class="status-item">
                                    <div class="status-dot active"></div>
                                    <span class="status-text">ELEMENTO VERIFICADO</span>
                                </div>
                                <div class="status-item">
                                    <div class="status-dot 
                                        @if($producto->stock > 0) active 
                                        @else inactive @endif"></div>
                                    <span class="status-text">
                                        @if($producto->stock > 0) INVENTARIO ACTIVO
                                        @else INVENTARIO AGOTADO @endif
                                    </span>
                                </div>
                                <div class="status-item">
                                    <div class="status-dot active"></div>
                                    <span class="status-text">DATOS SINCRONIZADOS</span>
                                </div>
                            </div>
                            <div class="last-update">
                                <small class="update-text">
                                    ÚLTIMA ACTUALIZACIÓN: 
                                    {{ $producto->updated_at ? $producto->updated_at->format('d/m/Y H:i:s') : 'N/A' }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Métricas holográficas -->
        <div class="cyber-metrics">
            <div class="metrics-header">
                <h3 class="metrics-title">
                    <i class="fas fa-chart-pie me-2 cyber-icon"></i>
                    MÉTRICAS DEL ELEMENTO
                </h3>
                <div class="metrics-scanner"></div>
            </div>

            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="metric-card primary">
                        <div class="metric-icon">
                            <i class="fas fa-money-bill-wave cyber-icon"></i>
                        </div>
                        <div class="metric-value">S/ {{ number_format($producto->precio, 2) }}</div>
                        <div class="metric-label">PRECIO UNITARIO</div>
                        <div class="metric-progress">
                            <div class="progress-bar cyan"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="metric-card secondary">
                        <div class="metric-icon">
                            <i class="fas fa-boxes cyber-icon"></i>
                        </div>
                        <div class="metric-value">{{ $producto->stock }}</div>
                        <div class="metric-label">UNIDADES DISPONIBLES</div>
                        <div class="metric-progress">
                            <div class="progress-bar purple"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="metric-card tertiary">
                        <div class="metric-icon">
                            <i class="fas fa-calculator cyber-icon"></i>
                        </div>
                        <div class="metric-value">S/ {{ number_format($producto->precio * $producto->stock, 2) }}</div>
                        <div class="metric-label">VALOR TOTAL</div>
                        <div class="metric-progress">
                            <div class="progress-bar green"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="metric-card quaternary">
                        <div class="metric-icon">
                            <i class="fas fa-calendar cyber-icon"></i>
                        </div>
                        <div class="metric-value">{{ $producto->created_at ? $producto->created_at->diffForHumans() : 'N/A' }}</div>
                        <div class="metric-label">TIEMPO DE REGISTRO</div>
                        <div class="metric-progress">
                            <div class="progress-bar orange"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Scanner principal del producto */
.cyber-scanner-container {
    background: var(--glass-bg);
    backdrop-filter: var(--blur-medium);
    border: 1px solid var(--glass-border);
    border-radius: 25px;
    padding: 3rem 2rem;
    margin-bottom: 2rem;
    position: relative;
    overflow: hidden;
}

.cyber-scanner-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--neon-cyan), var(--neon-orange), var(--neon-purple), var(--neon-cyan));
    animation: neon-flow 4s linear infinite;
}

.scanner-header {
    text-align: center;
    margin-bottom: 2rem;
    position: relative;
}

.element-id-display {
    font-family: 'Orbitron', monospace;
    margin-bottom: 1rem;
}

.id-prefix {
    color: var(--text-dim);
    font-size: 0.9rem;
    margin-right: 1rem;
}

.id-value {
    color: var(--neon-orange);
    font-weight: 900;
    font-size: 1.5rem;
    text-shadow: 0 0 15px var(--neon-orange);
    padding: 0.5rem 1rem;
    border: 1px solid var(--neon-orange);
    border-radius: 10px;
    background: rgba(255, 102, 0, 0.1);
}

.scanner-line {
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--neon-orange), transparent);
    animation: scan 3s linear infinite;
}

.product-title-section {
    text-align: center;
}

.product-name {
    font-family: 'Orbitron', monospace;
    font-size: clamp(2rem, 5vw, 3.5rem);
    font-weight: 900;
    background: linear-gradient(45deg, var(--neon-cyan), var(--neon-purple));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 1rem;
    text-shadow: 0 0 30px rgba(0, 245, 255, 0.5);
}

.product-status {
    margin-top: 1rem;
}

.status-active {
    color: var(--neon-green);
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 0.5rem 1.5rem;
    border: 1px solid var(--neon-green);
    border-radius: 20px;
    background: rgba(57, 255, 20, 0.1);
    display: inline-flex;
    align-items: center;
}

.status-inactive {
    color: var(--neon-pink);
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 0.5rem 1.5rem;
    border: 1px solid var(--neon-pink);
    border-radius: 20px;
    background: rgba(255, 20, 147, 0.1);
    display: inline-flex;
    align-items: center;
}

/* Panel de información holográfica */
.holo-info-panel,
.holo-control-panel {
    background: var(--glass-bg);
    backdrop-filter: var(--blur-medium);
    border: 1px solid var(--glass-border);
    border-radius: 25px;
    overflow: hidden;
    position: relative;
    height: 100%;
}

.holo-info-panel::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--neon-cyan), var(--neon-green));
}

.holo-control-panel::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--neon-purple), var(--neon-orange));
}

.panel-header {
    padding: 2rem 2rem 1rem;
    text-align: center;
}

.panel-title {
    font-family: 'Orbitron', monospace;
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--text-neon);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 1rem;
}

.panel-scanner {
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--neon-cyan), transparent);
    animation: scan 2s linear infinite;
}

.panel-content {
    padding: 1rem 2rem 2rem;
}

/* Campos de datos */
.data-field {
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 15px;
    transition: all 0.3s ease;
}

.data-field:hover {
    background: rgba(0, 245, 255, 0.05);
    border-color: var(--neon-cyan);
    transform: translateY(-2px);
}

.field-label {
    color: var(--text-dim);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    font-size: 0.8rem;
}

.field-value {
    color: var(--text-neon);
    font-size: 1.2rem;
    font-weight: 600;
    font-family: 'Orbitron', monospace;
}

.field-value.primary {
    color: var(--neon-cyan);
    font-size: 1.5rem;
    font-weight: 900;
    text-shadow: 0 0 10px var(--neon-cyan);
}

.field-value.financial {
    color: var(--neon-green);
    font-size: 1.8rem;
    font-weight: 900;
    text-shadow: 0 0 10px var(--neon-green);
}

/* Badges especializados */
.manufacturer-badge {
    background: rgba(138, 43, 226, 0.2);
    color: var(--neon-purple);
    padding: 0.5rem 1rem;
    border-radius: 15px;
    border: 1px solid rgba(138, 43, 226, 0.3);
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.category-badge {
    background: rgba(0, 245, 255, 0.2);
    color: var(--neon-cyan);
    padding: 0.5rem 1rem;
    border-radius: 15px;
    border: 1px solid rgba(0, 245, 255, 0.3);
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.no-data {
    color: var(--text-dark);
    font-style: italic;
    font-weight: 400;
}

/* Estados de stock */
.stock-high {
    color: var(--neon-green);
    font-weight: 700;
    display: flex;
    align-items: center;
}

.stock-medium {
    color: var(--neon-orange);
    font-weight: 700;
    display: flex;
    align-items: center;
}

.stock-low {
    color: var(--neon-pink);
    font-weight: 700;
    display: flex;
    align-items: center;
}

.description {
    background: rgba(255, 255, 255, 0.05);
    padding: 1rem;
    border-radius: 10px;
    border-left: 3px solid var(--neon-purple);
    font-family: 'Exo 2', sans-serif;
    line-height: 1.6;
    font-weight: 400;
    color: var(--text-dim);
}

/* Análisis financiero */
.financial-analysis {
    padding: 1.5rem;
    background: rgba(57, 255, 20, 0.05);
    border: 1px solid rgba(57, 255, 20, 0.2);
    border-radius: 15px;
}

.analysis-title {
    font-family: 'Orbitron', monospace;
    font-size: 1rem;
    font-weight: 700;
    color: var(--text-neon);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 1rem;
}

.analysis-grid {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.analysis-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem;
    background: rgba(255, 255, 255, 0.02);
    border-radius: 8px;
}

.analysis-label {
    color: var(--text-dim);
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.analysis-value {
    color: var(--text-neon);
    font-weight: 700;
    font-family: 'Orbitron', monospace;
}

.analysis-value.financial {
    color: var(--neon-green);
    text-shadow: 0 0 5px var(--neon-green);
}

.analysis-value.success {
    color: var(--neon-cyan);
}

/* Estado del sistema */
.system-status {
    padding: 1.5rem;
    background: rgba(0, 245, 255, 0.05);
    border: 1px solid rgba(0, 245, 255, 0.2);
    border-radius: 15px;
}

.status-title {
    font-family: 'Orbitron', monospace;
    font-size: 1rem;
    font-weight: 700;
    color: var(--text-neon);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 1rem;
}

.status-indicators {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.status-item {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.status-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    position: relative;
}

.status-dot.active {
    background: var(--neon-green);
    box-shadow: 0 0 10px var(--neon-green);
    animation: pulse-status 2s infinite;
}

.status-dot.inactive {
    background: var(--neon-pink);
    box-shadow: 0 0 10px var(--neon-pink);
}

@keyframes pulse-status {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.status-text {
    color: var(--text-dim);
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.last-update {
    padding-top: 1rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    text-align: center;
}

.update-text {
    color: var(--text-dark);
    font-size: 0.7rem;
    font-family: 'Orbitron', monospace;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Métricas holográficas */
.cyber-metrics {
    background: var(--glass-bg);
    backdrop-filter: var(--blur-medium);
    border: 1px solid var(--glass-border);
    border-radius: 25px;
    padding: 2rem;
    position: relative;
    overflow: hidden;
}

.cyber-metrics::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--neon-green), var(--neon-pink), var(--neon-cyan), var(--neon-green));
    animation: neon-flow 4s linear infinite;
}

.metrics-header {
    text-align: center;
    margin-bottom: 2rem;
}

.metrics-title {
    font-family: 'Orbitron', monospace;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-neon);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 1rem;
}

.metrics-scanner {
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--neon-green), transparent);
    animation: scan 3s linear infinite;
}

/* Tarjetas de métricas */
.metric-card {
    background: var(--glass-bg);
    backdrop-filter: var(--blur-light);
    border: 1px solid var(--glass-border);
    border-radius: 20px;
    padding: 2rem;
    text-align: center;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    height: 100%;
}

.metric-card:hover {
    transform: translateY(-10px) scale(1.03);
    box-shadow: 0 20px 40px rgba(0, 245, 255, 0.2);
}

.metric-card.primary {
    border-left: 3px solid var(--neon-cyan);
}

.metric-card.secondary {
    border-left: 3px solid var(--neon-purple);
}

.metric-card.tertiary {
    border-left: 3px solid var(--neon-green);
}

.metric-card.quaternary {
    border-left: 3px solid var(--neon-orange);
}

.metric-icon {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    opacity: 0.7;
}

.metric-value {
    font-family: 'Orbitron', monospace;
    font-size: 1.8rem;
    font-weight: 900;
    color: var(--neon-cyan);
    text-shadow: 0 0 10px var(--neon-cyan);
    margin-bottom: 0.5rem;
}

.metric-label {
    color: var(--text-dim);
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 600;
    font-size: 0.8rem;
    margin-bottom: 1rem;
}

.metric-progress {
    height: 3px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 2px;
    overflow: hidden;
}

.progress-bar {
    height: 100%;
    width: 75%;
    border-radius: 2px;
    animation: progress-glow 2s ease-in-out infinite alternate;
}

.progress-bar.cyan {
    background: linear-gradient(90deg, var(--neon-cyan), rgba(0, 245, 255, 0.3));
}

.progress-bar.purple {
    background: linear-gradient(90deg, var(--neon-purple), rgba(138, 43, 226, 0.3));
}

.progress-bar.green {
    background: linear-gradient(90deg, var(--neon-green), rgba(57, 255, 20, 0.3));
}

.progress-bar.orange {
    background: linear-gradient(90deg, var(--neon-orange), rgba(255, 102, 0, 0.3));
}

@keyframes progress-glow {
    0% { box-shadow: 0 0 5px currentColor; }
    100% { box-shadow: 0 0 15px currentColor; }
}

/* Responsive */
@media (max-width: 768px) {
    .cyber-scanner-container,
    .panel-content,
    .cyber-metrics {
        padding: 1.5rem;
    }
    
    .product-name {
        font-size: 2rem;
    }
    
    .field-value.primary,
    .field-value.financial {
        font-size: 1.2rem;
    }
    
    .metric-card {
        padding: 1.5rem;
        margin-bottom: 1rem;
    }
    
    .analysis-item {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
    }
}

/* Animaciones adicionales */
@keyframes scan {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

@keyframes neon-flow {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

/* Efectos especiales */
.data-field.description {
    border-left: 3px solid var(--neon-purple);
    background: rgba(138, 43, 226, 0.05);
}

.control-actions .holo-btn {
    margin-bottom: 1rem;
}

.control-actions .holo-btn:last-child {
    margin-bottom: 0;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Efectos de hover para campos de datos
    const dataFields = document.querySelectorAll('.data-field');
    dataFields.forEach(field => {
        field.addEventListener('mouseenter', function() {
            this.style.borderColor = 'var(--neon-cyan)';
            this.style.boxShadow = '0 0 20px rgba(0, 245, 255, 0.2)';
        });
        
        field.addEventListener('mouseleave', function() {
            this.style.borderColor = 'rgba(255, 255, 255, 0.1)';
            this.style.boxShadow = 'none';
        });
    });

    // Efectos para métricas
    const metricCards = document.querySelectorAll('.metric-card');
    metricCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.filter = 'drop-shadow(0 0 20px rgba(0, 245, 255, 0.3))';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.filter = 'none';
        });
    });

    // Animación de aparición para elementos
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 200);
            }
        });
    });

    document.querySelectorAll('.data-field, .metric-card').forEach(element => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(30px)';
        element.style.transition = 'all 0.6s ease';
        observer.observe(element);
    });

    // Efecto de typewriter para el nombre del producto
    const productName = document.querySelector('.product-name');
    if (productName && !sessionStorage.getItem('productNameTyped')) {
        const text = productName.textContent;
        productName.textContent = '';
        let i = 0;
        const timer = setInterval(() => {
            productName.textContent += text.charAt(i);
            i++;
            if (i >= text.length) {
                clearInterval(timer);
                sessionStorage.setItem('productNameTyped', 'true');
            }
        }, 80);
    }
});

function confirmDelete(productName) {
    return confirm(`⚠️ SISTEMA DE SEGURIDAD\n\n¿Confirmar eliminación del elemento "${productName}"?\n\nEsta operación es IRREVERSIBLE y eliminará permanentemente:\n• Datos del producto\n• Historial de transacciones\n• Referencias en el sistema\n\n¿Proceder con la eliminación?`);
}

// Atajos de teclado específicos
document.addEventListener('keydown', function(e) {
    // E para editar
    if (e.key === 'e' || e.key === 'E') {
        if (!e.ctrlKey && !e.altKey) {
            const editBtn = document.querySelector('a[href*="edit"]');
            if (editBtn) {
                e.preventDefault();
                editBtn.click();
            }
        }
    }
    
    // Escape para volver
    if (e.key === 'Escape') {
        const backBtn = document.querySelector('a[href*="index"]');
        if (backBtn) {
            backBtn.click();
        }
    }
});

// Efectos de carga para botones
document.querySelectorAll('.holo-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        if (this.tagName === 'A') {
            this.style.transform = 'scale(0.95)';
            this.innerHTML = '<i class="fas fa-sync fa-spin me-2"></i>PROCESANDO...';
        }
    });
});

// Sistema de notificaciones holográficas
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `holo-notification ${type}`;
    notification.innerHTML = `
        <i class="fas fa-info-circle me-2"></i>
        ${message}
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transform = 'translateY(-20px)';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}

// Mostrar notificación de bienvenida
setTimeout(() => {
    showNotification('ELEMENTO CARGADO EXITOSAMENTE', 'success');
}, 1000);
</script>
@endsection