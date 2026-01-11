<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Services\NotificationService;
use App\Models\Notification;
use Carbon\Carbon;

class NotificationCenter extends Component
{
    public $u_role;
    protected NotificationService $notificationService;
    public $userInstance = null;
    public $unread = [0];
    public $tabs = [];
    public $tabsFullTitle = [
        // 'GENERAL' => 'Notifications Générales',
        'EB' => 'Etats de Besoin',
        'DA' => 'Demandes d\'Achat',
        'PV' => 'Procès-Verbaux',
        'PV-ATTR' => 'Procès-Verbaux d\'Attribution',
        'BC' => 'Bons de Commande',
        'BR' => 'Bons de Réception',
        'DI' => 'Demandes d\'Interne',
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
    ];
    
    public $focusTask = null;


    protected $listeners = [
        'refreshNotifications' => 'loadNotifications',
        'requestUnreadCount'
        // 'brUpdated' => '$refresh',
        // 'dataStatus' => 'filterDataByStatus',
    ];


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

    public function requestUnreadCount()
    {
        $this->emit('unreadCountResponse', $this->unread);
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
