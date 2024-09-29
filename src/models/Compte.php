<?php
// <->
class Compte {
    private int $id;
    private string $name;
    private string $firstName;
    private string $email;
    private string $password;

    // Setter function
    public function setId(int $id) {
        $this->id = $id;
    }

    public function setName(string $name) : void {
        $this->name = $name;
    }

    public function setFirstName(string $firstName) : void {
        $this->firstName = $firstName;
    }

    public function setEmail(string $email) : void {
        $this->email = $email;
    }

    public function setPassword(string $password) : void {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $this->password = $hashed_password;
    }

    public function getId() : int {
        return $this->id;
    }

    public function getName() : string {
        return $this->name;
    }

    public function getFirstName() : string {
        return $this->firstName;
    }

    public function getEmail() : string {
        return $this->email;
    }

    public function getPassword() : string {
        return $this->password;
    }

    
}