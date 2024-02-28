<?php

namespace SalvaWorld\Envoyer\Resources;

class Server extends Resource {

    /**
     * The id of the server.
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
     * Update the server.
     *
     * @param  array  $data
     * @return \SalvaWorld\Envoyer\Resources\Server
     */
    public function update(array $data) {
        return $this->envoyer->updateServer($this->id, $this->projectId, $data);
    }

    /**
     * Refresh the server.
     *
     * @return \SalvaWorld\Envoyer\Resources\Server
     */
    public function refresh() {
        return $this->envoyer->refreshServer($this->id, $this->projectId);
    }

    /**
     * Delete server.
     *
     * @return \SalvaWorld\Envoyer\Resources\Server
     */
    public function delete() {
        return $this->envoyer->deleteServer($this->id, $this->projectId);
    }

}
