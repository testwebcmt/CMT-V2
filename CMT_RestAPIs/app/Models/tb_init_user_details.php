<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_init_user_details extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                        //Basic Details
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
                        'EmerContactName',
                        'EmerContactNo',
                        'aboutUs',
                        'ChildValue',
                        'notes',
                    ];
    
}
