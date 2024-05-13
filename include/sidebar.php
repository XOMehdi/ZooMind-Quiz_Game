<link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
<link rel="stylesheet" type="text/css" href="../css/sidebar.css">
</head>

<body>
    <div class="cover">
        <input type="checkbox" id="check">
        <label for="check">
            <i class='bx bx-menu' id="btn"></i>
            <i class='bx bx-window-close' id="cancel"></i>
        </label>
        <div class="sidebar">
            <div id="header"><b>MENU</b></div>
            <ul>
                <li><a href="../index.html"><i class='bx bx-home'></i>Home</a></li>
                <li><a href="./create.php"><i class='bx bx-edit'></i>Create</a></li>
                <li><a href="./explore.php"><i class='bx bx-compass'></i>Explore</a></li>
                <li><a href="./profile.php"><i class='bx bx-user-circle'></i>Profile</a></li>
                <li><a href="./favourite.php"><i class='bx bxs-heart'></i>Favourites</a></li>
                <li><a href="./about.php"><i class='bx bx-info-circle'></i>About</a></li>
                <?php
                $user_state = (isset($_SESSION['username'])) ? "signed_in" : "signed_out";

                if ($user_state === "signed_in") {
                    echo "<li id='sign_up-in-out'><a href='../sign_out.php'><i class='bx bx-user'></i>Sign out</a></li>";
                } else {
                    echo "<li id='sign_up-in-out'><a href='../index.html'><i class='bx bx-user'></i>Sign up / Sign in</a></li>";
                } ?>
            </ul>
        </div>
    </div>