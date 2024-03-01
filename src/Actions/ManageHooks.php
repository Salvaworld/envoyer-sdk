<?php

namespace SalvaWorld\Envoyer\Actions;

use SalvaWorld\Envoyer\Resources\Hook;

trait ManageHooks {

    /**
     * Get the collection of hooks.
     *
     * @param  string  $projectId
     *
     * @return \SalvaWorld\Envoyer\Resources\Hook[]
     */
    public function hooks(string $projectId) {

        return $this->transformCollection(
            $this->get("projects/$projectId/hooks")['hooks'],
            Hook::class,
            ['project_id' => $projectId]
        );
    }

    /**
     * Get a hook instance.
     *
     * @param  string  $hookId
     * @param  string  $projectId
     *
     * @return \SalvaWorld\Envoyer\Resources\Hook
     */
    public function hook(string $projectId, string $hookId) {
        return new Hook(
            $this->get("projects/$projectId/hooks/$hookId")['hook'] + ['project_id' => $projectId], $this
        );
    }

    /**
     * Create a new hook.
     *
     * @param  string  $projectId
     * @param  array  $data
     *
     * @return \SalvaWorld\Envoyer\Resources\Hook
     */
    public function createHook(string $projectId, array $data) {
        return new Hook($this->post("projects/$projectId/hooks", $data)['hook'] + ['project_id' => $projectId], $this);
    }

    /**
     * Update hook.
     *
     * @param  string  $projectId
     * @param  string  $hookId
     * @param  array  $data
     *
     * @return \SalvaWorld\Envoyer\Resources\Hook
     */
    public function updateHook(string $projectId, string $hookId, array $data) {
        return new Hook(
            $this->request('PUT', "projects/$projectId/hooks/$hookId", ['json' => $data])['hook']
             + ['project_id' => $projectId], $this
        );
    }

    /**
     * Delete hook.
     *
     * @param  string  $projectId
     * @param  string  $hookId
     *
     * @return void
     */
    public function deleteHook(string $projectId, string $hookId) {
        $this->delete("projects/$projectId/hooks/$hookId");
    }

}
