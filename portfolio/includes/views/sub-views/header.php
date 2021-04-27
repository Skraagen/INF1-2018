<?php
if (!empty($_SESSION['logged_in'])) {
  echo '<div class="admin-bar"></div>';
}
?>
<div class="ui large top fixed hidden menu">
  <div class="ui container">
    <a class="item" href="#home">Home</a>
    <a class="item" href="#portfolio">Work</a>
    <a class="item" href="#about">About</a>
    <a class="item" href="#contact">Contact</a>
     <div class="right menu">
       <div class="item">
         <?php
         if (!empty($_SESSION['logged_in'])) {
           echo '<form method="get" action="login.php">
                   <input type="hidden" name="logout" value="true">
                   <input class="ui basic negative button" type="submit" value="Logout">
               </form>';
          }
          ?>
       </div>
     </div>
  </div>
</div>

<div class="ui vertical inverted sidebar menu left">
  <a class="active item" href="#home">Home</a>
  <a class="item" href="#portfolio">Work</a>
  <a class="item" href="#about">About</a>
  <a class="item" href="#contact">Contact</a>
</div>


<div class="pusher">
  <div class="ui inverted vertical masthead center aligned segment background">

    <div class="ui container">
      <div class="ui large secondary inverted pointing menu">
        <a class="toc item">
          <i class="sidebar icon"></i>
        </a>
        <a class="active item" href="#home">Home</a>
        <a class="item" href="#portfolio">Work</a>
        <a class="item" href="#about">About</a>
        <a class="item" href="#contact">Contact</a>
        <div class="right menu">
          <div class="item" style="padding-bottom: 0">
            <?php
            if (! empty($_SESSION['logged_in'])) {
              echo '<form method="get" action="login.php">
                      <input type="hidden" name="logout" value="true">
                      <input class="ui inverted red button" type="submit" value="Logout">
                  </form>';
             }
             ?>
          </div>
        </div>
      </div>
    </div>
    <div class="ui text container">
      <h1 class="ui inverted header logo">
        <img src="assets/img/logo.png" alt="">
      </h1>
      <br>
      <a href="#portfolio">
        <div class="ui basic inverted icon labeled button">My work <i class="down arrow icon"></i></div>
      </a>
    </div>
  </div>
