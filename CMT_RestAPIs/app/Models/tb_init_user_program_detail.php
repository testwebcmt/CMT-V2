<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_init_user_program_detail extends Model
{
    use HasFactory;

    protected $table = 'tb_init_user_program_details';
    
    protected $fillable = [
        'programName',
        'category',
        'userId',
    ];
}
