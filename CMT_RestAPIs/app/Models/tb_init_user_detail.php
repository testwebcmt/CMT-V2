<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class tb_init_user_detail extends Model
{
    use HasFactory;

    protected $table = 'tb_init_user_details';
    
    protected $fillable = [
        'firstName',
        'middleName',
        'lastName',
        'gender',
        'age',
        'streetAddress',
        'city',
        'province',
        'country',
        'zipCode',
        'phoneHome',
        'phoneCell',
        'phoneWork',
        'email',
        'firstLang',
        'EmerContactName',
        'EmerContactNo',
        'aboutUs',
        'ChildValue',
        'notes',
        'notes_last_edited_byName',
        'notes_last_edited_byRole'
    ];
}
