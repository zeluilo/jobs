<!DOCTYPE html>
<html>

    <head>
        <link rel="stylesheet" href="/styles.css" />
        <title><?=$title ?? "";?></title>
    </head>

    <body>
        <header>
            <section>
                <aside>
                    <h3>Office Hours:</h3>
                    <p>Mon-Fri: 09:00-17:30</p>
                    <p>Sat: 09:00-17:00</p>
                    <p>Sun: Closed</p>
                </aside>
                <h1>Jo's Jobs</h1>
            </section>
        </header>
            <?php require 'nav.html.php' ?>

        <img src="/../images/randombanner.php"/>

        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { ?>
            <a href='/admin/logout'><button style="background-color: grey; font-size: 18px; padding: 2px 2px; margin: 7px; width: 150px; cursor: pointer;">LOGOUT HERE</button></a>
            <br><a href='/admin/jobs'><button style="background-color: grey; font-size: 18px; padding: 2px 2px; margin: 7px; width: 120px; cursor: pointer;">PANEL</button></a>
        <?php } else { ?>
            <a href='/admin/login'><button style="background-color: grey; font-size: 20px; padding: 2px 2px; margin: 7px; width: 140px; cursor: pointer;">LOGIN HERE</button></a>
        <?php } ?>

        <?= $output ?? ""; ?>
        <footer>
            &copy; Jo's Jobs <?=date('Y')?>
        </footer>
    </body>
</html>