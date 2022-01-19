<?php

function confirmQuery($create_post_query)
{
    global $connection;
    if (!$create_post_query) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
}

// CATEGORIES

function insert_categories()
{

    global $connection;

    if (isset($_POST['submit'])) {

        $cat_title = $_POST['cat_title'];

        if ($cat_title == "" || empty($cat_title)) {
            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUE('{$cat_title}')";

            $create_category_query = mysqli_query($connection, $query);

            if (!$create_category_query) {
                die("Query failer" . mysqli_error($connection));
            }
        }
    }
}


function findAllCategories()
{

    global $connection;


    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);



    while ($row = mysqli_fetch_assoc($select_categories)) {

        $cat_title = $row["cat_title"];
        $cat_id = $row["cat_id"];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
?>
        <td><a href='categories.php?delete=<?php echo $cat_id ?>' onclick="return confirm(' Are you sure you want to delete?');">Izbriši</a></td>
    <?php
        echo "<td><a href='categories.php?edit={$cat_id}'>Uredi</a></td>";
        echo "</tr>";
    }
}


function deleteCategories()
{

    global $connection;
    if (isset($_GET['delete'])) {

        $the_cat_id = $_GET['delete'];


        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";

        $delete_query = mysqli_query($connection, $query);
        // This header function will refresh the page because when we click on delete without header we have to click on it again in order to see the change
        header("Location: categories.php");
    }
}



// CATEGORIES END  // 





// POSTS


function createAd()
{

    global $connection;
    $ad_owner = $_SESSION['id'];
    $ad_name1 = $_POST['ad_title'];
    $price = $_POST['price'];
    $ad_cat = $_POST['ad_category_id'];
    $ad_description = $_POST['ad_content'];


    $post_image = $_FILES['image']['name'];
    // Before we submit the form image is saved in temp 
    $post_image_temp = $_FILES['image']['tmp_name'];


    $ad_tags = $_POST['ad_tags'];
    $ad_date = date("Y/m/d");
    $ad_comment_count = 0;

    move_uploaded_file($post_image_temp, "images/$post_image");

    $query = "INSERT INTO ads(ad_name,ad_cat,ad_description,price,ad_owner,ad_date,ad_comment_count,ad_image,ad_tags) ";
    $query .= "VALUES('{$ad_name1}','{$ad_cat}','{$ad_description}','{$price}','{$ad_owner}','{$ad_date}','{$ad_comment_count}','{$post_image}','{$ad_tags}')";

    $create_post_query = mysqli_query($connection, $query);
    return $create_post_query;
}


function findAllPosts()
{

    global $connection;

    $query = "SELECT * FROM ads";
    $select_categories = mysqli_query($connection, $query);



    while ($row = mysqli_fetch_assoc($select_categories)) {

        $post_id = $row["ad_id"];
        $post_title = $row["ad_name"];
        $post_category_id = $row["ad_cat"];
        $post_author = $row["ad_owner"];
        $post_date = $row["ad_date"];
        $post_image = $row["ad_image"];
        $post_content = $row["ad_description"];
        $post_tags = $row["ad_tags"];
        $post_comment_count = $row["ad_comment_count"];
        $post_status = $row["ad_status"];

        $post_status1 = ($post_status == 'Approved') ? 'Odobren' : 'Zabranjen';

        echo "<tr>";
        echo "<td>{$post_id}</td>";
        echo "<td>{$post_title}</td>";

        $query1 = "SELECT * FROM categories WHERE cat_id = $post_category_id";
        $select_categories_id = mysqli_query($connection, $query1);

        $query2 = "SELECT * FROM users WHERE user_id = $post_author";
        $select_users_id = mysqli_query($connection, $query2);


        $query_comment_count = "SELECT * FROM comments WHERE comment_ad_id = {$post_id}";
        $count_comments_query = mysqli_query($connection, $query_comment_count);
        $count_comments = mysqli_num_rows($count_comments_query);

        while ($row = mysqli_fetch_assoc($select_categories_id)) {

            $cat_title = $row["cat_title"];

            echo "<td>{$cat_title}</td>";
        }




        while ($row = mysqli_fetch_assoc($select_users_id)) {

            $username = $row["username"];

            echo "<td>{$username}</td>";
        }

        // echo "<td>{$post_author}</td>";
        echo "<td><img width='200px' height='100px' src='../images/$post_image' alt=''></td>";
        echo "<td>{$post_date}</td>";
        echo "<td>{$post_content}</td>";
        echo "<td>{$post_tags}</td>";
        echo "<td>{$count_comments}</td>";
        echo "<td>{$post_status1}</td>";
    ?>
        <td><a href='ads.php?delete=<?php echo $post_id ?>' onclick="return confirm(' Da li ste sigurni da želite obrisati ovaj oglas?');">Izbriši</a></td>
        <?php
        echo "<td><a href='ads.php?source=edit_post&edit={$post_id}'>Uredi</a></td>";



        // careful now

        if ($post_status == 'Unapproved') {
        ?>
            <td><a href='ads.php?approve=<?php echo $post_id ?>' onclick="return confirm(' Da li ste sigurni da želite odobriti ovaj oglas?');">Odobri</a></td>


        <?php
        }
        if ($post_status == 'Approved') {
        ?>
            <td><a href='ads.php?unapprove=<?php echo $post_id ?>' onclick="return confirm(' Da li ste sigurni da želite zabraniti ovaj oglas?');">Zabrani</a></td>
        <?php
        }

        echo "</tr>";
        // dont be careful
    }
}


function deletePosts()
{

    global $connection;
    if (isset($_GET['delete'])) {

        $the_ad_id = $_GET['delete'];


        $query = "DELETE FROM ads WHERE ad_id = {$the_ad_id}";

        $delete_query = mysqli_query($connection, $query);
        // This header function will refresh the page because when we click on delete without header we have to click on it again in order to see the change
        header("Location: ads.php");
    }
}



function countAds()
{
    global $connection;
    $ads = array();
    $sum = 0;
    $query_ad_count = "SELECT * FROM ads";
    $count_ads_query = mysqli_query($connection, $query_ad_count);
    $ads['all'] = mysqli_num_rows($count_ads_query);


    $query_ad_count_approved = "SELECT * FROM ads WHERE ad_status = 'Approved'";
    $count_ads_query = mysqli_query($connection, $query_ad_count_approved);
    $ads['approved'] = mysqli_num_rows($count_ads_query);

    $query_ad_count_approved = "SELECT * FROM ads WHERE ad_status = 'Unapproved'";
    $count_ads_query = mysqli_query($connection, $query_ad_count_approved);
    $ads['unapproved'] = mysqli_num_rows($count_ads_query);

    $query_cat_count = "SELECT * FROM categories";
    $count_cat_query = mysqli_query($connection, $query_cat_count);
    $cat_num = mysqli_num_rows($count_cat_query);


    for ($i = 1; $i <= $cat_num; $i++) {
        $query_ad_count_approved = "SELECT * FROM ads  WHERE ad_cat = {$i}";
        $count_ads_query = mysqli_query($connection, $query_ad_count_approved);
        $ads['ad_cat' . $i] = mysqli_num_rows($count_ads_query);
    }

    $query_ad_price_high = "SELECT * FROM ads WHERE ad_status = 'Approved' ORDER BY price DESC LIMIT 1";
    $count_ads_high = mysqli_query($connection, $query_ad_price_high);
    while ($row = mysqli_fetch_assoc($count_ads_high)) {

        $ads['ad_highest'] = $row["price"];
    }


    $query_ad_price_low = "SELECT * FROM ads  WHERE ad_status = 'Approved' ORDER BY price ASC LIMIT 1";
    $count_ads_low = mysqli_query($connection, $query_ad_price_low);
    while ($row = mysqli_fetch_assoc($count_ads_low)) {

        $ads['ad_lowest'] = $row["price"];
    }

    $query_ad_price_all = "SELECT * FROM ads  WHERE ad_status = 'Approved'";
    $count_ads_all_price = mysqli_query($connection, $query_ad_price_all);

    while ($row = mysqli_fetch_assoc($count_ads_all_price)) {

        $sum += $row["price"];
    }
    $ads['average_price'] = $sum / $ads['all'];
    return $ads;
}


/*
function countUsers()
{

    global $connection;
    $users = array();
    $query_user_count = "SELECT * FROM users";
    $count_user_query = mysqli_query($connection, $query_user_count);
    

    while ($row = mysqli_fetch_assoc($count_user_query)) {

        $post_id = $row["ad_id"];
        $post_category_id = $row["ad_cat"];
        $post_title = $row["ad_name"];
        $post_author = $row["ad_owner"];
        $post_date = $row["ad_date"];
        $post_image = $row["ad_image"];
        $post_content = $row["ad_description"];
        $post_tags = $row["ad_tags"];
        $post_comment_count = $row["ad_comment_count"];
        $post_status = $row["ad_status"];

        $query = "SELECT * FROM users WHERE user_id = $post_author";
        $getUsername = mysqli_query($connection, $query);
        $rowUser = mysqli_fetch_assoc($getUsername);
        $AuthorName = $rowUser['username']
}
*/



// COMMENTS




function findAllComments()
{

    global $connection;

    $query = "SELECT * FROM comments";
    
    $select_comments = mysqli_query($connection, $query);



    if (isset($_GET['approve'])) {
        $comment_id = $_GET['approve'];
        $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = {$comment_id}";
        echo $query;
        $update_status = mysqli_query($connection, $query);
        header("Location: comments.php");
    }

    if (isset($_GET['unapprove'])) {
        $comment_id = $_GET['unapprove'];
        $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = {$comment_id}";
        echo $query;
        $update_status = mysqli_query($connection, $query);
        header("Location: comments.php");
    }


    while ($row = mysqli_fetch_assoc($select_comments)) {

        $comment_id = $row["comment_id"];
        $comment_post_id = $row["comment_ad_id"];
        $comment_author = $row["comment_author"];
        $comment_email = $row["comment_email"];
        $comment_content = $row["comment_content"];
        $comment_status = $row["comment_status"];
        $comment_date = $row["comment_date"];


        echo "<tr>";
        echo "<td>{$comment_id}</td>";

        $query1 = "SELECT * FROM ads WHERE ad_id = $comment_post_id";
        $select_comments_post = mysqli_query($connection, $query1);

        while ($row = mysqli_fetch_assoc($select_comments_post)) {

            $post_id = $row["ad_id"];

            echo "<td>{$post_id}</td>";
        }



        echo "<td>{$comment_author}</td>";
        echo "<td>{$comment_email}</td>";
        echo "<td>{$comment_content}</td>";
        echo "<td>{$comment_date}</td>";
        echo "<td>{$comment_status}</td>";
        echo "<td></td>";

        ?>
        <?php

        if ($comment_status == 'Unapproved') {
        ?>
            <td><a href='comments.php?approve=<?php echo $comment_id ?>' onclick="return confirm(' Are you sure you want to approve this comment?');">Odobri</a></td>


        <?php
        }
        if ($comment_status == 'Approved') {
        ?>
            <td><a href='comments.php?unapprove=<?php echo $comment_id ?>' onclick="return confirm(' Are you sure you want to unapprove this comment?');">Ne odobri</a></td>
        <?php
        }

        ?>




        <td><a href='comments.php?delete=<?php echo $comment_id ?>' onclick="return confirm(' Are you sure you want to delete this comment?');">Izbriši</a></td>




        <?php

    }
    if (mysqli_num_rows($select_comments) == 0) {
        echo "<td>Nije pronađen niti jedan komentar</td>";
    }
}


function deleteComments()
{

    global $connection;
    if (isset($_GET['delete'])) {

        $the_comment_id = $_GET['delete'];


        $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";

        $delete_query = mysqli_query($connection, $query);
        // This header function will refresh the page because when we click on delete without header we have to click on it again in order to see the change
        header("Location: comments.php");
    }
}



// USERS



function findAllUsers()
{
    global $connection;
    $query = "SELECT * FROM users";
    $select_categories = mysqli_query($connection, $query);



    if (isset($_GET['role'])) {
        $the_user_id1 = $_GET['role'];
        $query1 = "UPDATE users SET user_role = 'Admin' WHERE user_id = {$the_user_id1}";

        $update_status = mysqli_query($connection, $query1);
        header("Location: users.php");
    }

    if (isset($_GET['unrole'])) {
        $the_user_id1 = $_GET['unrole'];
        $query1 = "UPDATE users SET user_role = 'Standard' WHERE user_id = {$the_user_id1}";

        $update_status = mysqli_query($connection, $query1);
        header("Location: users.php");
    }





    while ($row = mysqli_fetch_assoc($select_categories)) {

        $user_id = $row["user_id"];
        $username = $row["username"];
        $user_firstname = $row["user_firstname"];
        $user_lastname = $row["user_lastname"];
        $user_email = $row["user_email"];
        $user_image = $row["user_image"];
        $user_role = $row["user_role"];

        echo "<tr>";
        echo "<td>{$user_id}</td>";
        echo "<td>{$username}</td>";
        echo "<td>{$user_firstname}</td>";
        echo "<td>{$user_lastname}</td>";
        echo "<td>{$user_email}</td>";
        echo "<td><img width='200px' height='100px' src='../images/$user_image' alt=''></td>";
        echo "<td>{$user_role}</td>";







        if ($user_role == 'Standard') {
        ?>
            <td><a href='users.php?role=<?php echo $user_id ?>' onclick="return confirm(' Are you sure you want to make this user an admin?');">Make Admin</a></td>


        <?php
        }
        if ($user_role == 'Admin') {
        ?>
            <td><a href='users.php?unrole=<?php echo $user_id ?>' onclick="return confirm(' Are you sure you want to make this user standard?');">Make Standard</a></td>
        <?php
        }

        ?>


        <td><a href='users.php?delete=<?php echo $user_id ?>' onclick="return confirm(' Are you sure you want to delete this user?');">Delete</a></td>
<?php

    }
}


function deleteUsers()
{

    global $connection;
    if (isset($_GET['delete'])) {

        $the_user_id = $_GET['delete'];


        $query = "DELETE FROM users WHERE user_id = {$the_user_id}";

        $delete_query = mysqli_query($connection, $query);
        // This header function will refresh the page because when we click on delete without header we have to click on it again in order to see the change
        header("Location: users.php");
    }
}



function statusPosts()
{
    global $connection;
    if (isset($_GET['approve'])) {

        $the_ad_id = $_GET['approve'];


        $query = "UPDATE ads SET ad_status = 'Approved' WHERE ad_id = {$the_ad_id}";

        $delete_query = mysqli_query($connection, $query);
        // This header function will refresh the page because when we click on delete without header we have to click on it again in order to see the change
        header("Location: ads.php");
    }
    if (isset($_GET['unapprove'])) {

        $the_ad_id = $_GET['unapprove'];


        $query = "UPDATE ads SET ad_status = 'Unapproved' WHERE ad_id = {$the_ad_id}";

        $delete_query = mysqli_query($connection, $query);
        // This header function will refresh the page because when we click on delete without header we have to click on it again in order to see the change
        header("Location: ads.php");
    }
}