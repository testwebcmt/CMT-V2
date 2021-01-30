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
use Illuminate\Routing\Controller as BaseController;

class IrfSearch extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function irfsearch(Request $request)
    {

      //  $userId = $request->json()->get('userId');

     // $photos = tb_init_user_detail::all();
      //return response($photos, 200);
        
       // $user =  tb_init_user_detail::where('userId', $userId)->first();
       //$data = $request->json()->get('data');

       $data = $request->input('data', false);

       $search_users = tb_init_user_detail::where('userId',$data)
                                           ->orwhere('email',$data)
                                           ->first();
                                          
        //Checking whether the User Query returns value             
         if(is_null($search_users)) 
                {
                        return response("User Does Not Exist",200);
                }

          else
          {
            //Storing the result in a Array
            $resultArr = $search_users->toArray();
          }       
       
        //Getting the User Id from the Query
        $id = $resultArr['userId'];
        
        //Searching Child Details
        $search_child = tb_child_detail::where('parentId',$id)->get();

      //  $resultArr2 = $search_child->toArray();

        //Counting the rows returned
       // $ChildCount = count($search_child );

        
        $ProgramDetails = tb_init_user_program_detail::where('userId',$id)->get();


        $HealthDetails = tb_init_user_extra_detail::where('userId',$id)->get();


        //$GoalDetails = tb_init_user_goals::where('userId',$id);

      // //Creating Array for Response
        $search['User_Details'] = $search_users;
        $search['Child_Details'] = $search_child;
        $search['Program_Details'] = $ProgramDetails;
        $search['Health_Details'] = $HealthDetails;
                  
    return response($search,200);
        
        
        
        
    }
}
