<?php

namespace App\Http\Controllers;

use Request;
use Response;
use DB;
use App;
use Storage;

class RegisterController extends Controller
{

    public function newParticipantData(){
        $participant = \App\cj2017_participant::where('Email', '=', Request::get('email'))->first();
        
        if($participant === null){

            $tribes = array("Zion", "Zoe", "Rhema", "Shalom", "Agape", "Charis", "Trinitas", "Dunamis", "Shabach", "Shekinah");
            $tribe_count = 0;
    
            $this_tribe = $tribes[mt_rand(0, 9)];
    
            $new_parti = new \App\cj2017_participant;
            $new_parti['Fullname'] = Request::get('name');
            $new_parti['Phone'] = Request::get('phone');
            $new_parti['Email'] = Request::get('email');
            $new_parti['Hear about Camp'] = Request::get('hear');
            $new_parti['Career'] = Request::get('career');
            $new_parti['First time at Camp'] = Request::get('first');
            $new_parti['Tribe'] = $this_tribe;
            $new_parti['Gender'] = Request::get('gender');
            $new_parti['Status'] = "Not Arrived";
            $new_parti['Reg Mode'] = "Nucleus";
            //$new_parti['created_at'] = CURRENT_TIMESTAMP;
            $new_parti->save();

            $events_json = Storage::disk('local')->get('events.json');
            $events_json = json_decode($events_json, true);

            return Response::json(array('success' => true, 'last_insert_id' => $new_parti->id, 'tribe' => $this_tribe, 'events' => $events_json), 200);
        } else {
            return Response::json(array('success' => false, 'reason' => 'exists'), 200);
        }

        //$list_name = Request::get('name');
        //$list_emails = Request::get('emails');
        

    }

    public function getEventsData(){

        $events_json = Storage::disk('local')->get('events.json');
        $events_json = json_decode($events_json, true);

        return Response::json(array('success' => true, 'events' => $events_json), 200);

    }

    public function getParticipantData(){
        $participant = \App\cj2017_participant::where('Email', '=', Request::get('email'))->first();
        
        if($participant === null){

            //means this user doesn't exist
            return Response::json(array('success' => false, 'reason' => 'no exist'), 200);

        } else {

            $events_json = Storage::disk('local')->get('events.json');
            $events_json = json_decode($events_json, true);
            
            return Response::json(array('success' => true, 'participant' => $participant, 'events' => $events_json), 200);

        }
    }


}
