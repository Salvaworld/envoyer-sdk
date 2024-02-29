<?php

namespace SalvaWorld\Envoyer\Actions;

use SalvaWorld\Envoyer\Resources\Environment;
use SalvaWorld\Envoyer\Resources\Server;

trait ManageEnvironments {

    /**
     * Get environment by project id
     *
     * @param  string  $projectId
     * @param  string  $key
     *
     * @return \SalvaWorld\Envoyer\Resources\Environment
     */
    public function environment(string $projectId, string $key) {
        return $this->get("projects/$projectId/environment?key=$key")['environment'];
    }

    /**
     * Get Environment Servers
     *
     * @param  string  $projectId
     *
     * @return \SalvaWorld\Envoyer\Resources\Server[]
     */
    public function environmentServers(string $projectId) {
        return $this->transformCollection(
            $this->get("projects/$projectId/environment/servers")['servers'],
            Server::class,
            ['project_id' => $projectId]
        );
    }

    /**
     * Update environment.
     *
     * @param  string  $projectId
     * @param  array  $data
     *
     * @return void
     */
    public function updateEnvironment(string $projectId, array $data) {
        $this->put("projects/$projectId/environment", $data);
    }

    /**
     * Delete environment.
     *
     * @param  string $projectId
     * @param  array $data
     *
     * @return void
     */
    public function resetEnvironment(string $projectId, array $data) {
        $this->delete("projects/$projectId/environment", $data);
    }

}
