<?php

/* Host name of the MySQL server */
$host = 'localhost';

/* MySQL account username */
$user = 'root';

/* MySQL account password */
$passwd = '6LDYYk^sGN7-EpC-!mrBZ*BSAsHY8fKQ';

/* The schema you want to use */
$schema = 'carcovers';

/* Connection with MySQLi, procedural-style */
$conn = mysqli_connect($host, $user, $passwd, $schema);

/* Check if the connection succeeded */
if (!$conn)
{
   echo 'Connection failed<br>';
   echo 'Error number: ' . mysqli_connect_errno() . '<br>';
   echo 'Error message: ' . mysqli_connect_error() . '<br>';
   die();
}