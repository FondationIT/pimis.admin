<div class="table-wrap">
    <div class="table-responsive">
        <table id="bailleurTab" class="table table-hover w-100 pb-30">
            <thead>
                <tr>
                    <th>Nom </th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bailleurs as $bailleur)


                    <tr>
                        <td>{{$bailleur->name}}</td>
                        <td>{{$bailleur->email}}</td>
                        <td>{{$bailleur->phone}}</td>
                        <td>{{$bailleur->active}}</td>
                        <td>
                            <a href="#" class="mr-25" data-toggle="tooltip" data-original-title="Detail"> <i class="icon-eye"></i> </a>
                            <a href="#" class="mr-25" data-toggle="tooltip" data-original-title="Edit"> <i class="icon-pencil"></i> </a>
                            <a href="#" data-toggle="tooltip" data-original-title="Delete"> <i class="icon-trash txt-danger"></i> </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
