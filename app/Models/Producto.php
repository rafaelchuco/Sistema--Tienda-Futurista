<?php
// app/Models/Producto.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    
    protected $fillable = [
        'nombre',
        'marca',
        'precio',
        'stock',
        'id_categoria',
        'estado'
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'stock' => 'integer',
        'estado' => 'boolean'
    ];

    // Relación con Categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }

    // Scope para productos activos
    public function scopeActivos($query)
    {
        return $query->where('estado', 1);
    }

    // Accessor para formatear precio
    public function getPrecioFormateadoAttribute()
    {
        return 'S/ ' . number_format($this->precio, 2);
    }
    public $timestamps = true;
}
