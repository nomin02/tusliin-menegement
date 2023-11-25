<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iuu.duguilan.mn</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    
    <script>
    function validateForm() {
        var studentID = document.forms["registrationForm"]["ocode"].value;
        var regex = /^[a-zA-Z]{2}\d{2}[a-zA-Z]\d{3}$/;
        var errorMessageElement = document.getElementById("studentIDErrorMessage");

        if (!regex.test(studentID)) {
            errorMessageElement.innerText = "Incorrect student ID format. Please check and try again.";
            errorMessageElement.style.display = "block";
            return false;
        } else {
            errorMessageElement.style.display = "none";
        }

        var password = document.forms["registrationForm"]["p"].value;
        var confirmPassword = document.forms["registrationForm"]["cp"].value;

        if (password !== confirmPassword) {
            alert("Password and Confirm Password must match");
            return false;
        }

        // Add additional password strength checks if needed

        return true;
    }

    function confirmCancel() {
        return confirm("Are you sure you want to cancel registration?");
    }
</script>
</head>

<body style="background-color:#BB8FCE;">
    <div class="container">
        <h2>Registration Club</h2>
        <div class="form-container">
            <form name="registrationForm" action="reg2.php" method="post" onsubmit="return validateForm()">
                <div class="input-name">
                    <input type="text" name="fname" placeholder="Firstname" class="name">
                </div>

                <div class="input-name">
                    <input type="text" name="lname" placeholder="Lastname" class="name">
                </div>

                <div class="input-name">
                    <!-- Dynamically generate options for course -->
                    <select name="kurs" id="kurs">
                        <?php
                        $courseOptions = array("1 course", "2 course", "3 course", "4 course");
                        foreach ($courseOptions as $option) {
                            echo "<option value='" . htmlspecialchars($option) . "'>$option</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="input-name">
                    <!-- Dynamically generate options for major -->
                    <select name="merg" id="merg">
                        <?php
                        $majorOptions = array(
                            "Agriculture, General", "Agribusiness Operations", "Agricultural Business & Management",
                            "Agricultural Economics", "Food Sciences & Technology", "Human Resources Management",
                            "Marketing Management & Research", "Actuarial Science", "Machine Tool Technology"
                        );
                        foreach ($majorOptions as $option) {
                            echo "<option value='" . htmlspecialchars($option) . "'>$option</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="input-name">
    
    <input type="text" name="ocode" id="ocode" placeholder="Student ID" class="text-name">
    <span id="studentIDErrorMessage" class="e" style="display: none;"></span>
</div>

                <div class="input-name">
                    <input type="password" name="p" placeholder="Password" class="text-name">
                </div>

                <div class="input-name">
                    <input type="password" name="cp" id="cp" placeholder="Confirm password" class="text-name">
                </div>
                

                <div class="input-name">
                    <input type="submit" name="submit" value="Sign up" class="button">
                    <input type="button" value="Cancel" onclick="location.href='login.php';" class="button">
                </div>
            </form>
        </div>
    </div>
</body>

</html>
