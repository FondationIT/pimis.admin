<livewire:pimis-page />


<!-- Modal Presentation -->
  <div class="modal fade" id="presentationModalEditor" tabindex="-1" role="dialog" aria-labelledby="exampleModalEditor" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Presentation</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <form id="form-presentation">
                <div class="modal-body">
                    <div class="tinymce-wrap">
                        <textarea class="tinymce" id="data-presentation" >
                          @isset($pres)
                            {!! $pres[0]->data !!}
                          @endisset
                        </textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
              </form>
          </div>
      </div>
  </div>

  <!-- Modal Historique -->
  <div class="modal fade" id="historiqueModalEditor" tabindex="-1" role="dialog" aria-labelledby="exampleModalEditor" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Historique</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <form id="form-historique">
                <div class="modal-body">
                    <div class="tinymce-wrap">
                        <textarea class="tinymce" id="data-historique" >
                          @isset($his)
                            {!! $his[0]->data !!}
                          @endisset
                        </textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
              </form>
          </div>
      </div>
  </div>


  <!-- Modal Vision -->
  <div class="modal fade" id="visionModalEditor" tabindex="-1" role="dialog" aria-labelledby="exampleModalEditor" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Vision</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <form id="form-vision">
                <div class="modal-body">
                    <div class="tinymce-wrap">
                        <textarea class="tinymce" id="data-vision" >
                          @isset($vis)
                            {!! $vis[0]->data !!}
                          @endisset
                        </textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
              </form>
          </div>
      </div>
  </div>


  <!-- Modal Doctrine -->
  <div class="modal fade" id="doctrineModalEditor" tabindex="-1" role="dialog" aria-labelledby="exampleModalEditor" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Doctrine</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <form id="form-doctrine">
                <div class="modal-body">
                    <div class="tinymce-wrap">
                        <textarea class="tinymce" required ></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
              </form>
          </div>
      </div>
  </div>




