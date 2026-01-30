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

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#ag_interne">Interne</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#ag_externe">Externe</a>
                        </li>
                    </ul>
                    @if (Auth::user()->role == 'ADMIN' || Auth::user()->role == 'R.H' || Auth::user()->role == 'Sup')
                        <div class="d-flex">
                            <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" wire:click="$emit('agentForm')" data-target="#nAgentModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Ajouter</span></button>
                        </div>
                    @endif
               </div>
           <!-- /Title -->

           <!-- Main content -->
           <!-- Row -->

               <!-- Tab panes -->
                <div class="tab-content">
                    <div id="ag_interne" class="container tab-pane active"><br>
                        <h5>Agents de la Fondation</h5>
                        <livewire:rh.agents-table exportable />
                    </div>
                    <div id="ag_externe" class="container tab-pane fade"><br>
                        <h5>Agents Partenaires</h5>
                        <livewire:rh.agent-externe exportable />
                    </div>
                </div>


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

                     @if (Auth::user()->role == 'R.H' || Auth::user()->role == 'Sup')
                      <div class="d-flex">
                        <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" wire:click="$emit('contratAForm')" data-target="#contratAModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Ajouter</span></button>
                      </div>
                      @endif
                   </div>
               <!-- /Title -->

               <!-- Main content -->
               <!-- Row -->
               <livewire:rh.contrat-table
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

                     @if (Auth::user()->role == 'R.H' || Auth::user()->role == 'Sup')
                      <div class="d-flex">
                        <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" wire:click="$emit('compteForm')" data-target="#compteModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Ajouter</span></button>
                      </div>
                      @endif
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

                     @if (Auth::user()->role == 'R.H' || Auth::user()->role == 'Sup')
                      <div class="d-flex">
                        <button class="btn btn-sm btn-outline-light btn-wth-icon icon-wthot-bg mr-15 mb-15" data-toggle="modal" wire:click="$emit('paieAForm')" data-target="#paieAModalForms"><span class="icon-label"><i class="fa fa-plus"></i> </span><span class="btn-text">Ajouter</span></button>
                      </div>
                      @endif
                   </div>
               <!-- /Title -->

               <!-- Main content -->
               <!-- Row -->
                <livewire:rh.paiement-table
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
            </div>
        <!-- /Title -->


        <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#homeM">Liste</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1M">Rapport</a>
                </li>
            </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div id="homeM" class="container tab-pane active"><br>
              <h5>Liste</h5>
              <livewire:rh.om-table dates="created_at|d-m-Y" exportable/>
            </div>
            <div id="menu1M" class="container tab-pane fade"><br>
              <h5>Rapport</h5>
              <livewire:rh.rap-mission dates="created_at|d-m-Y" exportable/>
            </div>

          </div>





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
            </div>
        <!-- /Title -->


        <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#homeC">Liste</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1C">Rapport</a>
                </li>
            </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div id="homeC" class="container tab-pane active"><br>
              <h5>Liste</h5>
              <livewire:agent.conge-table dates="created_at|d-m-Y" exportable/>
            </div>
            <div id="menu1C" class="container tab-pane fade"><br>
              <h5>Rapport</h5>
              <livewire:rh.rap-conge dates="created_at|d-m-Y" exportable/>
            </div>

          </div>





    </div>
  </section>


















</div>

