<?php

namespace SalvaWorld\Envoyer\Resources;

class Notification extends Resource {

    /**
     * The id of the notification.
     *
     * @var int
     */
    public $id;

    /**
     * The id of the project.
     *
     * @var int
     */
    public $projectId;

    /**
     * Update the notification.
     *
     * @param  array  $data
     * @return \SalvaWorld\Envoyer\Resources\Notification
     */
    public function update(array $data) {
        return $this->envoyer->updateNotification($this->projectId, $this->id, $data);
    }

    /**
     * Delete notification.
     *
     * 
     * @return void
     */
    public function delete() {
        $this->envoyer->deleteNotification($this->projectId, $this->id);
    }

}
