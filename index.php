<?php

//connect to database
// hostName , userName ,password ,databaseName
$conn = mysqli_connect('localhost', 'junaid', 'test1234', 'game');

// check connection
if (!$conn) {
    echo 'connection error: ' . mysqli_connect_error();
}

// write query for all game
$sql = 'SELECT id, names, email, link FROM gamelist ORDER BY uploaded_on';

// make query & get RESULT
$result = mysqli_query($conn, $sql);

// fetch resulting rows as an array
$gamelist = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result from memory
mysqli_free_result($result);

//close connection
mysqli_close($conn);


// print_r($gamelist);
?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php') ?>

<h4 class="center" style="font-family: cursive; color:azure">
    LINKS 
</h4>
<br>     
<div class="container">
    <div class="row">
        <?php foreach ($gamelist as $gamelist) { ?>

            <div class="col s6 md3 lg2">
                <div class="card">
                    <img src="img/logo.png" class="logo" alt="">
                    <div class="card-content center thing ">
                        <h6><?php echo $gamelist['names'];  ?></h6>
                        <div>
                            <h6><?php echo $gamelist['email'];  ?></h6>
                        </div>
                        <div class="card-action right-align">
                            <a href="<?php echo $gamelist['link']?>" class="moreInfo go" target="_blank">GO</a>
                            <a href="details.php?id=<?php echo $gamelist['id']?>" class="center grey-text info">more Info</a>
                            
                        </div>
                    </div>
                </div>
            </div>



        <?php
        } ?>
    </div>
</div>

<?php include('templates/footer.php')  ?>
</body>

</html>