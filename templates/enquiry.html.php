<main class="sidebar">
    <?php require '../templates/sidebar.html.php';?>
    <h1>Enquiries</h1>
    <a class="new" href="/admin/contact">Add Enquiry</a>
    <table>
        <thead>
        <tr>
            <th style="width: 30%">Name</th>
            <th style="width: 35%">Enquiry</th>
            <th style="width: 15%">Staff</th>
        </tr>
        <?php foreach ($enquiries as $enquiry) { ?>
            <tr>
                <td><?= $enquiry['name'] ?></td>
                <td><?= $enquiry['enquiry'] ?></td>
               <?php if(isset($enquiry['adminId'])) { ?>
                    <td> Completed by <?= $enquiry['username'] ?></td>
                   <td> Complete </td>
                <?php } else { ?>
                   <td>
                       <form method="post" action="/admin/completeEnquiry">
                           <input type="hidden" name="id" value=" <?=$enquiry['id']?> " />
                           <input type="submit" name="submit" value="Click to Complete" />
                       </form>
                   </td>
                   <td>PENDING...</td>
                <?php } ?>
            </tr>
        <?php } ?>
        </thead>
    </table>
    </section>
</main>
