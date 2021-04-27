  <div class="ui inverted vertical footer segment background">
    <div class="ui container">
      <div class="ui stackable inverted divided equal height stackable grid">
        <div class="four wide column">
          Copyright © 2019 Mathias Raa
        </div>
        <div class="ten wide right aligned column">
          <?php
          if (empty($_SESSION['logged_in'])) {
            echo '<a href="login.php">
                    <button class="ui tiny right inverted basic button">
                      Admin
                      <i class="right arrow icon"></i>
                    </button>
                  </a>';
           }
           ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="assets/js/main.js" type="text/javascript"></script>
<script type="text/javascript">
<?php
$portfolio_item = mysqli_query($con, "SELECT * FROM portfolio_item")
or die(mysqli_error($con));
while ($row = $portfolio_item->fetch_assoc()) {
  echo '$( "#'. $row["item_id"] .'itemClick" ).click(function() {
    $("#'.$row["item_id"].'modal").modal("show");
  });';
}
?>
</script>
