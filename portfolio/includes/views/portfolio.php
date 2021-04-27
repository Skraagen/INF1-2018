<?php
$portfolio = mysqli_query($con, "SELECT * FROM portfolio")
or die(mysqli_error());

require_once(TEMPLATES_PATH . "/portfolio_item.php");

$item = new Item;
while ($row = $portfolio->fetch_assoc()) {
  $portfolio_id = $row["portfolio_id"];
?>
<div class="ui vertical stripe segment" id="portfolio">
  <div class="ui text container">
    <h2 class="ui header">
      <?php echo $row["title"]; ?>
      <div class="sub header">
        <?php echo $row["desc"]; ?>
      </div>
    </h2>
  </div>
  <div class="ui hidden section divider">
  </div>
  <div class="ui container">
    <div class="ui compact selection dropdown">
      <input class="categorySelect" type="hidden" name="category">
      <i class="dropdown icon"></i>
      <div class="default text">Category</div>
      <div class="menu">
        <?php
        $clients = mysqli_query($con, "SELECT * FROM category")
        or die(mysqli_error());

        while ($rad = $clients->fetch_assoc()) {
          if ($rad["portfolio_id"] == $portfolio_id) {
          echo '<div class="item" data-value="' . $rad["category_id"] . '">' . $rad["name"] . '</div>';
          }

        }
        ?>
      </div>
    </div>
    <div class="ui divider"></div>
    <div id="itemContainer" class="ui doubling three column stackable grid">

      <?php
      $category = mysqli_query($con, "SELECT * FROM category WHERE portfolio_id = $portfolio_id")
      or die(mysqli_error());

      while ($row_ = $category->fetch_assoc()) {
        $category_id = $row_['category_id'];

        $portfolio_item = mysqli_query($con, "SELECT * FROM portfolio_item WHERE category_id =$category_id")
        or die(mysqli_error($con));
        while ($row = $portfolio_item->fetch_assoc()) {
            echo '<div class="column grid-item portfolioCard '. $row["category_id"] .'category">';
            $item->setID($row["item_id"]);
            $item->setTitle($row["title"]);
            $item->setDesc($row["desc"]);
            $item->setDate($row["date"]);

            $client_id = $row['client_id'];
            $client = mysqli_query($con, "SELECT * FROM client WHERE client_id = $client_id");

            while ($rowx = $client->fetch_assoc()) {
                $item->setClient($rowx["name"], $rowx["desc"]);
            }

            $item_id = $row['item_id'];
            $image = mysqli_query($con, "SELECT * FROM image WHERE item_id = $item_id");
            $num_rows = mysqli_num_rows($image);

            while ($rowy = $image->fetch_assoc()) {
                $item->setLink($rowy["filepath"], $rowy["thumb"], $rowy["item_id"]);
            }

            $item->printItem($row["item_id"]);
            echo '</div>';
        }
      }
      echo '</div>';
      ?>
  </div>
</div>
<?php
}
?>
