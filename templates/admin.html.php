<main class="sidebar">
    <?php require '../templates/sidebar.html.php';?>
        <h1>LOGINS</h1>
        <table>
            <thead>
                <tr>
                    <th>Admin Username</th>
                </tr>
                <?php foreach ($admins as $admin) {
                    if($admin['checkadmin'] == 'ADMIN') {?>
                    <tr>
                        <td><?= $admin['username'] ?></td>
                        <td>
                            <form method="POST" action="/admin/deleteadmin">
                                <input type="hidden" name="id" value="<?=$admin['userId']?>" />
                                <input type="submit" name="submit" value="Delete Admin" />
                            </form>
                        </td>
                    </tr>
                <?php }
                } ?>
            </thead>
        </table>
    </section>
</main>
