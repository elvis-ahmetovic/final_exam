
    <?php include('includes/head.php'); ?>
    
        <div class="d-flex flex-column align-items-center register">
            <h2 class="register-title">Create a New Account</h2>
            
            <form class="d-flex flex-column align-items-center registration-form" id="registrationForm" action="register.php" method="POST" enctype="multipart/form-data">
                <input class="form-control mt-3 register-i" type="text" name="name" placeholder="Name">
                <input class="form-control mt-3 register-i" type="text" name="lastname" placeholder="Lastname">
                
                <input class="form-control mt-3 register-i" id="username" type="text" name="username" placeholder="Username">
                <input class="form-control mt-3 register-i" id="email" type="email" name="email" placeholder="Email">
                <input class="form-control mt-3 register-i" id="password" type="password" name="password" placeholder="Password">
                <input class="form-control mt-3 register-i" type="password" name="repeatPassword" placeholder="Repeat Password">
                <input class="form-control mt-3 register-i" type="text" name="city" placeholder="City">
                <input name="pippo" class="form-control mt-3 pl-2 py-2 register-i {dateITA:true}" placeholder="Birth Date (dd/mm/yyyy)*"/>
                <div class="d-flex flex-column align-items-center my-3 px-5 py-2 gender">
                    <input class="mr-3" type="radio" name="gender" value="male">
                    <span class="gender-val mb-4">Male</span>
                    <input class="mr-3" type="radio" name="gender" value="female">
                    <span class="gender-val">Female</span>
                </div>

                <input class="btn my-3 register-b" id="register" type="submit" name="register" value="Register">
            </form>
        </div>
    </div>

    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script type="text/javascript" src="templates/js/validate-registration.js"></script>
    
    
</body>
</html>