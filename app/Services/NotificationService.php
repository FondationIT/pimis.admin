<?php

namespace App\Services;

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
            'agents'       => $data['agent'],
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
            $baseQuery = Notification::whereJsonContains('agents', $userId)
                ->join('default_msg', 'default_msg.id', '=', 'notifications.msg_id')
                ->select(
                    'notifications.*',
                    'default_msg.type',
                    'default_msg.title',
                    'default_msg.message'
                );
            
            $rolCols = $this->notifRoleColms;

            return [

                'all' => (clone $baseQuery)
                    ->orderBy('notifications.id', 'DESC')
                    ->get(),

                'unread' => (clone $baseQuery)
                    ->where('is_read', false)->where(function ($query) use ($rolCols) {
                        $userRole = auth()->user()->role;
                        $columns = $rolCols[$userRole] ?? [];
                        foreach ($columns as $col) {
                            $query->where($col, false);
                        }
                    })
                    ->orderBy('notifications.id', 'DESC')
                    ->get(),

                'system' => (clone $baseQuery)
                    ->where('default_msg.type', 'system')
                    ->orderBy('notifications.id', 'DESC')
                    ->get(),
            ];
        } catch (\Throwable $e) {
            return [
                'all' => [],
                'unread' => [],
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

    public function markRead($userRole, $id)
    {
        try {
            $niv = $this->notifRoleColms[$userRole][0];
            logger('Through: '.$niv);
            // $query = Notification::query();
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
            return true;
        } catch (\Throwable $e) {
            logger('Error marking notification as read: '.$e->getMessage());
            return false;
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