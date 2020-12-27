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
        $validator = Validator::make($request->json()->all() , [
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
            'phoneHome' => 'required|string|max:15',
            'phoneCell' => 'required|string|max:15',
            'phoneWork' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:users',
            'EmerContactName' => 'required|string|max:255',
            'EmerContactNo' => 'required|string|max:15',
            'aboutUs' => 'required|string|max:255',
            'ChildValue' => 'required|string|max:5',
            'notes' => 'required|string|max:255',
            //'notes_last_edited_byName' => 'required|string|max:255',
            //'notes_last_edited_byRole' => 'required|string|max:255',
                        
            ]);
        $useremail = $request->email;
        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        $irf = Irf::create([
            //Basic Details            
            'firstname' => $request->json()->get('firstname'),
            ]);

        //$token = JWTAuth::fromUser($irf);

        return response()->json($irf,200 );
    }
    
    public function addchild(Request $request)
    {

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
