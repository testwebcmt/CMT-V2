<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class tb_init_user_extra_detail extends Model
{
    use HasFactory;

    protected $table = 'tb_init_user_extra_details';
    
    protected $fillable = [
        'myHealth',
        'myLifeSatisfaction',
        'mySocialNetwork',
        'myCommunityNetwork',
        'myStressLevel',
        'myHealthIssues',
        'myFamilyDoctor',
        'myVisitToFamilyDoctor',
        'myVisitToClinic',
        'myVisitToEmergency',
        'myVisitToHospital',
        'myDiseaseAwareness',
        'myCmtProgramAwareness',
        'myPhysicalActiveness',
        'cmtAgent',
        'userId',
    ];
}
