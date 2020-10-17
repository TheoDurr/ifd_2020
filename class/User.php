<?php
class User extends Atom{
    private $_id, $_firstName, $_lastName, $_birthDate, $_email, $_password, $_creationDate;

    public function __construct(array $data){
        $this->hydrate($data);
    }

    // Getters
    public function id(): int{
        return $this->_id;
    }

    public function firstName(): string{
        return ucfirst($this->_firstName);
    }

    public function lastName(): string{
        return strtoupper($this->_lastName);
    }

    public function birthDate(){
        return $this->_birthDate;
    }
    
    public function email(): string{
        return $this->_email;
    }
    
    public function password(): string{
        return $this->_password;
    }

    public function creationDate(){
        return $this ->_creationDate;
    }

    // Setters
    public function setId($id){
        if(is_string($id)){
            $id = (int) $id;
        }
        
        // Checking successful conversion
        if($id > 0){
            $this->_id = $id;
        } else {
            throw new Exception("Invalid User ID");
        }
    }

    public function setFirstName(string $firstName){
        if(strlen($firstName) <= 255){
            $this->_firstName = $firstName;
        } else {
            $this->_firstName = substr($firstName, 0, 255);
        }
    }

    public function setLastName(string $lastName){
        if(strlen($lastName) <= 255){
            $this->_lastName = $lastName;
        } else {
            $this->_lastName = substr($lastName, 0, 255);
        }
    }

    public function setBirthDate(string $birthDate){
        $this->_birthDate = $birthDate;
    }

    public function setEmail(string $email){
        $this->_email = $email;
    }

    public function setPassword(string $password){
        if(strlen($password) <= 255){
            $this->_password = $password;
        }
    }

    public function setCreationDate(string $creationDate){
        $this->_creationDate = $creationDate;
    }
}