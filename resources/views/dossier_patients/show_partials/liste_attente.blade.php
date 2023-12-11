<div class="tab-pane fade" id="custom-tabs-two-settings3" role="tabpanel" aria-labelledby="custom-tabs-two-settings3-tab">
    <h3>Consultation en attente:
    </h3>
    <br>
    <table class="table table-striped projects">
        <thead>
            <tr>
                <th>Services demandés</th>
                <th>N° dans la list d'attente</th>
                <th>Date d'enregistrement</th>
            </tr>
        </thead>
        <tbody>
           @foreach($listAttent as $item)
           <tr>
            <td></td>
            <td>{{$item->id}}</td>
            <td>{{$item->date_enregistrement}}</td>
           </tr>
           @endforeach
        </tbody>
    </table>
</div>