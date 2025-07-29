<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "Access denied. Please <a href='login.php'>login</a>.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Resources - Debate Club</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">
    <h2 class="mb-4">Debate Resources</h2>

    <form id="search-form" class="mb-3">
        <input type="text" id="search-query" class="form-control" placeholder="Search resources...">
    </form>

    <div id="resource-list"></div>

    <script>
    function loadResources(query = '') {
        fetch('load_resources.php?q=' + encodeURIComponent(query))
            .then(res => res.text())
            .then(data => document.getElementById('resource-list').innerHTML = data);
    }
    loadResources();

    document.getElementById('search-query').addEventListener('input', function() {
        loadResources(this.value);
    });
    </script>
</body>
</html>
