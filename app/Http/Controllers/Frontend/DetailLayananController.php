<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DetailLayananController extends Controller
{
    public function show($id)
{

    $available = ['daycare', 'bimbel', 'bermain', 'stimulasi','event'];

    if (!in_array($id, $available)) {
        abort(404);
    }

    return view("program.$id");
}

}
