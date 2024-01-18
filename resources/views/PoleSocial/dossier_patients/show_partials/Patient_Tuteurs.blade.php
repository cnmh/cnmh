<div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h4 class="card-title">Patient/Bénéficiaire</h4>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="AfficherDossier.php" data-source-selector="#card-refresh-content" data-load-on-init="false">
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
                        <td>
                            Numero:
                        </td>
                        <td>
                            {{ $dossierPatient->patient_id }}
                        </td>

                    </tr>
                    <tr>
                        <td>
                            Nom:
                        </td>
                        <td>
                            {{ $patient->nom }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Prénom:
                        </td>
                        <td>
                            {{ $patient->prenom }}
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            Date de naissance:
                        </td>
                        <td>
                            {{ $patient->patient_id }}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            Telephone:
                        </td>
                        <td>
                            {{ $patient->telephone }}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            CIN/Numéro d'état civil:
                        </td>
                        <td>
                            {{ $patient->cin }}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            Adresse:
                        </td>
                        <td>
                            {{ $patient->adresse }}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            Date d'enregistrement:
                        </td>
                        <td>
                            {{ $dossierPatient->date_enregsitrement }}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            Remarques:
                        </td>
                        <td>
                            {{ $patient->remarques }}
                        </td>
                    </tr>

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
                <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="AfficherDossier.php" data-source-selector="#card-refresh-content" data-load-on-init="false">
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
                        <td>
                            Nom:
                        </td>
                        <td>
                            {{ $parent->nom }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Prénom:
                        </td>
                        <td>
                            {{ $parent->prenom }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Sexe:
                        </td>
                        <td>
                            {{ $parent->sexe }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Telephone:
                        </td>
                        <td>
                            {{ $parent->telephone }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Email:
                        </td>
                        <td>
                            {{ $parent->email }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            CIN:
                        </td>
                        <td>
                            {{ $parent->cin }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Adresse:
                        </td>
                        <td>
                            {{ $parent->adresse }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Remarques:
                        </td>
                        <td>
                            {{ $parent->remarques }}
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
</div>