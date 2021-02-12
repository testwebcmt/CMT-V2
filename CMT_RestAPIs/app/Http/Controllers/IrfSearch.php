<?php

namespace App\Http\Controllers;
use App\Models\tb_init_user_detail;
use App\Models\tb_child_detail;
use App\Models\tb_init_user_program_detail;
use App\Models\tb_init_user_extra_detail;
use App\Models\tb_init_user_goals;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;

class IrfSearch extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function irfsearch($data)
    {

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
      
          $ProgramDetails_health = tb_init_user_program_detail::select('program_details_id','programName','category')
                                                              ->where('userId',$id)
                                                              ->get()
                                                              ->groupBy('category');
                                                  
         

                                                              

        //JSON_PRETTY_PRINT,JSON_FORCE_OBJECT
        //$ProgramDetails = collect($ProgramDetails1)->tojson();
        //$ProgramDetails = collection->diffAssoc($ProgramDetails1);
        //$object = (object) $ProgramDetails1;
/*
        $object= object;

        foreach ($ProgramDetails1 as $key => $value)
    {
      if (is_array($value))
      {
      $obj->$key = new stdClass();
      array_to_obj($value, $obj->$key);
      }
      else
      {
        $obj->$key = $value;
      }
    } 
                       //   $ProgramDetails2 = trim($ProgramDetails1, '[');

             //   $ProgramDetails = trim($ProgramDetails2, ']');
        
          //  $ProgramDetails2 = Str::replaceArray('[',['{'], $ProgramDetails1);

          //  $ProgramDetails = Str::replaceArray(']',['}'], $ProgramDetails2);
*/
             $HealthDetails = tb_init_user_extra_detail::where('userId',$id)->first();

             $GoalDetails = tb_init_user_goals::where('userId',$id)->get();
              
           //  $manage = json_decode($ProgramDetails1);

          //  $manage =  str_replace (array('[', ']'), '' , $ProgramDetails1);

          //  $manage = str_replace(array('[', ']'), '', htmlspecialchars(json_encode($manage), ENT_NOQUOTES));

      // //Creating Array for Response */
        $search['User_Details'] = $search_users;
        $search['Child_Details'] = $search_child;
        $search['GoalDetails'] = $GoalDetails;
        $search['Program_Details'] = $ProgramDetails_health;
        $search['Health_Details'] = $HealthDetails;

        $ProgramDetails =json_encode($search,JSON_FORCE_OBJECT);

       // $obj = (object)$search;

      // $manage = json_decode($search, true);


      // str_replace(array('[', ']'), '', htmlspecialchars(json_encode($ProgramDetails1), ENT_NOQUOTES));

      // str_replace (array('[', ']'), '' , $ProgramDetails);

       // $obj = json_encode($ProgramDetails);

     //  $obj = collect($ProgramDetails1);

      //   $yourJson = trim($ProgramDetails1, '[');
               
    return response($ProgramDetails,200);
           
    }
}
