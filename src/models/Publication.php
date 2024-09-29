<?php

class Publication {
    private int $id;
    private int $id_compte;
    private string $contenu;
    
    public function setId(int $id) {
        $this->id = $id;
    }

    public function setIdCompte(int $idCompte) {
        $this->id_compte = $idCompte;
    }

    public function setContenu(string $contenu) {
        $this->contenu = $contenu;
    }

    public function getId( ) {
        return $this->id;
    }

    public function getIdCompte( ) {
        return $this->id_compte;
    }

    public function getContenu( ) {
        return $this->contenu;
    }
}