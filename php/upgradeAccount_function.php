<?php
include '../config/db_conn.php';
session_start();

if (!isset(
    $_POST['category'],
    $_POST['specific-service']
)) {
    exit('Empty Field(s)');
}

if (empty($_POST['category'] ||
    empty($_POST['specific-service']))) {
    exit('Values Empty');
}

if ($stmt = $conn->prepare('SELECT user_provider.SP_id, subcategory.Subcategory_id FROM user_provider INNER JOIN subcategory ON user_provider.Subcategory_id=subcategory.Subcategory_id WHERE user_provider.user_id = :user_id AND subcategory.Subcategory = :subcat')) {
    $stmt->execute([':user_id' => $_SESSION['user_id'], ':subcat' => $_POST['specific-service']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($row);
    echo $_POST['upgrade-account-description'];

    if ($row !== false) {
        echo 'Service/s Existed. Choose Again';
    } else {
        if ($stmt = $conn->prepare('INSERT INTO user_provider(user_id, Subcategory_id ,Service_description)
        VALUES (?,?,?)')) {
            $stmt->execute([$_SESSION['user_id'],
                $_POST['specific-service'],
                $_POST['upgrade-account-description']]);
            header("Location: /../OOP/practice/user-account/includes/promote.php"); //diretso sa promote tab pre
            // echo 'Successfully Registered';
        } else {
            echo 'Error Occurred';
        }
    }

    if (isset($_SESSION['username'])) {
        echo "Your session is running " . $_SESSION['username'];
    } else {
        echo "fuck";
    }
}
