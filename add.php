<?php

include('templates/db_connect.php');

$names = $email = $link = '';
$errorMessage='';
$errors = array('names' => '', 'email' => '', 'link' => '','passwords'=>'');

if (isset($_POST['submit'])) {
    // echo $_POST['names'];
    // echo $_POST['email'];
    // echo $_POST['link'];
    if (empty($_POST['names'])) {
        $errors['names'] = 'A name is required <br>';
    } else {
        $names = $_POST['names'];
    }
    if (empty($_POST['email'])) {
        $errors['email'] = 'An email is required <br>';

        //     //  FILTER VALIDATE IN PHP
        //       if(!(filter_var($email,FILTER_VALIDATE_EMAIL)))
        //       {
        // echo "enter a valid email address";
        //       }

    } else {
        $email = $_POST['email'];
    }
    if (empty($_POST['link'])) {
        $errors['link'] = 'A link is required <br>';
    } else {
        $link = $_POST['link'];
    }
    //for password
    if (empty($_POST['passwords'])) {
        $errors['passwords'] = 'A password is required <br>';
    } else {
        $link = $_POST['passwords'];
    }


    if (array_filter($errors)) {
        $errorMessage= 'errors in the form';
    } else {
        $email=mysqli_real_escape_string($conn, $_POST['email']);
        $names=mysqli_real_escape_string($conn, $_POST['names']);
        $link=mysqli_real_escape_string($conn, $_POST['link']);
        $passwords=mysqli_real_escape_string($conn, $_POST['passwords']);

        // create sql
        $sql="INSERT INTO gamelist(names,email,link,passwords) VALUES('$names','$email','$link','$passwords')";

//save to DB and check
if(mysqli_query($conn,$sql)){
    // success
    header('Location: index.php');
}
else{
    //error
    echo 'query error: ' . mysqli_error($conn);
}
       
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php') ?>

<section class="container">
    <h4 class="center" style="color: white; font-weight: bold;">Add a Link</h4>
    <form action="add.php" method="POST" class="white">
        <label class="label" style="color: black;">Name:</label>
        <input type="text" name="names" placeholder="Call of Duty" value="<?php echo $names; ?>">
        <div class="red-text" style="font-weight: bold;"> <?php echo $errors['names']; ?> </div>
        <label class="label">Email:</label>
        <input type="email" name="email" placeholder="mohdjunaid@gmail.com" value="<?php echo $email; ?>">
        <div class="red-text" style="font-weight: bold;"> <?php echo $errors['email']; ?> </div>
        <label class="label">Link:</label>
        <input type="text" name="link" value="<?php echo $link; ?>">
        <div class="red-text" style="font-weight: bold;"> <?php echo $errors['link']; ?> </div>
        <label class="label">Password:</label>
        <input type="password" name="passwords" placeholder="******" >
        <div class="red-text" style="font-weight: bold;"> <?php echo $errors['passwords']; ?> </div>
        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand ">
        </div>
        <br>
        <div class="center red-text" style="font-weight: bold;"> <?php echo $errorMessage; ?></div>
    </form>
</section>

<?php include('templates/footer.php')  ?>
</body>

</html>