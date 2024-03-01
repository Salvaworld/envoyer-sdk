<?php

namespace SalvaWorld\Envoyer\Actions;

use SalvaWorld\Envoyer\Resources\Action;

trait ManageActions {

    /**
     * Get the collection of actions.
     *
     * @return \SalvaWorld\Envoyer\Resources\Action[]
     */
    public function actions() {
        return $this->transformCollection(
            $this->get('actions')['actions'], Action::class
        );
    }
}
