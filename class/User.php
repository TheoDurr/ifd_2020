<?php
/**
 * Class used to represent an user
 */
class User extends Atom{
    private $_id, $_firstName, $_lastName, $_birthDate, $_email, $_password, $_creationDate, $_admin;

    public function __construct(array $data){
        $this->hydrate($data);
    }

    // Getters
    public function id(): int{return $this->_id;}
    public function firstName(): string{return ucfirst($this->_firstName);}
    public function lastName(): string{return strtoupper($this->_lastName);}
    public function birthDate(){return $this->_birthDate;}    
    public function email(): string{return $this->_email;}    
    public function password(): string{return $this->_password;}
    public function creationDate(){return $this ->_creationDate;}
    public function admin(): bool {return $this->_admin;}
    
    // Setters
    public function setId(int $id){
        $this->_id = $id;
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

    public function setAdmin(bool $value){
        $this->_admin = $value;
    }

    public function comparePassword(string $pass){
        if(password_verify($pass, $this->password())){
            return true;
        }else{
            return false;
        }
    }
}