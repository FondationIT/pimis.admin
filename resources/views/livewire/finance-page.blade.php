<div>
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
           
            <livewire:finance.bon-req
            searchable="reference,projet"
            dates="created_at|d-m-Y"
            exportable
            />
            <!-- /Row -->

        </div>
    </section>
</div>
