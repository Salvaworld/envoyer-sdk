<?php

namespace SalvaWorld\Envoyer\Resources;

class Collaborator extends Resource {

    /**
     * The id of the project.
     *
     * @var int
     */
    public $projectId;

    /**
     * Create the collaborator.
     *
     * @param  array  $data
     * @return void
     */
    public function create(array $data) {
        $this->envoyer->createCollaborator($this->projectId, $data);
    }

    /**
     * Delete collaborator.
     *
     * @param  string  $email
     * 
     * @return void
     */
    public function delete($email) {
        $this->envoyer->deleteCollaborator($this->projectId, $email);
    }

}
