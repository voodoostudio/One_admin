<?php

namespace TCG\Voyager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Models\Post;
use Illuminate\Support\Facades\Mail;
use TCG\Voyager\Models\User;

class VoyagerController extends Controller
{
    public function index()
    {
        if(Auth::user()->role_id == 5 && Auth::user()->counter == 1) {
            return redirect('admin/profile');
        } elseif(Auth::user()->role_id == 5 && Auth::user()->counter > 1) {
            return redirect('admin/posts');
        } else {
            return Voyager::view('voyager::index');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('voyager.login');
    }

    public function upload(Request $request)
    {
        $fullFilename = null;
        $resizeWidth = 1800;
        $resizeHeight = null;
        $slug = $request->input('type_slug');
        $file = $request->file('image');

        $path = $slug.'/'.date('F').date('Y').'/';

        $filename = basename($file->getClientOriginalName(), '.'.$file->getClientOriginalExtension());
        $filename_counter = 1;

        // Make sure the filename does not exist, if it does make sure to add a number to the end 1, 2, 3, etc...
        while (Storage::disk(config('voyager.storage.disk'))->exists($path.$filename.'.'.$file->getClientOriginalExtension())) {
            $filename = basename($file->getClientOriginalName(), '.'.$file->getClientOriginalExtension()).(string) ($filename_counter++);
        }

        $fullPath = $path.$filename.'.'.$file->getClientOriginalExtension();

        $ext = $file->guessClientExtension();

        if (in_array($ext, ['jpeg', 'jpg', 'png', 'gif'])) {
            $image = Image::make($file)
                ->resize($resizeWidth, $resizeHeight, function (Constraint $constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode($file->getClientOriginalExtension(), 75);

            // move uploaded file from temp to uploads directory
            if (Storage::disk(config('voyager.storage.disk'))->put($fullPath, (string) $image, 'public')) {
                $status = __('voyager.media.success_uploading');
                $fullFilename = $fullPath;
            } else {
                $status = __('voyager.media.error_uploading');
            }
        } else {
            $status = __('voyager.media.uploading_wrong_type');
        }

        // echo out script that TinyMCE can handle and update the image in the editor
        return "<script> parent.helpers.setImageValue('".Voyager::image($fullFilename)."'); </script>";
    }

    public function profile()
    {
        return Voyager::view('voyager::profile');
    }

    public function individualProperty(Request $request) {
        $property_id = $request->property_id;
        $vip_users = (!empty($request->vip_users)) ? implode(",", $request->vip_users ) : '0';
        $client_id = "" . $vip_users . "";
        $ids = explode(",", $client_id);
        $property = Post::where('id', $property_id)->value('vip_users');

        if(!empty($request->vip_users)) {
            foreach ($ids as $item) {
                if (!in_array($item, explode(",", $property)) ) {
                    $emails = User::where('id', $item)->get();
                    foreach ($emails as $email) {
                        $data = [
                            'text'      => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,
                                            when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                            It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                                            and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
                            'name'      => $email->name,
                            'last_name' => $email->last_name,
                            'email'     => $email->email
                        ];

                        Mail::send('voyager::emails.notification', $data, function ($message) use ($data) {
                            $message->from(env('CONTACT_EMAIL'), 'HIS');
                            $message->to($data['email']);
                        });

                        Post::where('id', $property_id)->update(['vip_users' => $vip_users]);
                    }
                } else {
                    Post::where('id', $property_id)->update(['vip_users' => $vip_users]);
                }
            }
        } else {
            Post::where('id', $property_id)->update(['vip_users' => 0]);
        }
    }
}
