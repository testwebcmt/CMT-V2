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

class Irf_ProgramUpdate extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function ProgramUpdate(Request $request)
    {
        $Programs = $request->json()->get('userprograms');

        $id = $request->json()->get('userId');
              
        foreach($Programs as $key => $title)
        {
             foreach($title as $key2 => $val)
                 {
                          $checker2 = $val['isChecked'];
                          if($checker2 == 'true')
                             { 
                               $data= tb_init_user_program_detail::where('userId', $id)
                                                                    ->where('category',$val['value'])
                                                                    ->first(); 
                                if(is_null($data))
                                    {
                                        $data3= tb_init_user_program_detail::upsert([
                                        'programName' => $key,
                                        'category' => $val['value'],
                                        'userId' => $id],'userId',['programName','category','userId']);        
                                    }
                                }
                            else
                            {
                             
                                        DB::table('tb_init_user_program_details')->where('userId', $id)
                                                                        -> where('category', $val['value'])
                                                                        ->delete();
                                             
                            }                                        
                     }
                     
        }

        $Afterschool = $request->json()->get('after_school_program');

        $data1= tb_init_user_program_detail::where('userId', $id)
                                        ->where('programName','AfterSchool')
                                        ->first();
                                                   
        if($Afterschool == 'no' and !empty($data1))
            {
                DB::table('tb_init_user_program_details')->where('userId', $id)
                                            ->where('programName','AfterSchool')
                                            ->delete();
            }
        else if($Afterschool == 'yes' and is_null($data1))
            {
                $data4 = new tb_init_user_program_detail();
                $data4->programName = "AfterSchool";
                $data4->category = "AfterSchool";
                $data4->userId = $id;
                $data4->save();
            }
        
        $other = $request->json()->get('Others');
            
            $data5= tb_init_user_program_detail::where('userId', $id)
            ->where('programName','Other')
            ->first();

                    if(is_null($data5))
                     {
                      $data6 = tb_init_user_program_detail::upsert([
                        'programName' => "Other",
                        'category' => $other,
                        'userId' => $id],'userId',['programName','category','userId']);
                      }
                      else
                      {
                        $data6=tb_init_user_program_detail::where('userId',$id)
                                                ->where('programName','Other')
                                                ->update([
                                                    'programName' => "Other",
                                                    'category' => $other,
                                                    'userId' => $id]);
                      }
                 
}
}