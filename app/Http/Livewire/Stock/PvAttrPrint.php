<?php

namespace App\Http\Livewire\Stock;

use App\Models\PvAttrCommissionersConcents;
use App\Models\ProductOder;
use App\Models\Et_bes;
use App\Models\DemAch;
use App\Models\Price;
use App\Models\Bc;
use App\Models\Proforma;
use App\Models\Pv;
use App\Models\PvAttr;
use App\Models\signaturePv;
use App\Models\SignaturePVAttr;
use Livewire\Component;

class PvAttrPrint extends Component
{
    public $modelId;
    public $product;
    public $da;
    public $some;
    public $proforma;
    public $agent;
    public $pvs;
    public $pv;
    public $i = 1;
    public $commission_members;
    public $commission_members_validation=[
        'niv_1'=>false,
        'niv_2'=>false,
        'niv_3'=>false,
    ];
    protected $listeners = [
        'printPvAttr'
    ];

    public function pvAttrValidation($pvAttrId){
        
        $commission_members = getAdministratorUsers(true);

        foreach($commission_members as $member){
            $role = $member->role;
            $is_approved = PvAttrCommissionersConcents::where('pv_attr', $pvAttrId)->where('agent', $member->agent)->whereIn('is_approved', ['approved','rejected'])->value('is_approved');
            $is_signed = is_null($is_approved) ? 'En attente' : ($is_approved == 'approved' ? true : false);
            if($role == 'D.O'){
                $this->commission_members_validation['niv_1'] = $is_signed;
            }elseif($role == 'D.A.F'){
                $this->commission_members_validation['niv_2'] = $is_signed;
            }elseif($role == 'D.P'){
                $this->commission_members_validation['niv_3'] = $is_signed;
            }

            // match ($role) {
            //     'D.O'   => $this->commission_members_validation['niv_1'] = $is_signed,
            //     'D.A.F' => $this->commission_members_validation['niv_2'] = $is_signed,
            //     'D.P'   => $this->commission_members_validation['niv_3'] = $is_signed,
            // };
        }
    }

    public function mount()
    {
        $this->commission_members = getAdministratorUsers(true)
        ->map(function ($member) {

            // Append niv as a dynamic attribute on the model
            match ($member->role) {
                'D.O'   => $member->niv = 1,
                'D.A.F' => $member->niv = 2,
                'D.P'   => $member->niv = 3,
                default => $member->niv = 99,
            };

            return $member;
        })
        ->sortBy('niv')
        ->values();
    }

    public function printPvAttr($modelId){
        $this->modelId = $modelId;

        // initialize validation status
        $this->pvAttrValidation($this->modelId);

        $this->pvs = PvAttr::where("id", $this->modelId)->first();
        //$this->products = ProductOder::where("etatBes", $this->das[0]->eb)->orderBy("id", "DESC")->first();

        $this->pv = Pv::where("da", $this->pvs->da)->first();

        $this->da =DemAch::where("id", $this->pvs->da)->first();

        $this->proforma = Proforma::where("da", $this->pvs->da)->get();

        $this->product = ProductOder::where("etatBes", $this->da->eb)->get();

        $this->agent = SignaturePVAttr::where("pv", $modelId)->get();

    }
    public function render()
    {
        return view('livewire.stock.pv-attr-print');
    }
}
