<?php
if(!isset($_SESSION['logged_in'])){
  header("location:../../index.php");
  die();
} else {
?>

<div class="ui vertical stripe segment" id="edit">
  <div class="ui text container">
    <h2 class="ui red header"><i class="pencil alternate icon"></i><div class="content">Administrate portfolio
    <div class="sub header"></div></div></h2>
  </div>
  <div class="ui hidden section divider"></div>
  <div class="ui container">

    <!-- PORTFOLIO -->
    <div id="portfolioEditSection" class="ui medium header">Portfolio</div>


    <form id="portfolio_submit" class="" method="post" action="#portfolioEditSection">
    <table class="ui compact celled definition table" id="portfolio_edit">

      <thead>
        <tr>
          <th></th>
          <th>ID</th>
          <th class="three wide">Title</th>
          <th class="twelve wide">Description</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $portfolio = mysqli_query($con, "SELECT * FROM portfolio")
        or die(mysqli_error());

        $portfolio_add = 0;

        while ($row = $portfolio->fetch_assoc()) {
          $portfolio_id = $row["portfolio_id"];

          $portfolio_add += 1;
          echo '<tr>
                  <td class="collapsing">
                      <div class="ui fitted checkbox">
                      <input type="checkbox" name="portfolio_check[]" value="'.$row["portfolio_id"].'" class="checkbox"> <label></label>
                    </div>
                  </td>';
          echo '<td><input type="hidden" name="'.$portfolio_add.'portfolio_id" value="'.$row["portfolio_id"].'">' . $row["portfolio_id"] . '</td>';
          echo '<td><div class="ui form"><div class="field"><input name="'.$portfolio_add.'portfolio_title" type="text" value="' . $row["title"] . '"></div></div></td>';
          echo '<td><div class="ui form"><div class="field"><input name="'.$portfolio_add.'portfolio_desc" type="text" value="' . $row["desc"] . '"></div></div></td>';

        }
        function addPortfolioRow($portfolio_add, $con) {
          echo '<tr>
                  <td class="collapsing">
                      <div class="ui fitted checkbox">
                      <input type="checkbox"> <label></label>
                    </div>
                  </td>';
          echo '<td><input type="hidden" name="'.$portfolio_add.'portfolio_id" placeholder="ID"></td>';
          echo '<td><div class="ui form"><div class="field"><input name="'.$portfolio_add.'portfolio_title" type="text" placeholder="Title"></div></div></td>';
          echo '<td><div class="ui form"><div class="field"><input name="'.$portfolio_add.'portfolio_desc" type="text" placeholder="Description"></div></div></td>';
        }

        if (isset($_GET["portfolio_add"]) && $_GET["portfolio_add"] == "Add Object") {
          $portfolio_add += 1;
          addPortfolioRow($portfolio_add, $con);
        }
         ?>
      </tbody>
      <tfoot class="full-width">
        <tr>
          <th>
            <a>
              <div class="ui fitted checkbox">
              <input type="checkbox"onClick="toggle(this)"> <label></label>
            </div>
            </a>
          </th>
          <th colspan="7">
            <input form="portfolio_submit" type="submit" name="portfolio_remove" value="Delete" class="ui small negative button">
            <input form="portfolio_add" type="submit" name="portfolio_add" value="Add Object" class="ui right floated small positive button">
          </th>
        </tr>
      </tfoot>
    </table>
    </form>
    <div class="ui hidden divider"></div>
    <input form="portfolio_submit" type="submit" name="portfolio_submit" class="ui right floated button" value="Submit">
    <form id="portfolio_add" method="get" action="#portfolioEditSection"></form>

    <br>

    <!-- CATEGORY -->
    <div id="categoryEditSection" class="ui medium header">Category</div>


    <form id="category_submit" class="" method="post" action="#categoryEditSection">
    <table class="ui compact celled definition table" id="category_edit">

      <thead>
        <tr>
          <th></th>
          <th>ID</th>
          <th class="three wide">Name</th>
          <th class=" wide">Description</th>
          <th class=" one wide">Portfolio</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $category = mysqli_query($con, "SELECT * FROM category")
        or die(mysqli_error());

        $category_add = 0;

        while ($row = $category->fetch_assoc()) {
          $category_id = $row["category_id"];

          $category_add += 1;
          echo '<tr>
                  <td class="collapsing">
                      <div class="ui fitted checkbox">
                      <input type="checkbox" name="category_check[]" value="'.$row["category_id"].'" class="checkbox"> <label></label>
                    </div>
                  </td>';
          echo '<td><input type="hidden" name="'.$category_add.'category_id" value="'.$row["category_id"].'">' . $row["category_id"] . '</td>';
          echo '<td><div class="ui form"><div class="field"><input name="'.$category_add.'category_name" type="text" value="' . $row["name"] . '"></div></div></td>';
          echo '<td><div class="ui form"><div class="field"><input name="'.$category_add.'category_desc" type="text" value="' . $row["desc"] . '"></div></div></td>';
          echo '<td>
          <div class="ui compact selection dropdown">
            <input type="hidden" name="'.$category_add.'category_portfolio" value="'. $row["portfolio_id"] .'">
            <i class="dropdown icon"></i>
            <div class="default text">Portfolio</div>
            <div class="menu">';
              $portfolios = mysqli_query($con, "SELECT * FROM portfolio")
              or die(mysqli_error());


              while ($row = $portfolios->fetch_assoc()) {
                echo '<div class="item" data-value="' . $row["portfolio_id"] . '">' . $row["portfolio_id"] . '</div>';
              }
          echo '</div></div></td>';
        }
        function addCategoryRow($category_add, $con) {
          echo '<tr>
                  <td class="collapsing">
                      <div class="ui fitted checkbox">
                      <input type="checkbox"> <label></label>
                    </div>
                  </td>';
          echo '<td><input type="hidden" name="'.$category_add.'category_id" placeholder="ID"></td>';
          echo '<td><div class="ui form"><div class="field"><input name="'.$category_add.'category_name" type="text" placeholder="Title"></div></div></td>';
          echo '<td><div class="ui form"><div class="field"><input name="'.$category_add.'category_desc" type="text" placeholder="Description"></div></div></td>';
          echo '<td>
          <div class="ui compact selection dropdown">
            <input type="hidden" name="'.$category_add.'category_portfolio" value="">
            <i class="dropdown icon"></i>
            <div class="default text">Portfolio</div>
            <div class="menu">';
              $portfolios = mysqli_query($con, "SELECT * FROM portfolio")
              or die(mysqli_error());


              while ($row = $portfolios->fetch_assoc()) {
                echo '<div class="item" data-value="' . $row["portfolio_id"] . '">' . $row["portfolio_id"] . '</div>';
              }
          echo '</div></div></td>';
        }

        if (isset($_GET["category_add"]) && $_GET["category_add"] == "Add Object") {
          $category_add += 1;
          addCategoryRow($category_add, $con);
        }
         ?>
      </tbody>
      <tfoot class="full-width">
        <tr>
          <th>
            <a>
              <div class="ui fitted checkbox">
              <input type="checkbox"onClick="toggle(this)"> <label></label>
            </div>
            </a>
          </th>
          <th colspan="7">
            <input form="category_submit" type="submit" name="category_remove" value="Delete" class="ui small negative button">
            <input form="category_add" type="submit" name="category_add" value="Add Object" class="ui right floated small positive button">
          </th>
        </tr>
      </tfoot>
    </table>
    </form>
    <div class="ui hidden divider"></div>
    <input form="category_submit" type="submit" name="category_submit" class="ui right floated button" value="Submit">
    <form id="category_add" method="get" action="#categoryEditSection"></form>

    <br>

    <!-- CLIENT -->
    <div id="clientEditSection" class="ui medium header">Client</div>


    <form id="client_submit" class="" method="post" action="#clientEditSection">
    <table class="ui compact celled definition table" id="client_edit">

      <thead>
        <tr>
          <th></th>
          <th>ID</th>
          <th class="three wide">Name</th>
          <th class="twelve wide">Description</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $client = mysqli_query($con, "SELECT * FROM client")
        or die(mysqli_error());

        $client_add = 0;

        while ($row = $client->fetch_assoc()) {
          $client_id = $row["client_id"];

          $client_add += 1;
          echo '<tr>
                  <td class="collapsing">
                      <div class="ui fitted checkbox">
                      <input type="checkbox" name="client_check[]" value="'.$row["client_id"].'" class="checkbox"> <label></label>
                    </div>
                  </td>';
          echo '<td><input type="hidden" name="'.$client_add.'client_id" value="'.$row["client_id"].'">' . $row["client_id"] . '</td>';
          echo '<td><div class="ui form"><div class="field"><input name="'.$client_add.'client_name" type="text" value="' . $row["name"] . '"></div></div></td>';
          echo '<td><div class="ui form"><div class="field"><input name="'.$client_add.'client_desc" type="text" value="' . $row["desc"] . '"></div></div></td>';

        }
        function addClientRow($client_add, $con) {
          echo '<tr>
                  <td class="collapsing">
                      <div class="ui fitted checkbox">
                      <input type="checkbox"> <label></label>
                    </div>
                  </td>';
          echo '<td><input type="hidden" name="'.$client_add.'category_id" placeholder="ID"></td>';
          echo '<td><div class="ui form"><div class="field"><input name="'.$client_add.'client_name" type="text" placeholder="Title"></div></div></td>';
          echo '<td><div class="ui form"><div class="field"><input name="'.$client_add.'client_desc" type="text" placeholder="Description"></div></div></td>';
        }

        if (isset($_GET["client_add"]) && $_GET["client_add"] == "Add Object") {
          $client_add += 1;
          addClientRow($client_add, $con);
        }
         ?>
      </tbody>
      <tfoot class="full-width">
        <tr>
          <th>
            <a>
              <div class="ui fitted checkbox">
              <input type="checkbox"onClick="toggle(this)"> <label></label>
            </div>
            </a>
          </th>
          <th colspan="7">
            <input form="client_submit" type="submit" name="client_remove" value="Delete" class="ui small negative button">
            <input form="client_add" type="submit" name="client_add" value="Add Object" class="ui right floated small positive button">
          </th>
        </tr>
      </tfoot>
    </table>
    </form>
    <div class="ui hidden divider"></div>
    <input form="client_submit" type="submit" name="client_submit" class="ui right floated button" value="Submit">
    <form id="client_add" method="get" action="#clientEditSection"></form>

    <br>

    <!-- PORTFOLIO ITEM -->
    <div id="portfolioItemEditSection" class="ui medium header">Portfolio Item</div>


    <form id="portfolio_item_submit" class="" method="post" action="#portfolioItemEditSection">
    <table class="ui compact celled definition table" id="portfolio_item_edit">

      <thead>
        <tr>
          <th></th>
          <th>ID</th>
          <th class="three wide">Title</th>
          <th class="six wide">Description</th>
          <th class="two wide">Date</th>
          <th class="one wide">Client</th>
          <th class="one wide">Category</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $portfolio_item = mysqli_query($con, "SELECT * FROM portfolio_item")
        or die(mysqli_error());

        $portfolio_item_add = 0;

        while ($row = $portfolio_item->fetch_assoc()) {
          $portfolio_item_id = $row["item_id"];

          $portfolio_item_add += 1;

          echo '<tr>
                  <td class="collapsing">
                      <div class="ui fitted checkbox">
                      <input type="checkbox" name="item_check[]" value="'.$row["item_id"].'" class="checkbox"> <label></label>
                    </div>
                  </td>';
          echo '<td><input type="hidden" name="'.$portfolio_item_add.'item_id" value="'.$row["item_id"].'">' . $row["item_id"] . '</td>';
          echo '<td><div class="ui form"><div class="field"><input name="'.$portfolio_item_add.'item_title" type="text" value="' . $row["title"] . '"></div></div></td>';
          echo '<td><div class="ui form"><div class="field"><input name="'.$portfolio_item_add.'item_desc" type="text" value="' . $row["desc"] . '"></div></div></td>';
          echo '<td><div class="ui form"><div class="field"><input name="'.$portfolio_item_add.'item_date" type="date" value="' . $row["date"] . '"></div></div></td>';
          echo '<td>
          <div class="ui compact selection dropdown">
            <input type="hidden" name="'.$portfolio_item_add.'item_client" value="'. $row["client_id"] .'">
            <i class="dropdown icon"></i>
            <div class="default text">Client</div>
            <div class="menu">';
              $clients = mysqli_query($con, "SELECT * FROM client")
              or die(mysqli_error());


              while ($row_ = $clients->fetch_assoc()) {
                echo '<div class="item" data-value="' . $row_["client_id"] . '">' . $row_["name"] . '</div>';
              }
          echo '</div></div></td>';
          echo '<td>
          <div class="ui compact selection dropdown">
            <input type="hidden" name="'.$portfolio_item_add.'item_category" value="'. $row["category_id"] .'">
            <i class="dropdown icon"></i>
            <div class="default text">Category</div>
            <div class="menu">';
              $categories = mysqli_query($con, "SELECT * FROM category")
              or die(mysqli_error());


              while ($row_ = $categories->fetch_assoc()) {
                echo '<div class="item" data-value="' . $row_["category_id"] . '">' . $row_["name"] . '</div>';
              }
          echo '</div></div></td>';
          echo '</tr>';

        }

        function addPortfolioItemRow($portfolio_item_add, $con) {
          echo '<tr>
                  <td class="collapsing">
                      <div class="ui fitted checkbox">
                      <input type="checkbox"> <label></label>
                    </div>
                  </td>';
          echo '<td><input type="hidden" name="'.$portfolio_item_add.'item_id" placeholder="ID"></td>';
          echo '<td><div class="ui form"><div class="field"><input name="'.$portfolio_item_add.'item_title" type="text" placeholder="Title"></div></div></td>';
          echo '<td><div class="ui form"><div class="field"><input name="'.$portfolio_item_add.'item_desc" type="text" placeholder="Description"></div></div></td>';
          echo '<td><div class="ui form"><div class="field"><input name="'.$portfolio_item_add.'item_date" type="date" placeholder="Date"></div></div></td>';
          echo '<td>
          <div class="ui compact selection dropdown">
            <input type="hidden" name="'.$portfolio_item_add.'item_client" value="">
            <i class="dropdown icon"></i>
            <div class="default text">Client</div>
            <div class="menu">';
              $clients = mysqli_query($con, "SELECT * FROM client")
              or die(mysqli_error());


              while ($row = $clients->fetch_assoc()) {
                echo '<div class="item" data-value="' . $row["client_id"] . '">' . $row["name"] . '</div>';
              }
          echo '</div></div></td>';
          echo '<td>
          <div class="ui compact selection dropdown">
            <input type="hidden" name="'.$portfolio_item_add.'item_category" value="">
            <i class="dropdown icon"></i>
            <div class="default text">Category</div>
            <div class="menu">';
              $categories = mysqli_query($con, "SELECT * FROM category")
              or die(mysqli_error());


              while ($row = $categories->fetch_assoc()) {
                echo '<div class="item" data-value="' . $row["category_id"] . '">' . $row["name"] . '</div>';
              }
          echo '</div></div></td>';
          echo '</tr>';
        }

        if (isset($_GET["portfolio_item_add"]) && $_GET["portfolio_item_add"] == "Add Object") {
          $portfolio_item_add += 1;
          addPortfolioItemRow($portfolio_item_add, $con);
        }

         ?>
      </tbody>

      <tfoot class="full-width">
        <tr>
          <th>
            <a>
              <div class="ui fitted checkbox">
              <input type="checkbox"onClick="toggle(this)"> <label></label>
            </div>
            </a>
          </th>
          <th colspan="7">
            <input form="portfolio_item_submit" type="submit" name="portfolio_item_remove" value="Delete" class="ui small negative button">
            <input form="portfolio_item_add" type="submit" name="portfolio_item_add" value="Add Object" class="ui right floated small positive button">
          </th>
        </tr>
      </tfoot>
    </table>
    </form>
    <div class="ui hidden divider">

    </div>
    <input form="portfolio_item_submit" type="submit" name="portfolio_item_submit" class="ui right floated button" value="Submit">
    <form id="portfolio_item_add" method="get" action="#portfolioItemEditSection"></form>

    <br>

    <!-- IMAGE -->
    <div id="imageEditSection" class="ui medium header">Image</div>


    <form id="image_submit" class="" method="post" action="#imageEditSection">
    <table class="ui compact celled definition table" id="image_edit">

      <thead>
        <tr>
          <th></th>
          <th>ID</th>
          <th class="three wide">Title</th>
          <th class="one wide">Alt</th>
          <th class="two wide">Filename</th>
          <th class="">Filepath</th>
          <th class="one wide">Date</th>
          <th class="one wide">Item ID</th>
          <th class="one wide">Thumb</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $image = mysqli_query($con, "SELECT * FROM image")
        or die(mysqli_error());

        $image_add = 0;

        while ($row = $image->fetch_assoc()) {


          $image_add += 1;
          $thumb = $row["thumb"];
          echo '<tr>
                  <td class="collapsing">
                      <div class="ui fitted checkbox">
                      <input type="checkbox" name="image_check[]" value="'.$row["image_id"].'" class="checkbox"> <label></label>
                    </div>
                  </td>';
          echo '<td><input type="hidden" name="'.$image_add.'image_id" value="'.$row["image_id"].'">' . $row["image_id"] . '</td>';
          echo '<td><div class="ui form"><div class="field"><input name="'.$image_add.'image_title" type="text" value="' . $row["title"] . '"></div></div></td>';
          echo '<td><div class="ui form"><div class="field"><input name="'.$image_add.'image_alt" type="text" value="' . $row["alt"] . '"></div></div></td>';
          echo '<td><div class="ui form"><div class="field"><input name="'.$image_add.'image_filename" type="text" value="' . $row["filename"] . '"></div></div></td>';
          echo '<td><div class="ui form"><div class="field"><input name="'.$image_add.'image_filepath" type="text" value="' . $row["filepath"] . '"></div></div></td>';
          echo '<td><div class="ui form"><div class="field"><input name="'.$image_add.'image_date" type="date" value="' . $row["date"] . '"></div></div></td>';
          echo '<td>
          <div class="ui compact selection dropdown">
            <input type="hidden" name="'.$image_add.'image_portfolio_item" value="'. $row["item_id"] . '">
            <i class="dropdown icon"></i>
            <div class="default text">Item ID</div>
            <div class="menu">';
              $portfolio_items = mysqli_query($con, "SELECT * FROM portfolio_item")
              or die(mysqli_error());


              while ($row = $portfolio_items->fetch_assoc()) {
                echo '<div class="item" data-value="' . $row["item_id"] . '">' . $row["title"] . '</div>';
              }
          echo '</div></div></td>';
          echo '<td><div class="inline field">
                  <div class="ui toggle checkbox">
                    <input name="'.$image_add.'image_thumb" type="checkbox" value="1" tabindex="0"';
              if ($thumb == 1) {
                echo 'checked=""';
              }
          echo 'class="hidden">
                    <label></label>
                  </div>
                </div></td>';
          echo '</tr>';



        }

        function addImageRow($image_add, $con) {
          echo '<tr>
                  <td class="collapsing">
                      <div class="ui fitted checkbox">
                      <input type="checkbox"> <label></label>
                    </div>
                  </td>';
          echo '<td><input type="hidden" name="'.$image_add.'image_id" placeholder="ID"></td>';
          echo '<td><div class="ui form"><div class="field"><input name="'.$image_add.'image_title" type="text" placeholder="Title"></div></div></td>';
          echo '<td><div class="ui form"><div class="field"><input name="'.$image_add.'image_alt" type="text" placeholder="Alt"></div></div></td>';
          echo '<td><div class="ui form"><div class="field"><input name="'.$image_add.'image_filename" type="text" placeholder="Filename"></div></div></td>';
          echo '<td><div class="ui form"><div class="field"><input name="'.$image_add.'image_filepath" type="text" placeholder="Filepath"></div></div></td>';
          echo '<td><div class="ui form"><div class="field"><input name="'.$image_add.'image_date" type="date" placeholder="Date"></div></div></td>';
          echo '<td>
          <div class="ui compact selection dropdown">
            <input type="hidden" name="'.$image_add.'image_portfolio_item" value=">
            <i class="dropdown icon"></i>
            <div class="default text">Item ID</div>
            <div class="menu">';
              $portfolio_items = mysqli_query($con, "SELECT * FROM portfolio_item")
              or die(mysqli_error());


              while ($row = $portfolio_items->fetch_assoc()) {
                echo '<div class="item" data-value="' . $row["item_id"] . '">' . $row["title"] . '</div>';
              }
          echo '</div></div></td>';
          echo '<td><div class="inline field">
                  <div class="ui toggle checkbox">
                    <input name="'.$image_add.'image_thumb" type="checkbox" value="1" tabindex="0" class="hidden">
                    <label></label>
                  </div>
                </div></td>';
          echo '</tr>';
        }

        if (isset($_GET["image_add"]) && $_GET["image_add"] == "Add Object") {
          $image_add += 1;
          addImageRow($image_add, $con);
        }

         ?>

       </tbody>

       <tfoot class="full-width">
         <tr>
           <th>
             <a>
               <div class="ui fitted checkbox">
               <input type="checkbox"onClick="toggle(this)"> <label></label>
             </div>
             </a>
           </th>
           <th colspan="8">
             <input form="image_submit" type="submit" name="image_remove" value="Delete" class="ui small negative button">
             <input form="image_add" type="submit" name="image_add" value="Add Object" class="ui right floated small positive button">
           </th>
         </tr>
       </tfoot>
     </table>

     </form>
     <div class="ui hidden divider">

     </div>
     <input form="image_submit" type="submit" name="image_submit" class="ui right floated button" value="Submit">
     <form id="image_add" method="get" action="#imageEditSection"></form>
  </div>
</div>



<?php

//PORTFOLIO

$portfolio_result = mysqli_query($con, "SELECT * FROM portfolio");
$portfolio_num_rows = mysqli_num_rows($portfolio_result);


  if(isset($_POST["portfolio_submit"])){
    for ($i=1; $i <= $portfolio_add; $i++) {
    $portfolio_id = $_POST[$i . 'portfolio_id'];
    $title = $_POST[$i . 'portfolio_title'];
    $desc = $_POST[$i . 'portfolio_desc'];

    $sql = "UPDATE portfolio SET title = '$title', `desc` = '$desc' WHERE portfolio_id = '$portfolio_id'";

    if (!$con->query ($sql)) {
      echo "Noe gikk galt! $sql ($con->error($sql)) .";
    }

    $sql = mysqli_query($con, "SELECT * FROM portfolio")
    or die(mysqli_error());

    if ($portfolio_num_rows < $portfolio_add && $i > $portfolio_num_rows) {
      $sql = "INSERT INTO portfolio (title, `desc`) VALUES ('$title', '$desc')";
      if (!$con->query ($sql)) {
        echo "Noe gikk galt! $sql ($con->error($sql)) .";
      }

    }
  }
  echo "<meta http-equiv='refresh' content='0;url=index.php#portfolioEditSection'>";
} elseif(isset($_POST["portfolio_remove"])) {
  $checkbox = $_POST['portfolio_check'] ?? '';

  foreach ($checkbox as $value){
    $sql = "DELETE FROM portfolio WHERE portfolio_id = $value" ;
    if($con->query($sql)){
     } else {
       echo "Noe gikk galt med spørringen $sql ($con->error).";
     }
  }
  echo "<meta http-equiv='refresh' content='0;url=index.php#portfolioEditSection'>";
}

//CATEGORY

$category_result = mysqli_query($con, "SELECT * FROM category");
$category_num_rows = mysqli_num_rows($category_result);


  if(isset($_POST["category_submit"])){
    for ($i=1; $i <= $category_add; $i++) {
    $category_id = $_POST[$i . 'category_id'];
    $name = $_POST[$i . 'category_name'];
    $desc = $_POST[$i . 'category_desc'];
    $portfolio = $_POST[$i . 'category_portfolio'];

    $sql = "UPDATE category SET name = '$name', `desc` = '$desc', portfolio_id = '$portfolio' WHERE category_id = '$category_id'";

    if (!$con->query ($sql)) {
      echo "Noe gikk galt! $sql ($con->error($sql)) .";
    }

    $sql = mysqli_query($con, "SELECT * FROM category")
    or die(mysqli_error());

    if ($category_num_rows < $category_add && $i > $category_num_rows) {
      $sql = "INSERT INTO category (name, `desc`, portfolio_id) VALUES ('$name', '$desc', '$portfolio')";
      if (!$con->query ($sql)) {
        echo "Noe gikk galt! $sql ($con->error($sql)) .";
      }

    }
  }
  echo "<meta http-equiv='refresh' content='0;url=index.php#categoryEditSection'>";
} elseif(isset($_POST["category_remove"])) {
  $checkbox = $_POST['category_check'] ?? '';

  foreach ($checkbox as $value){
    $sql = "DELETE FROM category WHERE category_id = $value" ;
    if($con->query($sql)){
     } else {
       echo "Noe gikk galt med spørringen $sql ($con->error).";
     }
  }
  echo "<meta http-equiv='refresh' content='0;url=index.php#categoryEditSection'>";
}

//CLIENT

$client_result = mysqli_query($con, "SELECT * FROM client");
$client_num_rows = mysqli_num_rows($client_result);


  if(isset($_POST["client_submit"])){
    for ($i=1; $i <= $client_add; $i++) {
    $client_id = $_POST[$i . 'client_id'] ?? '';
    $name = $_POST[$i . 'client_name'];
    $desc = $_POST[$i . 'client_desc'];

    $sql = "UPDATE client SET name = '$name', `desc` = '$desc' WHERE client_id = '$client_id'";

    if (!$con->query ($sql)) {
      echo "Noe gikk galt! $sql ($con->error($sql)) .";
    }

    $sql = mysqli_query($con, "SELECT * FROM client")
    or die(mysqli_error());

    if ($client_num_rows < $client_add && $i > $client_num_rows) {
      $sql = "INSERT INTO client (name, `desc`) VALUES ('$name', '$desc')";
      if (!$con->query ($sql)) {
        echo "Noe gikk galt! $sql ($con->error($sql)) .";
      }

    }
  }
  echo "<meta http-equiv='refresh' content='0;url=index.php#clientEditSection'>";
} else if(isset($_POST["client_remove"])) {
  $checkbox = $_POST['client_check'] ?? '';

  foreach ($checkbox as $value){
    $sql = "DELETE FROM client WHERE client_id = $value" ;
    if($con->query($sql)){
     } else {
       echo "Noe gikk galt med spørringen $sql ($con->error).";
     }
  }
  echo "<meta http-equiv='refresh' content='0;url=index.php#clientEditSection'>";
}

//PORTFOLIO ITEM

$portfolio_item_result = mysqli_query($con, "SELECT * FROM portfolio_item");
$portfolio_item_num_rows = mysqli_num_rows($portfolio_item_result);

  if(isset($_POST["portfolio_item_submit"])){
    for ($i=1; $i <= $portfolio_item_add; $i++) {
    $item_id = $_POST[$i . 'item_id'] ?? '';
    $title = $_POST[$i . 'item_title'];
    $desc = $_POST[$i . 'item_desc'];
    $date = $_POST[$i . 'item_date'];
    $client = $_POST[$i . 'item_client'];
    $category = $_POST[$i . 'item_category'];


    $sql = "UPDATE portfolio_item SET title = '$title', `desc` = '$desc', `date` = '$date', client_id = '$client', category_id = '$category' WHERE item_id = '$item_id'";

    if (!$con->query ($sql)) {
      echo "Noe gikk galt! $sql ($con->error($sql)) .";
    }

    $sql = mysqli_query($con, "SELECT * FROM portfolio_item")
    or die(mysqli_error());

    if ($portfolio_item_num_rows < $portfolio_item_add && $i > $portfolio_item_num_rows) {
      $sql = "INSERT INTO portfolio_item (title, `desc`, `date`, client_id, category_id) VALUES ('$title', '$desc', '$date', '$client', '$category')";
      if (!$con->query ($sql)) {
        echo "Noe gikk galt! $sql ($con->error($sql)) .";
      }

    }
  }
  echo "<meta http-equiv='refresh' content='0;url=index.php#portfolioItemEditSection'>";
} elseif(isset($_POST["portfolio_item_remove"])) {
  $checkbox = $_POST['item_check'] ?? '';

  foreach ($checkbox as $value){
    $sql = "DELETE FROM portfolio_item WHERE item_id = $value" ;
    if($con->query($sql)){
     } else {
       echo "Noe gikk galt med spørringen $sql ($con->error).";
     }
  }
  echo "<meta http-equiv='refresh' content='0;url=index.php#portfolioItemEditSection'>";
}

//IMAGE

$image_result = mysqli_query($con, "SELECT * FROM image");
$image_num_rows = mysqli_num_rows($image_result);

  if(isset($_POST["image_submit"])){
    for ($i=1; $i <= $image_add; $i++) {
    $image_id = $_POST[$i . 'image_id'] ?? '';
    $title = $_POST[$i . 'image_title'];
    $alt = $_POST[$i . 'image_alt'];
    $filename = $_POST[$i . 'image_filename'];
    $filepath = $_POST[$i . 'image_filepath'];
    $date = $_POST[$i . 'image_date'];
    $portfolio_item = $_POST[$i . 'image_portfolio_item'];
    $thumb = $_POST[$i . 'image_thumb'] ?? '0';


    $sql = "UPDATE image SET title = '$title', alt = '$alt', filename = '$filename', filepath = '$filepath', `date` = '$date', item_id = '$portfolio_item', thumb = '$thumb' WHERE image_id = '$image_id'";

    if (!$con->query ($sql)) {
      echo "Noe gikk galt! $sql ($con->error($sql)) .";
    }

    $sql = mysqli_query($con, "SELECT * FROM image")
    or die(mysqli_error());

    if ($image_num_rows < $image_add && $i > $image_num_rows) {
      $sql = "INSERT INTO image (title, alt, filename, filepath, `date`, item_id, thumb) VALUES ('$title', '$alt', '$filename', '$filepath', '$date', '$portfolio_item', '$thumb')";
      if (!$con->query ($sql)) {
        echo "Noe gikk galt! $sql ($con->error($sql)) .";
      }

    }
  }
  echo "<meta http-equiv='refresh' content='0;url=index.php#imageEditSection'>";
} elseif(isset($_POST["image_remove"])) {
  $checkbox = $_POST['image_check'] ?? '';

  foreach ($checkbox as $value){
    $sql = "DELETE FROM image WHERE image_id = $value" ;
    if($con->query($sql)){
     } else {
       echo "Noe gikk galt med spørringen $sql ($con->error).";
     }
  }
  echo "<meta http-equiv='refresh' content='0;url=index.php#imageEditSection'>";
}
}
?>
