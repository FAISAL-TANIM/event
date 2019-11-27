<?php
@include_once "../../model/SinglePackage.php";

function getAllSinglePackage()
{
    $connection = mysqli_connect("localhost", "root", "", "event_organizer");
    if (!$connection) {
        return -1;
    }
    $query = "SELECT * from single_package where vendor_username = '" . $_SESSION['username'] . "'";
    $result = $connection->query($query);
    return $result;
    mysqli_close($connection);
}
function getAllBundlePackage()
{
    $connection = mysqli_connect("localhost", "root", "", "event_organizer");
    if (!$connection) {
        return -1;
    }
    // $query = "SELECT * from single_package ORDER BY Price";
    // $result = $connection->query($query);
    // return $result;
    mysqli_close($connection);
}
function insertSinglePackage(SinglePackage $singlePackage)
{
    $connection = mysqli_connect("localhost", "root", "", "event_organizer");
    if (!$connection) {
        return -1;
    }

    $query = "INSERT into single_package (category, package_type, package_name,vendor_username,price, transport_cost, available_status, image, rating ) 
    VALUES ('" . $singlePackage->getCategory() . "' , '" . $singlePackage->getPackageType() . "', '" . $singlePackage->getPackageName() . "','" . $singlePackage->getVendorName() . "','" . $singlePackage->getPrice() . "','" . $singlePackage->getTransportCost() . "','" . $singlePackage->getAvailableStatus() . "','" . "../../packageImage/singlePackagePicture/" . $singlePackage->getImage() . "','') ";
    if (mysqli_query($connection, $query)) {
        return 1;
    } else {
        return 0;
    }
    mysqli_close($connection);
}
