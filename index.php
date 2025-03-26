<?php
session_start();
include("connect.php");
?>
<?php
include("header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question Bank Management System</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <section class="hero">
        <div class="container">
            <h2>What are you looking for ??</h2>
            <p>Get your important papers , assignments and many more...</p>
         
            <a href="search.php" class="btn-primary">Search Anything </a>
        </div>
    </section>
    <section class="features">
        <div class="container">
            <h2>Our Features</h2>
            <div class="feature-grid">
                <div class="feature-item">
                    <h3>Previous year question papers </h3>
                    <p>Easy access to previous year question papers</p> 
                </div>
                <div class="feature-item">
                    <h3>Advanced Search</h3>
                    <p>Find specific questions papers quickly using subject code</p>
                </div>
                <div class="feature-item">
                    <h3>Notes</h3>
                    <p>Notes according to subject code</p>
                </div>
                <div class="feature-item">
                    <h3>Solutions </h3>
                    <p>Solutions to previous year question papers</p>
                </div>
            </div>
        </div>
    </section>
    <section class="cta">
        <div class="container">
            <h2>Boost Up Your Studies</h2>
            <a href="login.php" class="btn-primary">login to upload </a>
        </div>
    </section>
</body>
</html>
<?php 
include("homeButton.php");?>