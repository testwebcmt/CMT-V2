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

class Irf_UserUpdate extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function UserUpdate(Request $request)
    {
        $validator = Validator::make($request->json()->all() , [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'streetAddress' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'age' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'zipCode' => 'required|string|max:255',
            'phoneCell' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'firstLang' => 'required|string|max:255',
            'EmerContactName' => 'required|string|max:255',
            'EmerContactNo' => 'required|string|max:255',   
        ]);

        if($validator->fails())
            {
                return response()->json($validator->errors()->toJson(), 400);
            } 

        $id= $request->json()->get('userId');

        $user=tb_init_user_detail::where('userId',$id)
                            ->update([
            'firstName' => $request->json()->get('firstName'),
            'middleName' => $request->json()->get('middleName'),
            'lastName' => $request->json()->get('lastName'),
            'gender' => $request->json()->get('gender'),
            'age' => $request->json()->get('age'),
            'streetAddress' => $request->json()->get('streetAddress'),
            'city' => $request->json()->get('city'),
            'province' => $request->json()->get('province'),
            'country' => $request->json()->get('country'),
            'zipCode' => $request->json()->get('zipCode'),
            'phoneHome' => $request->json()->get('phoneHome'),
            'phoneCell' => $request->json()->get('phoneCell'),
            'phoneWork' => $request->json()->get('phoneWork'),
            'email' => $request->json()->get('email'),
            'firstLang' => $request->json()->get('firstLang'),
            'EmerContactName' => $request->json()->get('EmerContactName'),
            'EmerContactNo' => $request->json()->get('EmerContactNo'),
            'notes' => $request->json()->get('notes')            
        ]);

            
}
}