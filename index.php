<?php require_once 'head.php';?>
<body>

  <div class="modal" id="logowanieSuccess">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" style="color:green;">Witaj <?php echo $_SESSION['user']['Name']. ' ' . $_SESSION['user']['Surname'];?>
            ! Pomyślnie zalogowano!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="rejestracjaSuccess">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" style="color:green;">Pomyślnie utworzono nowe konto!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="logoutSuccess">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" style="color:green;">Pomyślnie wylogowano z konta</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="rejestracja" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Zarejestruj się!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="User.controller.php">
         <?php if (isset($_SESSION['registerError'])) { ?>
         <div class="form-group text-danger" id="error-message">
          <p><?php echo $_SESSION['registerError']; ?></p>
          </div>
        <?php } unset($_SESSION['registerError']); ?>
          <div class="form-group">
           <input type="text" class="form-control" id="input-login" name="login" placeholder="Login" required autocomplete="off">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="input-password" name="password_normal" placeholder="Hasło" required autocomplete="off">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="input-password" name="password_valid" placeholder="Potwierdź hasło" required autocomplete="off">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="input-name" name="name" placeholder="Imię">
          </div>
          <div class="form-group">
           <input type="text" class="form-control" id="input-surname" name="surname" placeholder="Nazwisko">
          </div>
          <div class="form-group">
            <label for="select-gender">Wybierz płeć: </label>
              <select class="form-control" id="select-gender" name="GenderId">
                <?php $tmp=$db->connection->prepare("SELECT * FROM `tmp_task`.`gender`");
                $tmp->execute();
                while($row = $tmp->fetch(PDO::FETCH_ASSOC))
                {
                  echo '<option value="'.$row['GenderID'].'">'.$row['Gender'].'</option>';
                }?>
              </select>
          </div>
            <input type="hidden" name="do" value="register">
            <button type="submit" class="btn btn-primary">Rejestracja</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="logowanie" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Zaloguj się!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="User.controller.php">
       <?php if (isset($_SESSION['loginError'])) { ?>
       <div class="form-group text-danger" id="error-message">
        <p><?php echo $_SESSION['loginError']; ?></p>
        </div>
      <?php } unset($_SESSION['loginError']); ?>
        <div class="form-group">
         <input type="text" class="form-control" id="input-login" name="login" placeholder="Login" required autocomplete="off">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" id="input-password" name="password" placeholder="Hasło" required autocomplete="off">
        </div>
          <input type="hidden" name="do" value="login">
          <button type="submit" class="btn btn-primary">Logowanie</button>
      </form>
      </div>
    </div>
  </div>
</div>




<div class="container" id="main">

  <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top" id="indexNavbar">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="container">
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Strona główna</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <?php if(!isset($_SESSION['user'])){?>
        <li class="nav-item">

          <a class="nav-link" data-toggle="modal" data-target="#rejestracja" href="#"><i class="fas fa-user-plus mr-2"></i>Rejestracja</a>
        </li>
        <li class="nav-item">

          <a class="nav-link" data-toggle="modal" data-target="#logowanie" href="#"><i class="fas fa-sign-in-alt mr-2"></i>Logowanie</a>
        </li>
      <?php } else if(isset($_SESSION['user'])){?>
        <li class="nav-item">

          <a class="nav-link" href="User.controller.php?do=logout"><i class="fas fa-sign-in-alt mr-2"></i>Wyloguj</a>
        </li><?php } ?>

      </ul>
    </div>
    </div>
  </nav>

 <?php if(isset($_SESSION['user'])){
   $sth = $db->connection->prepare("SELECT * FROM `tmp_task`.`Gender` WHERE `GenderID` = ?");
   $sth->bindParam(1, $_SESSION['user']['GenderID']);
   $sth->execute();
   $row = $sth->fetch(PDO::FETCH_ASSOC);?>
   <h1>Witaj <?= $_SESSION['user']['Name']. ' '.$_SESSION['user']['Surname'].'<br> Płeć: '. $row['Gender'].'<br>' ?>
 <?php }?>
</div>

</body>
<script type="text/javascript">
  <?php if(isset($_GET['rejestracja']) && $_GET['rejestracja']=='false')
  { ?>
    $('#rejestracja').modal('show');
 <?php }
  else if(isset($_GET['logowanie']) && $_GET['logowanie']=='false')
  { ?>
    $('#logowanie').modal('show');
 <?php }
  else if(isset($_GET['logowanie']) && $_GET['logowanie']=='true'){
    ?>$('#logowanieSuccess').modal('show'); <?php } else if(isset($_GET['rejestracja']) && $_GET['rejestracja']=='true'){
      ?>$('#rejestracjaSuccess').modal('show');<?php } else if(isset($_GET['logout']) && $_GET['logout'] == 'true'){
        ?>$('#logoutSuccess').modal('show');<?php } ?>
</script>
</html>
