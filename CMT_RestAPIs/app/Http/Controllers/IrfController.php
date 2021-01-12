<?php

namespace App\Http\Controllers;

use App\Models\tb_init_user_details;
use App\Models\tb_child_details;
use App\Models\tb_community_programs;
use App\Models\tb_init_user_extra_details;
use App\Models\tb_init_user_goals;
use App\Models\tb_init_user_health_details;
use App\Models\tb_init_user_program_details;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class IrfController extends Controller
{
    //
    public function irf_register(Request $request)
    {
       /* $validator = Validator::make($request->json()->all() , [
            //Basic Details
            'firstName' => 'required|string|max:255',
            'middleName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'gender' => 'required|string|max:25',
            'age' => 'required|string|max:15',
            'streetAddress' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'zipCode' => 'required|string|max:25',
            //Contact Details
            'phoneHome' => 'required|string|max:15',
            'phoneCell' => 'required|string|max:15',
            'phoneWork' => 'required|string|max:15',
            'firstLang' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'EmerContactName' => 'required|string|max:255',
            'EmerContactNo' => 'required|string|max:15',
            'aboutUs' => 'required|string|max:255',
            'ChildValue' => 'required|string|max:5',
            'notes' => 'required|string|max:255',
            //'notes_last_edited_byName' => 'required|string|max:255',
            //'notes_last_edited_byRole' => 'required|string|max:255',
            //IRF Program
            'programName' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            //Child Details
            'childFirstname' => 'required|string|max:255',
            'childLastname' => 'required|string|max:255',
            'childDob' => 'required|string|max:255',

            ]);
        $useremail = $request->email;
        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        $irf = tb_init_user_details::create([
            //Basic Details            
            'firstname' => $request->json()->get('firstname'),
            'middleName' => $request->json()->get('middleName'),
            'lastName' => $request->json()->get('lastName'),
            'gender' => $request->json()->get('gender'),
            'age' => $request->json()->get('age'),
            'streetAddress' => $request->json()->get('streetAddress'),
            'city' => $request->json()->get('city'),
            'province' => $request->json()->get('province'),
            'country' => $request->json()->get('country'),
            'zipCode' => $request->json()->get('zipCode'),
            //Contact Details
            'phoneHome' => $request->json()->get('phoneHome'),
            'phoneCell' => $request->json()->get('phoneCell'),
            'phoneWork' => $request->json()->get('phoneWork'),
            'firstLang' => $request->json()->get('firstLang'),
            'email' => $request->json()->get('email'),
            'EmerContactName' => $request->json()->get('EmerContactName'),
            'EmerContactNo' => $request->json()->get('EmerContactNo'),
            'aboutUs' => $request->json()->get('aboutUs'),
            //'ChildValue' => $request->json()->get('ChildValue'),
            'notes' => $request->json()->get('notes'),
            //Child Details
            // 'ChildAr' => ['childFirstname' => 'required|string|max:255',
            // 'childLastname' => 'required|string|max:255',
            // 'childDob' => 'required|string|max:255',]
            ]);
            $email = $request->json()->get('email');
            $userId = Irf::where('email',$email)
          */  
            childFirstname = $request->json()->get('childFirstname');
            childLastname = $request->json()->get('childFirstname');
            childDob = $request->json()->get('childFirstname');

            for($i=0; $i<= count($ChildFN['childFirstname']); $i++) {
            
              if(empty($ChildFN['childFirstname'][$i]) || !is_numeric($ChildFN['childFirstname'][$i])) continue;
            
              $data2 = [ 
                'childFirstname' => $ChildFN['nameEn'][$i],
                'childLastname' => $ChildLN['nameEn'][$i],
                'childDob' => $ChildDOB['nameEn'][$i],
                'parentId' => $request->get('Id');,
                  ];
                }
                  tb_child_details::create($data2);

        //$token = JWTAuth::fromUser($irf);

        return response()->json($irf,200 );
    }
    
    public function addchild(Request $request)
    {

        childFirstname = $request->json()->get('childFirstname');
        childLastname = $request->json()->get('childLasttname');
        childDob = $request->json()->get('childDob');

        for($i=0; $i<= count($ChildFN['childFirstname']); $i++) {
        
          if(empty($ChildFN['childFirstname'][$i]) || !is_numeric($ChildFN['childFirstname'][$i])) continue;
        
          $data2 = [ 
            'childFirstname' => $ChildFN['nameEn'][$i],
            'childLastname' => $ChildLN['nameEn'][$i],
            'childDob' => $ChildDOB['nameEn'][$i],
            'parentId' => $request->get('Id');,
              ];
            }
              tb_child_details::create($data2);
    }

    public function irf_search(Request $request)
     {

        $data = $request->get('data');

        $search_users = Irf::where('id', 'like', "{$data}")
                         ->orWhere('firstname', 'like', "{$data}")
                         ->orWhere('email_id', 'like', "{$data}")
                         ->get();

        //return response::json(['data' => $search_users ]);     
        //return response()->json(['data' => $search_users], 400);
        return response()->json($search_users,200 );
    } 

    public function irf_update(Request $request)
     {

     }

    public function showallusers()
     {
        return response()->json(Irf::all());
     }
}
