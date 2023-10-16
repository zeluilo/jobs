<main class="sidebar">
    <?php require '../templates/sidebar.html.php';?>
    <section class="right">
    <h1>Register!</h1>
    <form action="/admin/register" method="POST">
        <label>Username</label>
        <input type="text" name="username" placeholder="Enter your Username" autocomplete="off"/>

        <label>Email</label>
        <input type="email" name="email" placeholder="Enter your Email" autocomplete="off"/>

        <label>Password</label>
        <input type="password" name="password" placeholder="Enter your Password" autocomplete="off"/>

        <label>UserType</label>
        <select name="checkadmin">
            <?php
                echo '<option>ADMIN</option>';
                echo '<option>CLIENT</option>';
            ?>
        </select>
        <input type="submit" name='submit' value="Register Now"></a>
    </form>
</main>