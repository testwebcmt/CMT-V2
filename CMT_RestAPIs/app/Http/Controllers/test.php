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

class test extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function irf(Request $request)
    {

        $validator = Validator::make($request->json()->all() , [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'streetAddress' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'age' => 'required|integer|max:11',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'zipCode' => 'required|string|max:255',
            'phoneCell' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'firstLang' => 'required|string|max:255',
            'EmerContactName' => 'required|string|max:255',
            'EmerContactNo' => 'required|string|max:255',
            'aboutUs' => 'required|string|max:255',
            'ChildValue' => 'required|string|max:255',
            'notes_last_edited_byName' => 'required|string|max:255',
            'notes_last_edited_byRole' => 'required|string|max:255'
        ]);

        if($validator->fails())
            {
                return response()->json($validator->errors()->toJson(), 400);
            } 

        $user = tb_init_user_detail::create([
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
            'aboutUs' => $request->json()->get('aboutUs'),
            'ChildValue' => $request->json()->get('ChildValue'),
            'notes' => $request->json()->get('notes'),
            'notes_last_edited_byName' => $request->json()->get('notes_last_edited_byName'),
            'notes_last_edited_byRole' => $request->json()->get('notes_last_edited_byRole'),
        ]);

                $ChildDetails = $request->json()->get('child_program');
                
                foreach($ChildDetails as $key => $title)
                {
                    $data2 = new tb_child_detail();
                    $data2->childFirstname = $title['childFirstName'];
                    $data2->childLastname = $title['childLastName'];
                    $data2->childDob = $title['childBirthDate'];
                    $data2->parentId = $user->id;
                    $data2->save();
                }
              //    Link::insert($data2);
            
               // return response($data2, 200);

               $Programs = $request->json()->get('userprograms');
              
               foreach($Programs as $key => $title)
               {
                    foreach($title as $key2 => $val)
                        {
                            $data3 = new tb_init_user_program_detail();
                            $data3->programName = $key;
                            $data3->category = $val['value'];
                            $data3->userId = $user->id;
                            $data3->save();
                        }    
               }
              

               $ChildDetails = $request->json()->get('MemberDetails');

               $data4 = new tb_init_user_extra_detail();

               foreach($ChildDetails as $key => $title)
               {              
                   foreach($title as $key2 => $val)
                   {                        
                         $data4->$key = $val['value'];   
                   }
               }
               $data4->cmtAgent = $user->id;
               $data4->userId = $user->id;
               $data4->save(); 
               $display = $user->id;  
               return response($display, 200);
    }
}
