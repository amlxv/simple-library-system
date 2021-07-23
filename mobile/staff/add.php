<?php

/** 
 * File Name           : staff/add.php
 * Project Name        : Simple Library System
 * Author              : amlxv
 * Github Profile      : https://github.com/amlxv
 * Github Repositories : https://github.com/amlxv/simple-library-system
 * Version             : 1.0 - Initial Release
 */

require '../../config.php';

/**
 * :: Add Staff
 * 
 */

if (!empty($_POST)) {

    // Get post data
    $table       = 'staff';
    $id          = $_POST['id'];
    $name        = $_POST['name'];
    $phone_num   = $_POST['phone'];
    $password    = $_POST['password'];

    // Database connection
    $db = new mysqli($db_conf['host'], $db_conf['username'], $db_conf['password'], $db_conf['db_name']) or die;


    // Encrypt password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Find the user with his/her ID
    $sql = "INSERT INTO $table (id, name, password, phone_num) VALUES ('$id', '$name', '$hashed_password', '$phone_num')";

    // Execute
    if ($db->query($sql)) {
        echo "A new staff has been added!";
    } else {
        echo "Failed. Reason: " . $db->error;
    }
}