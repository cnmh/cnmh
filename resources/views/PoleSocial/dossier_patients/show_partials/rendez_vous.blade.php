<div class="tab-pane fade" id="custom-tabs-two-settings2" role="tabpanel" aria-labelledby="custom-tabs-two-settings2-tab">
    <h3> Liste des rendez-vous </h3>
    <br>
    <table class="table table-striped projects">
        <thead>
            <tr>
                <th>
                    Date
                </th>
                <th>
                    Heur
                </th>
                <th>
                    Service
                </th>
                <th>
                    Etat
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            {{-- <tr>
                <td>
                    {{ $R->date_rendez_vous }}
                    {{explode(' ', $R->date_rendez_vous)}}
                    12-1-2022
                </td>
                <td>
                    2:00 PM
                </td>
                <td>
                    Ergothérapie
                </td>
                <td>
                    <span class="badge bg-danger">Absence</span>
                </td>
                <td>
                    <a class="btn btn-primary btn-sm" href="#">
                        <i class="fas fa-folder">
                        </i>
                        Détail
                    </a>
                </td>
            </tr> --}}
            @foreach ($listrendezvous as $item)
                <tr>
                    {{-- <td>{{$item->date_rendez_vous}} --}}
                        <td>
                        {{explode(' ', $item->date_rendez_vous)[0]}}
                        </td>
                    <td>
                        {{explode(' ', $item->date_rendez_vous)[1]}}
                    </td>
                    <td>
                        Service médical
                    </td>
                    <td>{{$item->etatRendezVous}}</td>
                    {{-- <td>
                        <a class="btn btn-primary btn-sm" href="#">
                            <i class="fas fa-folder">
                            </i>
                            Détail
                        </a>
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
</div>