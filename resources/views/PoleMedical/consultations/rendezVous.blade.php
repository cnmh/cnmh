@extends('layouts.app')

@section('content')
<section class="content-header">


    <div class="container-fluid">

    </div>
</section>


<section class="content">
    <div class="container-fluid ">
        @include('flash::message')

        <div class="clearfix"></div>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Consultation {{ \App\Models\Consultation::OrientationType() }}</h1>
                    </div>

                </div>
            </div>
        </section>


        <div class="row">

            <div class="col-md-12">
                <div class="card card-default">

                    <div class="steps">
                        <div class="md-stepper-horizontal orange">
                            <div class="md-step active done">
                                <div class="md-step-circle"><span>1</span></div>
                                <div class="md-step-title">Rendez-Vous</div>
                                <div class="md-step-bar-left"></div>
                                <div class="md-step-bar-right"></div>
                            </div>
                            <div class="md-step  done">
                                <div class="md-step-circle"><span>2</span></div>
                                <div class="md-step-title">Patient</div>
                                <div class="md-step-bar-left"></div>
                                <div class="md-step-bar-right"></div>
                            </div>
                            <div class="md-step ">
                                <div class="md-step-circle"><span>3</span></div>
                                <div class="md-step-title">Consultation</div>
                                <div class="md-step-bar-left"></div>
                                <div class="md-step-bar-right"></div>
                            </div>

                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-2 mr-2">
                       <form class="form-inline ml-3">
                            <div class="input-group input-group-sm">
                                <input type="search" class="form-control form-control-lg" id="search" placeholder="Recherche">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-lg btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                   
                    <div class="card-body p-0 mt-2">
                        <div class="table-responsive" id="#rendezVous-table">

                            <form action="{{ route('consultations.rendezvous-select', App\Models\Consultation::OrientationType() ) }}" method="get">

                                <table class="table table-striped" id="tuteurs-table">
                                    <thead>
                                        <tr>

                                            <th></th>
                                            <th>N°Dossier</th>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Téléphone</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="RendezVousTable">

                                        @foreach ($dossier_patients as $dossier_patient)
                                        <tr>
                                            <td>

                                                <input required type="radio"
                                                    value="{{ $dossier_patient->dossier_patient_id }}"
                                                    name="dossier_patient_id"
                                                    aria-label="Radio button for following text input">
                                            </td>
                                            <input type="hidden" name="consultation_id"
                                                value="{{$dossier_patient->consultation_id}} ">
                                            <td>{{ $dossier_patient->numero_dossier }}</td>
                                            <td>{{ $dossier_patient->nom }}</td>
                                            <td>{{ $dossier_patient->prenom }}</td>
                                            <td>{{ $dossier_patient->telephone }}</td>
                                            <td>
                                                <div class='btn-group'>
                                                    @can('destroy-RendezVous')
                                                
                                                    <button type="button" class="btn btn-danger" onclick="confirmAndSubmit('{{ route('rendez-vous.destroy', $dossier_patient->consultation_id) }}')">Reporter</button>

                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>


                        </div>
                        <div class="ml-4 mb-3">
                            <a href="{{ url()->previous() }}"
                                class="btn btn-primary">@lang('crud.previous')</a>
                            {{-- <div name="rendezVous" value="false" class="btn btn-primary">Ajouter sans RendezVous</div> --}}
                            <button class="btn btn-primary">@lang('crud.next')</button>
                        </div>
                        </form>
                        <div class="card-footer clearfix">
                            <div class="float-left">
                                @include('adminlte-templates::common.paginate', [
                                'records' => $dossier_patients,
                                ])
                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->

            </div>
        </div>
        <!-- /.card -->



    </div>
</section>

<script>
    function confirmAndSubmit(route) {
        if (confirm('Are you sure?')) {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = route;
            form.style.display = 'none';

            var csrfTokenField = document.createElement('input');
            csrfTokenField.type = 'hidden';
            csrfTokenField.name = '_token';
            csrfTokenField.value = '{{ csrf_token() }}';
            form.appendChild(csrfTokenField);

            var methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            form.appendChild(methodField);
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>

<script>
$(document).ready(function() {
    console.log('hello');

        function fetch_data(page, search) {
            var type = "<?php echo App\Models\Consultation::OrientationType(); ?>";

            $.ajax({
                url: "/Pôle-medical/" + type + "/Consultations/Rendez-Vous?page=" + page + "&query=" + search.trim(),
                dataType: 'json', 
                success: function(response) {
                    $('#RendezVousTable').html('');
                    var data = response.data;

                    var dossier_patient_id = {{ $dossier_patient->dossier_patient_id ?? null }};

                    for (var i = 0; i < data.length; i++) {
                        var row = '<tr>';
                        var rowData = data[i];

                        console.log(rowData);
                        row += '<td><input type="radio" name="dossier_patient_id" value="' + rowData.dossier_patient_id + '" ' + (rowData.dossier_patient_id == dossier_patient_id ? 'checked' : '') + '></td>';
                        row += '<input type="hidden" name="consultation_id" value="' + rowData.consultation_id + '" ' + (rowData.dossier_patient_id == dossier_patient_id ? 'checked' : '') + '>';
                        row += '<td>' + rowData.numero_dossier + '</td>';
                        row += '<td>' + rowData.nom + '</td>';
                        row += '<td>' + rowData.prenom + '</td>';
                        row += '<td>' + rowData.telephone + '</td>';
                        row += '<td style="width: 120px">';
                        row += '<div class="btn-group">';
                        row += '<button type="button" class="btn btn-danger" onclick="confirmAndSubmit(\'/rendez-vous/destroy/' + rowData.consultation_id + '\')">Reporter</button>';
                        row += '</div>';
                        row += '</td>';
                        row += '</tr>';


                        $('#RendezVousTable').append(row);
                    }


                }


            });



        }

        $('body').on('click', '.pagination li', function(event) {
            event.preventDefault();
            var pageButton = $(this).find('.page-link');
            if (pageButton.length) {
                var page = pageButton.attr('page-number');
                var search = $('#search').val();
                fetch_data(page, search);
            }
        });

        $('body').on('keyup', '#search', function() {
            var search = $('#search').val();
            var page = 1;
            fetch_data(page, search);
        });

       fetch_data(1, '');
    });
</script>
@endsection