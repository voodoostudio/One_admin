<?php

namespace TCG\Voyager\Http\Controllers;

use TCG\Voyager\Models\Category;

class VoyagerAdminController extends Controller
{
    public function getSubCategories($id) {
        $subCategories = Category::where('parent_id',$id)->select('id', 'name')->get();
        return $subCategories;
    }

}
