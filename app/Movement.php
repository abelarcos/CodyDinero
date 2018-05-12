<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    protected $table = 'movements';//comunicarse con la tabla movements

    protected $fillable = [ //definir los campos que pueden ser llenados

        'type', 'movement_date', 'category_id', 'description', 'money'
    ]; 

    protected $dates = ['movement_date']; //convertirlo en una instancia de carbon y poder manipularlo

    public function getMoneyDecimalAttribute(){ 
    
        //funcion para devolverme el valor y 2 decimales. 
        //lo toma como si fuera un campo mas en la tabla pero no lo almacena  en la BD
        return $this->attributes['money'] / 100;
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){ //relacion un movimiento le pertenece a un usuario
        return $this->belongsTo(User::class);
    }
}
