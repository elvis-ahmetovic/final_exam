<?php include('includes/head.php'); ?>

<?php if(isLoggedIn() && isUserAdmin() || isAdmin()): ?>

    <h2 class="display-4 text-center">Administration</h2>

    <div class="">
        <div class="d-flex flex-column flex-md-row justify-content-center py-3 admin-links">
            <a href="adminUsers.php?users" title="Show all users"><p class="infoMsg mr-md-3">Users: <?php echo $usersNum; ?></p></a>
            <a href="adminUsers.php?coaches" title="Show all coaches"><p class="infoMsg">Coaches: <?php echo $coachesNum; ?></p></a>
            <a href="adminUsers.php?banned" title="Show all banned users"><p class="infoMsg ml-md-3">Banned: <?php echo $bannedUsers; ?></p></a>
            <p class="infoMsg ml-md-3">Total Users: <?php echo $allUsers; ?></p>
        </div>

        <div class="row">

            <!-- Left Column -->
            <div class="col-12 col-md-2 d-flex flex-column align-items-center">
                <div class="mt-3">
                    <form action="administration.php" method="GET">
                        <button class="btn btn-primary admin-b" name="allCats">Categories</button>
                    </form>
                </div>
                <div class="mt-3">
                    <form action="administration.php" method="GET">
                        <button class="btn btn-primary admin-b" name="allMMsgs">Motivation Messages</button>
                    </form>
                </div>
                <div class="mt-3">
                    <form action="administration.php" method="GET">
                        <button class="btn btn-primary admin-b" name="allCMsgs">Contact Messages
                            <?php if($newContactMessages): ?>
                                <span class="badge badge-light ml-2"><?php echo $newContactMessages; ?> </span>
                            <?php endif; ?>
                        </button>
                    </form>
                </div>
                <div class="mt-3">
                    <form action="administration.php" method="GET">
                        <button class="btn btn-primary admin-b" name="allDMsgs">Deleted Contact Messages</button>
                    </form>
                </div>

                <?php if(isAdmin()): ?>

                    <div class="mt-3">
                        <a href="administration.php?login" class="btn btn-primary admin-b">Change Password</a>
                    </div>

                <?php else: ?>

                    <div class="mt-3">
                        <a href="index.php" class="btn btn-primary admin-b">Back To App</a>
                    </div>

                <?php endif; ?>
                
                <div class="mt-3">
                    <form action="index.php" method="POST" class="mx-3">
                        <input class="admin-logout" type="submit" name="logout" value="Logout">
                    </form>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-12 col-md-10">

                <?php if($allCats): ?>
                    <!-- Add & Delete Categories -->
                    <div class="addDelCat">
                        <!--List of categories-->
                        <table class="table table-striped table-hover table-borderless">

                            <!--New category form-->
                            <form action="" method="POST">
                                <div class="input-group my-3 ml-1 note-form">
                                    <input type="text" name="new-category" class="form-control note-i" placeholder="Type a new category..." aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn note-b" type="submit" name="save-category" id="button-addon2">Save</button>
                                    </div>
                                </div>
                            </form>
                            
                            <?php foreach($allCats as $category) : ?>

                                <tr class="note-list-row">
                                    <td>
                                        <?php if($category->deleted == 1): ?>
                                            <del class="text-danger"><?php echo $category->name; ?><del>
                                        <?php else: ?>
                                            <?php echo $category->name; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if(isset($category->user_publisher)): ?> 
                                            <?php echo Administration::getUsernameAdmin($category->user_publisher); ?>
                                        <?php else: ?>
                                            Administrator
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <form action="" method="GET">
                                            <input type="hidden" name="category-id" value="<?php echo $category->id; ?>">
                                            <?php if($category->deleted == 1): ?>
                                                <button type="submit" name="restore-category"><i class="fas fa-trash-restore ml-2 text-success"></i></button>
                                            <?php else: ?>
                                                <button type="submit" name="delete-category"><i class="fas fa-trash-alt ml-2 text-danger"></i></button>
                                            <?php endif; ?>
                                            
                                        </form>
                                    </td>
                                </tr>

                            <?php endforeach; ?>

                        </table>
                    <!-- End DIV Add & Delete Categories -->
                    <div>

                <?php elseif($allMMsgs): ?>
                    <!-- Add & Delete Motivation Messages -->
                    <div class="addDelMMsgs">

                        <!--New message form-->
                        <form action="" method="POST">
                            <div class="my-3 pb-3 d-flex flex-column adminMMsgs">
                                <input type="text" name="new-mot-title" class="form-control mb-2 adminMMsgs-i" placeholder="Type a title..." aria-describedby="button-addon2">
                                <textarea name="new-mot-msg" class="form-control mb-2 adminMMsgs-i" placeholder="Type a message..." rows="5"></textarea>
                                <div class="input-group-append">
                                    <button class="btn adminMMsgs-b" type="submit" name="save-mot-message" id="button-addon2">Save</button>
                                </div>
                            </div>
                        </form>

                        <?php foreach($allMMsgs as $message) : ?>

                            <ul class="adminMMsgs-ul">
                                <li class="p-2 adminMMsgs-title"><?php echo $message->title; ?>
                                    <ul>
                                        <li class="adminMMsgs-text"><?php echo $message->text; ?></li>
                                        <li class="mb-2">
                                        <form action="" method="GET">
                                            <input type="hidden" name="message-id" value="<?php echo $message->id; ?>">
                                            <button class="btn admin-b-del" type="submit" name="delete-message">Delete</button>
                                        </form>
                                        </li>
                                    </ul>
                                </li>
                                <li>Published: 
                                    <?php if($message->user_publisher == NULL): ?> 
                                        Administrator 
                                    <?php else: ?>
                                        <?php echo Administration::getUsernameAdmin($message->user_publisher); ?>
                                    <?php endif; ?>
                                </li>
                            </ul>

                        <?php endforeach; ?>
                    <!-- End DIV Add & Delete Mot. Messages -->
                    </div>

                <?php elseif($allCMsgs): ?>
                    <!-- Contact Messages DIV -->
                    <div class="p-3 contactMsgs">

                        <?php foreach($allCMsgs as $contactMessage) : ?>

                            <div class="card mb-2 card-msg">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $contactMessage->name . ' ' . $contactMessage->lastname; ?><span><?php echo ($contactMessage->userId !== NULL) ? ' (User)' : ' (Guest)'; ?></span></h5>
                                    <h6 class="card-subtitle mb-3 text-muted"><?php echo $contactMessage->email; ?></h6>
                                    <p class="card-text"><?php echo $contactMessage->text; ?></p>
                                    <p class=""><?php $dt = new DateTime($contactMessage->sendDate); echo $dt->format('d/m/Y'); ?></p>
                                    <div class="d-flex flex-row">
                                        <form action="administration.php" method="GET">
                                            <input type="hidden" name="contMsgId" value="<?php echo $contactMessage->id; ?>">
                                            <button class="btn admin-b-del" name="del-cont-message">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                                
                        <?php endforeach; ?>

                    <!-- End DIV Contact Messages -->
                    </div>

                <?php elseif($allDMsgs): ?>
                    <!-- Deleted Contact Messages DIV -->
                    <div class="p-3 deletedCtMsgs">

                        <?php foreach($allDMsgs as $deletedtMessage) : ?>

                            <div class="card mb-2 card-msg">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $deletedtMessage->name . ' ' . $deletedtMessage->lastname; ?></h5>
                                    <h6 class="card-subtitle mb-3 text-muted"><?php echo $deletedtMessage->email; ?></h6>
                                    <p class="card-text"><?php echo $deletedtMessage->text; ?></p>
                                    <p class=""><?php $dt = new DateTime($deletedtMessage->sendDate); echo $dt->format('d/m/Y'); ?></p>
                                </div>
                            </div>
                                
                        <?php endforeach; ?>

                    <!-- End DIV Deleted Contact Messages -->
                    </div>

                <?php elseif(isset($_GET['login'])): ?>

                    <?php if(!isset($_GET['success'])): echo ''; ?>
                    <?php else: ?>
                        <p class="succMsg mt-2 text-center"><?php echo $_GET['success']; ?></p>
                    <?php endif; ?>

                    <!-- Div za promjenu šifre -->
                    <div class="d-flex flex-column align-items-center mt-5 admin-pass">
                        <h3 class="my-5">Promijeni šifru</h3>
                        <form action="" method="POST" id="adminPassForm" class="d-flex flex-column align-items-center">
                            <input class="admin-pass-i pl-2 mb-2" id="newAdminPass" type="password" name="newAdminPass" placeholder="Upiši Novu Lozinku">
                            <input class="admin-pass-i pl-2 mb-2" type="password" name="reNewAdminPass" placeholder="Potvrdi Novu Lozinku">
                            <input class="admin-pass-b px-3 mb-3" type="submit" name="newAdminPassword" value="Sačuvaj Promjenu">
                        </form>
                    </div>

                <?php endif; ?>
            </div>
        </div>
    </div>

<?php elseif(isLoggedIn()): ?>

    <?php header('Location: index.php'); ?>

<?php else: ?>

    <!--Login div-->
    <div class="d-flex flex-column justify-content-center align-items-center mt-5 admin-login">
        <h2 class="display-3 my-5 text-center">Sign In</h2>
        <form method='POST' action="administration.php" class="d-flex flex-column justify-content-center align-items-center mt-2 mx-auto py-2">
            <input class="form-control mb-3 login-i" type='text' name='username' placeholder="Username">
            <input class="form-control mb-3 login-i" type='password' name='password' placeholder='Password'>
            <input class="py-2 login-b" type="submit" name='login' value='Login'>
        </form>
        <a href="index.php" class="mt-5">Back</a>
    </div>
</div>
<?php endif; ?>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script type="text/javascript" src="templates/js/validate-admin-password.js"></script>
</body>
</html>


