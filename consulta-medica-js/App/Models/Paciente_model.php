<?php

namespace App\Models;

use CodeIgniter\Model;

class Paciente_model extends Model
{
    protected $table      = 'usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'senha', 'nome', 'data_nascimento'];
}
