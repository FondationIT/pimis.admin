<div>
    <div class="modal fade" id="pvModalForms" tabindex="-1" role="dialog" wire:ignore.self aria-labelledby="exampleModalEditor" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">PV</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form wire:submit.prevent='submit'>
                    <div class="modal-body">
                        <div class="col-sm">
                            <div class="table-wrap">
                                <div class="table-responsive">
                                    <table id="edit_datable_1" class="table  table-bordered table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Cost</th>
                                                <th>Profit</th>
                                                <th>Fun</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Car</td>
                                                <td>100</td>
                                                <td>200</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>Bike</td>
                                                <td>330</td>
                                                <td>240</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>Plane</td>
                                                <td>430</td>
                                                <td>540</td>
                                                <td>3</td>
                                            </tr>
                                            <tr>
                                                <td>Yacht</td>
                                                <td>100</td>
                                                <td>200</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>Segway</td>
                                                <td>330</td>
                                                <td>240</td>
                                                <td>1</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th><strong>TOTAL</strong></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" wire:loading.attr='disabled' id="btnCat" type="submit">Valider</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
