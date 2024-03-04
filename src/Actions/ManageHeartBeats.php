<?php

namespace SalvaWorld\Envoyer\Actions;

use SalvaWorld\Envoyer\Resources\HeartBeat;

trait ManageHeartBeats {

    /**
     * Get the collection of heartbeats.
     *
     * @param  string  $projectId
     *
     * @return \SalvaWorld\Envoyer\Resources\HeartBeat[]
     */
    public function heartBeats(string $projectId) {

        return $this->transformCollection(
            $this->get("projects/$projectId/heartbeats")['heartbeats'],
            HeartBeat::class,
            ['project_id' => $projectId]
        );
    }

    /**
     * Get a heartbeat instance.
     *
     * @param  string  $projectId
     * @param  string  $heartbeatId
     *
     * @return \SalvaWorld\Envoyer\Resources\HeartBeat
     */
    public function heartBeat(string $projectId, string $heartbeatId) {
        return new HeartBeat(
            $this->get("projects/$projectId/heartbeats/$heartbeatId")['heartbeat'] + ['project_id' => $projectId], $this
        );
    }

    /**
     * Create heartbeat
     *
     * @param  string  $projectId
     * @param  array  $data
     *
     * @return \SalvaWorld\Envoyer\Resources\HeartBeat
     */
    public function createHeartBeat(string $projectId, array $data) {
        return new HeartBeat($this->post("projects/$projectId/heartbeats", $data)['heartbeat'] + ['project_id' => $projectId], $this);
    }

    /**
     * Delete heartbeat.
     *
     * @param  string  $projectId
     * @param  string  $heartbeatId
     *
     * @return void
     */
    public function deleteHeartBeat(string $projectId, string $heartbeatId) {
        $this->delete("projects/$projectId/heartbeats/$heartbeatId");
    }

}
