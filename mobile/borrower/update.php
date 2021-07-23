<?php

/** 
 * File Name           : borrower/update.php
 * Project Name        : Simple Library System
 * Author              : amlxv
 * Github Profile      : https://github.com/amlxv
 * Github Repositories : https://github.com/amlxv/simple-library-system
 * Version             : 1.0 - Initial Release
 */

require '../../config.php';

/**
 * :: Update Borrower
 * 
 */

if (!empty($_POST)) {

    // Get post data
    $table       = 'borrower';
    $id          = $_POST['id'];
    $name        = $_POST['name'];
    $phone_num   = $_POST['phone'];
    $password    = $_POST['password'];

    // Database connection
    $db = new mysqli($db_conf['host'], $db_conf['username'], $db_conf['password'], $db_conf['db_name']) or die;

    // Check the id
    $result = $db->query("SELECT * FROM $table WHERE id='$id'");
    if ($result->num_rows < 1) {
        echo "The Borrower's ID does not exist";
        return;
    }

    // Encrypt password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Create default update query
    $sql = "UPDATE $table SET name='$name', password='$hashed_password', phone_num='$phone_num' WHERE id='$id'";

    // Execute
    if ($db->query($sql)) {
        echo "The borrower information has been updated!";
    } else {
        echo "Failed. Reason: " . $db->error;
    }
}