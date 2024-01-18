<H1>ssss</H1>
<h2>fggfgf</h2>
@php
                    $url = parse_url($_SERVER['REQUEST_URI']);
                    $explodePath = explode("=",$url['path']);
                    $parentId = $explodePath[1];
                    $explodeQuery = explode("=",$url['query']);
                    $patientId = $explodeQuery[1];
                @endphp
<form action="{{route("dossier-patients.store")}}" method="POST">
    @csrf
    <div class="row">
        @include('dossier_patients.fields')
    </div>
    {{-- <input type="text" value="{{1}}" name="numero_dossier">

    <input type="hidden" value="{{'dossier social'}}" name="etat">
    <input type="date"  name="date_enregsitrement">

    <input type="hidden" value="{{$parentId}}" name="couverture_medical_id">
    <input type="hidden" value="{{$parentId}}" name="couverture_medical_id">
    <input type="hidden" value="{{$patientId}}" name="patient_id">nada
    <input type="text " name="name">gg --}}
    <button  class="btn btn-primary">Next</button>
</form>
