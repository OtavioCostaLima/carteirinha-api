<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
	 protected $connection = 'tenant';

    protected $fillable = ['nome', 'cpf', 'bairro', 'naturalidade', 'nascionalidade', 'sexo', 'email', 
    'ctps', 'data_emissao', 'profissao', 'data_nascimento', 'estado_civil', 'numero_residencia',
    'orgao_emissor', 'pis_pasep', 'pos_graduacao', 'cidade', 'etinia', 'grau_instrucao', 'rg', 'celular', 
    'endereco', 'secao','serie', 'situacao', 'titulo_eleitor', 'estado', 'complemento', 'cep'];

  public function timeTables(): HasMany {
    return $this->hasMany(\App\Models\TimeTable::class);
  }

  public function user() {
    return $this->belongsTo(\App\User::class);
 }
}
