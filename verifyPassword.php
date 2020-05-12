<?php

$password = 'nice2020';
$password_inputted_by_user = 'nice2020';

//PASSWORD_BCRYPT or PASSWORD_DEFAULT use any in the 2nd parameter
/*
PASSWORD_BCRYPT always results 60 characters long string.
PASSWORD_DEFAULT capacity is beyond 60 characters
*/
$password_encrypted = password_hash($password, PASSWORD_BCRYPT);


if (password_verify($password_inputted_by_user, $password_encrypted)) {
    // Success!
    echo 'Password Matches';
}else {
    // Invalid credentials
    echo 'NO';
}

?>