<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BermainModel;
use App\Models\BimbelModel;
use App\Models\DaycareRegistrationModel;
use App\Models\EventModel;
use App\Models\EventRegistrationModel;
use App\Models\StimulasiModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        return view('home', [
            'total_daycare' => DaycareRegistrationModel::count(),
            'total_bermain' => BermainModel::count(),
            'total_bimbel'=> BimbelModel::count(),
            'total_stimulasi' =>StimulasiModel::count(),
            'total_event' => EventRegistrationModel::count(),
        ]);
    }
}
