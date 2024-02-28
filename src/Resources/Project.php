<?php

namespace SalvaWorld\Envoyer\Resources;

class Project extends Resource {

    /**
     * The id of the project.
     *
     * @var int
     */
    public $id;

    /**
     * Update the given project.
     *
     * @param  array  $data
     * @return \SalvaWorld\Envoyer\Resources\Project
     */
    public function update(array $data) {
        return $this->envoyer->updateProject($this->id, $data);
    }

    /**
     * Delete project.
     *
     * @return void
     */
    public function delete() {
        return $this->envoyer->deleteProject($this->id);
    }

    /**
     * Update project source.
     *
     * @param  array  $data
     * @return \SalvaWorld\Envoyer\Resources\Project
     */
    public function updateSource(array $data) {
        return $this->envoyer->updateProjectSource($this->id, $data);
    }

    /**
     * Get linked folders.
     *
     * @return \SalvaWorld\Envoyer\Resources\Project
     */
    public function linkedFolders() {
        return $this->envoyer->getLinkedFolders($this->id);
    }

    /**
     * Create linked folder.
     *
     * @param  string  $projectId
     * @param  array  $data
     * @return \SalvaWorld\Envoyer\Resources\Project
     */
    public function createLinkedFolder(array $data) {
        return $this->envoyer->createLinkedFolder($this->id, $data);
    }

    /**
     * Delete linked folder.
     *
     * @param  array  $data
     * @return void
     */
    public function deleteLinkedFolder(array $data) {
        return $this->envoyer->deleteLinkedFolder($this->id, $data);
    }

}
