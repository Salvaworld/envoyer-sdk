<?php

namespace SalvaWorld\Envoyer\Resources;

class HeartBeat extends Resource {

    /**
     * The id of the heartbeat.
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
     * Create the heartbeat.
     *
     * @param  array  $data
     * @return void
     */
    public function create(array $data) {
        $this->envoyer->createHeartBeat($this->projectId, $data);
    }

    /**
     * Cancel deployment.
     *
     * @return void
     */
    public function delete() {
        $this->envoyer->deleteHeartBeat($this->projectId, $this->id);
    }

}
