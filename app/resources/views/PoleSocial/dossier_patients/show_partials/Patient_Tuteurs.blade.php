<div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="card-title">Patient/Bénéficiaire</h4>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="card-refresh"
                        data-source="AfficherDossier.php" data-source-selector="#card-refresh-content"
                        data-load-on-init="false">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize">
                        <i class="fas fa-expand"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-striped projects">
                    <tbody>
                        <tr>
                            <td rowspan="3">
                                <img width="99" height="99" src="../assets/dist/img/User-avatar.svg.png">
                            </td>

                        </tr>
                        @if(!empty( $patient->nom ))
                        <tr>
                            <td>
                                Nom:
                            </td>
                            <td>
                                {{ $patient->nom }}
                            </td>
                        </tr>
                        @endif
                        @if(!empty( $patient->prenom ))

                        <tr>
                            <td>
                                Prénom:
                            </td>
                            <td>
                                {{ $patient->prenom }}
                            </td>
                        </tr>
                        @endif

                        @if(!empty( $patient->date_naissance ))

                        <tr>
                            <td></td>
                            <td>
                                Date de naissance:
                            </td>
                            <td>
                                {{ $patient->date_naissance->format('Y-m-d') }}
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                Age:
                            </td>
                            <td>
                                @php
                                    $now = \Carbon\Carbon::now();
                                @endphp

                                {{ $now->diff($patient->date_naissance)->format('%y') }} ans
                            </td>
                        </tr>
                        @endif

                        @if(!empty(  $patient->telephone ))
                        <tr>
                            <td></td>
                            <td>
                                Telephone:
                            </td>
                            <td>
                                {{ $patient->telephone }}
                            </td>
                        </tr>
                        @endif
                        @if(!empty(  $patient->cin ))
                        <tr>
                            <td></td>
                            <td>
                                CIN/Numéro d'état civil:
                            </td>
                            <td>
                                {{ $patient->cin }}
                            </td>
                        </tr>
                        @endif
                        @if(!empty(  $patient->adresse ))
                        <tr>
                            <td></td>
                            <td>
                                Adresse:
                            </td>
                            <td>
                                {{ $patient->adresse }}
                            </td>
                        </tr>
                        @endif
                        @if(!empty( $dossierPatient->date_enregsitrement ))
                        <tr>
                            <td></td>
                            <td>
                                Date d'enregistrement:
                            </td>
                            <td>
                                {{ $dossierPatient->date_enregsitrement->format('Y-m-d') }}
                            </td>
                        </tr>
                        @endif
                        @if(!empty( $patient->remarques ))
                        <tr>
                            <td></td>
                            <td>
                                Remarques:
                            </td>
                            <td>
                                {{ $patient->remarques }}
                            </td>
                        </tr>
                        @endif


                        <!-- entretien social informations -->
                        <tr>
                            <td></td>
                            <td>
                                Responsable d'entretien:
                            </td>
                            <td>
                                Service social
                            </td>
                        </tr>
                        @if(!empty( $dossierPatient->created_at ))
                        <tr>
                            <td></td>
                            <td>
                                Date et heur d'entretien:
                            </td>
                            <td>
                                {{ $dossierPatient->created_at }}
                            </td>
                        </tr>
                        @endif

                        @if(!empty( $couvertureMedical->nom ))
                        <tr>
                            <td></td>
                            <td>
                                Couverture médicale:
                            </td>
                            <td>
                                {{ $couvertureMedical->nom }}
                            </td>
                        </tr>
                        @endif

                        @if(!empty( $situationFamilial->nom ))
                        <tr>
                            <td></td>
                            <td>
                                Situation familial:
                            </td>
                            <td>
                                {{ $situationFamilial->nom }}
                            </td>
                        </tr>
                        @endif
                        @if(!empty($type_handicap_patient))
                        <tr>
                            <td></td>
                            <td>
                                Types d'handicapes:
                            </td>
                            <td>
                            <ul>
                                @foreach ($type_handicap_patient as $item)
                                    <li>{{ $item->nom }}</li>
                                @endforeach
                            </ul>
                            </td>
                        </tr>
                        @endif
                        @if(!empty($NiveauScolairePatient->nom))
                        <tr>
                            <td></td>
                            <td>
                                Niveau scolaire:
                            </td>
                            <td>
                                {{ $NiveauScolairePatient->nom }}
                            </td>
                        </tr>
                        @endif

                        @if(!empty($service_demander_patient))
                        <tr>
                            <td></td>
                            <td>
                                Services demandés:
                            </td>
                            <td>
                                <ol>
                                    @foreach ($service_demander_patient as $item)
                                        <li>{{ $item->nom }}</li>
                                    @endforeach
                                </ol>
                            </td>
                        </tr>
                        @endif
                        @if(!empty($dossierPatient->romarque))
                        <tr>
                            <td></td>
                            <td>
                                Remarques:
                            </td>
                            <td>
                                {!! $dossierPatient->romarque !!}
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <!-- /.col -->
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="card-title">Parent/Tuteur</h4>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="card-refresh"
                        data-source="AfficherDossier.php" data-source-selector="#card-refresh-content"
                        data-load-on-init="false">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize">
                        <i class="fas fa-expand"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-striped projects">
                    <tbody>
                        @if(!empty(  $parent->nom ))
                        <tr>
                            <td>
                                Nom:
                            </td>
                            <td>
                                {{ $parent->nom }}
                            </td>
                        </tr>
                        @endif
                        @if(!empty(  $parent->prenom ))
                        <tr>
                            <td>
                                Prénom:
                            </td>
                            <td>
                                {{ $parent->prenom }}
                            </td>
                        </tr>
                        @endif
                        @if(!empty(  $parent->sexe ))
                        <tr>
                            <td>
                                Sexe:
                            </td>
                            <td>
                                {{ $parent->sexe }}
                            </td>
                        </tr>
                        @endif
                        @if(!empty(  $parent->telephone ))
                        <tr>
                            <td>
                                Telephone:
                            </td>
                            <td>
                                {{ $parent->telephone }}
                            </td>
                        </tr>
                        @endif
                        @if(!empty(  $parent->email ))
                        <tr>
                            <td>
                                Email:
                            </td>
                            <td>
                                {{ $parent->email }}
                            </td>
                        </tr>
                        @endif
                        @if(!empty(  $parent->cin ))
                        <tr>
                            <td>
                                CIN:
                            </td>
                            <td>
                                {{ $parent->cin }}
                            </td>
                        </tr>
                        @endif
                        @if(!empty(  $parent->adresse ))
                        <tr>
                            <td>
                                Adresse:
                            </td>
                            <td>
                                {{ $parent->adresse }}
                            </td>
                        </tr>
                        @endif
                        @if(!empty(  $parent->professionPere ))
                        <tr>
                            <td>
                                Profession de pére:
                            </td>
                            <td>
                                {{ $parent->professionPere }}
                            </td>
                        </tr>
                        @endif
                        @if(!empty(  $parent->professionMere ))
                        <tr>
                            <td>
                                Profession de mére:
                            </td>
                            <td>
                                {{ $parent->professionMere }}
                            </td>
                        </tr>
                        @endif
                        @if(!empty(  $parent->nombreDesEnfants ))
                        <tr>
                            <td>
                                Nombre des enfants:
                            </td>
                            <td>
                                {{ $parent->nombreDesEnfants }}
                            </td>
                        </tr>
                        @endif
                        @if(!empty(  $parent->lienParente ))
                        <tr>
                            <td>
                                Lien de parenté:
                            </td>
                            <td>
                                {{ $parent->lienParente }}
                            </td>
                        </tr>
                        @endif
                        @if(!empty(  $parent->remarques ))
                        <tr>
                            <td>
                                Remarques:
                            </td>
                            <td>
                                {{ $parent->remarques }}
                            </td>
                        </tr>
                        @endif

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
