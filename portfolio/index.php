<?php require_once("resources/init.php"); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require_once("includes/head_tag_contents.php");?>
  </head>
  <body id="home" class="pushable">
    <?php
    session_start();

    require_once(VIEWS_PATH . "/sub-views/header.php");
    ?>

    <div class="ui vertical stripe quote segment">
      <div class="ui equal width stackable internally celled grid">
        <div class="center aligned row">
          <div class="column">
            <h3>"Flexibility, Quality, Service"</h3>
            <p>My business summarized</p>
          </div>
          <div class="column">
            <h3>I create Quality brand designs </h3>
            <p>
              Satisfaction <b>guaranteed</b>
            </p>
          </div>
        </div>
      </div>
    </div>

    <?php if (!empty($_SESSION['logged_in'])){ require_once(VIEWS_PATH . "/edit.php"); } ?>

    <?php require_once(VIEWS_PATH . "/portfolio.php");?>

    <?php require_once(VIEWS_PATH . "/about.php");?>

    <?php require_once(VIEWS_PATH . "/contact.php");?>

    <?php require_once(VIEWS_PATH . "/sub-views/footer.php");?>

  </body>
</html>
