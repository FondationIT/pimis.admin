<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Services\NotificationService;
use App\Models\Notification;
use App\Models\PvCommissionersConcents;
use Carbon\Carbon;

class NotificationCenter extends Component
{
    public $u_role;
    protected NotificationService $notificationService;
    public $userInstance = null;
    public $unread = [0];
    public $tabs = [];
    public bool $dropdownOpen = false;
    public $tabsFullTitle = [
        // 'GENERAL' => 'Notifications Générales',
        'EB' => 'Etats de Besoin',
        'DA' => 'Demandes d\'Achat',
        'PV' => 'Procès-Verbaux',
        'PV-ATTR' => 'Procès-Verbaux d\'Attribution',
        'BC' => 'Bons de Commande',
        'BR' => 'Bons de Réception',
        'DI' => 'Demandes d\'Interne',
        'CMA' => 'Commissions d\'Analyse',
    ];
    public $tableToEmit = [
        // 'GENERAL' => 'generalNotifications',
        'EB' => 'ebUpdated',
        'DA' => 'demAchUpdated',
        'PV' => 'pvUpdated',
        'PV-ATTR' => 'pvAttrUpdated',
        'BC' => 'bcUpdated',
        'BR' => 'bonReqUpdated',
        'DI' => 'diUpdated',
        'CMA' => 'cmaUpdated',
    ];
    public $sectionToOpen = [
        // 'GENERAL' => 'generalS',
        'EB' => 'etBes',
        'DA' => 'demAchS',
        'PV' => 'pvS',
        'PV-ATTR' => 'pvAttrS',
        'BC' => 'bonComS',
        'BR' => 'bonReqS',
        'DI' => 'diStock',
        'CMA' => 'usCpv',
    ];
    
    public $focusTask = null;


    protected $listeners = [
        'refreshNotifications' => 'loadNotifications',
        'requestUnreadCount',
        'notificationRead' => 'MarkReadNotifications',
    ];

    public function isCommissionNotification($task)
    {
        if (str_starts_with($task, 'CMA-')) {
            $pvInstance = PvCommissionersConcents::where('reference', $task)
            ->leftJoin('pvs', 'pvs.id', '=', 'pv_commissioners_concents.pv')
            ->select('pv_commissioners_concents.*', 'pvs.reference as pv_reference')
            ->first();
            if ($pvInstance->exists()){
                return $pvInstance->pv_reference;
            }
        }
        return null;
    }


    public function boot(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
        $this->loadNotifications();
    }

    public function mount()
    {
        $this->u_role = getUserRole();
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        $userId = Auth::user()->agent;
        $data = $this->notificationService->getUserNotifications($userId);

        $this->unread = $data['unread'];

        // Group unread notifications
        $this->tabs = $this->notificationService->groupByPrefix($this->unread);
    }

    public function MarkReadNotifications($task)
    {
        if (!$task) {
            logger()->error('No task provided for marking notifications as read.');
        }
        $this->notificationService->markRead($task);
    }

    public function requestUnreadCount()
    {
        // return $this->unread->count();
    }


    public function timeAgo($timestamp)
    {
        return Carbon::parse($timestamp)->diffForHumans();
    }


    public function render()
    {
        return view('livewire.notification-center');
    }
}
