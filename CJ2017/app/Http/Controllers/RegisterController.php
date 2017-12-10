<?php

namespace App\Http\Controllers;

use Request;
use DB;
use App;

class RegisterController extends Controller
{

    
    public function newParticipantData(){

        //$list_name = Request::get('name');
        //$list_emails = Request::get('emails');

        $new_parti = new \App\cj2017_participant;
        $new_parti['Fullname'] = Request::get('name');
        $new_parti['Phone'] = Request::get('phone');
        $new_parti['Email'] = Request::get('email');
        $new_parti['Hear about Camp'] = Request::get('hear');
        $new_parti['Career'] = Request::get('career');
        $new_parti['First time at Camp'] = Request::get('first');
        $new_parti['Tribe'] = Request::get('tribe');
        $new_parti['Gender'] = Request::get('gender');
        $new_parti['Status'] = "Not Arrived";
        $new_parti['Reg Mode'] = "Nucleus";
        //$new_question['Date Asked'] = 'CURRENT_TIMESTAMP';
        $new_parti->save();
    
        return Response::json(array('success' => true, 'last_insert_id' => $new_parti->id), 200);

    }

    public function getParticipantData(){

    }


}
