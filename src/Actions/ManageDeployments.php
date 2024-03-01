<?php

namespace SalvaWorld\Envoyer\Actions;

use SalvaWorld\Envoyer\Resources\Deployment;

trait ManageDeployments {

    /**
     * Get the collection of deployments.
     *
     * @param  string  $projectId
     *
     * @return \SalvaWorld\Envoyer\Resources\Deployment[]
     */
    public function deployments(string $projectId) {

        return $this->transformCollection(
            $this->get("projects/$projectId/deployments")['deployments'],
            Deployment::class,
            ['project_id' => $projectId]
        );
    }

    /**
     * Get a deployment instance.
     *
     * @param  string  $projectId
     * @param  string  $deploymentId
     *
     * @return \SalvaWorld\Envoyer\Resources\Deployment
     */
    public function deployment(string $projectId, string $deploymentId) {
        return new Deployment(
            $this->get("projects/$projectId/deployments/$deploymentId")['deployment'] + ['project_id' => $projectId], $this
        );
    }

    /**
     * Deploy project.
     *
     * @param  string  $projectId
     * @param  array  $data
     *
     * @return void
     */
    public function deploy(string $projectId, array $data) {
        $this->post("projects/$projectId/deployments", $data);
    }

    /**
     * Cancel deployment.
     *
     * @param  string  $projectId
     * @param  string  $deploymentId
     *
     * @return void
     */
    public function cancelDeployment(string $projectId, string $deploymentId) {
        $this->delete("projects/$projectId/deployments/$deploymentId");
    }

}
