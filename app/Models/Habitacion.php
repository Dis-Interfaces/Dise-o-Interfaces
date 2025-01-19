<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Habitacion extends Model
{
    use HasFactory;
    protected $table = 'habitaciones';
    protected $fillable = [
        'hotel_id',
        'tipo_habitacion_id',
        'numero_habitacion',
        'tarifa',
        'estado',
        'piso'
    ];
    public function hotel()
    {
        return $this->belongsTo(Hoteles::class, 'hotel_id');
    }


    public function reservaciones()
{
    return $this->belongsToMany(Reservacion::class, 'reservacion_habitaciones', 'habitacion_id', 'reservacion_id');
}


}