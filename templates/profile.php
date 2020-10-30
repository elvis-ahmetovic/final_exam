<?php if(isLoggedIn()): ?>
        
        <?php include('includes/head.php'); ?>

        <!--Basic profil info panel-->
        <div class="d-flex flex-column align-items-center profile-info">
            <!--Profil info title-->
            <h3 class="py-1 text-center profile-h">Profil</h3>

                <?php if(!isset($_GET['success'])): echo ''; ?>
                <?php else: ?>
                <p class="succMsg mt-2"><?php echo $_GET['success']; ?></p>
                <?php endif; ?>

            <!--Profil info div-->
            <div class="d-flex flex-column align-items-center mt-2 px-2 personal-container">

                <!--Avatar i myInfo divs-->
                <div class="d-flex flex-column flex-sm-row justify-content-sm-center avatar-my-info">

                    <!--Show avatar and form to change it & pass change div-->
                    <div class="d-flex flex-column align-items-center mr-sm-1 mr-md-3 mr-lg-5 py-4 avatar">
                        <img class="mx-auto mb-3" id="pfofileAvatar" src="templates/images/avatars/<?php echo $user->avatar; ?>" alt="avatar">
                        <form id="newAvatar" action="" method="POST" enctype="multipart/form-data" class="d-none flex-column align-items-center">
                            <label class="my-2 pr-2 custom-file-change" for="change-file">
                                <i class="fa fa-cloud-upload py-2 px-4"></i> Choose Image
                            </label>
                            <input class="mb-3 d-none" type="file" name="avatar" id="change-file">
                            <input class="mail-city-pass-b px-3 mb-3" type="submit" name="saveAvatar" value="Save">
                            <p class="change" id="closeAvatar">Close</p>
                        </form>
                        <p class="text-center change" id="changeAvatarBtn">Change Avatar</p>

                        <!--Change password btn-->
                        <p class="change" id="changePassBtn">Change Password</p>

                        <!-- Change Password -->
                        <div class="passChange">
                            <form action="" method="POST" id="passChangeForm" class="d-none flex-column align-items-center">
                                <input class="mail-city-pass-i pl-2 mb-2" id="newPass" type="password" name="newPass" placeholder="Type a New Password">
                                <input class="mail-city-pass-i pl-2 mb-2" type="password" name="reNewPass" placeholder="Repeat Password">
                                <input class="mail-city-pass-b px-3 mb-3" type="submit" name="newPassword" value="Save">
                                <p class="change" id="closePassForm">Zatvori</p>
                            </form>
                        </div>
                    </div>
                    
                    <!--My info div (email, city...)-->
                    <div class="d-flex flex-column ml-sm-1 ml-md-3 ml-lg-5 py-3 my-info">
                        <h4>Basic Information</h4>
                        <p class="mt-3 my-info-text">Name: <span><?php echo ucfirst($user->name) . " " . ucfirst($user->lastname); ?></span></p>
                        <p class="my-info-text">Username: <span><?php echo $user->username; ?></span></p>
                    
                        <!--Show email and form to change it-->
                        <div class="d-flex flex-row mail-city">
                            <p class="my-info-text">Email:&nbsp;<span id="mail"><?php echo $user->email; ?></span></p>
                            <div id="changeEmail">
                                <form action="" method="POST" id="changeEmailForm" class="d-none flex-column align-items-center">
                                    <input class="mail-city-pass-i pl-2 mb-2" type='text' id="newEmail" name='newEmail' placeholder='Type a New Email' autofocus>
                                    <input class="mail-city-pass-b px-3 mb-2" type='submit' name='saveEmail' value='Save'>
                                    <p class="change" id='closeEmail'>Close</p>
                                </form>
                            </div>
                            <p class="change" id="changeMailBtn">&nbsp;Change</p>
                        </div>
                    
                        <!--Show city and form to change it-->
                        <div class="d-flex flex-row mail-city">
                            <p class="my-info-text">City:&nbsp;<span id="city"><?php echo ucfirst($user->city); ?></span></p>
                            <div id="changeCity">
                                <form action="" method="GET" id="changeCityForm" class="d-none flex-column align-items-center">
                                    <input class="mail-city-pass-i pl-2 mb-2" type='text' name='newCity' placeholder='Type a New City' autofocus>
                                    <input class="mail-city-pass-b px-3 mb-2" type='submit' name='saveCity' value='Save'>
                                    <p class='change' id='closeCity'>Close</p>
                                </form>
                            </div>
                            <p class="change" id="changeCityBtn">&nbsp;Change</p>
                        </div>

                        <p class="my-info-text">Birth Date: <span><?php echo $user->birthDate; ?></span></p>
                        <?php $time = $user->regDate; ?>
                        <p class="my-info-text">Registration Date: <span><?php echo date("d-m-Y", strtotime($time)); ?></span></p>

                        <?php if($user->coachStatus == '1') : ?>
        
                            <!-- Open coach panel button, only for coaches -->
                            <p class="align-self-end mr-5 px-3 py-1 panel-btn" id="openCoachPanel">Coach Panel</p>

                        <?php else: ?>

                            <!-- Open advertise panel button, only for users -->
                            <p class="align-self-end mr-5 px-3 py-1 panel-btn" id="openAdsPanel">Become a Coach</p>

                        <?php endif; ?>

                    </div>
                </div>
            <!--End Profil info div-->    
            </div>                
        </div>


        <?php if($user->coachStatus === '1') : ?>

        <!--Note div, only coaches-->
        <div class="mb-4 note">
            <!--Note title-->
            <h3 class="text-center mx-auto my-3 py-1 note-h">Notes</h3>
            <!--Notes container-->
            <div class="mx-auto py-3 note-container">

                <!--New notes form-->
                <form action="" method="GET">
                    <input type="hidden" name="coach_id" value="<?php echo $coach->id . 'x'; ?>">
                    <div class="input-group my-3 ml-1 note-form">
                        <input type="text" name="newNote" class="form-control note-i" placeholder="Type a New Note..." aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn note-b" type="submit" name="saveNote" id="button-addon2">Save</button>
                        </div>
                    </div>
                </form>
                
                <!--List of notes-->
                <table class="table table-striped table-hover table-borderless">

                <?php if($notes): ?>
                    <?php foreach($notes as $note) : ?>

                        <tr class="note-list-row">
                            <td>
                                <?php echo $note->noteBody; ?>
                            </td>
                            <td>
                                <form action="" method="GET">
                                    <input type="hidden" name="noteId" value="<?php echo $note->id; ?>">
                                    <button type="submit" name="delete-note"><i class="fas fa-trash-alt ml-2"></i></button>
                                </form>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                <?php endif; ?>

                </table>
            <!--End Notes container-->
            </div>
        <!--End Note div-->
        </div>

        <?php endif; ?>

        <!-- Advertise div -->
        <div class="d-none flex-column advertise">
            <!-- Advertise div title -->
            <h3 class="text-center mx-auto mb-3 py-1 ads-h">Become a Coach</h3>
            <!-- Ads Container -->
            <div class="mx-auto py-3 ads">
                <!-- Ads Form -->
                <form action="" method="POST" id="advertise-form" class="d-flex flex-column align-items-center mx-auto">
                    <select class="mx-auto mb-3 py-1 pl-2" name="category" id="select">
                        <option disabled selected hidden>Category</option>
                        
                        <?php foreach($categories as $category) : ?>

                            <option value="<?php echo $category->id; ?>"><?php echo ucfirst($category->name); ?></option>

                        <?php endforeach; ?>

                    </select>
                    <input class="ads-i mx-auto mb-3 py-1 pl-2" type="number" name="price" min="1" step="0.01" placeholder="Price per Hour">
                    <input class="ads-i mx-auto mb-3 py-1 pl-2" type="tel" name="phone" placeholder="Phone Number (01771234567)">
                    <input class="ads-i mx-auto mb-3 py-1 pl-2" type="text" name="titleMsg" placeholder="Message Title">
                    <textarea class="ads-i mx-auto mb-3 py-1 pl-2" name="textMsg" cols="80" rows="10"
                        placeholder="Type a Message..."></textarea>
                    <input class="py-1 ads-b" type="submit" name="advertise" value="Save">
                </form>
            </div>
            <!-- Back button to profile -->
            <p class="back-button mt-3 text-center">Back</p>
        </div>

        <!-- Coach panel -->
        <div class="d-none flex-column coach-panel">
            <!-- Coach panel title -->
            <h3 class="text-center py-1 mb-3 mx-auto coach-panel-h">Coach Panel</h3>

            <!-- Coach panel container -->
            <div class="d-flex flex-column mx-auto p-2 coach-panel-container">

                <!--Div with coach's info-->
                <div class="p-2 ml-5 my-3 coach-info">
                    <h4 class="coach-info-h">Coach Information</h4>

                    <div class="d-flex flex-row change-coach-info">
                        <p class="coach-info-text">Category:&nbsp;<span class="<?php echo ($coach->catDeleted == 0) ? '' : 'text-danger' ?>" id="catName"><?php echo ($coach->catDeleted == 0) ? ucfirst($coach->catName) : 'Yout category is not avalible' ?></span></p>

                        <!--Div for change category-->
                        <div class="d-none" id="changeCategory">
                            <form class="d-flex flex-column align-items-center" id="changeCategoryForm" action="" method="GET">
                                <select class="mx-auto mb-3 py-1 pl-2 change-coach-category" name="newCategory" id="select">

                                    <option disabled selected hidden>Choose a New Category</option>
                                
                                    <?php foreach($categories as $category) : ?>

                                        <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>

                                    <?php endforeach; ?>

                                </select>

                                <input class="px-3 mb-2 change-coach-info-b" type='submit' name='saveCategory' value='Save'>
                                <p class='change' id='closeCategory'>Close</p>
                            </form>
                        </div>

                        <p class="change" id="changeCategoryBtn">&nbsp;Change</p>
                    </div>

                    <div class="d-flex flex-row change-coach-info">
                        <p class="coach-info-text">Price:&nbsp;<span id="priceVal"><?php echo $coach->price; ?>/h</span></p>

                        <!--Div for changing price-->
                        <div class="d-none" id="changePrice">
                            <form class="d-flex flex-column align-items-center" id="changePriceForm" action="" method="GET">
                                <input class="pl-2 mb-2 change-coach-info-i" type='number' name='newPrice' min="1" step="0.01" placeholder='Set a New Price' autofocus>
                                <input class="px-3 mb-2 change-coach-info-b" type='submit' name='savePrice' value='Save'>
                                <p class='change' id='closePrice'>Close</p>
                            </form>
                        </div>

                        <p class="change" id="changePriceBtn">&nbsp;Change</p>
                    </div>

                    <div class="d-flex flex-row change-coach-info">
                        <p class="coach-info-text">Phone:&nbsp;<span id="phoneNum"><?php echo printPhoneNum($coach->phone); ?></span></p>

                        <!--Div for change phone number-->
                        <div class="d-none" id="changeTel">
                            <form class="d-flex flex-column align-items-center" id="changeTelForm" action="" method="GET">
                                <input class="pl-2 mb-2 change-coach-info-i" type='text' name='newPhone' placeholder='Type a New Number' autofocus>
                                <input class="px-3 mb-2 change-coach-info-b" type='submit' name='savePhone' value='Save'>
                                <p class='change' id='closeTel'>Close</p>
                            </form>
                        </div>

                        <p class="change" id="changeTelBtn">&nbsp;Change</p>
                    </div>
                </div>

                <!--Div with messages for users-->
                <div class="align-self-end p-2 mr-5 my-3 msg-to-users">

                    <!--Messages title and form for change-->
                    <div class="d-flex flex-row justify-content-end msg-title">
                        <form action="" method="GET" id="changeTitleForm" class="d-none flex-column align-items-center">
                            <input class="pl-2 mb-2 msg-title-i" type="text" name="newTitle" placeholder="Type a Title" autofocus>
                            <input class="px-3 mb-2 msg-title-b" type='submit' name='saveTitle' value='Save'>
                            <p class='change' id='closeTitle'>Close</p>
                        </form>
                        <p class="change" id="changeTitleBtn">Change&nbsp;</p>
                        <h4 class="text-right msg-to-users-h" id="title"><?php echo ucfirst($coach->titleMsg); ?></h4>
                    </div>

                    <!--Messages body and form for change-->
                    <div class="msg-text">
                        <p class="text-right msg-text-p" id="textMsg"><?php echo ucfirst($coach->textMsg); ?></p>
                        <p class="change" id="changeTexteBtn">&nbsp;Change</p>
                        <form action="" method="GET" id="changeTexteForm" class="d-none flex-column align-items-center">
                            <textarea class="pl-2 mb-2 msg-text-i" name="newText" cols="80" rows="10" maxlength="300"
                                placeholder="Type a Message..." autofocus></textarea>
                            <input class="px-3 mb-2 msg-text-b" type='submit' name='saveText' value='Save'>
                            <p class='change' id='closeText'>Close</p>
                        </form>
                    </div>
                </div>

            </div>
            <p class="back-button mt-3 text-center" id='backButton'>Back</p>
        </div>

        
    </div>

    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script type="text/javascript" src="templates/js/validate-password.js"></script>
    <script type="text/javascript" src="templates/js/validate-email.js"></script>
    <script type="text/javascript" src="templates/js/validate-city.js"></script>
    <script type="text/javascript" src="templates/js/validate-ads-form.js"></script>
    <script type="text/javascript" src="templates/js/validate-category.js"></script>
    <script type="text/javascript" src="templates/js/validate-phone.js"></script>
    <script type="text/javascript" src="templates/js/validate-price.js"></script>
    <script type="text/javascript" src="templates/js/validate-title.js"></script>
    <script type="text/javascript" src="templates/js/validate-text.js"></script>

    <script type="text/javascript" src="templates/js/avatar.js"></script>
    <script type="text/javascript" src="templates/js/email.js"></script>
    <script type="text/javascript" src="templates/js/city.js"></script>
    <script type="text/javascript" src="templates/js/password.js"></script>
    <script type="text/javascript" src="templates/js/advertise.js"></script>
    <script type="text/javascript" src="templates/js/coach-panel.js"></script>
    <script type="text/javascript" src="templates/js/selected.js"></script>
    <script type="text/javascript" src="templates/js/category.js"></script>
    <script type="text/javascript" src="templates/js/price.js"></script>
    <script type="text/javascript" src="templates/js/phone.js"></script>
    <script type="text/javascript" src="templates/js/msg-title.js"></script>
    <script type="text/javascript" src="templates/js/msg-text.js"></script>
    
</body>
</html>

<?php else: ?>
    <?php header('Location: index.php'); ?>
<?php endif; ?>