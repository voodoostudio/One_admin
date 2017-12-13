<?php

namespace TCG\Voyager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Models\Post;

class VoyagerClientsController extends Controller
{

    public function index ()
    {
        return view('voyager::clients.clients-view');
    }

    public function clientCreate ()
    {
        return view('voyager::clients.edit-add');
    }

}
