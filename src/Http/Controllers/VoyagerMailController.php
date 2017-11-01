<?php

namespace TCG\Voyager\Http\Controllers;

use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Models\Mailing;
use TCG\Voyager\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;

class VoyagerMailController extends Controller
{
    public function index()
    {
        return Voyager::view('voyager::mailer');
    }

    public function confirmEmail(Request $request) {

        $this->validate($request, [
            'email' => 'required|email',
        ]);

        /* Add data in DB */
        $confirm_code = sha1(rand() . time() . rand());
        $property = new Post;
        $property_id = $request->property_id;
        $property_data = $property::find($property_id);

        $mailer = new Mailing;
        $mailer->email          = $request->email;
        $mailer->property       = json_encode($property_data);
        $mailer->confirm_code   = $confirm_code;

        $link = $_SERVER['SERVER_NAME'] . '/admin/property-email?confirm_code=' . $confirm_code;

        /* Send data from email */
        $data = [
            'email' => $request->email,
            'link' => $link,
        ];

        /* Message box (errors || success)*/
        $success = array(
            'status' => 'success',
            'msg' => 'good',
        );

        $error = array(
            'status' => 'error',
            'msg' => 'bad'
        );

        /* Send email */
        Mail::send('voyager::emails.confirm', $data, function ($message) use ($data) {
            $message->from(env('CONTACT_EMAIL'), 'HIS CONFIRM');
            $message->to($data['email']);
        });

        /* Check if email send (if send data add in DB, else show message with error) */
        if (Mail::failures()) {
            return $error;
        } else {
            $mailer->save();
            return $success;
        }
    }

    public function sendPropertyEmail() {
        $confirm_code = $_GET['confirm_code'];

        $mailer = new Mailing;

        $email = $mailer::where('confirm_code', '=', $confirm_code)->value('email');
        $property_data = $mailer::where('confirm_code', '=', $confirm_code)->value('property');

        /* Send data from email */
        $data = [
            'email'     => $email,
            'property'  => $property_data
        ];

        /* Send email */
        Mail::send('voyager::emails.property', $data, function ($message) use ($data) {
            $message->from(env('CONTACT_EMAIL'), 'HIS CONFIRM');
            $message->to($data['email']);
        });

        return Voyager::view('voyager::mailer');
    }

}
