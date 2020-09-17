<?php
require_once 'User.class.php';
class Db
{
  const DB_HOSTNAME = 'localhost';
  const DB_USERNAME = 'root';
  const DB_PASSWORD = '';
  const DB_NAME = 'tmp_task';

  public $connection = null;

  function connect()
  {
    session_start();
    try{
      $this->connection = new PDO('mysql:host='.self::DB_HOSTNAME.';'.self::DB_NAME, self::DB_USERNAME, self::DB_PASSWORD);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }

  }

  function save($object)
  {
    if($object instanceof User){
      return $this->saveUser($object);
    }
  }

  function saveUser($user)
  {
    $login = $user->getLogin();
    $password = $user->getPassword();
    $name = $user->getName();
    $surname = $user->getSurname();
    $genderId = $user->getGenderId();

    if(!empty($login) && !empty($password) && !empty($name) && !empty($surname) && !empty($genderId))
    {

      $sth = $this->connection->prepare("SELECT * FROM `tmp_task`.`User` WHERE `Login` = ?");
      $sth->bindParam(1, $login);
      $sth->execute();
      $rowcount = $sth->rowCount();

      if($rowcount === 0)
      {

        if(strlen($login) >= 6)
        {
          if(strlen($password) >= 8)
          {
            if($_POST['password_normal'] == $_POST['password_valid'])
            {
              $password_hash = password_hash($password, PASSWORD_DEFAULT);
              $data = array($login, $password_hash, $name, $surname, $genderId);
              $stmt = $this->connection->prepare("INSERT INTO `tmp_task`.`User` VALUES (NULL, ?, ?, ?, ?, ?)");
              $stmt->execute($data);
              header('Location: index.php?rejestracja=true');
            } else {
              $_SESSION['registerError'] = 'Hasła się nie zgadzają';
              header('Location: index.php?rejestracja=false');
            }
          } else {
            $_SESSION['registerError'] = 'Hasło musi mieć conajmniej 8 znaków';
            header('Location: index.php?rejestracja=false');
          }
        } else {
          $_SESSION['registerError'] = 'Login musi mieć conajmniej 6 znaków';
          header('Location: index.php?rejestracja=false');
        }

      } else {
        $_SESSION['registerError'] = 'Login jest zajęty';
        header('Location: index.php?rejestracja=false');
      }

    } else {
      $_SESSION['registerError'] = 'Proszę wypełnić wszystkie pola';
      header('Location: index.php?rejestracja=false');
    }

  }

  function validate($user)
  {
    $login = $user->getLogin();
    $password_hash = $user->getPassword();
    if(!empty($login) && !empty($password_hash))
    {
      $sth = $this->connection->prepare("SELECT * FROM `tmp_task`.`User` WHERE `Login` = ?");
      $sth->bindParam(1, $login);
      $sth->execute();
      $rowcount = $sth->rowCount();
      if($rowcount === 1)
      {
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        if(password_verify($password_hash, $row['Password']))
        {
          $_SESSION['user'] = $row;
          header('Location: index.php?logowanie=true');
        } else {
          $_SESSION['loginError'] = 'Podany login lub hasło jest nieprawidłowy';
          header('Location: index.php?logowanie=false');
        }
      } else {
        $_SESSION['loginError'] = 'Podany login lub hasło jest nieprawidłowy';
        header('Location: index.php?logowanie=false');
      }
    } else {
      $_SESSION['loginError'] = 'Proszę wypełnić wszystkie pola';
      header('Location: index.php?logowanie=false');
    }
  }
}
