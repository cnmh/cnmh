<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tuteur;
use App\Models\Patient;
use App\Models\DossierPatient;
use App\Models\Consultation\Consultation;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

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


        $currentYear = Carbon::now()->year;
        $startDate = Carbon::now();
        $endDate = Carbon::now();



         // Nouveau patients
         $countNouveauPatientFemme0_5years = Patient::whereYear('created_at', '=', $currentYear)
         ->whereRaw("YEAR(NOW()) - YEAR(date_naissance) <= 5")
         ->where('sexe', 'Femme')
         ->count();
     
        $countNouveauPatientHomme0_5years = Patient::whereYear('created_at', '=', $currentYear)
         ->whereRaw("YEAR(NOW()) - YEAR(date_naissance) <= 5")
         ->where('sexe', 'Homme')
         ->count();
     
       $countNouveauPatientFemme6_11years = Patient::whereYear('created_at', '=', $currentYear)
         ->whereRaw("YEAR(NOW()) - YEAR(date_naissance) BETWEEN 6 AND 11")
         ->where('sexe', 'Femme')
         ->count();
     
        $countNouveauPatientHomme6_11years = Patient::whereYear('created_at', '=', $currentYear)
         ->whereRaw("YEAR(NOW()) - YEAR(date_naissance) BETWEEN 6 AND 11")
         ->where('sexe', 'Homme')
         ->count();
     
        $countNouveauPatientFemme12_17years = Patient::whereYear('created_at', '=', $currentYear)
         ->whereRaw("YEAR(NOW()) - YEAR(date_naissance) BETWEEN 12 AND 17")
         ->where('sexe', 'Femme')
         ->count();
     
        $countNouveauPatientHomme12_17years = Patient::whereYear('created_at', '=', $currentYear)
         ->whereRaw("YEAR(NOW()) - YEAR(date_naissance) BETWEEN 12 AND 17")
         ->where('sexe', 'Homme')
         ->count();
     

        $countNouveauPatientFemme18plus = Patient::whereYear('created_at', '=', $currentYear)
         ->whereRaw("YEAR(NOW()) - YEAR(date_naissance) > 17")
         ->where('sexe', 'Femme')
         ->count();

        $countNouveauPatientHomme18plus = Patient::whereYear('created_at', '=', $currentYear)
         ->whereRaw("YEAR(NOW()) - YEAR(date_naissance) > 17")
         ->where('sexe', 'Homme')
         ->count();
     
        
        // Ancianne patients
        $countAncianPatientFemme0_5years = Patient::whereYear('created_at', '<', $currentYear)
        ->whereRaw("YEAR(NOW()) - YEAR(date_naissance) <= 5")
        ->where('sexe', 'Femme')
        ->count();
    
         $countAncianPatientHomme0_5years = Patient::whereYear('created_at', '<', $currentYear)
        ->whereRaw("YEAR(NOW()) - YEAR(date_naissance) <= 5")
        ->where('sexe', 'Homme')
        ->count();
    
         $countAncianPatientFemme6_11years = Patient::whereYear('created_at', '<', $currentYear)
        ->whereRaw("YEAR(NOW()) - YEAR(date_naissance) BETWEEN 6 AND 11")
        ->where('sexe', 'Femme')
        ->count();
    
         $countAncianPatientHomme6_11years = Patient::whereYear('created_at', '<', $currentYear)
        ->whereRaw("YEAR(NOW()) - YEAR(date_naissance) BETWEEN 6 AND 11")
        ->where('sexe', 'Homme')
        ->count();
    
        $countAncianPatientFemme12_17years = Patient::whereYear('created_at', '<', $currentYear)
        ->whereRaw("YEAR(NOW()) - YEAR(date_naissance) BETWEEN 12 AND 17")
        ->where('sexe', 'Femme')
        ->count();
    
        $countAncianPatientHomme12_17years = Patient::whereYear('created_at', '<', $currentYear)
        ->whereRaw("YEAR(NOW()) - YEAR(date_naissance) BETWEEN 12 AND 17")
        ->where('sexe', 'Homme')
        ->count();
    
        $countAncianPatientFemme18plus = Patient::whereYear('created_at', '<', $currentYear)
        ->whereRaw("YEAR(NOW()) - YEAR(date_naissance) >= 18")
        ->where('sexe', 'Femme')
        ->count();
    
         $countAncianPatientHomme18plus = Patient::whereYear('created_at', '<', $currentYear)
        ->whereRaw("YEAR(NOW()) - YEAR(date_naissance) >= 18")
        ->where('sexe', 'Homme')
        ->count();
    
        return View::make('home', compact('dossierCount','patientCount','Consultation','dossierEnAttend','countAncianPatientFemme0_5years','countAncianPatientHomme0_5years','countAncianPatientFemme6_11years',
        'countAncianPatientHomme6_11years','countAncianPatientFemme12_17years','countAncianPatientHomme12_17years','countAncianPatientFemme18plus','countAncianPatientHomme18plus','countNouveauPatientFemme0_5years','countNouveauPatientHomme0_5years','countNouveauPatientFemme6_11years',
        'countNouveauPatientHomme6_11years','countNouveauPatientFemme12_17years','countNouveauPatientHomme12_17years','countNouveauPatientFemme18plus','countNouveauPatientHomme18plus'));
    }
}