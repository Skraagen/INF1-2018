<?php
session_start();
require_once("resources/init.php");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require_once("includes/head_tag_contents.php");?>

    <style type="text/css">
      body {
        background-color: #f9f9f9;
      }
      body > .grid {
        height: 100%;
      }
      .column {
        max-width: 450px;
      }
    </style>
  </head>
  <body>
    <?php

    $sql  = "SELECT * FROM admin WHERE login_id = 1";
    $username_result = $con -> query($sql);

    while ($row = $username_result->fetch_assoc()) {
      $username = $row['username'];
      $password = $row['password'];
    }

    if (! empty($_POST) && $_POST['user'] === $username && $_POST['pass'] === $password) {
        $_SESSION['logged_in'] = true;
        header('Location: index.php');
    } else {
    ?>
    <div class="ui middle aligned center aligned grid">
      <div class="column left aligned">
        <?php
        $logout = $_GET['logout'] ?? '';

        if ($logout) {
          session_destroy();
          echo '<div class="ui info message">
                <i class="close icon"></i>
                You have been logged out
                </ul></div>';
        }

        if (!empty($_POST) && $_POST['user'] != $username && $_POST['pass'] != $password) {
          echo '<div class="ui error message">
                <i class="close icon"></i>
                Wrong username or password
                </ul></div>';
        }

        ?>
        <form method="POST" class="ui large form">
          <div class="ui stacked very padded segment">
            <div class="ui medium left aligned header">Administration login</div>
            <div class="ui hidden divider"></div>
            <div class="field">
              <div class="ui left icon input">
                <i class="user icon"></i>
                <input type="text" name="user" placeholder="Username">
              </div>
            </div>
            <div class="field">
              <div class="ui left icon input">
                <i class="lock icon"></i>
                <input type="password" name="pass" placeholder="Password">
              </div>
            </div>
            <div class="fluid">
              <input class="fluid ui secondary submit button" type="submit" value="Login">
            </div>
          </div>
        </form>
        <div class="ui divider"></div>
        <a href="index.php">
          <button class="ui tiny left basic labeled icon button">
            <i class="left arrow icon"></i>
            Return
          </button>
        </a>
      </div>
    </div>

    <?php
    }
    ?>

  	<script type="text/javascript">
    $('.message .close')
      .on('click', function() {
        $(this)
          .closest('.message')
          .transition('fade')
          setTimeout(function() { window.location.replace("login.php"); }, 500);
      });
    </script>
  </body>
</html>
