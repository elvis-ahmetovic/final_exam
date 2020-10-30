<?php require_once('../config/init.php'); ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="index.php">Be Best Version of Yourself</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse ml-5" id="navbarSupportedContent">
        <ul class="navbar-nav">

        <?php if(isLoggedIn()) : ?>

            <li class="nav-item">
                <a href="index.php">Index</a>
            </li>
            <li class="nav-item">
                <a href="index.php#coaches">Coaches</a>
            </li>
            <li class="nav-item">
                <a href="index.php#contact">Contact</a>
            </li>
            <li class="nav-item">
                <a href="profile.php?id=<?php echo $_SESSION['user_id']; ?>"><img src="templates/images/avatars/<?php echo $_SESSION['avatar']; ?>" alt="avatar"><span>&nbsp;<?php echo ucfirst($_SESSION['name']); ?></span></a>
            </li>
            <li class="nav-item">
                <a href="messages.php" class="d-table">Messages
                    <?php if($unreadedMessages): ?> 
                        <span class="badge badge-light ml-2"><?php echo $unreadedMessages; ?> </span>
                    <?php else: ?> 

                    <?php endif; ?> 
                </a>
            </li>

            <?php if(isUserAdmin()) : ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle pt-0 mt-1" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="mx-3 pl-2" href="administration.php">Administration</a>
                        <hr>
                        <form action="index.php" method="POST" class="mx-3">
                            <input class="admin-logout" type="submit" name="logout" value="Logout">
                        </form>
                    </div>
                </li>

            <?php else : ?>

                <li class="nav-item">
                    <form action="index.php" method="POST" class="ml-3">
                        <input class="logout" type="submit" name="logout" value="Logout">
                    </form>
                </li>

            <?php endif; ?>

        <?php else : ?>

            <li class="nav-item">
                <a href="index.php">Index</a>
            </li>
            <li class="nav-item">
                <a href="index.php#coaches">Coaches</a>
            </li>
            <li class="nav-item dropdown">
                <a href="index.php#contact">Contact</a>
            </li>
            <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle pt-0 mt-1" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="mx-3 pl-2" href="administration.php">Administration</a>
                        </div>
                    </a>
                </li>

        <?php endif; ?>

        </ul>
    </div>
</nav>

