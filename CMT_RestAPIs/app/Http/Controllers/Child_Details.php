<?php

namespace App\Http\Controllers;
use App\Models\tb_init_user_detail;
use App\Models\tb_child_detail;
use App\Models\tb_init_user_program_detail;
use App\Models\tb_init_user_extra_detail;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;

class Child_Details extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function ChildUpdate(Request $request)
    {

        $id = $request->json()->get('userId');

       
                
        foreach($ChildDetails as $key => $title)
        {
            $childid = $title['childId'];
            
            $data6=tb_child_detail::where('parentId',$id)
            ->where('childId',$childid)
            ->update([
                'childFirstname' => $title['childFirstName'],
                'childLastname' => $title['childLastName'],
                'childDob' => $title['childBirthDate']]);
         }

               
}
}