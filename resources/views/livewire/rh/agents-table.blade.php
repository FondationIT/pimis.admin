<div>
    <div class="row">
        <div class="col-sm">
            <div class="table-wrap">
                <div class="table-responsive">
                    <table id="agentTab" class="table table-hover w-100 pb-30">
                        <thead>
                            <tr>
                                <th>Nom complet</th>
                                <th>Matricule</th>
                                <th>Telephone</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agents as $agent)


                                <tr>
                                    <td>{{$agent->firstname.' '.$agent->lastname.' '.$agent->middlename}}</td>
                                    <td>{{$agent->matricule}}</td>
                                    <td>{{$agent->phone}}</td>
                                    <td>{{$agent->email}}</td>
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
        </div>
    </div>
</div>
