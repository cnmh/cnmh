<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tuteur;
use App\Models\Patient;
use App\Models\DossierPatient;
use App\Models\Consultation;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    

    public function index()
    {
        $dossierCount = DossierPatient::count();
        $patientCount = Patient::count();
        $dossierEnAttend = Consultation::where('etat','enAttente')->count();
        $Consultation = Consultation::where('etat','enConsultation')->count();
        return View::make('home', compact('dossierCount','patientCount','Consultation','dossierEnAttend'));
    }
}
