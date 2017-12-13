<?php

namespace TCG\Voyager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use TCG\Voyager\Models\Clients;
use Illuminate\Support\Facades\Mail;

class VoyagerClientsController extends Controller
{
    public function index ()
    {
        return view('voyager::clients.clients-view');
    }

    public function clientView ()
    {
        return view('voyager::clients.edit-add');
    }

    public function clientCreate(Request $request) {
        $rules = array(
            'name'      => 'required',
            'email'      => 'required',
        );

        $clients = new Clients;
        $role = 5;
        $password = uniqid(rand(),true);
        $b_pass = bcrypt($password);
        $url = $_SERVER['REQUEST_URI'] . 'admin/login?email=' . $request->email . '&password=' . $password . '';
        $data = [
            'name'      => $request->name,
            'email'     => $request->email,
            'url'       => $url,
            'password'  => $password,
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/admin/clients')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            $clients->name              = Input::get('name');
            $clients->last_name         = Input::get('last_name');
            $clients->lng_corres        = Input::get('lng_corres');
            $clients->email             = Input::get('email');
            $clients->password          = $b_pass;
            $clients->role_id           = $role;

            $clients->save();

            Mail::send('voyager::emails.invite_client', $data, function ($message) use ($data) {
                $message->from(env('CONTACT_EMAIL'), 'HIS');
                $message->to($data['email']);
            });


//            if (Mail::failures()) {
//                return $error;
//            } else {
//                return $success;
//            }




            // redirect
            return $url;

        }
    }



}
