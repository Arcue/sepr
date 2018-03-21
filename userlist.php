<?php
if (isset($_SESSION['username'])){
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
            if($_SESSION['userrole'] == "Administrator") {
                $editlink = "Edit";
               //              <button type="submit" class="btn" name="logout" form="postform">Logout</button>
                $deletelink = "<button onclick=\"deleteUser('".$row["username"]."')\">Delete User</button>";
            } else {
                $editlink = "";
                $deletelink = "";
            }
            echo '<tr><td>'.$row["username"].'</td><td>'.$row['email'].'</td><td>'.$row['groupname'].'</td><td>'.$row['registered'].'</td><td>'.$row['lastvisited'].'</td>';
            echo '<td class="admintools">'.$editlink.'</td><td class="admintools">'.$deletelink.'</td></tr>';
        }
    }
}
?>
