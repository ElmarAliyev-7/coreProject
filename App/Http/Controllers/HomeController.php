<?php

namespace App\Http\Controllers;

require_once 'System/View.php';
use System\View;
use PDO;

class HomeController
{
    /**
     * @return bool|string
     */
    public function index(): bool|string
    {
        global $conn;
        $stmt = $conn->prepare('SELECT * FROM blogs');
        $stmt->execute();
        $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return View::show('home', ['blogs' => $blogs]);
    }
}
