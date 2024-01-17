    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up</title>
        <link rel="stylesheet" href="signup.css">
    </head>

    <body>
        <div class="header" id="myHeader">
            <nav>
                <a href="projekti.php"><img src="luciano_main-350x120 (1).png" class="logo"></a>
                <div>
                    <a href="produktet.php"><button>Products</button></a>
                    <a href="about.php"><button>About Us</button></a>
                    <a href="signup.php"><button>Sign Up</button></a>
                </div>
            </nav>
        </div>

        <div class="container">
            <div class="formbox">
                <h1 id="title">Sign Up</h1>
                <form action="process_signup.php" method="post">
                    <div class="input-group">
                        <div class="input-field" id="nameField">
                            <input type="text" name="Name" placeholder="Name" required pattern="[A-Za-z\s]+"
                                title="Enter a valid name (letters and spaces only)">
                        </div>
                        <div class="input-field">
                            <input type="email" name="Email" placeholder="Email" required>
                        </div>
                        <div class="input-field">
                            <input type="password" name="Password" placeholder="Password" required pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$"
                                title="Password must be at least 8 characters long and include one letter, one number, and one special character">
                        </div>
                        <p id="erjoni">Forgot password <a href="#">Click here</a></p>
                    </div>
                    <div class="btn-field">
                        <button type="submit" id="signupbtn">Sign up</button>
                        <button type="button" id="signinbtn" class="disable">Sign in</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
    let singinbtn = document.getElementById("signinbtn");
    let nameField = document.getElementById("nameField");
    let title = document.getElementById("title");

    singinbtn.onclick = function () {
        nameField.style.maxHeight = "0";
        title.innerHTML = "Sign In";
        singinbtn.classList.add("disable");
    }

    function performSignup() {
        let isValid = validateForm();
        if (isValid) {
            alert("Sign up successful!");
            window.location.href = "projekti.html";
        }
    }

    function validateForm() {
        let nameValue = nameField.querySelector('input').value;
        let emailValue = document.querySelector('.input-field input[type="email"]').value;
        let passwordValue = document.querySelector('.input-field input[type="password"]').value;

        let nameRegex = /^[A-Za-z\s]+$/;

        if (!nameRegex.test(nameValue)) {
            alert("Enter a valid name (letters and spaces only)");
            return false;
        }

        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailValue)) {
            alert("Enter a valid email address");
            return false;
        }

        let passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
        if (!passwordRegex.test(passwordValue)) {
            alert("Password must be at least 8 characters long and include one letter, one number, and one special character");
            return false;
        }

        return true;
    }

    document.addEventListener("keyup", function (event) {
        if (event.key === "Enter") {
            if (document.activeElement === singinbtn) {
                performSignup();
            }
        }
    });
</script>

<script>
    let signupbtn = document.getElementById("signupbtn");

    signupbtn.onclick = function () {
        let nameField = document.getElementById("nameField");
        let title = document.getElementById("title");

        nameField.style.maxHeight = "60px";
        title.innerHTML = "Sign Up";
        signupbtn.classList.add("disable");
        singinbtn.classList.remove("disable");
    };
</script>

    </body>

    </html>
