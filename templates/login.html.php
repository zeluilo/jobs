<?php echo $show_message; ?>
<main class="home">
    <h2>Login!</h2>
        <form action="../admin/login" method="POST">
            <label>Username</label>
            <input type="name" name="username" placeholder="Enter your Username" />

            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your Password" />

            <input type="submit" name='submit' value="Login">
        </form>
</main>
