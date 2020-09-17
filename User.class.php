<?php

class User
{
  private $id;
  private $login;
  private $password;
  private $name;
  private $surname;
  private $genderId;

  public function getId(){ return $this->id; }
  public function setId($id){ $this->id = $id; return $this; }
  public function getLogin(){ return $this->login; }
  public function setLogin($login){ $this->login = $login; return $this; }
  public function getPassword(){ return $this->password; }
  public function setPassword($password){ $this->password = $password; return $this; }
  public function getName(){ return $this->name; }
  public function setName($name){ $this->name = $name; return $this; }
  public function getSurname(){ return $this->surname; }
  public function setSurname($surname){ $this->surname = $surname; return $this; }
  public function getGenderId(){ return $this->genderId; }
  public function setGenderId($genderId){ $this->genderId = $genderId; return $this; }
}
