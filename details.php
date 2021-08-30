<?php

include('templates/db_connect.php');

$errors = array('passwords' => '');

// //for password
// if (empty($_POST['passwords'])) {
//     $errors['passwords'] = 'A password is required to delete<br>';
// } 
// else{ 
//     $passwords = $_POST['passwords'];
// }

// if(isset($_POST['passwords'])){
//     $passwords = $_POST['passwords'];
//     $sql="SELECT * FROM gamelist WHERE passwords='".$passwords."' LIMIT 1";
//     $res=mysqli_query($conn,$sql);
//     if(mysqli_num_rows($res)==1)
//     {
//         echo "successfully deleted";
//     }
//     else{
//         echo "wrong password entered";
//     }

// }



if (isset($_POST['delete'])) {

    $passwords = $_POST['passwords'];
    $sql = "SELECT * FROM gamelist WHERE passwords='" . $passwords . "' LIMIT 1";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) == 1) {
        // echo "successfully deleted";


        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        $sql = "DELETE FROM gamelist WHERE id=$id_to_delete";

        if (mysqli_query($conn, $sql)) {
            // success
            header('Location: index.php');
        } else {
            echo 'query error due to ' . mysqli_error($conn);
        }
    } else {
        echo 'wrong passwod';
    }
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    //make sql
    $sql = "SELECT * FROM gamelist WHERE id=$id";

    // get the query result
    $result = mysqli_query($conn, $sql);

    // fetch result in array format
    $gamelist = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);

    // print_r($gamelist);


}

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php') ?>

<h3 class="center heading" style="color:brown">DETAILS</h3>

<div class="center container">
    <?php if ($gamelist) :  ?>

        <h5 class="list_detail"><?php echo htmlspecialchars($gamelist['names']); ?></h5>
        <p class="list_detail"> Uploaded by (email) : <?php echo htmlspecialchars($gamelist['email']); ?></p>
        <p class="list_detail">Uploaded on : <?php echo htmlspecialchars($gamelist['uploaded_on']); ?></p>

        <!-- delete form  -->
        <form action="details.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $gamelist['id'] ?>">
            <input type="passwords" placeholder="Enter Password to delete" class="center passClass" required><br>
            <div class="red-text" style="font-weight: bold;"> <?php echo $errors['passwords']; ?> </div>
            <input type="submit" value="Delete" name="delete" class="btn brand-text ">
        </form>


    <?php else :  ?>
        <h5 class="list_detail">No such game exist </h5>
    <?php endif; ?>


</div>





<?php include('templates/footer.php')  ?>

</html>