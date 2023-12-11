<div class="tab-pane fade" id="custom-tabs-two-settings" role="tabpanel" aria-labelledby="custom-tabs-two-settings-tab">
    <table class="table table-striped projects">
        <tbody>
            <tr>
                <td>
                    Responsable d'entretien:
                </td>
                <td>
                    Service social
                </td>
            </tr>
            <tr>
                <td>
                    Date et heur d'entretien:
                </td>
                <td>
                    {{$dossierPatient->created_at}}
                </td>
            </tr>
            <tr>
                <td>
                    Couverture médicale:
                </td>
                <td>
                    {{$couvertureMedical->nom}}
                </td>
            </tr>
            <tr>
                <td>
                    Situation familial:
                </td>
                <td>
                    {{$situationFamilial->nom}}
                </td>
            </tr>
            <tr>
                <td>
                    Types d'handicapes:
                </td>
                <td>
                    <ul>
                        @foreach($type_handicap_patient as $item)
                        <li>{{$item->nom}}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            <tr>
                <td>
                    Niveau scolaire:
                </td>
                <td>
                    {{$NiveauScolairePatient->nom}}
                </td>
            </tr>
            <tr>
                <td>
                    Services demandés:
                </td>
                <td>
                    <ol>
                       
                    </ol>
                </td>
            </tr>
            <tr>
                <td>
                    Remarques:
                </td>
                <td>
                   
                </td>
            </tr>
        </tbody>
    </table>
</div>