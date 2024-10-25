<?php

namespace App\Models;

use CodeIgniter\Model;

class TodoModel extends Model
{
    protected $table = 'todo';
    protected $primaryKey = 'id';
    protected $allowedFields = ['task', 'description', 'status'];
    protected $useTimestamps = true;
}
