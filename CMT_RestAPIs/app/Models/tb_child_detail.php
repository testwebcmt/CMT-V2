<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_child_detail extends Model
{
    use HasFactory;

    protected $table = 'tb_child_details';
    
    protected $fillable = [
        'childFirstname',
        'childLastname',
        'childDob',
    ];
}
