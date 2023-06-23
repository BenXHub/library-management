<?php

/**
 * Establishes a connection to the MySQL database.
 *
 * @return mysqli|null The database connection object or null on failure.
 */
function connection()
{
    $config = [
        'host'   => 'localhost',
        'user'   => 'root',
        'pass'   => '',
        'dbname' => 'library_management'
    ];

    $con = new mysqli($config['host'], $config['user'], $config['pass'], $config['dbname']);

    if ($con->connect_error) {
        die(json_encode([
            'error' => $con->connect_error
        ]));
    }

    return $con;
}
