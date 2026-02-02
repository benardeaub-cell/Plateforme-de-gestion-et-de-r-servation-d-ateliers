<?php

namespace workshop_platform\Entities;

class Roles {
    private ?int $id_role = null;
    private ?string $label = null;

    public function getId_Role(): ?int {
        return $this->id_role;
    }

    public function setId_Role(int $id_role): self {
        $this->id_role = $id_role;
        return $this;
    }

    public function getLabel(): ?string {
        return $this->label;
    }

    public function setLabel(string $label): self {
        $this->label = $label;
        return $this;
    }
}