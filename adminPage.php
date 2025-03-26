<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<body>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="css/adminPage.css">
    </head>
    <body>
        <div class="container">
            <aside class="sidebar">
                <h2>Admin Panel</h2>
                <ul>
                    <li><a href="#dashboard">Dashboard</a></li>
                    <li><a href="upload.php">Manage Papers</a></li>
                    <li><a href="adminUsers.php">Users</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </aside>
            <main class="main-content">
                <header>
                    <h1>Welcome to the Admin Dashboard</h1>
                </header>
                <section id="users">
                    <h2>Papers</h2>
                    <p>This includes Papers management functionalities.</p>
                </section>
                <section  id="settings">
                    <h2>Settings</h2>
                    <p>This includes various users of this Admin Panel</p>
                </section>
            </main>
        </div>
    </body>
    </html>
</body>
</html><?php
include("adminPageButton.php"); ?>