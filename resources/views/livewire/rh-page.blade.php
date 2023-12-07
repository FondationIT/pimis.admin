<div >
    <section id="art-section" class="section js-section u-category-media">

        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Resources humaines</a></li>
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
                   <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" wire:click="$emit('agentForm')" data-target="#nAgentModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Ajouter</span></button>
                 </div>
               </div>
           <!-- /Title -->

           <!-- Main content -->
           <!-- Row -->
                <livewire:rh.agents-table
                model="App\Models\Agent"
                searchable="firstname, email, matricule"
                exportable
                />


           </div>
       </section>







       <section id="contratA-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Resources humaines</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contrats agents</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->
           <!-- Content Wrapper. Contains page content -->
            <div class="container">
               <!-- Title -->
                   <div class="hk-pg-header align-items-top">
                     <div>
                       <h3 class="hk-pg-title font-weight-600 mb-10">Contrats agents</h3>
                     </div>

                     <div class="d-flex">
                       <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" wire:click="$emit('contratAForm')" data-target="#contratAModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Ajouter</span></button>
                     </div>
                   </div>
               <!-- /Title -->

               <!-- Main content -->
               <!-- Row -->
               <livewire:rh.contrat-table
                model="App\Models\Contrat"
                searchable="agent"
                exportable
                />
               <!-- /Row -->

           </div>
       </section>









       <section id="aff-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Resources humaines</a></li>
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
                       <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" wire:click="$emit('affectationForm')" data-target="#nAffectationModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Ajouter</span></button>
                     </div>
                   </div>
               <!-- /Title -->

               <!-- Main content -->
               <!-- Row -->
               <livewire:rh.affectations-table
                model="App\Models\Affectation"
                searchable="agent, projet, lieu"
                exportable
                />
               <!-- /Row -->

           </div>
       </section>



       <section id="compteA-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Resources humaines</a></li>
                <li class="breadcrumb-item active" aria-current="page">Compte Agents</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->
           <!-- Content Wrapper. Contains page content -->
            <div class="container">
               <!-- Title -->
                   <div class="hk-pg-header align-items-top">
                     <div>
                       <h3 class="hk-pg-title font-weight-600 mb-10">Compte des agents</h3>
                     </div>

                     <div class="d-flex">
                       <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" wire:click="$emit('compteForm')" data-target="#compteModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Ajouter</span></button>
                     </div>
                   </div>
               <!-- /Title -->

               <!-- Main content -->
               <!-- Row -->
                <livewire:finance.compte-table />
                <!-- /Row -->

           </div>
       </section>



       <section id="paieA-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Resources humaines</a></li>
                <li class="breadcrumb-item active" aria-current="page">Paiement Agents</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->
           <!-- Content Wrapper. Contains page content -->
            <div class="container">
               <!-- Title -->
                   <div class="hk-pg-header align-items-top">
                     <div>
                       <h3 class="hk-pg-title font-weight-600 mb-10">Paiement</h3>
                     </div>

                     <div class="d-flex">
                       <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" wire:click="$emit('paieAForm')" data-target="#paieAModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Ajouter</span></button>
                     </div>
                   </div>
               <!-- /Title -->

               <!-- Main content -->
               <!-- Row -->
                <livewire:rh.paiement-table
                searchable="reference"
                exportable
                />
                <!-- /Row -->

           </div>
       </section>



       <section id="mvmtR-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Resources humaines</a></li>
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
                     </div>
                   </div>
               <!-- /Title -->

               <!-- Main content -->
               <!-- Row -->

                <livewire:agent.mvmt-table
            searchable="reference"
            exportable
            />

               <!-- /Row -->

           </div>
       </section>




       <section id="missR-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Resources humaines</a></li>
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
                searchable="reference"
                exportable
                />
               <!-- /Row -->

           </div>
       </section>


       <section id="congeR-section" class="section js-section u-category-media">
        <!-- Breadcrumb -->
        <nav class="hk-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light bg-transparent">
                <li class="breadcrumb-item"><a href="#">Resources humaines</a></li>
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
                     </div>
                   </div>
               <!-- /Title -->

               <!-- Main content -->
               <!-- Row -->

                <livewire:agent.conge-table
            searchable="reference"
            exportable
            />

               <!-- /Row -->

           </div>
       </section>
















 

</div>

