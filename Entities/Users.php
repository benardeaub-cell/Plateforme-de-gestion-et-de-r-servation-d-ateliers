<?php


namespace workshop_platform\Entities;



class Users {
    private ?int $id_user = null;
    private ?string $name = null;
    private ?string $email = null;
    private ?string $password = null;
    private ?string $created_at = null;
    private ?int $id_role = null;


    public function getId_User(): ?int {
        return $this->id_user;
    }


    public function setId_User(int $id_user): self {
        $this->id_user = $id_user;
        return $this;
    }


    public function getName(): ?string {
        return $this->name;
    }


    public function setName(string $name): self {
        $this->name = $name;
        return $this;
    }


    public function getEmail(): ?string {
        return $this->email;
    }


    public function setEmail(string $email): self {
        $this->email = $email;
        return $this;
    }


    public function getPassword(): ?string {
        return $this->password;
    }


    public function setPassword(string $password): self {
        $this->password = $password;
        return $this;
    }


    public function getCreatedAt(): ?string {
        return $this->created_at;
    }


    public function setCreatedAt(string $created_at): self {
        $this->created_at = $created_at;
        return $this;
    }


    public function getId_Role(): ?int {
        return $this->id_role;
    }

    
    public function setId_Role(int $id_role): self {
        $this->id_role = $id_role;
        return $this;
    }
}