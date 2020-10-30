<?php if(isLoggedIn()): ?>

<?php include('includes/head.php'); ?>

    <h2 class="display-4 text-center"><?php echo $title; ?></h2>

    <!-- Back Button on administration page -->
    <a class="back-button ml-4 mb-2" href="administration.php">Nazad</a>

    <!-- Back Button on administration page -->
    <a class="back-button ml-4 mb-2" href="adminUsers.php?<?php echo (isset($_GET['users'])) ? 'coaches' : 'users' ?>"><?php echo (isset($_GET['users'])) ? 'Treneri' : 'Korisnici' ?></a>

    <!-- Back Button on administration page -->
    <a class="back-button ml-4 mb-2" href="adminUsers.php?banned">Svi Banovani</a>

    <!-- Content DIV -->
    <div class="d-flex flex-column flex-md-row justify-content-center">
        <table class="table table-striped adminTable">
            <thead class="thead-dark">
                <th scope="col">Ime</th>
                <th scope="col">Prezime</th>
                <th scope="col">Korisničko ime</th>
                <th scope="col">Email</th>
                <th scope="col">Grad</th>
                <th scope="col">Datum Rođenja</th>
                <th scope="col">Datum registracije</th>
                <th scope="col">Status</th>
                <th scope="col">Restrikcija</th>
            </thead>

            <!-- If results exists -->
            <?php if($users): ?>
                <!-- Loop trough results -->
                <?php foreach($users as $user): ?>
                    <tbody class="<?php echo ($user->banned == 1) ? 'banned' : '';  ?>">
                        <tr>
                            <td><?php echo $user->name; ?></td>
                            <td><?php echo $user->lastname; ?></td>
                            <td><?php echo $user->username; ?></td>
                            <td><?php echo $user->email; ?></td>
                            <td><?php echo $user->city; ?></td>
                            <td><?php echo $user->birthDate; ?></td>
                            <td><?php $dt = new DateTime($user->regDate); echo $dt->format('d/m/Y'); ?></td>
                            <td>
                                <form action="adminUsers.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $user->id; ?>">
                                    <?php if(isset($_GET['users'])): ?>
                                        <?php if($user->adminStatus == 1): ?>
                                            <input type="submit" class="btn btn-primary" name="setUserAdmin" value="Admin">
                                        <?php else: ?>
                                            <input type="submit" class="btn btn-secondary" name="setUserAdmin" value="Korisnik">
                                        <?php endif; ?>
                                    <?php elseif(isset($_GET['coaches'])): ?>
                                        <?php if($user->adminStatus == 1): ?>
                                            <input type="submit" class="btn btn-primary" name="setCoachAdmin" value="Admin">
                                        <?php else: ?>
                                            <input type="submit" class="btn btn-secondary" name="setCoachAdmin" value="Trener">
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php echo ($user->coachStatus == 1) ? 'Trener' : 'Korisnik'; ?>
                                    <?php endif; ?>
                                    
                                    
                                </form>
                            </td>
                            <td>
                                <form action="adminUsers.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $user->id; ?>">
                                    <?php if(isset($_GET['users'])): ?>
                                        <input type="submit" class="btn btn-secondary" name="banUser" value="<?php echo ($user->banned == 1) ? 'Banovan' : 'Pristup';  ?>">
                                    <?php elseif(isset($_GET['coaches'])): ?>
                                        <input type="submit" class="btn btn-secondary" name="banCoach" value="<?php echo ($user->banned == 1) ? 'Banovan' : 'Pristup';  ?>">
                                    <?php else: ?>
                                        <input type="submit" class="btn btn-secondary" name="ban" value="<?php echo ($user->banned == 1) ? 'Banovan' : 'Pristup';  ?>" title="ban">
                                    <?php endif; ?>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                <!-- End Loop -->
                <?php endforeach; ?>
            <?php else: ?>
            <!-- End If (results exists) -->
            <?php endif; ?>
        </table>
    
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

<?php else: ?>
    <?php header('Location: index.php'); ?>
<?php endif; ?>