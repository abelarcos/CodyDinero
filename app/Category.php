<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories'; //comunicarse con la tabla categories
    protected $fillable = ['name']; //definir los campos que pueden ser llenados
}
