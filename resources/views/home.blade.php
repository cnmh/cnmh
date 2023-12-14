@extends('layouts.app')

@section('content')
<div class="p-4">
    <div class="card card-dark" style="display: flex; flex-direction: column;">
        <div class="card-header">
            <h3 class="card-title">Statistiques</h3>
        </div>
        <div class="card-body" style="flex: 1;">
            <div id="barChart" style="height: 400px;"></div>
        </div>
        <!-- /.card-body -->
    </div>
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box" style="background:#fd5c63;">
                <div class="inner">
                    <h3>{{$dossierEnAttend}}</h3>
                    <p>Dossiers en attente</p>
                </div>
                <div class="icon">
                    <i class="fas fa-folder-open"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">

            <div class="small-box" style="background:#FFD54F;">
                <div class="inner">
                    <h3>{{$dossierEnRendezVous}}</h3>
                    <p>Dossiers en rendez-vous</p>
                </div>
                <div class="icon">
                    <i class="fas fa-folder-open"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background:#00838f;">
                <div class="inner">
                    <h3>{{$dossierEnConsultation}}</h3>

                    <p>Dossiers en consultation</p>
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
                    <h3>{{$reussirRendezVous}} %</h3>
                    <p class="text-dark">Rendez-vous réaliser</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Google Charts -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {
    'packages': ['corechart']
});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable(<?php echo $data; ?>);

    var options = {
        legend: {
            position: 'top'
        },
        colors: ['#1cb36c', '#FFD54F', '#00838f'],
        isStacked: false,
    };

    var chart = new google.visualization.BarChart(document.getElementById('barChart'));
    chart.draw(data, options);
}
</script>
@endsection