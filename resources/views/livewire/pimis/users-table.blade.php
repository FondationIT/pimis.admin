
<div class="table-wrap">
    <div class="table-responsive">
        <table id="userTab" class="table table-hover w-100 pb-30">
            <thead>
                <tr>
                    <th>Nom complet</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)


                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->role}}</td>
                        <td>{{$user->active}}</td>
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
