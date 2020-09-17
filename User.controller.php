<?php
require_once 'db.class.php';

$db = new Db();
$db->connect();

switch(strtoupper($_REQUEST['do']))
{
  case 'REGISTER':
  $user = new User();
  $user->setLogin($_POST['login'])->setPassword($_POST['password_normal'])->setName($_POST['name'])->setSurname($_POST['surname'])->setGenderId($_POST['GenderId']);
  $db->save($user);
  break;

  case 'LOGIN':
  $user = new User();
  $user->setLogin($_POST['login'])->setPassword($_POST['password']);
  $db->validate($user);
  break;

  case 'LOGOUT':
  unset($_SESSION['user']);
  header('Location: index.php?logout=true');
  break;
}
