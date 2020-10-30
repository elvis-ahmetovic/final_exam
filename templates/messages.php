<?php if(isLoggedIn()): ?>
        
        <?php include('includes/head.php'); ?>

        <!--Private messages-->
        <div class="d-flex flex-column align-items-center messages">
            <!--Private messages title-->
            <h3 class="py-1 text-center messages-h">Messages</h3>

            <!-- New conversation button -->
            <div class="align-self-md-start mt-3 mt-md-1 ml-md-2">
                <button class="btn new-msg-btn" id="new-message">New Message</button>
            </div>

            <!--Private messages container-->
            <div class="mt-3 mt-md-2 mx-2 mx-md-0 d-flex flex-column flex-md-row w-100 priv-msgs">

                <!-- Conversations -->
                <div class="navbar navbar-expand-md conversations mb-2 mx-auto">

                    <!-- List of contacts button -->
                    <button class="navbar-toggler contacts-btn mx-auto mb-2 align-self-end" type="button" data-toggle="collapse" data-target="#contacts-ba" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-comments fa-2x"></i>
                    </button>

                    <!-- Collapse -->
                    <div class="collapse navbar-collapse flex-sm-column" id="contacts-ba">

                        <!-- If Conversations exists -->
                        <?php if($conversations): ?>

                            <!-- Conversations list -->
                            <div class="conv-list overflow-auto">

                                <!-- Loop Trough All Conversations -->
                                <?php foreach($conversations as $conversation): ?>

                                    <!-- Link that wrapp conversation card -->
                                    <a class="conv-card-wrapper" href="messages.php?open=1&conversation_id=<?php echo $conversation->id; ?>&to=
                                        <?php if($conversation->participant_1 == $_SESSION['user_id']) 
                                        echo $conversation->participant_2; else echo $conversation->participant_1;?>
                                    ">
                                        <!-- Conversation Card -->
                                        <div class="d-flex flex-row conv-card align-items-center mb-3 py-2
                                            <?php echo ($_GET['conversation_id'] == $conversation->id) ? 'active mr-2' : ''; ?>
                                        ">

                                            <!-- Check if first participant of conversation is current user -->
                                            <?php if($conversation->participant_1 == $_SESSION['user_id']): ?>
                                                <!-- If is, print avatar of second participant -->
                                                <img class="p-2 mx-2 conv-card-img" src="templates/images/avatars/<?php echo $conversation->par2_avatar; ?>" alt="avatar">
                                            
                                            <?php else: ?>         
                                                <!-- if not, print avatar of first participant -->
                                                <img class="p-2 mx-2 conv-card-img" src="templates/images/avatars/<?php echo $conversation->par1_avatar; ?>" alt="avatar">
                                            <!-- End if -->
                                            <?php endif; ?>

                                            <!-- Conversation Card Info -->
                                            <div class="px-2 conv-card-info">

                                                <!-- Conversation Card Header -->
                                                <h4 class="mt-1 conv-card-info-h">
                                                    <!-- Check if first participant of conversation is current user
                                                            If is, print nama & lastname of second participant
                                                                if not, print name & lastname of first participant -->
                                                    <?php if($conversation->participant_1 == $_SESSION['user_id']) 
                                                    echo ucfirst($conversation->participant2_name) . ' ' . ucfirst($conversation->participant2_lastname); 
                                                    else echo ucfirst($conversation->participant1_name) . ' ' . ucfirst($conversation->participant1_lastname);?>
                                                </h4><!-- Close Header -->

                                                <!-- Date & Time when conversation is created -->
                                                <p class="date-time"><?php echo conversationCreate($conversation->create_time); ?></p>
                                            </div><!-- End Conversation Card Info -->
                                        </div><!-- End Conversation Card -->
                                    </a><!-- Close Link -->

                                <?php endforeach; ?>
                                
                            </div><!-- End Conversations list -->

                        <!-- If Conversations do not exists -->
                        <?php else: ?>

                            <h4 class="text-center">No Conversations</h4>

                        <!-- End If (Conversations) -->
                        <?php endif; ?>

                    </div><!-- End Collapse -->
                </div> <!-- End Conversations -->

                <!-- Conversation Messages -->
                <div class="ml-2 ml-md-0 mx-md-auto conv-messages">
                    <!-- Conversations container -->
                    <div class="conv-msgs-container">

                        <!-- If messages exists -->
                        <?php if($convMessages): ?>
                   
                            <!-- Conversations body -->
                            <div class="p-2 mb-0 overflow-auto conv-msgs-body">

                                <!-- Loop trough all messages in particular conversation -->
                                <?php foreach($convMessages as $convMsg): ?>
                                    
                                    <div class="conversation-line">
                                        <h5 class="ml-2 mt-1 conversation-line-h"><?php echo ucfirst($convMsg->name) . ' ' . ucfirst($convMsg->lastname); ?></h5>
                                        <p class="mx-1 conversation-line-text"><?php echo $convMsg->text; ?></p>
                                        <p class="date-time"><?php echo date('d-m-Y', strtotime($convMsg->sendTime)); ?></p>
                                    </div>

                                <?php endforeach; ?>

                            </div><!-- End Conversations body -->

                                <!-- <form action="" method="GET">
                                    <input type="hidden" name="conversation_id" value="<?php //
                                    
                                    echo $convMsg->conversationId; ?>">
                                    <button class="float-right mb-1 mr-1 delete-conv-b" type="submit" name="deleteConversation">Izbriši Konverzaciju</button>
                                </form> -->

                            <!-- Send Message in Current conversation -->
                            <div class="conversation-live">
                                <form action="" method="POST">
                                    <div class="input-group">
                                        <textarea class="form-control conversation-live-i" name="respondMessage" cols="70" rows="3" placeholder="Type a message..." aria-label="Recipient's username" aria-describedby="button-addon2"></textarea>
                                        <div class="input-group-append">
                                            <button class="btn conversation-live-b" type="submit" name="sendRespond" id="button-addon2">Send</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        <?php else: ?>
                            <div class="d-flex flex-column justify-content-center noConversations">

                                <h4 class="align-self-center">No Selected Conversations</h4>

                            </div>
                        <?php endif; ?>

                    </div><!-- End Conversations container -->
                </div><!-- End Conversation Messages -->

                <!-- New conversation form -->
                <div class="d-none new-message">
                    <form action="" method="POST" id="newMsgForm" class="d-flex flex-column align-items-center">
                        <div class="form-group">
                            <select name="msg_to" id="" class="form-control new-message-select">
                                <option value="">Find Coach</option>
                                
                                <?php foreach($coaches as $coach): ?>
                                    <option value="<?php echo $coach->userId; ?>">
                                        <p><?php echo ucfirst($coach->name) . ' ' . ucfirst($coach->lastname); ?></p>
                                        <p>(<?php echo ucfirst($coach->catName) . ' / ' . ucfirst($coach->city); ?>)</p>
                                    </option>
                                <?php endforeach; ?>
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control new-message-i" name="newText" cols="70" rows="3" placeholder="Type a Message..."></textarea>
                        </div>
                        <button class="btn new-message-b" type="submit" name="createNewConversation">Send</button>
                    </form>
                </div>
            </div>

        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="templates/js/new-msg.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script type="text/javascript" src="templates/js/validate-new-msg.js"></script>
</body>
</html>

<?php else: ?>
    <?php header('Location: index.php'); ?>
<?php endif; ?>