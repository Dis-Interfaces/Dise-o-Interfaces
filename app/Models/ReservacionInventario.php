<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservacionInventario extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservacion_id', 
        'inventario_id', 
        'cantidad', 
        'precio_unitario', 
        'subtotal',
    ];

    public function reservacion()
    {
        return $this->belongsTo(Reservacion::class, 'reservacion_id');
    }

    public function inventarios()
    {
        return $this->belongsTo(Inventario::class, 'inventario_id');
    }
}
