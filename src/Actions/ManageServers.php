<?php

namespace SalvaWorld\Envoyer\Actions;

use SalvaWorld\Envoyer\Resources\Server;

trait ManageServers {

    /**
     * Get the collection of servers.
     * 
     * @param  string  $projectId
     *
     * @return \SalvaWorld\Envoyer\Resources\Server[]
     */
    public function servers(string $projectId) {

        return $this->transformCollection(
            $this->get("projects/$projectId/servers")['servers'],
            Server::class,
            ['project_id' => $projectId]
        );
    }

    /**
     * Get a server instance.
     *
     * @param  string  $serverId
     * @param  string  $projectId
     *
     * @return \SalvaWorld\Envoyer\Resources\Server
     */
    public function server(string $serverId, string $projectId) {
        return new Server(
            $this->get("projects/$projectId/servers/$serverId")['server'] + ['project_id' => $projectId], $this
        );
    }

    /**
     * Refresh the server.
     *
     * @param  string  $serverId
     * @param  string  $projectId
     *
     * @return \SalvaWorld\Envoyer\Resources\Server
     */
    public function refreshServer(string $serverId, string $projectId) {
        return new Server($this->post("projects/$projectId/servers/$serverId/refresh"), $this);
    }

    /**
     * Create a new server.
     *
     * @param  string  $projectId
     * @param  array  $data
     *
     * @return \SalvaWorld\Envoyer\Resources\Server
     */
    public function createServer(string $projectId, array $data, bool $wait = true) {
        $server = $this->post("servers/$projectId/sites", $data)['site'];

        if ($wait) {
            return $this->retry($this->getTimeout(), function () use ($projectId, $server) {
                $server = $this->server($projectId, $server['id']);
            });
        }

        return new Server($server + ['project_id' => $projectId], $this);
    }

    /**
     * Update server.
     *
     * @param  string  $serverId
     * @param  string  $projectId
     * @param  array  $data
     *
     * @return \SalvaWorld\Envoyer\Resources\Server
     */
    public function updateServer(string $serverId, string $projectId, array $data) {
        return new Server(
            $this->request('PUT', "projects/$projectId/servers/$serverId", ['json' => $data])['server']
            + ['project_id' => $projectId], $this
        );
    }

    /**
     * Delete server.
     *
     * @param  string  $projectId
     * @param  string  $serverId
     *
     * @return \SalvaWorld\Envoyer\Resources\Server
     */
    public function deleteServer(string $projectId, string $serverId) {
        return new Server($this->delete("projects/$projectId/servers/$serverId"), $this);
    }

}
