<main class="sidebar">
    <?php require '../templates/sidebar.html.php';?>
        <h1>Categories</h1>
                <a class="new" href="/admin/addcategory">Add new category</a>
        <table>
            <thead>
                 <tr>
                     <th>Name</th>
                     <th style="width: 50%">&nbsp;</th>
                     <th style="width: 5%">&nbsp;</th>
                 </tr>
                 <?php foreach ($categories as $category) { ?>
                    <tr>
                        <td><?= $category['name'] ?></td>
                        <td><a style="float: right" href="/admin/editcategory?id=<?=$category['id']?>">Edit</a></td>
                        <td>
                            <form method="POST" action="/admin/deletecategory">
                                <input type="hidden" name="id" value="<?=$category['id']?>" />
                                <input type="submit" name="submit" value="Delete" />
                            </form>
                        </td>
                    </tr>
                 <?php } ?>
            </thead>
        </table>
    </section>
</main>