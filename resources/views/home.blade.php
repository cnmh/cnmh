@extends('layouts.app')

@section('content')
<div class="p-4">
    <div class="card card-dark" style="display: flex; flex-direction: column;">
        <div class="card-header">
            <h3 class="card-title">Tableau de board</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background:#00838f;">
                <div class="inner">
                    <h3>{{$dossierCount}}</h3>

                    <p>Nombre des dossiers</p>
                </div>
                <div class="icon">
                    <i class="fas fa-folder-open"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">

            <div class="small-box" style="background:#FFD54F;">
                <div class="inner">
                    <h3>{{$patientCount}}</h3>
                    <p>Nombre des bénéficiaires</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box" style="background:#fd5c63;">
                <div class="inner">
                    <h3>{{$Consultation}}</h3>
                    <p>Nombre des consultations</p>
                </div>
                <div class="icon">
                    <i class="fas fa-folder-open"></i>
                </div>
            </div>
        </div>


        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background:#1cb36c;">
                <div class="inner">
                    <h3>{{$dossierEnAttend}}</h3>
                    <p class="text-dark">Dossiers en attente</p>
                </div>
                <div class="icon">
                    <i class="fas fa-folder-open"></i>
                </div>
            </div>
        </div>
    </div>

    

                <table class="table table-striped" id="tuteurs-table">
                    <thead>
                        <tr>
                            <th class="text-center p-0" style="border: 2px solid #333;background-color: #FFD54F;"> 
                                <div style="border-bottom: 2px solid #333;">TRANCHE</div>
                                <div>SEXE</div>
                            </th>
                            <th class="text-center p-0" style="border: 2px solid #333;background-color: #FFD54F;">
                                <div style="border-bottom: 2px solid #333;">Bénéficiaires 0-5 ans</div>
                                <div class="d-flex justify-content-around">
                                    <span class="border-right" style="border-right: 2px solid #000; flex: 1;background-color: lightblue;">M</span>
                                    <span style="flex: 1; border-left: 2px solid #000;background-color: lightpink;">F</span>
                                </div>
                            </th>
                            <th class="text-center p-0" style="border: 2px solid #333;background-color: #FFD54F;">
                                <div style="border-bottom: 2px solid #333;">Bénéficiaires 6-11 ans</div>
                                <div class="d-flex justify-content-around">
                                    <span class="border-right" style="border-right: 2px solid #000; flex: 1;background-color: lightblue;">M</span>
                                    <span style="flex: 1; border-left: 2px solid #000;background-color: lightpink;">F</span>
                                </div>
                            </th>
                            <th class="text-center p-0" style="border: 2px solid #333;background-color: #FFD54F;">
                                <div style="border-bottom: 2px solid #333;">Bénéficiaires 12-17 ans</div>
                                <div class="d-flex justify-content-around">
                                    <span class="border-right" style="border-right: 2px solid #000; flex: 1;background-color: lightblue;">M</span>
                                    <span style="flex: 1; border-left: 2px solid #000;background-color: lightpink;">F</span>
                                </div>
                            </th>
                            <th class="text-center p-0" style="border: 2px solid #333;background-color: #FFD54F;">
                                <div style="border-bottom: 2px solid #333;">Bénéficiaires 18 et plus</div>
                                <div class="d-flex justify-content-around">
                                    <span class="border-right" style="border-right: 2px solid #000; flex: 1;background-color: lightblue;">M</span>
                                    <span style="flex: 1; border-left: 2px solid #000;background-color: lightpink;">F</span>
                                </div>
                            </th>
                            <th class="text-center p-0" style="border: 2px solid #333;background-color: #FFD54F;">
                                <div style="border-bottom: 2px solid #333;">Total</div>
                                <div class="d-flex justify-content-around">
                                    <span class="border-right" style="border-right: 2px solid #000; flex: 1;background-color: lightblue;">M</span>
                                    <span style="flex: 1; border-left: 2px solid #000;background-color: lightpink;">F</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="tuteurTable">
                        <tr class="p-2">
                            <td class="text-center p-0" style="border: 2px solid #333;background-color: #f4f4f4;">
                                <div>Nouveau</div>
                            </td>
                            <td class="text-center p-0" style="border: 2px solid #333;">
                                <div class="d-flex justify-content-around">
                                    <span class="border-right" style="border-right: 2px solid #000; flex: 1;">{{$countNouveauPatientHomme0_5years}}</span>
                                    <span style="flex: 1; border-left: 2px solid #000;">{{$countNouveauPatientFemme0_5years}}</span>
                                </div>
                            </td>
                            <td class="text-center p-0" style="border: 2px solid #333;">
                                <div class="d-flex justify-content-around">
                                    <span class="border-right" style="border-right: 2px solid #000; flex: 1;">{{$countNouveauPatientHomme6_11years}}</span>
                                    <span style="flex: 1; border-left: 2px solid #000;">{{$countNouveauPatientFemme6_11years}}</span>
                                </div>
                            </td>
                            <td class="text-center p-0" style="border: 2px solid #333;">
                                <div class="d-flex justify-content-around">
                                    <span class="border-right" style="border-right: 2px solid #000; flex: 1;">{{$countNouveauPatientHomme12_17years}}</span>
                                    <span style="flex: 1; border-left: 2px solid #000;">{{$countNouveauPatientFemme12_17years}}</span>
                                </div>
                            </td>
                            <td class="text-center p-0" style="border: 2px solid #333;">
                                <div class="d-flex justify-content-around">
                                    <span class="border-right" style="border-right: 2px solid #000; flex: 1;">{{$countNouveauPatientHomme18plus}}</span>
                                    <span style="flex: 1; border-left: 2px solid #000;">{{$countNouveauPatientFemme18plus}}</span>
                                </div>
                            </td>
                            <td class="text-center p-0" style="border: 2px solid #333;">
                                <div class="d-flex justify-content-around">
                                    <span class="border-right" style="border-right: 2px solid #000; flex: 1;">{{$countNouveauPatientHomme0_5years + $countNouveauPatientHomme6_11years + $countNouveauPatientHomme12_17years + $countNouveauPatientHomme18plus}}</span>
                                    <span style="flex: 1; border-left: 2px solid #000;">{{$countNouveauPatientFemme0_5years + $countNouveauPatientFemme6_11years + $countNouveauPatientFemme12_17years + $countNouveauPatientFemme18plus}}</span>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="text-center p-0" style="border: 2px solid #333;">
                                <div>ANCIENS CAS</div>
                            </td>
                            <td class="text-center p-0" style="border: 2px solid #333;">
                                <div class="d-flex justify-content-around">
                                    <span class="border-right" style="border-right: 2px solid #000; flex: 1;">{{$countAncianPatientHomme0_5years}}</span>
                                    <span style="flex: 1; border-left: 2px solid #000;">{{$countAncianPatientFemme0_5years}}</span>
                                </div>
                            </td>
                            <td class="text-center p-0" style="border: 2px solid #333;">
                                <div class="d-flex justify-content-around">
                                    <span class="border-right" style="border-right: 2px solid #000; flex: 1;">{{$countAncianPatientHomme6_11years}}</span>
                                    <span style="flex: 1; border-left: 2px solid #000;">{{$countAncianPatientFemme6_11years}}</span>
                                </div>
                            </td>
                            <td class="text-center p-0" style="border: 2px solid #333;">
                                <div class="d-flex justify-content-around">
                                    <span class="border-right" style="border-right: 2px solid #000; flex: 1;">{{$countAncianPatientHomme12_17years}}</span>
                                    <span style="flex: 1; border-left: 2px solid #000;">{{$countAncianPatientFemme12_17years}}</span>
                                </div>
                            </td>
                            <td class="text-center p-0" style="border: 2px solid #333;">
                                <div class="d-flex justify-content-around">
                                    <span class="border-right" style="border-right: 2px solid #000; flex: 1;">{{$countAncianPatientHomme18plus}}</span>
                                    <span style="flex: 1; border-left: 2px solid #000;">{{$countAncianPatientFemme18plus}}</span>
                                </div>
                            </td>
                            <td class="text-center p-0" style="border: 2px solid #333;">
                                <div class="d-flex justify-content-around">
                                    <span class="border-right" style="border-right: 2px solid #000; flex: 1;">{{$countAncianPatientHomme0_5years + $countAncianPatientHomme6_11years + $countAncianPatientHomme12_17years + $countAncianPatientHomme18plus}}</span>
                                    <span style="flex: 1; border-left: 2px solid #000;">{{$countAncianPatientFemme0_5years + $countAncianPatientFemme6_11years + $countAncianPatientFemme12_17years + $countAncianPatientFemme18plus}}</span>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="text-center p-0" style="border: 2px solid #333;">
                                <div>TOTAL</div>
                            </td>
                            <td class="text-center p-0" style="border: 2px solid #333;">
                                <div class="d-flex justify-content-around">
                                    <span class="border-right" style="border-right: 2px solid #000; flex: 1;background-color: lightblue;">{{$countNouveauPatientHomme0_5years + $countAncianPatientHomme0_5years}}</span>
                                    <span style="flex: 1; border-left: 2px solid #000;background-color: lightpink;">{{$countNouveauPatientFemme0_5years + $countAncianPatientFemme0_5years}}</span>
                                </div>
                            </td>
                            <td class="text-center p-0" style="border: 2px solid #333;">
                                <div class="d-flex justify-content-around">
                                    <span class="border-right" style="border-right: 2px solid #000; flex: 1;background-color: lightblue;">{{$countNouveauPatientHomme6_11years + $countAncianPatientHomme6_11years}}</span>
                                    <span style="flex: 1; border-left: 2px solid #000;background-color: lightpink;">{{$countNouveauPatientFemme6_11years + $countAncianPatientFemme6_11years}}</span>
                                </div>
                            </td>
                            <td class="text-center p-0" style="border: 2px solid #333;">
                                <div class="d-flex justify-content-around">
                                    <span class="border-right" style="border-right: 2px solid #000; flex: 1;background-color: lightblue;">{{$countNouveauPatientHomme12_17years + $countAncianPatientHomme12_17years}}</span>
                                    <span style="flex: 1; border-left: 2px solid #000;background-color: lightpink;">{{$countNouveauPatientFemme12_17years + $countAncianPatientFemme12_17years}}</span>
                                </div>
                            </td>
                            <td class="text-center p-0" style="border: 2px solid #333;">
                                <div class="d-flex justify-content-around">
                                    <span class="border-right" style="border-right: 2px solid #000; flex: 1;background-color: lightblue;">{{$countAncianPatientHomme18plus + $countNouveauPatientHomme18plus}}</span>
                                    <span style="flex: 1; border-left: 2px solid #000;background-color: lightpink;">{{$countAncianPatientFemme18plus + $countNouveauPatientFemme18plus}}</span>
                                </div>
                            </td>
                            <td class="text-center p-0" style="border: 2px solid #333;">
                                <div class="d-flex justify-content-around">
                                    <span class="border-right" style="border-right: 2px solid #000; flex: 1;background-color: lightblue;">{{$countNouveauPatientHomme0_5years + $countNouveauPatientHomme6_11years + $countNouveauPatientHomme12_17years + $countNouveauPatientHomme18plus + $countAncianPatientHomme0_5years + $countAncianPatientHomme6_11years + $countAncianPatientHomme12_17years + $countAncianPatientHomme18plus}}</span>
                                    <span style="flex: 1; border-left: 2px solid #000;background-color: lightpink;">{{$countNouveauPatientFemme0_5years + $countNouveauPatientFemme6_11years + $countNouveauPatientFemme12_17years + $countNouveauPatientFemme18plus + $countAncianPatientFemme0_5years + $countAncianPatientFemme6_11years + $countAncianPatientFemme12_17years + $countAncianPatientFemme18plus}}</span>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="text-center p-0" style="border: 2px solid #333;">
                                <div>TOTAL</div>
                            </td>
                            <td class="text-center p-0" style="border: 2px solid #333;background-color: #85f8c3;">
                                <div class="d-flex justify-content-around">
                                    <span class="border-right" style="border-right: 2px solid #000; flex: 1;">{{$countNouveauPatientHomme0_5years + $countAncianPatientHomme0_5years + $countNouveauPatientFemme0_5years + $countAncianPatientFemme0_5years}}</span>
                                </div>
                            </td>
                            <td class="text-center p-0" style="border: 2px solid #333;background-color: #85f8c3;">
                                <div class="d-flex justify-content-around">
                                    <span class="border-right" style="border-right: 2px solid #000; flex: 1;">{{$countNouveauPatientHomme6_11years + $countAncianPatientHomme6_11years + $countNouveauPatientFemme6_11years + $countAncianPatientFemme6_11years}}</span>
                                </div>
                            </td>
                            <td class="text-center p-0" style="border: 2px solid #333;background-color: #85f8c3;">
                                <div class="d-flex justify-content-around">
                                    <span class="border-right" style="border-right: 2px solid #000; flex: 1;">{{$countNouveauPatientHomme12_17years + $countAncianPatientHomme12_17years + $countNouveauPatientFemme12_17years + $countAncianPatientFemme12_17years}}</span>
                                </div>
                            </td>
                            <td class="text-center p-0" style="border: 2px solid #333;background-color: #85f8c3;">
                                <div class="d-flex justify-content-around">
                                    <span class="border-right" style="border-right: 2px solid #000; flex: 1;">{{$countAncianPatientFemme18plus + $countNouveauPatientFemme18plus + $countAncianPatientHomme18plus + $countNouveauPatientHomme18plus}}</span>
                                </div>
                            </td>
                            <td class="text-center p-0" style="border: 2px solid #333;background-color: #85f8c3;">
                                <div class="d-flex justify-content-around">
                                    <span class="border-right" style="border-right: 2px solid #000; flex: 1;">{{ $countNouveauPatientHomme0_5years + $countNouveauPatientHomme6_11years + $countNouveauPatientHomme12_17years + $countNouveauPatientHomme18plus + $countAncianPatientHomme0_5years + $countAncianPatientHomme6_11years + $countAncianPatientHomme12_17years + $countAncianPatientHomme18plus +  $countNouveauPatientFemme0_5years + $countNouveauPatientFemme6_11years + $countNouveauPatientFemme12_17years + $countNouveauPatientFemme18plus + $countAncianPatientFemme0_5years + $countAncianPatientFemme6_11years + $countAncianPatientFemme12_17years + $countAncianPatientFemme18plus}}</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
</div>

@endsection