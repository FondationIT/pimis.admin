<div class="table-wrap">
    <div class="table-responsive">
        <table id="affectationTab" class="table table-hover w-100 pb-30">
            <thead>
                <tr>
                    <th>Nom agent</th>
                    <th>Projet</th>
                    <th>Poste</th>
                    <th>Lieu d'affectation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($affectations as $aff)


                    <tr>
                        <td>{{App\Models\Agent::firstWhere('id', $aff->agent)->firstname.' '.App\Models\Agent::firstWhere('id', $aff->agent)->lastname}}</td>
                        <td>{{App\Models\Projet::firstWhere('id', $aff->projet)->name}}</td>
                        <td>{{$aff->poste}}</td>
                        <td>{{$aff->lieu}}</td>
                        <td>
                            <a href="#" class="mr-25" data-toggle="tooltip" data-original-title="Edit"> <i class="icon-pencil"></i> </a>
                            <a href="#" data-toggle="tooltip" data-original-title="Delete"> <i class="icon-trash txt-danger"></i> </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
