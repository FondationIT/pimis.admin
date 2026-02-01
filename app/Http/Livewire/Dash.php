<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Hash;

use App\Models\Agent;
use App\Models\PasswordUpdate;
use App\Models\Projet;
use App\Models\Affectation;
use App\Models\AgentCardDailyScan;
use App\Models\AgentCardDetail;
use Livewire\Component;


class Dash extends Component
{
    public $selectedProjet = null;
    public $unreadCount = 0;
    public $myprojetsCount = 0;
    public $myprojets = [];
    public $is_not_adminUser = false;
    public $openProject = null;
    public $isNewUser = false;
    public $hasPasswordExpired = false;
    public $needsCardVerification = true;
    public $lockBodyScroll = false;
    

    protected $listeners = [
        'dashUpdated' => '$refresh',
        'unreadCountResponse'
    ];

    public function toggleProject($project){
        $this->openProject = $this->openProject === $project ? null : $project;
    }

    

    public function mount()
    {
        $has_card_been_scanned_today = null;
        $agentInstance = Agent::where('id',auth()->user()->agent)->first();
        $agentCodeInstance = AgentCardDetail::where('qr',$agentInstance->matricule)->first();
        if($agentCodeInstance){
            $has_card_been_scanned_today = AgentCardDailyScan::where('card',$agentCodeInstance->id)->whereDate('created_at', now())->first();
            logger('Card Ver:',[$has_card_been_scanned_today,now()]);
            if($has_card_been_scanned_today){
                $this->needsCardVerification = false;
            }
        }
        $this->hasPasswordExpired = PasswordUpdate::where('user', auth()->id())
            ->where('is_active', false)->exists();
        $this->isNewUser = Hash::check('password', auth()->user()->password);
        
        $this->is_not_adminUser = in_array(trim(strtolower(auth()->user()->role)), ['pers','compt2','mag','log2']);
        $affectationInstance = $this->is_not_adminUser ? Affectation::where('agent', auth()->user()->agent) : Affectation::query();
        
        $affectationInstance->get()
        ->each(function ($affectation) {

            $project = Projet::find($affectation->projet);
            if (!$project) {
                return;
            }

            $is_active_project = $project->active ?? false;

            // Find project index in myprojets
            $index = collect($this->myprojets)
                ->search(fn ($item) => trim(strtolower($item['project'])) === trim(strtolower($project->name)));

            // Example post (replace with your real post logic)
            $post = [
                'id' => $affectation->id,
                'title' => $affectation->poste ?? 'Poste sans titre',
                'location' => $affectation->lieu ?? 'Lieu non spécifié',
            ];

            if ($index === false) {
                // Project does NOT exist → add project + first post
                $this->myprojets[] = [
                    'project' => $project->name,
                    'posts' => [$post],
                    'is_active' => $is_active_project,
                ];

                $this->myprojetsCount++;
            } else {
                // Project exists → push post only
                $this->myprojets[$index]['posts'][] = $post;
            }
        });

        $this->myprojets = collect($this->myprojets)
        ->sortBy(fn ($item) => strtolower(trim($item['project'])))
        ->values()
        ->toArray();

    }

    public function getUnread()
    {
        $this->emit('requestUnreadCount');
    }

    public function unreadCountResponse($count)
    {
        $this->unreadCount = $count;
    }

    public function render()
    {
        return view('livewire.dash');
    }
}
