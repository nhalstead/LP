<?php include ("../include/class.user.php");?>

smartipants

<?php
function fetch_role()
{
    $role = "guest";
    if(isset($_SESSION['id_user']))
    {
        // User exists
        $sql = sprintf("SELECT * FROM users WHERE id_user='%s' LIMIT 1",
            mysql_real_escape_string($_SESSION['id_user']));

        // RUN THE MYSQL QUERY TO FETCH THE USER, SAVE INTO $row

        if(!empty($row))
        {
            $role = $user_row['role'];
        }
    }

    return $role;
}

$role = fetch_role();
if($role == 'guest')
{
    // SHOW GUEST CONTENT
}
elseif($role == 'member')
{
    // SHOW OTHER CONTENT
}
elseif($role == 'admin')
{
    // SHOW ADMIN CONTENT
}
?>