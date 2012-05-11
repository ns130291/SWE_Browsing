<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>BookExpress</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div id="header">BookExpress</div>
        <div id="main">
            <div id="breadcrumb">
                <a href="index.php">Home</a> &gt; Kategorie
            </div>
            <nav>
                <h3>Sortieren nach...</h3>
                <div>
                    <a href="category.php">Kategorie</a>
                </div>
                <div>
                    <a href="genre.php">Genre</a>
                </div>
                <div>
                    <a href="author.php">Autor</a>
                </div>
                <div>
                    <a href="publisher.php">Verlag</a>
                </div>
                <div>
                    <a href="year.php">Erscheinungsjahr</a>
                </div>
                <div>
                    <a href="popularity.php">Beliebtheit</a>
                </div>
                <div>
                    <a href="rating.php">Bewertungen</a>
                </div>
                <div>
                    <a href="alphabetical.php">Alphabetisch</a>
                </div>
                <div>
                    <a href="isbn.php">ISBN</a>
                </div>
            </nav>
            <section>
                <h2>Kategorie</h2>
                <?php
                $link = mysql_connect('localhost:3306', 'root');
                if (!$link) {
                    echo 'no link';
                }
                mysql_set_charset('utf8');
                $result = mysql_query("SELECT DISTINCT category FROM bookexpress.item");
                if (!$result) {
                    echo '-1';
                } else {
                    while ($row = mysql_fetch_array($result)) {
                        $breadcrumb = ' &gt; <a href"category.php">Kategorie</a>';
                        ?>
                        <div class="item">
                            <a href="genre.php?category=<?php echo $row[0]; ?>&breadcrumb=<?php urlencode($breadcrumb) ?>"><?php echo $row[0]; ?></a>
                        </div>
                        <?php
                    }
                }
                ?>
            </section>
        </div>
        <footer>
            Credits to Nico and Anja
        </footer>
    </body>
</html>

<?php ?>
