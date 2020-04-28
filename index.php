<?php
session_start();
include('includes/functions.php');
include('includes/authentication.php');
include('includes/database.php');

displayPageHeader('RoomsForRent');
?>

<div class="row">
    <div class="col-md-8">
        <a class="btn btn-primary btn-lg" href="src/signin.php" role="button">Sign In</a>
        <a class="btn btn-primary btn-lg" href="src/signup.php" role="button">Sign Up</a>
        <?php
            if(is_logged())
                echo '<a class="btn btn-primary btn-lg" href="src/signout.php" role="button">Sign Out</a>';
        ?>
    </div>
    <div class="col-md-4">
        <!-- Button to add a room for renting -->
        <a class="btn btn-primary btn-lg" href="create.php" role="button">Add Your Room For Renting</a>
    </div>
</div>
<br><br>

<!-- Show list of rooms available -->
<h3>Rooms Available Now:</h3>
<ul class="list-group">
    
    <?php
    $ids = $database->getAllRoomIds();
    $count = count($ids);
    for($i=0; $i<$count; ++$i){
        $room = $database->getRoomInfo($ids[$i]);
	    $owner = $database->getUserInfo($room->postedBy);
        displayList($room, $owner);
    }
    ?>            
</ul>

<?php displayPageFooter(); ?>
