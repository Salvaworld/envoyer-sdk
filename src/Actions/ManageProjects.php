<?php

namespace SalvaWorld\Envoyer\Actions;

use SalvaWorld\Envoyer\Resources\Project;

trait ManageProjects {

    /**
     * Get the collection of projects.
     *
     * @return \SalvaWorld\Envoyer\Resources\Project[]
     */
    public function projects() {
        return $this->transformCollection(
            $this->get('projects')['projects'], Project::class
        );
    }

    /**
     * Get a project instance.
     *
     * @param  string  $projectId
     * @return \SalvaWorld\Envoyer\Resources\Project
     */
    public function project(string $projectId) {
        return new Project($this->get("projects/$projectId")['project']);
    }

    /**
     * Create a new project.
     *
     * @param  array  $data
     * @return \SalvaWorld\Envoyer\Resources\Project
     */
    public function createProject(array $data) {
        return new Project($this->post('projects', $data)['project']);
    }

    /**
     * Update project source.
     *
     * @param  string  $projectId
     * @param  array  $data
     * @return \SalvaWorld\Envoyer\Resources\Project
     */
    public function updateProjectSource(string $projectId, array $data) {
        return new Project($this->put("projects/$projectId/source", $data)['project']);
    }

    /**
     * Update project.
     *
     * @param  string  $projectId
     * @param  array  $data
     * @return \SalvaWorld\Envoyer\Resources\Project
     */
    public function updateProject(string $projectId, array $data) {
        return new Project($this->put("projects/$projectId", $data)['project']);
    }

    /**
     * Delete project.
     *
     * @param  string  $projectId
     * @return void
     */
    public function deleteProject(string $projectId) {
        $this->delete("projects/$projectId");
    }

    /**
     * Get Linked Folders
     *
     * @param  string  $projectId
     * @return \SalvaWorld\Envoyer\Resources\Project
     */
    public function getLinkedFolders(string $projectId) {
        return new Project($this->get("projects/$projectId"));
    }

    /**
     * Create linked folder.
     *
     * @param  string  $projectId
     * @param  array  $data
     * @return \SalvaWorld\Envoyer\Resources\Project
     */
    public function createLinkedFolder(string $projectId, array $data) {
        return new Project($this->post("projects/$projectId/folders", $data)['folders']);
    }

    /**
     * Delete linked folder.
     *
     * @param  string  $projectId
     * @return void
     */
    public function deleteLinkedFolder(string $projectId, array $data) {
        $this->delete("projects/$projectId/folders", $data);
    }

}
