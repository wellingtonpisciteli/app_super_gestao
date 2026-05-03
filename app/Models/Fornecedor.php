<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model
{
    use SoftDeletes;
    
    //Conversão de objeto para registro no banco
    protected $table = 'fornecedores';
    
    //Autorização para utilizar o método stático create
    protected $fillable = ['nome', 'site', 'uf', 'email'];
}
