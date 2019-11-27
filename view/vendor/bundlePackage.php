<?php error_reporting(E_ALL ^ E_NOTICE)?>

<?php
@include_once "../../controller/serviceController/CaterersController.php";

$result = getAllBundlePackage();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rating = $row["rating"] * 20;
        echo '<div class="venues-slide first">';
        echo '<div class="img" >';
        echo "<img src=" . substr($row["image"],3) . " style=max-height:260px>";
        echo '</div>';
        echo '<div class="text">';
        echo     "<h3>" . $row["package_name"] . "</h3>";
        echo "    <div class=reviews>" . $row["rating"] . "<div class=star>";
        echo "        <div class=fill style=width:" . $rating . "% ></div>";
        echo '        </div>reviews</div>';
        echo '    <div class="outher-info">';
        echo '        <div class="info-slide first">';
        echo '            <label>Price</label>';
        echo             "<span>" . $row["price"] . "</span>";
        echo '        </div>';
        echo '        <div class="info-slide">';
        echo '            <label>Transport cost</label>';
        echo             "<span>" . $row["transport_cost"] . "<small>  (Onwards)</small></span>";
        echo '        </div>';
        echo '        <div class="info-slide">';
        echo '            <label>Available</label>';
        echo              "<span>" . $row["available_status"] . "<small>  (status)</small></span>";
        echo '        </div>';
        echo '    </div>';
        echo '</div>';
    }
} else {
    echo "Empty";
}
?>;