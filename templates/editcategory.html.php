<main class="sidebar">
    <?php require '../templates/sidebar.html.php';?>
        <h1>Edit Category</h1>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $categories['id'] ?>" />

            <label>Category Name</label>
            <input type="text" name="name" value="<?php echo $categories['name']?>" />

            <input type="submit" name="submit" value="Edit Category" />
        </form>
    </section>
</main>
