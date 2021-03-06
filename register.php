<?php  include('server.php') ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="sv">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="modell.css"/>
    <link rel="icon" href="images/JG.png">
    <title>Purple RoTa</title>
    <script src="script.js"></script>
</head>
<nav class="grad">
    <div class="table">
        <ul>
            <li><a href="index.php">Home</a></li>
        </ul>
    </div>
    <div class="dropdown">
        <button onclick="myFunction()" class="dropbtn">&#8801;</button>
        <div id="myDropdown" class="dropdown-content">
            <li><a href="index.php">Home</a></li>
        </div>
    </div>
</nav>
<header class="grad2">
    <h1>PHP Stuff</h1>
</header>

<body>


<article>
    <div class="sitecontent">
            <h3>Register</h3>
        <form method="post" action="register.php">
            <?php include('errors.php'); ?>
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" value="<?php echo $username; ?>">
            </div>
            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $email; ?>">
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password_1">
            </div>
            <div class="input-group">
                <label>Confirm password</label>
                <input type="password" name="password_2">
            </div>
            <div class="input-group">
                <button type="submit" class="btn" name="reg_user">Register</button>
            </div>
        </form>

    </div>
</article>
<footer>
    <div class="footer">
        <h1>&copy;2017, Joakim Granqvist</h1>
    </div>
    <div class="footer">
        <p>
            Bakgrundsbilden:</p>
        <p>
            <a href="https://pixabay.com/en/background-mesh-triangle-polygon-1409125/">Bilden</a><br>
            <a href="https://creativecommons.org/publicdomain/zero/1.0/deed.en">CC0 Public Domain</a><br>
            Free for commercial use, No attribution required
        </p>
    </div>
    <div class="footer">
        <p>
            Rubrik Fonten:</p>
        <p>
            <a href="https://fonts.google.com/specimen/Orbitron?selection.family=Orbitron">Orbitron</a><br>
            <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&id=OFL_web">Open Font License</a>
        </p>
    </div>
</footer>
</body>
</html>
