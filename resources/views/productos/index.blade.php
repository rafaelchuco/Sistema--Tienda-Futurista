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
            <span class="info-text">
                MOSTRANDO {{ $productos->firstItem() }} - {{ $productos->lastItem() }} 
                DE {{ $productos->total() }} ELEMENTOS
            </span>
        </div>
        <div class="pagination-controls">
            {{ $productos->links() }}
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

/* Paginación holográfica */
.holo-pagination {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 2rem;
    padding: 1.5rem;
    background: var(--glass-bg);
    border: 1px solid var(--glass-border);
    border-radius: 20px;
    backdrop-filter: var(--blur-light);
}

.pagination-info .info-text {
    color: var(--text-dim);
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Estado vacío */
.cyber-empty-state {
    background: var(--glass-bg);
    backdrop-filter: var(--blur-medium);
    border: 1px solid var(--glass-border);
    border-radius: 25px;
    padding: 4rem 2rem;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.cyber-empty-state::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--neon-pink), var(--neon-cyan));
}

.empty-icon {
    margin-bottom: 2rem;
}

.empty-title {
    font-family: 'Orbitron', monospace;
    font-size: 2rem;
    font-weight: 900;
    color: var(--text-neon);
    margin-bottom: 1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.empty-description {
    color: var(--text-dim);
    font-size: 1.1rem;
    margin-bottom: 2rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.empty-actions {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}

/* Override para cualquier fondo blanco persistente */
.table, .table td, .table th, .table tr {
    background: transparent !important;
    color: var(--text-neon) !important;
}

.table-responsive {
    background: transparent !important;
}

/* Responsive mejorado */
@media (max-width: 768px) {
    .table-header {
        flex-direction: column;
        text-align: center;
    }
    
    .holo-pagination {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .search-actions {
        text-align: center;
    }
    
    .empty-actions {
        flex-direction: column;
    }
    
    .action-group {
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    /* Responsividad de tabla en móviles */
    .holo-table {
        font-size: 0.8rem;
    }
    
    .holo-table thead th,
    .holo-table tbody td {
        padding: 1rem 0.5rem !important;
    }
}

/* Animaciones adicionales */
@keyframes scan {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

/* Personalización de paginación Bootstrap */
.pagination .page-link {
    background: var(--glass-bg) !important;
    border: 1px solid var(--glass-border) !important;
    color: var(--text-neon) !important;
    margin: 0 2px;
    border-radius: 8px;
}

.pagination .page-link:hover {
    background: rgba(0, 245, 255, 0.1) !important;
    border-color: var(--neon-cyan) !important;
    color: var(--neon-cyan) !important;
}

.pagination .page-item.active .page-link {
    background: var(--neon-cyan) !important;
    border-color: var(--neon-cyan) !important;
    color: var(--dark-void) !important;
    box-shadow: 0 0 10px rgba(0, 245, 255, 0.5);
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