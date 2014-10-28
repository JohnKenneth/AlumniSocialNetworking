<?php

// Inialize session
session_start();

// Delete certain session
unset($_SESSION['studInfo']);
unset($_SESSION['adminInfo']);
// Delete all session variables
// session_destroy();

// Jump to login page

header('Location: ?notif=logout');

?>


<!--Done--!>