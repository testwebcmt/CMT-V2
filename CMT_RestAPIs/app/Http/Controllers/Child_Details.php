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

       $ChildDetails = $request->json()->get('child_program');
                
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
public function Childdelete(Request $request)
{

    $id = $request->json()->get('userId');

    $ChildDetails = $request->json()->get('child_program');
             
     foreach($ChildDetails as $key => $title)
     {
         $childid = $title['childId'];
         
         $data1= tb_child_detail::where('parentId', $id)
                            ->where('childId',$childid)
                            ->first();

        if(!empty($data1))
            {

                DB::table('tb_child_details')->where('parentId', $id)
                                            ->where('childId',$childid)
                                            ->delete();            
            }
        else
            {
                return response("Child Not Available", 200); 
            }  
        }
        return response("Child Deleted", 200);
        }

        public function AddChild(Request $request)
        {

            $id = $request->json()->get('userId');

            $ChildDetails = $request->json()->get('child_program');
                
                foreach($ChildDetails as $key => $title)
                {
                    $data2 = new tb_child_detail();
                    $data2->childFirstname = $title['childFirstName'];
                    $data2->childLastname = $title['childLastName'];
                    $data2->childDob = $title['childBirthDate'];
                    $data2->parentId = $id;
                    $data2->save();
                }

                return response("Child Added", 200);


        }
}