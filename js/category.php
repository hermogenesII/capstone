<?php
session_start();

require "/xampp/htdocs/OOP/js/index.class.php";
$category = $_POST['category'];
$location = $_POST['location'];
if (isset($_POST['category']) || isset($_POST['location'])) {
    if ($category === "" && $location === "") {
        $providers = getAllCategory();
    } else if ($category !== "" && $location === "") {
        $providers = getProviderByCategory($category);
    } else if ($category === "" && $location !== "") {
        $providers = getProviderByLocation($location);
    } else {
        $providers = getProviderByCategoryAndLocation($category, $location);
    }
    echo json_encode($providers);
}
