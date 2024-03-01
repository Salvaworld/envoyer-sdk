<?php

namespace SalvaWorld\Envoyer\Resources;

class Deployment extends Resource {

    /**
     * The id of the deployment.
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
     * Update the hook.
     *
     * @param  array  $data
     * @return void
     */
    public function deploy(array $data) {
        $this->envoyer->deploy($this->projectId, $data);
    }

    /**
     * Cancel deployment.
     *
     * @return void
     */
    public function delete() {
        $this->envoyer->cancelDeployment($this->projectId, $this->id);
    }

}
