<div >
    <section id="artS-section" class="section js-section u-category-media">

        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Service</a></li>
                <li class="breadcrumb-item active" aria-current="page">Agents</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->


        <!-- Content Wrapper. Contains page content -->
         <div class="container">

           <!-- Title -->
               <div class="hk-pg-header align-items-top">
                 <div>
                   <h3 class="hk-pg-title font-weight-600 mb-10">Agents</h3>
                 </div>
                 <div class="d-flex">
                 </div>
               </div>
           <!-- /Title -->

           <!-- Main content -->
           <!-- Row -->
                <livewire:rh.agents-table
                exportable
                />


           </div>
       </section>


       <section id="affS-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Service</a></li>
                <li class="breadcrumb-item active" aria-current="page">Affectations agents</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->
           <!-- Content Wrapper. Contains page content -->
            <div class="container">
               <!-- Title -->
                   <div class="hk-pg-header align-items-top">
                     <div>
                       <h3 class="hk-pg-title font-weight-600 mb-10">Affectations agents</h3>
                     </div>

                     <div class="d-flex">
                     </div>
                   </div>
               <!-- /Title -->

               <!-- Main content -->
               <!-- Row -->
               <livewire:rh.affectations-table
                exportable
                />
               <!-- /Row -->

           </div>
       </section>



       <section id="mvmtS-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Service</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mouvements agents</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->
           <!-- Content Wrapper. Contains page content -->
            <div class="container">
               <!-- Title -->
                   <div class="hk-pg-header align-items-top">
                     <div>
                       <h3 class="hk-pg-title font-weight-600 mb-10">Mouvements agents</h3>
                     </div>

                     <div class="d-flex">
                      <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" wire:click="$emit('mvnt2Form')" data-target="#mvnt2ModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Ajouter</span></button>
                     </div>
                   </div>
               <!-- /Title -->

               <!-- Main content -->
               <!-- Row -->
               <div class="row">

                <livewire:agent.mvmt-table
                exportable
                />

               </div>
               <!-- /Row -->

           </div>
       </section>


       <section id="missS-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Service</a></li>
                <li class="breadcrumb-item active" aria-current="page">Missions</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->
           <!-- Content Wrapper. Contains page content -->
            <div class="container">
               <!-- Title -->
                   <div class="hk-pg-header align-items-top">
                     <div>
                       <h3 class="hk-pg-title font-weight-600 mb-10">Missions agents</h3>
                     </div>

                     <div class="d-flex">
                     </div>
                   </div>
               <!-- /Title -->

               <!-- Main content -->
               <!-- Row -->
               <livewire:rh.om-table
                exportable
                />
               <!-- /Row -->

           </div>
       </section>


       <section id="congeS-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Service</a></li>
                <li class="breadcrumb-item active" aria-current="page">Conges</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->
           <!-- Content Wrapper. Contains page content -->
            <div class="container">
               <!-- Title -->
                   <div class="hk-pg-header align-items-top">
                     <div>
                       <h3 class="hk-pg-title font-weight-600 mb-10">Conges agents</h3>
                     </div>

                     <div class="d-flex">
                        <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" wire:click="$emit('conge2Form')" data-target="#conge2ModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Ajouter</span></button>
                     </div>
                   </div>
               <!-- /Title -->

               <!-- Main content -->
               <!-- Row -->
               <div class="row">

                <livewire:agent.conge-table
                exportable
                />

               </div>
               <!-- /Row -->

           </div>
       </section>


</div>
