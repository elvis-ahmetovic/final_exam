        
        <?php include('includes/head.php'); ?>
        <div id="home"></div>
        <!--If results exsists-->
        <?php if(isset($_GET['search'])): ?>

        <div class="d-flex flex-column align-items-center results">
            <!--Search results title-->
            <h3 class="py-1 text-center results-h">Search Result</h3>
            <p class="term">search for: <span><?php echo $str; ?></span></p>

            <!--Search results container-->
            <div class="row mt-2 search-results">
        
            <?php foreach($findCoaches as $coach) : ?>

                <!--Coach Card-->
                <div class="col-10 col-md-8 col-lg-5 mx-auto my-5 p-3 d-flex flex-column align-items-center card coach-card">
                    <!--Firstname, lastname & category-->
                    <h3 class="text-center mb-1"><?php echo $coach->name . " " . $coach->lastname; ?><span> (<?php echo $coach->catName; ?>)</span></h3>
                    <hr>
                    <!--Card content-->
                    <div class="d-flex flex-column flex-md-row justify-content-md-around flex-lg-column flex-xl-row card-main">
                        <!--Img & basic info-->
                        <div class="d-flex flex-row mx-auto">
                            <!--img-->
                            <img class="m-2 p-2" src="templates/images/avatars/<?php echo $coach->avatar; ?>" alt="avatar">
                            <!--Basic info-->
                            <div class="d-flex flex-column justify-content-center pl-3 card-info">
                                <p>City: <?php echo $coach->city; ?></p>
                                <p>Years: <?php echo getAge($coach->birthDate); ?></p>
                                <p>Phone: <?php if(isLoggedIn()) echo printPhoneNum($coach->phone); else echo '<span class="text-danger">Only authenticated users</span>' ?></p>
                            </div>
                        </div>
                        <!--Buttons-->
                        <div class="align-self-center d-flex flex-column mx-auto buttons">
                            <!--Modal btn send message-->
                            <?php if(isLoggedIn()) : ?>
                                <!--Modal btn (Send Message)-->
                                <button type="button" class="btn mb-3" data-toggle="modal" data-target="#sendMessage<?php echo $coach->id; ?>">Send Message</button>
                            <?php endif; ?>
                            <!--Modal btn more informations-->
                            <button type="button" class="btn" data-toggle="modal" data-target="#moreInformations<?php echo $coach->id; ?>">More Info</button>
                        </div>
                    </div>

                    <!--MODAL MORE INFORMATIONS-->
                    <div class="modal fade" id="moreInformations<?php echo $coach->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <!--Modal dialog-->
                        <div class="modal-dialog modal-lg mt-5" role="document">
                            <!--Modal content-->
                            <div class="modal-content">
                                <!--modal header-->
                                <div class="modal-header">
                                    <div class="modal-title-hr">
                                        <h5 class="modal-title text-center" id="exampleModalLabel"><?php echo $coach->name . " " . $coach->lastname; ?></h5>
                                        <hr>
                                    </div>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!--Modal body-->
                                <div class="modal-body p-4">
                                    <div class="">
                                        <h4 class="modal-body-title mb-3"><?php echo $coach->titleMsg; ?></h4>
                                        <p class="modal-body-text"><?php echo $coach->textMsg; ?></p>
                                        <p class="modal-body-text">Price: <?php echo $coach->price; ?>/h</p>
                                        <p class="modal-body-text">Phone: <?php if(isLoggedIn()) echo printPhoneNum($coach->phone); else echo '<span class="text-danger">Samo registrovani korisnici</span>' ?></p>
                                    </div>
                                </div>
                                <!--Modal footer-->
                                <div class="modal-footer">
                                    <!--Close btn-->
                                    <button type="button" class="btn" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--MODAL SEND MESSAGE-->
                    <div class="modal fade" id="sendMessage<?php echo $coach->id; ?>" aria-hidden="true">
                    <!--Modal dialog-->
                        <div class="modal-dialog modal-lg mt-5" role="document">
                            <!--Modal content-->
                            <div class="modal-content">
                                <!--Modal body-->
                                <div class="modal-body p-4">
                                    <form action="" method="POST" class="d-flex flex-column align-items-center">
                                        <div class="form-group">
                                            <input type="hidden" name="msg_to" value="<?php echo $coach->userId; ?>">
                                            <input type="text" class="form-control new-message-i" value="<?php echo $coach->name . " " . $coach->lastname; ?>" readonly="readonly" style="background-color: #fff;">
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control new-message-i" name="newText" cols="70" rows="3" placeholder="Type a message..."></textarea>
                                        </div>
                                        <button class="btn new-message-b" type="submit" name="createNewConversation">Send</button>
                                    </form>
                                </div>
                                <!--Modal footer-->
                                <div class="modal-footer">
                                    <!--Close btn-->
                                    <button type="button" class="btn" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> 

            <?php endforeach; ?>

            </div>
        </div>

        <!--If results do not exsists-->
        <?php else: ?>

            <!--Welcome Div-->
            <div class="row d-flex flex-column justify-content-center align-items-center mt-5 welcome">
                <!--Search div-->
                <div class="d-flex flex-column align-items-center mt-3">
                    <!--Search heading-->
                    <!-- <h2 class="mt-3 search-h">Traži Trenera</h2> -->
                    <!--Search form-->
                    <form action="index.php" method="GET" id="searchform" class="w-80 py-3 mt-3 mx-auto">
                        <div class="input-group">
                            <input type="text" class="form-control search-i ui-autocomplete-input" id="searchcoach" name="searchcoach" placeholder="Type (name, category or city)..." aria-label="Recipient's username" aria-describedby="button-addon2" autocomplete="off">
                            
                            <div class="input-group-append">
                                <button class="btn search-b" type="submit" name="search" id="button-addon2">Search</button>
                            </div>
                        </div>
                    </form>
                </div> 
            </div>


            <?php if(isLoggedIn()) : ?>

                <!--If contact message succaessfully sent-->
                <?php if(@$_GET['action'] == 'csuccess'): ?>
                    <p class="success text-center mt-2"><?php echo 'Your message was successfully sent'; ?></p>
                <?php endif; ?>

                <!--Div displayed after logging-->
                <div class="d-flex flex-column m-msgs">

                    <?php foreach($motivationMessages as $motivationMessage) : ?>

                    <h2 class="my-3 my-sm-5 mx-1 text-center"><?php echo $motivationMessage->title; ?></h2>
                    <p class="mb-2 my-lg-5 text-center mx-auto"><?php echo $motivationMessage->text; ?></p>

                    <?php endforeach; ?>

                </div> 

            <?php else : ?>   

                <!--If user is successfully registered-->
                <?php if(@$_GET['action'] == 'success'): ?>
                    <p class="success text-center mt-2"><?php echo 'You were successfully registered, you can log in'; ?></p>
                <?php elseif(@$_GET['action'] == 'csuccess'): ?>
                    <p class="success text-center mt-2"><?php echo 'Your message was successfully sent'; ?></p>
                <?php elseif(@$_GET['action'] == 'error'): ?>
                    <p class="error text-center mt-2"><?php echo 'Wrong credentials'; ?></p>
                <?php endif; ?>
                    

                <!--Login Register option div-->
                <div id="log-reg" class="d-flex flex-column justify-content-center align-items-center log-reg">
                    <a href="register.php">Create a New Account</a>
                    <p class="login">Sign In</p>
                </div>

                <!--Login div-->
                <div class="d-none flex-column justify-content-center align-items-center login-div">
                    <h2>Sign In</h2>
                    <form method='POST' action="" class="d-flex flex-column justify-content-center align-items-center mt-2 py-2">
                        <input class="form-control mb-3 login-i" type='text' name='username' placeholder='Username' autofocus>
                        <input class="form-control mb-3 login-i" type='password' name='password' placeholder='Password'>
                        <input class="py-2 login-b" type="submit" name='login' value='Login'>
                    </form>
                    <p id='backButton'>Back</p>
                </div>

        <?php endif; ?>

                <!--Print 6 random coaches-->
                <div id="coaches" class="row random">

                    <?php foreach($coaches as $coach) : ?>

                        <!--Coach Card-->
                        <div class="col-10 col-md-8 col-lg-5 col-xl-4 mx-auto my-5 p-3 d-flex flex-column align-items-center card coach-card">
                            <!--Firstname, lastname & category-->
                            <h3 class="text-center mb-1"><?php echo $coach->name . " " . $coach->lastname; ?><span> (<?php echo ($coach->catDeleted == 0) ? $coach->catName : 'bez kategorije' ?>)</span></h3>
                            <hr>
                            <!--Card content-->
                            <div class="d-flex flex-column flex-md-row justify-content-md-around flex-lg-column flex-xl-row card-main">
                                <!--Img & basic info-->
                                <div class="d-flex flex-row mx-auto">
                                    <!--img-->
                                    <img class="m-2 p-2" src="templates/images/avatars/<?php echo $coach->avatar; ?>" alt="avatar">
                                    <!--Basic info-->
                                    <div class="d-flex flex-column justify-content-center pl-3 card-info">
                                        <p>City: <?php echo $coach->city; ?></p>
                                        <p>Years: <?php echo getAge($coach->birthDate); ?></p>
                                        <p>Phone: <?php if(isLoggedIn()) echo printPhoneNum($coach->phone); else echo '<span class="text-danger">Only authenticated users</span>' ?></p>
                                    </div>
                                </div>
                                <!--Buttons-->
                                <div class="align-self-center d-flex flex-column mx-auto buttons">
                                    <?php if(isLoggedIn()) : ?>
                                        <!--Modal btn (Send Message)-->
                                        <button type="button" class="btn mb-3" data-toggle="modal" data-target="#sendMessage<?php echo $coach->id; ?>">Send Message</button>
                                    <?php endif; ?>
                                    <!--Modal btn (More information)-->
                                    <button type="button" class="btn" data-toggle="modal" data-target="#moreInformation<?php echo $coach->id; ?>">More Info</button>
                                </div>
                            </div>

                            <!--MODAL MORE INFORMATION-->
                            <div class="modal fade" id="moreInformation<?php echo $coach->id; ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <!--Modal dialog-->
                                <div class="modal-dialog modal-lg mt-5" role="document">
                                    <!--Modal content-->
                                    <div class="modal-content">
                                        <!--modal header-->
                                        <div class="modal-header">
                                            <div class="modal-title-hr">
                                                <h5 class="modal-title text-center" id="exampleModalLabel"><?php echo $coach->name . " " . $coach->lastname; ?></h5>
                                                <hr>
                                            </div>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <!--Modal body-->
                                        <div class="modal-body p-4">
                                            <div class="">
                                                <h4 class="modal-body-title mb-3"><?php echo $coach->titleMsg; ?></h4>
                                                <p class="modal-body-text"><?php echo $coach->textMsg; ?></p>
                                                <p class="modal-body-text">Price: <?php echo $coach->price; ?>/h</p>
                                                <p class="modal-body-text">Phone: <?php if(isLoggedIn()) echo printPhoneNum($coach->phone); else echo '<span class="text-danger">Only authenticated users</span>' ?></p>
                                            </div>
                                        </div>
                                        <!--Modal footer-->
                                        <div class="modal-footer">
                                            <!--Close btn-->
                                            <button type="button" class="btn" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--MODAL SEND MESSAGE-->
                            <div class="modal fade" id="sendMessage<?php echo $coach->id; ?>" aria-hidden="true">
                            <!--Modal dialog-->
                                <div class="modal-dialog modal-lg mt-5" role="document">
                                    <!--Modal content-->
                                    <div class="modal-content">
                                        <!--Modal body-->
                                        <div class="modal-body p-4">
                                            <form action="" method="POST" class="d-flex flex-column align-items-center">
                                                <div class="form-group">
                                                    <input type="hidden" name="msg_to" value="<?php echo $coach->userId; ?>">
                                                    <input type="text" class="form-control new-message-i" value="<?php echo $coach->name . " " . $coach->lastname; ?>" readonly="readonly" style="background-color: #fff;">
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control new-message-i" name="newText" cols="70" rows="3" placeholder="Type a message..."></textarea>
                                                </div>
                                                <button class="btn new-message-b" type="submit" name="createNewConversation">Send</button>
                                            </form>
                                        </div>
                                        <!--Modal footer-->
                                        <div class="modal-footer">
                                            <!--Close btn-->
                                            <button type="button" class="btn" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                    <?php endforeach; ?>

                </div>

                <!--Contact-->
                <div id="contact" class="d-flex flex-column align-items-center contact">
                    <h3 class="contact-h text-center my-5">Contact</h3></p>
                    <div id="success_contact"></div>

                    <form action="index.php" method="POST" id="contact_form" class="d-flex flex-column align-items-center">

                        <input class="form-control mb-3 contact-i" type="text" name="name" id="name" placeholder="Name"
                        <?php echo  isset($_SESSION['name']) ? "value='$_SESSION[name]'" : '' ?>
                        <?php echo isset($_SESSION['name']) ? "disabled='disabled'" : '' ?>>

                        <input class="form-control mb-3 contact-i" type="text" name="lastname" id="lastname" placeholder="Lastname"
                        <?php echo  isset($_SESSION['lastname']) ? "value='$_SESSION[lastname]'" : '' ?>
                        <?php echo isset($_SESSION['lastname']) ? "disabled='disabled'" : '' ?>>

                        <input class="form-control mb-3 contact-i" type="email" name="email" id="email" placeholder="Email"
                        <?php echo  isset($_SESSION['email']) ? "value='$_SESSION[email]'" : '' ?>
                        <?php echo isset($_SESSION['email']) ? "disabled='disabled'" : '' ?>>

                        <textarea class="form-control mb-3 contact-i" name="text" id="text" placeholder="Type a message..." cols="30" rows="10"></textarea>
                        <input class="contact-b py-2" type="submit" id="submitform" name="contact" value="Send">
                    </form>
                </div>

        <!--End If (results exsists)-->  
        <?php endif; ?>

    </div>

   
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="templates/js/login.js"></script>

    <!--JQuery Validate Plugin-->  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <!--Search validation--> 
    <script type="text/javascript" src="templates/js/search.js"></script>
    <!--Contact form AJAX--> 
    <script type="text/javascript" src="templates/js/contact.js"></script>
</body>
</html>

