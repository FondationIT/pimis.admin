<div >
    <section id="art-section" class="section js-section u-category-media">


        <!-- Content Wrapper. Contains page content -->
         <div class="container">

           <!-- Title -->
               <div class="hk-pg-header align-items-top">
                 <div>
                   <h3 class="hk-pg-title font-weight-600 mb-10">Agents</h3>
                 </div>
                 <div class="d-flex">
                   <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" data-target="#nAgentModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Nouveau </span></button>
                 </div>
               </div>
           <!-- /Title -->

           <!-- Main content -->
           <!-- Row -->
                <livewire:agent-datatables
                model="App\Models\Agent"
                searchable="firstname, email, matricule"
                exportable
                />


           </div>
       </section>


       <section id="aff-section" class="section js-section u-category-media">
           <!-- Content Wrapper. Contains page content -->
            <div class="container">
               <!-- Title -->
                   <div class="hk-pg-header align-items-top">
                     <div>
                       <h3 class="hk-pg-title font-weight-600 mb-10">Affectations agents</h3>
                     </div>

                     <div class="d-flex">
                       <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" data-target="#nAffectationModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Nouveau </span></button>
                     </div>
                   </div>
               <!-- /Title -->

               <!-- Main content -->
               <!-- Row -->
               <div class="row">
                   <div class="col-sm">

                   </div>
               </div>
               <!-- /Row -->

           </div>
       </section>



       <section id="mvmt-section" class="section js-section u-category-media">
           <!-- Content Wrapper. Contains page content -->
            <div class="container">
               <!-- Title -->
                   <div class="hk-pg-header align-items-top">
                     <div>
                       <h3 class="hk-pg-title font-weight-600 mb-10">Mouvements agents</h3>
                     </div>

                     <div class="d-flex">
                       <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" data-target="#"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Nouveau </span></button>
                     </div>
                   </div>
               <!-- /Title -->

               <!-- Main content -->
               <!-- Row -->
               <div class="row">

               </div>
               <!-- /Row -->

           </div>
       </section>


       <section id="recrut-section" class="section js-section u-category-media">
           <!-- Content Wrapper. Contains page content -->
            <div class="container">
               <!-- Title -->
                   <div class="hk-pg-header align-items-top">
                     <div>
                       <h3 class="hk-pg-title font-weight-600 mb-10">Recrutements agents</h3>
                     </div>

                     <div class="d-flex">
                       <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" data-target="#"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Nouveau </span></button>
                     </div>
                   </div>
               <!-- /Title -->

               <!-- Main content -->
               <!-- Row -->
               <div class="row">

               </div>
               <!-- /Row -->

           </div>
       </section>
</div>

