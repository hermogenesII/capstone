<?php
function getAllCategory()
{
    // session_start();

    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
    } else {
        $id = null;
    }

    include '/xampp/htdocs/OOP/config/db_conn.php';
    // $sql = "SELECT user_provider.SP_id,user.user_id, user.fname, user.mname, user.lname, user_provider.Service_description, images.image_filename FROM user_provider
    // INNER JOIN user ON user_provider.user_id=user.user_id
    // LEFT JOIN images ON user.user_id=images.user_id AND images.image_type = 'profile'  WHERE user.user_id != '$id'
    $sql = "SELECT DISTINCT user.user_id, user.fname, user.mname, user.lname, images.image_filename, provider_description.description FROM user_provider
	INNER JOIN user ON user_provider.user_id=user.user_id LEFT JOIN provider_description ON user.user_id=provider_description.user_id
    LEFT JOIN images ON user.user_id=images.user_id AND images.image_type = 'profile'  WHERE user.user_id != '$id'ORDER BY RAND()";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();

    $providers = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $providers[] = $row;
    }
    return $providers;
}

function getProviderByCategory($category)
{

    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
    } else {
        $id = null;
    }
    include '/xampp/htdocs/OOP/config/db_conn.php';

    // $sql = "SELECT user_provider.*, user.fname, user.mname, user.lname, subcategory.*, category.*, images.image_filename FROM user_provider INNER JOIN user ON user_provider.user_id=user.user_id INNER JOIN subcategory ON user_provider.Subcategory_id=subcategory.Subcategory_id INNER JOIN category ON subcategory.category_id=category.category_id LEFT JOIN images ON user.user_id=images.user_id AND images.image_type = 'profile'  WHERE category.Category = '$category'
    // AND user.user_id != '$id' ORDER BY RAND();";
    $sql = "SELECT DISTINCT user.user_id, user.fname, user.mname, user.lname, category.*, images.image_filename, provider_description.description FROM user_provider INNER JOIN user ON user_provider.user_id=user.user_id INNER JOIN subcategory ON user_provider.Subcategory_id=subcategory.Subcategory_id INNER JOIN category ON subcategory.category_id=category.category_id LEFT JOIN images ON user.user_id=images.user_id AND images.image_type = 'profile' LEFT JOIN provider_description ON provider_description.user_id=user.user_id WHERE category.Category = '$category'
    AND user.user_id != '$id' ORDER BY RAND();";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();

    $providers = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $providers[] = $row;
    }
    return $providers;
    return $id;
}

function getProviderByLocation($location)
{

    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
    } else {
        $id = null;
    }
    include '/xampp/htdocs/OOP/config/db_conn.php';
    $sql = "SELECT DISTINCT user.user_id, user.fname, user.mname, user.lname, municipality.municipality_name, images.image_filename, provider_description.description FROM user_provider INNER JOIN user ON user_provider.user_id=user.user_id INNER JOIN barangay ON user.address=barangay.barangay_code INNER JOIN municipality ON barangay.municipality_code=municipality.municipality_code LEFT JOIN images ON user.user_id=images.user_id AND images.image_type = 'profile' LEFT JOIN provider_description ON provider_description.user_id=user.user_id WHERE municipality.municipality_name = '$location'
    AND user.user_id != '$id' ORDER BY RAND();";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();

    $providers = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $providers[] = $row;
    }
    return $providers;
    return $id;
}

function getProviderByCategoryAndLocation($category, $location)
{

    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
    } else {
        $id = null;
    }
    include '/xampp/htdocs/OOP/config/db_conn.php';
    $sql = "SELECT DISTINCT user.user_id, user.fname, user.mname, user.lname, municipality.municipality_name, category.*, images.image_filename, provider_description.description FROM user_provider INNER JOIN user ON user_provider.user_id=user.user_id INNER JOIN barangay ON user.address=barangay.barangay_code INNER JOIN municipality ON barangay.municipality_code=municipality.municipality_code INNER JOIN subcategory ON user_provider.Subcategory_id=subcategory.Subcategory_id INNER JOIN category ON subcategory.category_id=category.category_id LEFT JOIN images ON user.user_id=images.user_id AND images.image_type = 'profile' LEFT JOIN provider_description ON provider_description.user_id=user.user_id WHERE category.Category = '$category' AND municipality.municipality_name = '$location'
    AND user.user_id != '$id' ORDER BY RAND();";
    $stmt = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $stmt->execute();

    $providers = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $providers[] = $row;
    }
    return $providers;
    return $id;
}
