<?php

namespace App\Http\Controllers;
use App\Models\tb_init_user_detail;
use App\Models\tb_init_user_goals;
use App\Models\tb_init_user_program_detail;
use App\Models\tb_init_user_extra_detail;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;

class Add_Goals extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function AddGoals(Request $request)
    {
        $validator = Validator::make($request->json()->all() , [
            'CategoryName' => 'required|string|max:255',
            'ProgramName' => 'required|string|max:255',
            'Location' => 'required|string|max:255',
            'Instructor' => 'required|string|max:255',
            'StartDate' => 'required|date_format:Y/m/d',
            'EndDate' => 'required|date_format:Y/m/d',
            'Status' => 'required|string|max:255',
            'RatingBefore' => 'required|string|max:255',
          
        ]);

        if($validator->fails())
            {
                return response()->json($validator->errors()->toJson(), 400);
            } 

        $user = tb_init_user_goals::create([
            'user_goal_category_name' => $request->json()->get('CategoryName'),
            'user_goal_program_name' => $request->json()->get('ProgramName'),
            'user_goal_program_location' => $request->json()->get('Location'),
            'user_goal_program_instructor' => $request->json()->get('Instructor'),
            'user_goal_program_startdate' => $request->json()->get('StartDate'),
            'user_goal_program_enddate' => $request->json()->get('EndDate'),
            'user_goal_program_status' => $request->json()->get('Status'),
            'user_goal_program_participantcomments' => $request->json()->get('ParticipantComments'),
            'user_goal_program_additionalcomments' => $request->json()->get('AdditionalComments'),
            'user_goal_program_RatingBefore' => $request->json()->get('RatingBefore'),
            'user_goal_program_RatingAfter' => $request->json()->get('RatingAfter'),
            'userId' => $request->json()->get('userId')            
        ]);
         
               return response("Goals Added", 200);
    }
    public function getprogramdetails($id)
    {
        $result = DB::Table('tb_init_user_program_details')->select('category','programName')->where('userId',$id)->get();

        return response($result, 200);

    
    }



}
