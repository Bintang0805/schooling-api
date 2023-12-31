<?php

namespace App\Http\Controllers\Admin;

use App\Models\School;
use App\Models\Meeting;
use Illuminate\Http\Request;
use App\Models\MeetingDetail;
use Jubaer\Zoom\Facades\Zoom;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMeetingRequest;

class MeetingController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        Meeting::where([['start_date', '<=', now()], ['status', "!=", 'Finished']])->update([
            'status' => 'On Going'
        ]);

        $meetings = Meeting::with("user")->get();
        $schools = School::all();

        return response()->json(['meetings' => $meetings, 'schools' => $schools]);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMeetingRequest $request) {
        $data = $request->validated();

        $zoomMeeting = Zoom::createMeeting([
            "agenda" => $data['topic'],
            "topic" => $data['topic'],
            "type" => 1, // 1 => instant, 2 => scheduled, 3 => recurring with no fixed time, 8 => recurring with fixed time
            "timezone" => 'Asia/Jakarta', // set your timezone
            "password" => $data['password'],
            "start_time" => $data['start_date'], // set your start time
            "pre_schedule" => false,  // set true if you want to create a pre-scheduled meeting
            // "schedule_for" => 'ikhsanbintang1105@gmail.com', // set your schedule for
            "settings" => [
                'join_before_host' => true, // if you want to join before host set true otherwise set false
                'host_video' => false, // if you want to start video when host join set true otherwise set false
                'participant_video' => false, // if you want to start video when participants join set true otherwise set false
                'mute_upon_entry' => true, // if you want to mute participants when they join the meeting set true otherwise set false
                'waiting_room' => false, // if you want to use waiting room for participants set true otherwise set false
                'audio' => 'both', // values are 'both', 'telephony', 'voip'. default is both.
                'auto_recording' => 'none', // values are 'none', 'local', 'cloud'. default is none.
                'approval_type' => 2, // 0 => Automatically Approve, 1 => Manually Approve, 2 => No Registration Required
            ],

        ]);

        $data['link'] = $zoomMeeting['data']['join_url'];
        $data['zoom_meeting_id'] = $zoomMeeting['data']['id'];

        // dd($data);
        Meeting::create($data);

        return response()->json(['message' => 'Meeting saved successfully.']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function show(Meeting $meeting) {
        return response()->json(['meeting' => $meeting]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meeting $meeting) {
        Zoom::deleteMeeting($meeting->zoom_meeting_id);
        $meeting->delete();

        return response()->json(['message' => 'Meeting deleted successfully.']);
    }

    public function addParticipants(Request $request, Meeting $meeting) {
        foreach($request->participants as $participant) {
            $joined = MeetingDetail::where(['meeting_id' => $meeting->id,
                'user_id' => $participant])->count();

            if($joined > 0) {
                continue;
            }

            MeetingDetail::create([
                'meeting_id' => $meeting->id,
                'user_id' => $participant
            ]);
        }

        return response()->json(['message' => 'Participants added successfully.']);
    }

    public function deleteParticipants(Request $request, Meeting $meeting) {
        foreach($request->participants as $participant) {
            MeetingDetail::where([
                'meeting_id' => $meeting->id,
                'user_id' => $participant
            ])->delete();
        }

        return response()->json(['message' => 'Participants deleted successfully.']);

    }

    public function finishMeeting(Meeting $meeting) {
        $meeting->update([
            'status' => 'Finished'
        ]);

        return response()->json(['message' => 'Meeting is finished']);
    }
}
