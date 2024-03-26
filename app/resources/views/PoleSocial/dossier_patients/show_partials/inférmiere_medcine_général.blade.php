<div class="tab-pane fade" id="custom-tabs-five-normal7" role="tabpanel" aria-labelledby="custom-tabs-five-normal-tab">
    <table class="table table-striped projects">
        <thead>
            <th>Numero d'ordre</th>
            <th>Médecin responsable</th>
            <th>Date de consultation</th>
            <th></th>
        </thead>
        <tbody>
            @foreach($médecin as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>Médecin générale</td>
                <td>{{$item->date_consultation}}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('consultations.consulter', ['type' => App\Models\Consultation::OrientationType(),'consultationID' => $item->id]) }}"">
                        <i class="fas fa-folder">
                        </i>
                        Détail
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>