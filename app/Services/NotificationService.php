<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class NotificationService
{
    public $notifRoleColms = [
        'Sup'    => [],
        'ADMIN'  => [],
        'S.E'    => [],
        'D.A.F'  => [],
        'D.P'    => [],
        'C.P'    => [],
        'R.H'    => [],
        'A.I'    => [],
        'COMPT2' => ['is_niv1'],
        'COMPT1' => [],
        'CAISS'  => [],
        'LOG1'   => [],
        'LOG2'   => [],
        'MAG'    => [],
        'CHR'    => [],
        'SECU'   => [],
        'PERS'   => [],
    ];
    public function sendNotification(array $data)
    {
        /**
         * Expected $data array structure:
         * [
         *     'agent' => (int) required,
         *     'msg_id' => (int) required,
         *     'task' => (string) required,
         *     'is_delegated' => (bool) optional,
         *     'delegated_by' => (int|null) optional,
         * ]
         */

        if (!isset($data['agent'], $data['msg_id'], $data['task'])) {
            throw new \InvalidArgumentException("agent, msg_id and task are required.");
        }

        if (!empty($data['is_delegated']) && empty($data['delegated_by'])) {
            throw new \InvalidArgumentException("delegated_by is required when is_delegated = true.");
        }

        return Notification::create([
            'agent'       => $data['agent'],
            'msg_id'       => $data['msg_id'],
            'task'         => $data['task'],
            'is_delegated' => $data['is_delegated'] ?? false,
            'delegated_by' => $data['delegated_by'] ?? null,
        ]);
    }

    public function getUserNotifications($userId)
    {
        try {
            // Base query with join
            $baseQuery = Notification::where('agent', $userId)
                ->leftJoin('default_msgs', 'default_msgs.id', '=', 'notifications.msg_id')
                ->select(
                    'notifications.*',
                    'default_msgs.type',
                    'default_msgs.title',
                    'default_msgs.message'
            );

            $rolCols = $this->notifRoleColms;

            return [

                'all' => (clone $baseQuery)
                    ->orderBy('notifications.id', 'DESC')
                    ->get(),

                'unread' => (clone $baseQuery)
                    ->where('is_read', false)
                    ->orderBy('notifications.id', 'DESC')
                    ->get(),

                'read' => (clone $baseQuery)
                    ->where('is_read', false)
                    ->orderBy('notifications.id', 'DESC')
                    ->get(),

                'system' => (clone $baseQuery)
                    ->where('default_msgs.type', 'system')
                    ->orderBy('notifications.id', 'DESC')
                    ->get(),
            ];
        } catch (\Throwable $e) {
            return [
                'all' => [],
                'unread' => [],
                'read' => [],
                'system' => [],
            ];
        }
    }

    public function groupByPrefix($notifications)
    {
        // 'GENERAL' => [],
        $groups = [
            'EB' => [],
            'DA' => [],
            'PV' => [],
            'PV-ATTR' => [],
            'BC' => [],
            'BR' => [],
            'DI' => [],
        ];

        foreach ($notifications as $notif) {
            foreach ($groups as $prefix => &$list) {
                if (str_starts_with($notif->task, $prefix.'-')) {
                    if($prefix === 'PV' && str_starts_with($notif->task, 'PV-ATTR-')){
                        continue;
                    }
                    $list[] = $notif;
                }
            }
        }

        // Sort groups by number of items DESC
        uasort($groups, function ($a, $b) {
            return count($b) <=> count($a);
        });

        // if (!isset($groups['GENERAL'])) {
        //     $groups['GENERAL'] = [];
        // }

        $groups = array_filter(
            $groups,
            fn ($group, $key) => $key === 'GENERAL' || !empty($group),
            ARRAY_FILTER_USE_BOTH
        );


        return $groups;
    }

    public function markRead($task,$userRole=false)
    {
        try {
            $notificationInstance = Notification::where('task', trim(str($task)))->where('agent', Auth::user()->agent);

            if($notificationInstance->exists()){

                $allDone = true;

                // Mark current agent as read
                // $key = array_search(Auth::user()->agent, $read_user);
                // if ($key !== false) {
                //     $read_user[$key] = $read_user[$key] . '_r';
                // }

                // if (!str_ends_with((string) $value, '_r')) {
                //     $allDone = false;
                //     break;
                // }
                // // foreach ($read_user as $value) {
                // // }

                // Update notification
                $notificationInstance->update([
                    'is_read' => true,
                    'updated_at' => now()
                ]);
            }

            // return true;


            // $niv = $this->notifRoleColms[$userRole][0];
            // logger('Through: '.$niv);

            // 
            // if($niv != 'is_niv4') {
            //     if (is_numeric($id)) {
            //         $query->where('id', $id);
            //     } else {
            //         $query->where('task', trim($id));
            //     }
            //     $query->update([$niv => 1]);
            // }else{
    
            //     $query->where('id', $id)->orWhere('task', trim($id))->update(['is_niv4' => 1, 'is_read' => true]);
            // }
            // return true;

        } catch (\Throwable $e) {
            logger('Error marking notification as read: '.$e->getMessage());
            // return false;
        }
        
        // $this->loadNotifications();

        
    }
}


// [
//     {"id":2,
//     "agent":3679,
//     "msg_id":1,
//     "is_read":0,
//     "is_delegated":0,
//     "delegated_by":null,
//     "created_at":"2025-12-02T10:12:01.000000Z",
//     "updated_at":"2025-12-02T10:12:01.000000Z",
//     "task":"EB-ODR-DI-2024-09-26-FP9653623730",
//     "is_niv4":0,
//     "is_niv3":0,
//     "is_niv2":0,
//     "is_niv1":0,
//     "type":"system",
//     "title":"bonde commande",
//     "message":"le bon de commande numero - a besoin de votre attention"
// }
// ]