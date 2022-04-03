<?php

namespace App\Traits;

use App\Models\User;
use App\StatusNames;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Pusher\PushNotifications\PushNotifications;

trait PushNotify
{
    /**
     * @param Model|\Illuminate\Database\Eloquent\Builder|\App\Models\User $user
     * @param array $notification_data
     */
    private function notify($user, array $notification_data)
    {
        $this->_notify($user, $notification_data);
    }

    /**
     * @param Model|\Illuminate\Database\Eloquent\Builder|User $user
     * @param $ios_data
     * @param $android_data
     * @param $notification
     * @return \Exception|mixed|void
     */
    public function _notify($user, $notification)
    {
        try {
            if (app()->runningUnitTests()) {
                return;
            }

            $pushNotifications = new  PushNotifications(array(
                "instanceId" => config('services.pusher.instance_id'),
                "secretKey" => config('services.pusher.app_secret'),
            ));

            $locale = app()->getLocale();
            $content = [
                "fcm" => [
                    "data" => $notification,
                    "notification" => [
                        "title" => Arr::get($notification, "title.$locale"),
                        "body" => Arr::get($notification, "body.$locale"),
                    ],
                ],
                "apns" => [
                    "aps" => [
                        "alert" => [
                            "title" => Arr::get($notification, "title.$locale"),
                            "body" => Arr::get($notification, "body.$locale"),
                        ],
                        "badge" => Arr::get($notification, 'badge', "0"),
                        "sound" => "default"
                    ],
                    "data" => $notification
                ],
            ];
            $publishResponse = $pushNotifications->publishToInterests(
                [
                    'notification_' . $user->id
                ],
                $content
            );

        } catch (Exception $e) {
            logger()->error("Pusher_notifications: Error in sending notification to user_id: " . $user->id . "\n Error message: " . $e);
            return $e;
        }

        logger()->debug("Pusher_notifications: Notification sent to user_id: " . $user->id . " successfully");
        return $publishResponse;
    }
}
