<?php

namespace SalvaWorld\Envoyer\Actions;

use SalvaWorld\Envoyer\Resources\Notification;

trait ManageNotifications {

    /**
     * Get the collection of notifications.
     *
     * @param  string  $projectId
     *
     * @return \SalvaWorld\Envoyer\Resources\Notification[]
     */
    public function notifications(string $projectId) {

        return $this->transformCollection(
            $this->get("projects/$projectId/notifications")['notifications'],
            Notification::class,
            ['project_id' => $projectId]
        );
    }

    /**
     * Get a notification instance.
     *
     * @param  string  $projectId
     * @param  string  $notificationId
     *
     * @return \SalvaWorld\Envoyer\Resources\Notification
     */
    public function notification(string $projectId, string $notificationId) {
        return new Notification(
            $this->get("projects/$projectId/notifications/$notificationId")['notification'] + ['project_id' => $projectId], $this
        );
    }

    /**
     * Create notification
     *
     * @param  string  $projectId
     * @param  array  $data
     *
     * @return \SalvaWorld\Envoyer\Resources\Notification
     */
    public function createNotification(string $projectId, array $data) {
        return new Notification($this->post("projects/$projectId/notifications", $data)['notifications'] + ['project_id' => $projectId], $this);
    }

    /**
     * Update notification.
     *
     * @param  string  $projectId
     * @param  string  $notificationId
     * @param  array  $data
     *
     * @return \SalvaWorld\Envoyer\Resources\Notification
     */
    public function updateNotification(string $projectId, string $notificationId, array $data) {
        return new Notification(
            $this->request('PUT', "projects/$projectId/notifications/$notificationId", ['json' => $data])['notification']
             + ['project_id' => $projectId], $this
        );
    }

    /**
     * Delete notification.
     *
     * @param  string  $projectId
     * @param  string  $email
     *
     * @return void
     */
    public function deleteNotification(string $projectId, string $email) {
        $this->delete("projects/$projectId/notifications", ['email' => $email]);
    }

}
