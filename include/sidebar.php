<link rel="icon" type="image/x-icon" href="../img/site_logo.ico">
<link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>

<body>
    <div id="sidebar-box">
        <input type="checkbox" id="check">
        <label for="check">
            <i class='bx bx-menu' id="btn"></i>
            <i class='bx bx-window-close' id="cancel"></i>
        </label>
        <div id="sidebar-items-box">
            <h2 id="sidebar-header">Menu</h2>
            <ul>
                <li><a href="../index.html"><i class='bx bx-home menu-icon'></i>Home</a></li>
                <li><a href="./create.php"><i class='bx bx-edit menu-icon'></i>Create</a></li>
                <li><a href="./explore.php"><i class='bx bx-compass menu-icon'></i>Explore</a></li>
                <li><a href="./profile.php"><i class='bx bx-user-circle menu-icon'></i>Profile</a></li>
                <li><a href="./favourite.php"><i class='bx bx-heart menu-icon'></i>Favourites</a></li>
                <li><a href="./about.php"><i class='bx bx-info-circle menu-icon'></i>About</a></li>
                <?php
                $user_state = (isset($_SESSION['username'])) ? "signed_in" : "signed_out";

                if ($user_state === "signed_in") {
                    echo "<li id='sign_up-in-out'><a href='../sign_out.php'><i class='bx bx-user menu-icon'></i>Sign out</a></li>";
                } else {
                    echo "<li id='sign_up-in-out'><a href='../index.html'><i class='bx bx-user menu-icon'></i>Sign up / Sign in</a></li>";
                } ?>
            </ul>
        </div>
    </div>