<?php

namespace SalvaWorld\Envoyer\Resources;

class Hook extends Resource {

    /**
     * The id of the hook.
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
     * @return \SalvaWorld\Envoyer\Resources\Hook
     */
    public function update(array $data) {
        return $this->envoyer->updateHook($this->projectId, $this->id, $data);
    }

    /**
     * Delete hook.
     *
     * @return void
     */
    public function delete() {
        $this->envoyer->deleteHook($this->projectId, $this->id);
    }

}
