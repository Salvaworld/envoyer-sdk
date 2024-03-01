<?php

namespace SalvaWorld\Envoyer\Actions;

use SalvaWorld\Envoyer\Resources\Collaborator;

trait ManageCollaborators {

    /**
     * Get the collection of collaborators.
     *
     * @param  string  $projectId
     *
     * @return \SalvaWorld\Envoyer\Resources\Collaborator[]
     */
    public function collaborators(string $projectId) {

        return $this->transformCollection(
            $this->get("projects/$projectId/collaborators")['collaborators'],
            Collaborator::class,
            ['project_id' => $projectId]
        );
    }

    /**
     * Get a collaborator instance.
     *
     * @param  string  $projectId
     * @param  string  $collaboratorId
     *
     * @return \SalvaWorld\Envoyer\Resources\Collaborator
     */
    public function collaborator(string $projectId, string $collaboratorId) {
        return new Collaborator(
            $this->get("projects/$projectId/collaborators/$collaboratorId")['collaborator'] + ['project_id' => $projectId], $this
        );
    }

    /**
     * Create collaborator
     *
     * @param  string  $projectId
     * @param  array  $data
     *
     * @return \SalvaWorld\Envoyer\Resources\Collaborator
     */
    public function createCollaborator(string $projectId, array $data) {
        return new Collaborator($this->post("projects/$projectId/collaborators", $data)['collaborators'] + ['project_id' => $projectId], $this);
    }

    /**
     * Delete collaborator.
     *
     * @param  string  $projectId
     * @param  string  $email
     *
     * @return void
     */
    public function deleteCollaborator(string $projectId, string $email) {
        $this->delete("projects/$projectId/collaborators", ['email' => $email]);
    }

}
