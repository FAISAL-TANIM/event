<?php error_reporting(E_ALL ^ E_NOTICE)?>

<?php
include_once "../../../controller/serviceController/CaterersController.php";

$result = getCaterersByHighPrice();
// for Table row==========================================================
if (isset($_POST["bookPackage"])) {
    if (isset($_SESSION["shoppingCart"])) {
        $item_array_id = array_column($_SESSION["shoppingCart"], "itemId");
        if (!in_array($_POST["hiddenPackageId"], $item_array_id)) {
            $count = count($_SESSION["shoppingCart"]) + 1;
            $item_array = array(
                'itemId' => $_POST["hiddenPackageId"],
                'itemName' => $_POST["hiddenPackageName"],
                'itemPrice' =>  $_POST["hiddenPrice"],
                'itemTransportCost' => $_POST["hiddenTransportCost"],
                'itemVendor' =>  $_POST["hiddenVendor"]
            );
            $_SESSION["shoppingCart"][$count] = $item_array;
        } else {
            @include_once "../../errors/alreadyAddedPackage.php";
        }
    } else {
        $item_array = array(
            'itemId' => $_POST["hiddenPackageId"],
            'itemName' => $_POST["hiddenPackageName"],
            'itemPrice' => $_POST["hiddenPrice"],
            'itemTransportCost' => $_POST["hiddenTransportCost"],
            'itemVendor' => $_POST["hiddenVendor"]
        );
        $_SESSION["shoppingCart"][0] = $item_array;
    }
}
?>

<?php

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rating = $row["rating"] * 20;
        ?>
        <form method="post" action="caterers.php">
            <div class="venues-slide first">
                <div class="img">
                    <img src="<?php echo $row["image"]; ?>">
                </div>
                <div class="text">
                    <h3><?php echo $row["package_name"]; ?></h3>
                    <input type="hidden" name="hiddenPackageName" value="<?php echo $row["package_name"]; ?>" />
                    <input type="hidden" name=hiddenPackageId value=<?php echo $row["id"]  ?>>
                    <div class=reviews> <?php echo $row["rating"]; ?>
                        <div class=star>
                            <div class=fill style="width: <?php echo   $rating; ?>%"></div>
                        </div>reviews</div>
                    <div class="outher-info">
                        <div class="info-slide first">
                            <label>Price</label>
                            <span> <?php echo $row["price"]; ?> </span>
                            <input type="hidden" name="hiddenPrice" value="<?php echo $row["price"]; ?>" />
                        </div>
                        <div class="info-slide">
                            <label>Transport cost</label>
                            <span> <?php echo $row["transport_cost"]; ?> <small> (Your)</small></span>
                            <input type="hidden" name="hiddenTransportCost" value="<?php echo $row["transport_cost"]; ?>" />
                        </div>
                        <div class="info-slide">
                            <label>Available</label>
                            <span> <?php echo $row["available_status"]; ?> <small> </small></span>
                            <input type="hidden" name="hiddenAvailableStatus" />
                        </div>
                    </div>
                    <div class="outher-link">
                        <span> <?php echo $row["vendor_username"]; ?> <small> (vendor)</small></span>
                        <input type="hidden" name="hiddenVendor" value="<?php echo $row["vendor_username"]; ?>" />
                    </div>
                    <?php
                            if ($row["available_status"] == "yes" || $row["available_status"] == "Yes") {
                                ?>
                        <div class="button">
                            <input type="submit" class="btn" name="bookPackage" value="Book Now" />
                        </div>
                    <?php
                            }

                            ?>




                </div>
            </div>
        </form>
<?php
    }
} else {
    include_once "../../errors/spinner.php";
}
?>