@extends('layouts.layout')


@section('title', 'NEXUS | Base de Datos')
@section('header', 'BASE DE DATOS DE PRODUCTOS')
@section('description', 'Centro de control y monitoreo de inventario avanzado')

@section('contenido')
<!-- Panel de estadísticas holográficas -->
<div class="cyber-dashboard">
    <div class="dashboard-header">
        <h4 class="dashboard-title">
            <i class="fas fa-chart-pie me-2 cyber-icon"></i>
            ANÁLISIS DEL SISTEMA
        </h4>
        <div class="dashboard-scanner"></div>
    </div>
    
    <div class="row g-4 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="holo-stats-card cyber-stat-primary">
                <div class="stat-icon">
                    <i class="fas fa-database cyber-icon"></i>
                </div>
                <div class="holo-stats-number">{{ $productos->total() }}</div>
                <div class="holo-stats-label">ELEMENTOS REGISTRADOS</div>
                <div class="stat-progress">
                    <div class="progress-line cyan"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="holo-stats-card cyber-stat-secondary">
                <div class="stat-icon">
                    <i class="fas fa-sitemap cyber-icon"></i>
                </div>
                <div class="holo-stats-number text-neon-purple">{{ $categorias->count() }}</div>
                <div class="holo-stats-label">CLASIFICACIONES</div>
                <div class="stat-progress">
                    <div class="progress-line purple"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="holo-stats-card cyber-stat-tertiary">
                <div class="stat-icon">
                    <i class="fas fa-warehouse cyber-icon"></i>
                </div>
                <div class="holo-stats-number text-neon-orange">{{ $productos->sum('stock') }}</div>
                <div class="holo-stats-label">INVENTARIO TOTAL</div>
                <div class="stat-progress">
                    <div class="progress-line orange"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="holo-stats-card cyber-stat-quaternary">
                <div class="stat-icon">
                    <i class="fas fa-coins cyber-icon"></i>
                </div>
                <div class="holo-stats-number text-neon-green">S/ {{ number_format($productos->sum('precio'), 2) }}</div>
                <div class="holo-stats-label">VALOR DE ACTIVOS</div>
                <div class="stat-progress">
                    <div class="progress-line green"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sistema de búsqueda holográfico -->
<div class="holo-search-system">
    <div class="search-header">
        <h5 class="search-title">
            <i class="fas fa-scanner me-2 cyber-icon"></i>
            SISTEMA DE FILTRADO AVANZADO
        </h5>
        <div class="search-scanner"></div>
    </div>
    
    <form method="GET" action="{{ route('productos.index') }}" class="cyber-search-form">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="cyber-input-group">
                    <label for="search" class="holo-form-label">
                        <i class="fas fa-search cyber-icon"></i>
                        CONSULTA DE BÚSQUEDA
                    </label>
                    <div class="input-wrapper">
                        <input type="text" 
                               class="holo-form-control" 
                               id="search" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Buscar elementos..."
                               autocomplete="off">
                        <div class="input-glow"></div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="cyber-input-group">
                    <label for="categoria" class="holo-form-label">
                        <i class="fas fa-filter cyber-icon"></i>
                        FILTRO CATEGORIAL
                    </label>
                    <div class="input-wrapper">
                        <select class="holo-form-select" id="categoria" name="categoria">
                            <option value="">[ TODAS LAS CATEGORÍAS ]</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id_categoria }}" 
                                        {{ request('categoria') == $categoria->id_categoria ? 'selected' : '' }}>
                                    {{ strtoupper($categoria->descripcion) }}
                                </option>
                            @endforeach
                        </select>
                        <div class="input-glow"></div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="cyber-input-group">
                    <label for="order_by" class="holo-form-label">
                        <i class="fas fa-sort cyber-icon"></i>
                        ORDENAMIENTO
                    </label>
                    <div class="input-wrapper">
                        <select class="holo-form-select" id="order_by" name="order_by">
                            <option value="nombre" {{ request('order_by') == 'nombre' ? 'selected' : '' }}>NOMBRE</option>
                            <option value="marca" {{ request('order_by') == 'marca' ? 'selected' : '' }}>FABRICANTE</option>
                            <option value="precio" {{ request('order_by') == 'precio' ? 'selected' : '' }}>VALOR</option>
                            <option value="stock" {{ request('order_by') == 'stock' ? 'selected' : '' }}>INVENTARIO</option>
                            <option value="created_at" {{ request('order_by') == 'created_at' ? 'selected' : '' }}>FECHA</option>
                        </select>
                        <div class="input-glow"></div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-6">
                <div class="cyber-input-group">
                    <label for="order_direction" class="holo-form-label">
                        <i class="fas fa-sort-amount-down cyber-icon"></i>
                        DIRECCIÓN
                    </label>
                    <div class="input-wrapper">
                        <select class="holo-form-select" id="order_direction" name="order_direction">
                            <option value="asc" {{ request('order_direction') == 'asc' ? 'selected' : '' }}>ASC</option>
                            <option value="desc" {{ request('order_direction') == 'desc' ? 'selected' : '' }}>DESC</option>
                        </select>
                        <div class="input-glow"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="search-actions mt-4">
            <button type="submit" class="holo-btn holo-btn-primary me-3">
                <i class="fas fa-search me-2"></i>
                EJECUTAR BÚSQUEDA
            </button>
            <a href="{{ route('productos.index') }}" class="holo-btn holo-btn-secondary">
                <i class="fas fa-times me-2"></i>
                LIMPIAR FILTROS
            </a>
        </div>
    </form>
</div>

<!-- Header de la tabla con acciones -->
<div class="table-header">
    <div class="table-title-section">
        <h3 class="table-title">
            <i class="fas fa-database me-2 cyber-icon"></i>
            ELEMENTOS REGISTRADOS
            @if(request('search'))
                <span class="search-results">
                    ({{ $productos->total() }} RESULTADOS PARA "{{ strtoupper(request('search')) }}")
                </span>
            @endif
        </h3>
    </div>
    <div class="table-actions">
        <a href="{{ route('productos.create') }}" class="holo-btn holo-btn-success">
            <i class="fas fa-plus me-2"></i>
            NUEVO ELEMENTO
        </a>
    </div>
</div>

@if($productos->count() > 0)
    <!-- Tabla holográfica de productos -->
    <div class="holo-table-container">
        <div class="table-responsive">
            <table class="holo-table table mb-0">
                <thead>
                    <tr>
                        <th>
                            <a href="#" onclick="sortTable('nombre', '{{ request('order_direction') == 'asc' ? 'desc' : 'asc' }}')" 
                               class="table-sort-link">
                                <i class="fas fa-tag me-1"></i>IDENTIFICADOR
                                @if(request('order_by') == 'nombre')
                                    <i class="fas fa-sort-{{ request('order_direction') == 'asc' ? 'up' : 'down' }} ms-1 sort-indicator"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="#" onclick="sortTable('marca', '{{ request('order_direction') == 'asc' ? 'desc' : 'asc' }}')" 
                               class="table-sort-link">
                                <i class="fas fa-industry me-1"></i>FABRICANTE
                                @if(request('order_by') == 'marca')
                                    <i class="fas fa-sort-{{ request('order_direction') == 'asc' ? 'up' : 'down' }} ms-1 sort-indicator"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="#" onclick="sortTable('precio', '{{ request('order_direction') == 'asc' ? 'desc' : 'asc' }}')" 
                               class="table-sort-link">
                                <i class="fas fa-coins me-1"></i>VALOR UNITARIO
                                @if(request('order_by') == 'precio')
                                    <i class="fas fa-sort-{{ request('order_direction') == 'asc' ? 'up' : 'down' }} ms-1 sort-indicator"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="#" onclick="sortTable('stock', '{{ request('order_direction') == 'asc' ? 'desc' : 'asc' }}')" 
                               class="table-sort-link">
                                <i class="fas fa-warehouse me-1"></i>INVENTARIO
                                @if(request('order_by') == 'stock')
                                    <i class="fas fa-sort-{{ request('order_direction') == 'asc' ? 'up' : 'down' }} ms-1 sort-indicator"></i>
                                @endif
                            </a>
                        </th>
                        <th><i class="fas fa-sitemap me-1"></i>CLASIFICACIÓN</th>
                        <th><i class="fas fa-calendar me-1"></i>REGISTRO</th>
                        <th class="text-center"><i class="fas fa-cogs me-1"></i>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $producto)
                        <tr class="table-row" data-product-id="{{ $producto->id_producto }}">
                            <td>
                                <div class="product-name">
                                    <strong class="name-primary">{{ strtoupper($producto->nombre) }}</strong>
                                    <div class="product-id">#{{ str_pad($producto->id_producto, 6, '0', STR_PAD_LEFT) }}</div>
                                </div>
                            </td>
                            <td>
                                <span class="brand-label">{{ strtoupper($producto->marca ?: 'SIN ESPECIFICAR') }}</span>
                            </td>
                            <td>
                                <div class="price-display">
                                    <span class="price-value">S/ {{ number_format($producto->precio, 2) }}</span>
                                </div>
                            </td>
                            <td>
                                @if($producto->stock > 50)
                                    <span class="stock-badge stock-high">
                                        <i class="fas fa-check-circle me-1"></i>
                                        {{ $producto->stock }} UND
                                    </span>
                                @elseif($producto->stock > 10)
                                    <span class="stock-badge stock-medium">
                                        <i class="fas fa-exclamation-triangle me-1"></i>
                                        {{ $producto->stock }} UND
                                    </span>
                                @else
                                    <span class="stock-badge stock-low">
                                        <i class="fas fa-times-circle me-1"></i>
                                        {{ $producto->stock }} UND
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="category-badge">
                                    {{ strtoupper($producto->categoria->descripcion ?? 'SIN CATEGORÍA') }}
                                </span>
                            </td>
                            <td>
                                <div class="date-display">
                                    {{ $producto->created_at ? $producto->created_at->format('d/m/Y') : 'N/A' }}
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="action-group">
                                    <a href="{{ route('productos.show', $producto->id_producto) }}" 
                                       class="holo-btn-mini holo-btn-info" 
                                       title="ANALIZAR ELEMENTO">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('productos.edit', $producto->id_producto) }}" 
                                       class="holo-btn-mini holo-btn-warning ms-1" 
                                       title="MODIFICAR ELEMENTO">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('productos.destroy', $producto->id_producto) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirmDelete('{{ $producto->nombre }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="holo-btn-mini holo-btn-danger ms-1" 
                                                title="ELIMINAR ELEMENTO">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Paginación holográfica -->
    <div class="holo-pagination">
        <div class="pagination-info">
            <div class="info-text">
                <span class="range">{{ $productos->firstItem() }} - {{ $productos->lastItem() }}</span>
                <span class="total">DE {{ number_format($productos->total()) }} ELEMENTOS</span>
            </div>
        </div>
        
        <div class="pagination-separator"></div>
        
        <div class="pagination-controls">
            {{ $productos->appends(request()->query())->links() }}
        </div>
    </div>
@else
    <!-- Estado vacío holográfico -->
    <div class="cyber-empty-state">
        <div class="empty-icon">
            <i class="fas fa-database fa-4x cyber-icon pulse-cyber"></i>
        </div>
        <h4 class="empty-title">BASE DE DATOS VACÍA</h4>
        <p class="empty-description">
            @if(request('search') || request('categoria'))
                NO SE ENCONTRARON ELEMENTOS QUE COINCIDAN CON LOS PARÁMETROS DE BÚSQUEDA
            @else
                EL SISTEMA NO CONTIENE ELEMENTOS REGISTRADOS
            @endif
        </p>
        <div class="empty-actions">
            @if(request('search') || request('categoria'))
                <a href="{{ route('productos.index') }}" class="holo-btn holo-btn-secondary me-3">
                    <i class="fas fa-times me-2"></i>
                    LIMPIAR FILTROS
                </a>
            @endif
            <a href="{{ route('productos.create') }}" class="holo-btn holo-btn-primary">
                <i class="fas fa-plus me-2"></i>
                INICIALIZAR ELEMENTO
            </a>
        </div>
    </div>
@endif

<style>
/* Dashboard holográfico */
.cyber-dashboard {
    background: var(--glass-bg);
    backdrop-filter: var(--blur-medium);
    border: 1px solid var(--glass-border);
    border-radius: 25px;
    padding: 2rem;
    margin-bottom: 2rem;
    position: relative;
    overflow: hidden;
}

.cyber-dashboard::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--neon-cyan), var(--neon-purple), var(--neon-green), var(--neon-cyan));
    animation: neon-flow 4s linear infinite;
}

.dashboard-header {
    margin-bottom: 2rem;
    text-align: center;
}

.dashboard-title {
    font-family: 'Orbitron', monospace;
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--text-neon);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 1rem;
}

.dashboard-scanner {
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--neon-cyan), transparent);
    animation: scan 3s linear infinite;
}

/* Stats cards mejoradas */
.cyber-stat-primary {
    border-left: 3px solid var(--neon-cyan);
}

.cyber-stat-secondary {
    border-left: 3px solid var(--neon-purple);
}

.cyber-stat-tertiary {
    border-left: 3px solid var(--neon-orange);
}

.cyber-stat-quaternary {
    border-left: 3px solid var(--neon-green);
}

.stat-icon {
    position: absolute;
    top: 1rem;
    right: 1rem;
    font-size: 2rem;
    opacity: 0.3;
}

.stat-progress {
    margin-top: 1rem;
    height: 2px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 1px;
    overflow: hidden;
}

.progress-line {
    height: 100%;
    width: 70%;
    border-radius: 1px;
    animation: progress-glow 2s ease-in-out infinite alternate;
}

.progress-line.cyan {
    background: linear-gradient(90deg, var(--neon-cyan), rgba(0, 245, 255, 0.3));
}

.progress-line.purple {
    background: linear-gradient(90deg, var(--neon-purple), rgba(138, 43, 226, 0.3));
}

.progress-line.orange {
    background: linear-gradient(90deg, var(--neon-orange), rgba(255, 102, 0, 0.3));
}

.progress-line.green {
    background: linear-gradient(90deg, var(--neon-green), rgba(57, 255, 20, 0.3));
}

@keyframes progress-glow {
    0% { box-shadow: 0 0 5px currentColor; }
    100% { box-shadow: 0 0 15px currentColor; }
}

/* Sistema de búsqueda */
.holo-search-system {
    background: var(--glass-bg);
    backdrop-filter: var(--blur-medium);
    border: 1px solid var(--glass-border);
    border-radius: 25px;
    padding: 2rem;
    margin-bottom: 2rem;
    position: relative;
}

.holo-search-system::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--neon-purple), var(--neon-green));
}

.search-header {
    margin-bottom: 2rem;
    text-align: center;
}

.search-title {
    font-family: 'Orbitron', monospace;
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--text-neon);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 1rem;
}

.search-scanner {
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--neon-purple), transparent);
    animation: scan 2s linear infinite;
}

.search-actions {
    text-align: center;
    padding-top: 1rem;
    border-top: 1px solid var(--glass-border);
}

/* Header de tabla */
.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    flex-wrap: wrap;
    gap: 1rem;
}

.table-title {
    font-family: 'Orbitron', monospace;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-neon);
    margin: 0;
}

.search-results {
    font-size: 0.8rem;
    color: var(--text-dim);
    font-weight: 500;
}

/* Tabla holográfica CORREGIDA - FONDO OSCURO */
.holo-table-container {
    background: rgba(10, 10, 15, 0.9) !important;
    backdrop-filter: var(--blur-medium);
    border-radius: 20px;
    border: 1px solid var(--glass-border);
    overflow: hidden;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    position: relative;
}

.holo-table-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--neon-cyan), transparent);
}

.holo-table {
    color: var(--text-neon) !important;
    font-size: 0.9rem;
    margin: 0;
    background: transparent !important;
}

.holo-table thead th {
    background: rgba(0, 245, 255, 0.1) !important;
    color: var(--neon-cyan) !important;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    border: none !important;
    padding: 1.5rem 1rem;
    position: relative;
}

.holo-table thead th::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--neon-cyan), transparent);
}

.holo-table tbody td {
    padding: 1.5rem 1rem !important;
    border: none !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
    transition: all 0.3s ease;
    background: transparent !important;
    color: var(--text-neon) !important;
}

.holo-table tbody tr {
    background: transparent !important;
}

.holo-table tbody tr:hover {
    background: rgba(0, 245, 255, 0.05) !important;
    transform: scale(1.001);
    box-shadow: 0 4px 20px rgba(0, 245, 255, 0.1);
}

.table-sort-link {
    color: var(--neon-cyan) !important;
    text-decoration: none;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.table-sort-link:hover {
    color: var(--neon-purple) !important;
    text-shadow: 0 0 10px var(--neon-purple);
}

.sort-indicator {
    color: var(--neon-green) !important;
}

.table-row {
    transition: all 0.3s ease;
    background: transparent !important;
}

.product-name {
    display: flex;
    flex-direction: column;
}

.name-primary {
    color: var(--text-neon) !important;
    font-size: 1rem;
    line-height: 1.2;
    font-weight: 700;
}

.product-id {
    color: var(--text-dark) !important;
    font-size: 0.7rem;
    font-family: 'Orbitron', monospace;
    margin-top: 0.2rem;
}

.brand-label {
    color: var(--text-dim) !important;
    font-weight: 500;
    font-size: 0.9rem;
}

.price-display {
    font-family: 'Orbitron', monospace;
}

.price-value {
    color: var(--neon-green) !important;
    font-weight: 700;
    font-size: 1.1rem;
    text-shadow: 0 0 5px var(--neon-green);
}

/* Badges de stock */
.stock-badge {
    padding: 0.4rem 0.8rem;
    border-radius: 15px;
    font-weight: 600;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-flex;
    align-items: center;
}

.stock-high {
    background: linear-gradient(135deg, var(--neon-green), rgba(57, 255, 20, 0.7));
    color: var(--dark-void);
    box-shadow: 0 0 10px rgba(57, 255, 20, 0.3);
}

.stock-medium {
    background: linear-gradient(135deg, var(--neon-orange), rgba(255, 102, 0, 0.7));
    color: var(--dark-void);
    box-shadow: 0 0 10px rgba(255, 102, 0, 0.3);
}

.stock-low {
    background: linear-gradient(135deg, var(--neon-pink), rgba(255, 20, 147, 0.7));
    color: var(--dark-void);
    box-shadow: 0 0 10px rgba(255, 20, 147, 0.3);
}

.category-badge {
    background: rgba(138, 43, 226, 0.2);
    color: var(--neon-purple) !important;
    padding: 0.3rem 0.8rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border: 1px solid rgba(138, 43, 226, 0.3);
}

.date-display {
    color: var(--text-dark) !important;
    font-size: 0.85rem;
    font-family: 'Orbitron', monospace;
}

/* Botones mini holográficos */
.holo-btn-mini {
    background: var(--glass-bg);
    backdrop-filter: var(--blur-light);
    border: 1px solid var(--glass-border);
    border-radius: 8px;
    padding: 0.5rem;
    font-size: 0.8rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 35px;
    height: 35px;
    text-decoration: none;
}

.holo-btn-mini:hover {
    transform: translateY(-2px) scale(1.1);
}

.holo-btn-mini.holo-btn-info {
    color: var(--neon-purple);
    border-color: var(--neon-purple);
}

.holo-btn-mini.holo-btn-info:hover {
    background: var(--neon-purple);
    color: var(--dark-void);
    box-shadow: var(--glow-purple);
}

.holo-btn-mini.holo-btn-warning {
    color: var(--neon-orange);
    border-color: var(--neon-orange);
}

.holo-btn-mini.holo-btn-warning:hover {
    background: var(--neon-orange);
    color: var(--dark-void);
    box-shadow: 0 0 20px rgba(255, 102, 0, 0.5);
}

.holo-btn-mini.holo-btn-danger {
    color: var(--neon-pink);
    border-color: var(--neon-pink);
}

.holo-btn-mini.holo-btn-danger:hover {
    background: var(--neon-pink);
    color: var(--dark-void);
    box-shadow: 0 0 20px rgba(255, 20, 147, 0.5);
}

.action-group {
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Paginación holográfica REDISEÑADA */
.holo-pagination {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 3rem;
    padding: 2.5rem 3rem;
    background: linear-gradient(135deg, rgba(10, 10, 15, 0.95), rgba(15, 15, 25, 0.9));
    border: 1px solid rgba(0, 245, 255, 0.2);
    border-radius: 30px;
    backdrop-filter: blur(25px);
    position: relative;
    overflow: hidden;
    box-shadow: 
        0 20px 60px rgba(0, 0, 0, 0.4),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
}

.holo-pagination::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(
        90deg, 
        transparent, 
        var(--neon-cyan) 10%, 
        var(--neon-purple) 30%, 
        var(--neon-green) 70%, 
        var(--neon-cyan) 90%, 
        transparent
    );
    animation: holographic-flow 8s linear infinite;
}

.holo-pagination::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: radial-gradient(ellipse at center, var(--neon-cyan), transparent);
    opacity: 0.6;
}

/* Información de paginación mejorada */
.pagination-info {
    background: linear-gradient(135deg, rgba(0, 245, 255, 0.08), rgba(138, 43, 226, 0.05));
    padding: 1.5rem 2rem;
    border-radius: 20px;
    border: 1px solid rgba(0, 245, 255, 0.15);
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(10px);
    transition: all 0.4s ease;
    min-width: 300px;
}

.pagination-info::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        90deg, 
        transparent, 
        rgba(0, 245, 255, 0.1), 
        transparent
    );
    transition: left 0.8s ease;
}

.pagination-info:hover::before {
    left: 100%;
}

.pagination-info:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(0, 245, 255, 0.2);
    border-color: rgba(0, 245, 255, 0.3);
}

.pagination-info .info-text {
    color: var(--neon-cyan);
    font-size: 1rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    font-family: 'Orbitron', monospace;
    text-shadow: 0 0 15px rgba(0, 245, 255, 0.4);
    position: relative;
    z-index: 2;
    line-height: 1.4;
}

.pagination-info .info-highlight {
    color: var(--neon-green);
    font-weight: 800;
    font-size: 1.1em;
}

/* Controles de paginación reorganizados */
.pagination-controls {
    display: flex;
    align-items: center;
    gap: 1rem;
}

/* Personalización completa de paginación Bootstrap */
.pagination {
    display: flex;
    align-items: center;
    gap: 0.3rem;
    margin: 0;
    padding: 0.5rem 1rem;
    background: rgba(0, 0, 0, 0.3);
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(15px);
}

.pagination .page-item {
    margin: 0;
}

.pagination .page-link {
    background: rgba(15, 15, 25, 0.8) !important;
    border: 1px solid rgba(0, 245, 255, 0.2) !important;
    color: var(--text-neon) !important;
    padding: 0.8rem 1.1rem;
    border-radius: 15px !important;
    font-family: 'Orbitron', monospace;
    font-weight: 600;
    font-size: 0.9rem;
    letter-spacing: 0.8px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    backdrop-filter: blur(10px);
    position: relative;
    overflow: hidden;
    text-decoration: none;
    min-width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

/* Efecto holográfico en hover */
.pagination .page-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        90deg, 
        transparent, 
        rgba(0, 245, 255, 0.15), 
        transparent
    );
    transition: left 0.6s ease;
}

.pagination .page-link:hover {
    background: linear-gradient(135deg, rgba(0, 245, 255, 0.15), rgba(138, 43, 226, 0.1)) !important;
    border-color: var(--neon-cyan) !important;
    color: var(--neon-cyan) !important;
    transform: translateY(-4px) scale(1.05);
    box-shadow: 
        0 10px 30px rgba(0, 245, 255, 0.3),
        0 0 20px rgba(0, 245, 255, 0.2);
    text-shadow: 0 0 15px var(--neon-cyan);
}

.pagination .page-link:hover::before {
    left: 100%;
}

/* Página activa con estilo especial */
.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, var(--neon-cyan), rgba(0, 245, 255, 0.8)) !important;
    border-color: var(--neon-cyan) !important;
    color: var(--dark-void) !important;
    box-shadow: 
        0 0 30px rgba(0, 245, 255, 0.8),
        inset 0 0 20px rgba(255, 255, 255, 0.2),
        0 8px 25px rgba(0, 245, 255, 0.4);
    font-weight: 900;
    transform: scale(1.15);
    z-index: 5;
    text-shadow: none;
    position: relative;
}

.pagination .page-item.active .page-link::after {
    content: '';
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    background: linear-gradient(45deg, var(--neon-cyan), var(--neon-purple));
    border-radius: inherit;
    z-index: -1;
    opacity: 0.7;
    animation: active-pulse 2s ease-in-out infinite;
}

/* Estados deshabilitados */
.pagination .page-item.disabled .page-link {
    background: rgba(10, 10, 15, 0.4) !important;
    border-color: rgba(255, 255, 255, 0.05) !important;
    color: rgba(255, 255, 255, 0.2) !important;
    cursor: not-allowed;
    opacity: 0.3;
    transform: none !important;
    box-shadow: none !important;
}

.pagination .page-item.disabled .page-link:hover {
    transform: none !important;
    box-shadow: none !important;
    text-shadow: none !important;
    background: rgba(10, 10, 15, 0.4) !important;
}

/* Botones de navegación especiales (anterior/siguiente) */
.pagination .page-item:first-child .page-link,
.pagination .page-item:last-child .page-link {
    background: linear-gradient(135deg, rgba(138, 43, 226, 0.15), rgba(75, 0, 130, 0.1)) !important;
    border-color: var(--neon-purple) !important;
    color: var(--neon-purple) !important;
    font-size: 1.1rem;
    padding: 0.8rem 1.5rem;
    font-weight: 700;
    width: 60px;
}

.pagination .page-item:first-child .page-link:hover,
.pagination .page-item:last-child .page-link:hover {
    background: linear-gradient(135deg, rgba(138, 43, 226, 0.25), rgba(75, 0, 130, 0.2)) !important;
    border-color: var(--neon-purple) !important;
    color: var(--neon-purple) !important;
    box-shadow: 
        0 10px 30px rgba(138, 43, 226, 0.4),
        0 0 25px rgba(138, 43, 226, 0.3);
}

/* Separador visual entre controles */
.pagination-separator {
    width: 2px;
    height: 30px;
    background: linear-gradient(to bottom, transparent, var(--neon-cyan), transparent);
    margin: 0 1rem;
    opacity: 0.5;
}

/* Animaciones mejoradas */
@keyframes holographic-flow {
    0% { 
        background-position: -200% 50%; 
        opacity: 0.8;
    }
    50% { 
        opacity: 1;
    }
    100% { 
        background-position: 200% 50%; 
        opacity: 0.8;
    }
}

@keyframes active-pulse {
    0%, 100% { 
        opacity: 0.7; 
        transform: scale(1);
    }
    50% { 
        opacity: 1; 
        transform: scale(1.02);
    }
}

/* Efectos adicionales para toda la paginación */
.pagination-controls:hover {
    transform: scale(1.02);
    transition: transform 0.4s ease;
}

.pagination-controls:hover .pagination {
    box-shadow: 0 15px 40px rgba(0, 245, 255, 0.15);
}

/* Responsive mejorado */
@media (max-width: 768px) {
    .holo-pagination {
        flex-direction: column;
        gap: 2rem;
        text-align: center;
        padding: 2rem;
    }
    
    .pagination-info {
        order: 2;
        width: 100%;
        text-align: center;
        min-width: auto;
    }
    
    .pagination-controls {
        order: 1;
        width: 100%;
        justify-content: center;
    }
    
    .pagination {
        flex-wrap: wrap;
        justify-content: center;
        gap: 0.5rem;
        padding: 1rem;
    }
    
    .pagination .page-link {
        padding: 0.7rem 0.9rem;
        font-size: 0.85rem;
        min-width: 45px;
        height: 45px;
    }
    
    .pagination .page-item:first-child .page-link,
    .pagination .page-item:last-child .page-link {
        width: 50px;
        padding: 0.7rem 1rem;
    }
}

@media (max-width: 480px) {
    .holo-pagination {
        padding: 1.5rem;
        margin-top: 2rem;
    }
    
    .pagination .page-link {
        padding: 0.6rem 0.8rem;
        font-size: 0.8rem;
        min-width: 40px;
        height: 40px;
    }
    
    .pagination .page-item:first-child .page-link,
    .pagination .page-item:last-child .page-link {
        width: 45px;
        padding: 0.6rem 0.9rem;
        font-size: 1rem;
    }
    
    .pagination-info .info-text {
        font-size: 0.9rem;
        line-height: 1.6;
    }
}

/* Mejora en la información de paginación */
.info-text {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.3rem;
}

.info-text .range {
    font-size: 1.2em;
    color: var(--neon-green);
}

.info-text .total {
    font-size: 0.9em;
    color: var(--text-dim);
}

/* Responsive para paginación */
@media (max-width: 768px) {
    .holo-pagination {
        flex-direction: column;
        gap: 1.5rem;
        text-align: center;
        padding: 1.5rem;
    }
    
    .pagination {
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .pagination .page-link {
        padding: 0.6rem 0.8rem;
        font-size: 0.8rem;
        min-width: 40px;
    }
    
    .pagination-info {
        order: 2;
        width: 100%;
        text-align: center;
    }
    
    .pagination-controls {
        order: 1;
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .pagination .page-link {
        padding: 0.5rem 0.6rem;
        font-size: 0.75rem;
        min-width: 35px;
    }
    
    .pagination .page-item:first-child .page-link,
    .pagination .page-item:last-child .page-link {
        padding: 0.5rem 0.8rem;
    }
}

/* Override para cualquier fondo blanco persistente */
.table, .table td, .table th, .table tr {
    background: transparent !important;
    color: var(--text-neon) !important;
}

.table-responsive {
    background: transparent !important;
}

/* Animación de carga para cambio de página */
.pagination-loading {
    opacity: 0.5;
    filter: blur(2px);
    transition: all 0.3s ease;
}

/* Efectos adicionales para elementos específicos */
.holo-table tbody tr:nth-child(even) {
    background: rgba(255, 255, 255, 0.01) !important;
}

.holo-table tbody tr:nth-child(odd) {
    background: rgba(0, 0, 0, 0.1) !important;
}

/* Bordes holográficos para celdas */
.holo-table td:first-child {
    border-left: 2px solid transparent;
    transition: border-color 0.3s ease;
}

.holo-table tbody tr:hover td:first-child {
    border-left-color: var(--neon-cyan);
}

/* Efectos de glow para headers */
.holo-table thead th:hover {
    background: rgba(0, 245, 255, 0.15) !important;
    text-shadow: 0 0 10px var(--neon-cyan);
}

/* Personalización específica para el select de categorías */
.holo-form-select {
    background: var(--glass-bg) !important;
    backdrop-filter: var(--blur-medium);
    border: 1px solid var(--glass-border) !important;
    border-radius: 15px !important;
    color: var(--text-neon) !important;
    font-family: 'Orbitron', monospace;
    font-weight: 600;
    font-size: 0.9rem;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    padding: 1rem !important;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.holo-form-select:focus {
    outline: none !important;
    border-color: var(--neon-cyan) !important;
    box-shadow: 0 0 20px rgba(0, 245, 255, 0.3) !important;
    background: rgba(10, 10, 15, 0.95) !important;
}

.holo-form-select:hover {
    border-color: var(--neon-purple) !important;
    box-shadow: 0 0 15px rgba(138, 43, 226, 0.2) !important;
}

/* Personalización específica para las opciones del select */
.holo-form-select option {
    background: rgba(10, 10, 15, 0.95) !important;
    color: var(--text-neon) !important;
    font-family: 'Orbitron', monospace;
    font-weight: 600;
    padding: 0.8rem !important;
    border: none !important;
}

/* Estilo especial para la opción "TODAS LAS CATEGORÍAS" */
.holo-form-select option[value=""] {
    background: rgba(15, 15, 25, 0.98) !important;
    color: rgba(255, 255, 255, 0.4) !important; /* Tono oscuro/gris */
    font-style: italic;
    font-weight: 500;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
}

/* Alternativa con tono más oscuro */
.holo-form-select option[value=""]:hover {
    background: rgba(20, 20, 30, 0.95) !important;
    color: rgba(255, 255, 255, 0.3) !important; /* Aún más oscuro en hover */
}

/* Para navegadores que soportan mejor personalización de select */
.holo-form-select option:first-child {
    background: linear-gradient(135deg, rgba(15, 15, 25, 0.98), rgba(10, 10, 20, 0.95)) !important;
    color: rgba(200, 200, 200, 0.5) !important; /* Gris oscuro */
    font-weight: 400;
    text-shadow: none;
    opacity: 0.7;
}

/* Estilo adicional para mejor contraste */
.cyber-input-group .holo-form-select option[value=""] {
    background: rgba(5, 5, 10, 0.9) !important;
    color: #666666 !important; /* Color hexadecimal gris oscuro */
    font-size: 0.85rem;
    letter-spacing: 0.3px;
}

/* Para navegadores webkit (Chrome, Safari) */
.holo-form-select option:first-child {
    color: #4a4a4a !important; /* Gris más oscuro */
    background-color: rgba(8, 8, 12, 0.95) !important;
}

/* Para Firefox */
@-moz-document url-prefix() {
    .holo-form-select option[value=""] {
        color: #555555 !important;
        background: rgba(10, 10, 15, 0.9) !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Efectos de hover para las filas de la tabla
    const tableRows = document.querySelectorAll('.table-row');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.borderLeft = '3px solid var(--neon-cyan)';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.borderLeft = 'none';
        });
    });

    // Auto-enfoque en búsqueda con atajo de teclado
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.key === '/') {
            e.preventDefault();
            const searchInput = document.getElementById('search');
            if (searchInput) {
                searchInput.focus();
                searchInput.style.boxShadow = '0 0 20px rgba(0, 245, 255, 0.5)';
                setTimeout(() => {
                    searchInput.style.boxShadow = '';
                }, 2000);
            }
        }
    });

    // Efectos de stats cards
    const statsCards = document.querySelectorAll('.holo-stats-card');
    statsCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.03)';
            this.style.filter = 'drop-shadow(0 0 20px rgba(0, 245, 255, 0.3))';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.filter = '';
        });
    });

    // Efectos mejorados para paginación
    const paginationLinks = document.querySelectorAll('.pagination .page-link');
    paginationLinks.forEach(link => {
        if (!link.closest('.page-item').classList.contains('disabled')) {
            link.addEventListener('click', function(e) {
                // Efecto de carga
                const paginationContainer = document.querySelector('.holo-pagination');
                if (paginationContainer) {
                    paginationContainer.classList.add('pagination-loading');
                    
                    // Crear efecto de escaneo
                    const scanner = document.createElement('div');
                    scanner.style.cssText = `
                        position: absolute;
                        top: 0;
                        left: -100%;
                        width: 100%;
                        height: 100%;
                        background: linear-gradient(90deg, transparent, rgba(0, 245, 255, 0.3), transparent);
                        animation: scan 1s ease-out;
                        pointer-events: none;
                        z-index: 10;
                    `;
                    paginationContainer.appendChild(scanner);
                    
                    setTimeout(() => {
                        scanner.remove();
                    }, 1000);
                }
            });
        }
    });

    // Efectos de hover para información de paginación
    const paginationInfo = document.querySelector('.pagination-info');
    if (paginationInfo) {
        paginationInfo.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
            this.style.boxShadow = '0 10px 30px rgba(0, 245, 255, 0.2)';
        });
        
        paginationInfo.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '';
        });
    }
});

function sortTable(column, direction) {
    const url = new URL(window.location.href);
    url.searchParams.set('order_by', column);
    url.searchParams.set('order_direction', direction);
    
    // Efecto visual antes de navegar
    const tableContainer = document.querySelector('.holo-table-container');
    tableContainer.style.opacity = '0.5';
    tableContainer.style.filter = 'blur(2px)';
    
    setTimeout(() => {
        window.location.href = url.toString();
    }, 300);
}

function confirmDelete(productName) {
    return confirm(`⚠️ SISTEMA DE SEGURIDAD\n\n¿Confirmar eliminación del elemento "${productName}"?\n\nEsta operación es IRREVERSIBLE y eliminará permanentemente el registro del sistema.`);
}

// Efectos de carga para formularios de búsqueda
document.querySelector('.cyber-search-form').addEventListener('submit', function() {
    const submitBtn = this.querySelector('button[type="submit"]');
    if (submitBtn) {
        submitBtn.innerHTML = '<i class="fas fa-sync fa-spin me-2"></i>ESCANEANDO...';
        submitBtn.disabled = true;
    }
});

// Animación de aparición progresiva para las filas
const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry, index) => {
        if (entry.isIntersecting) {
            setTimeout(() => {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }, index * 100);
        }
    });
});

document.querySelectorAll('.table-row').forEach(row => {
    row.style.opacity = '0';
    row.style.transform = 'translateY(20px)';
    row.style.transition = 'all 0.5s ease';
    observer.observe(row);
});
</script>
@endsection