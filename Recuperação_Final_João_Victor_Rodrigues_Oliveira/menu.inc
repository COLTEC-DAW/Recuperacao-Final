<?php
if (session_status() == PHP_SESSION_NONE) session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ./login.php");
}
?>

<div>
  <h1>Meu Querido Diário</h1>

  <h3>
    Login:
    <?= $_SESSION["login"] ?>
  </h3>

  <?php
    if (isset($_COOKIE["lastThought" . $_SESSION["login"]])) { ?>
  <h3>
    Última postagem:
    <?= $_COOKIE["lastThought" . $_SESSION["login"]] ?>
  </h3>
  <?php } ?>

  <a href="./logout.php"><button>Logout</button></a>
</div>
<br />
<hr />
