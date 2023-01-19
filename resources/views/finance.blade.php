<section id="bonReqF-section" class="section js-section u-category-media">
    <!-- Content Wrapper. Contains page content -->
     <div class="container">
        <!-- Title -->
            <div class="hk-pg-header align-items-top">
              <div>
                <h3 class="hk-pg-title font-weight-600 mb-10">Bons de réquisitions</h3>
              </div>

              <div class="d-flex">
                <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" data-target="#nEtBesModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Nouveau </span></button>
              </div>
            </div>
        <!-- /Title -->

        <!-- Main content -->
        <!-- Row -->
        <div class="row">
            <div class="col-sm">
                <div class="table-wrap">
                    <div class="table-responsive">
                        <table id="etBesTab" class="table table-hover w-100 pb-30">
                            <thead>
                                <tr>
                                    <th>Reference</th>
                                    <th>Date</th>
                                    <th>Agent</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($etBesF as $etB)


                                    <tr>
                                        <td>{{$etB->reference}}</td>
                                        <td>{{$etB->created_at}}</td>
                                        <td>{{App\Models\Agent::firstWhere('id', $etB->agent)->firstname.' '.App\Models\Agent::firstWhere('id', $etB->agent)->lastname}}</td>
                                        @if($etB->niv2 == 0)
                                        <td><span class="badge badge-info">En cours</span></td>
                                        @elseif ($etB->niv3 == 1)
                                        <td><span class="badge badge-success">Approuvé</span></td>
                                        @elseif ($etB->niv3 == 2)
                                        <td><span class="badge badge-danger">Refusé</span></td>
                                        @endif

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
        <!-- /Row -->

    </div>
</section>
