<?php

namespace SalvaWorld\Envoyer\Resources;

class Environment extends Resource {

    /**
     * The id of the project.
     *
     * @var int
     */
    public $projectId;

    /**
     * Update the server.
     *
     * @param  array  $data
     * @return void
     */
    public function update(array $data) {
        return $this->envoyer->updateEnvironment($this->projectId, $data);
    }

    /**
     * Reset server.
     *
     * @return void
     */
    public function reset(array $data) {
        return $this->envoyer->resetEnvironment($this->projectId, $data);
    }

}
