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
                <a href="index.php">Home</a>
                <?php
                if (isset($_GET['rating'])) {
                    $breadcrumb = ' &gt; <a href="rating.php">Bewertung</a>';
                    echo ' &gt; <a href="rating.php">Bewertung</a>';
                    if ((bool) $_GET['rating']) {
                        $breadcrumb .= ' &gt; <a href="rating.php?rating=1">Absteigend</a>';
                        echo ' &gt; Absteigend';
                    } else {
                        $breadcrumb .= ' &gt; <a href="rating.php?rating=0">Aufsteigend</a>';
                        echo ' &gt; Aufsteigend';
                    }
                } else {
                    echo ' &gt; Bewertung';
                }
                ?>
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
                <h2>Bewertung</h2>
                <?php
                if (isset($_GET['rating'])) {
                    $link = mysql_connect('localhost:3306', 'root');
                    if (!$link) {
                        echo 'no link';
                    }
                    mysql_set_charset('utf8');
                    $query = 'SELECT rating, title, isbn FROM bookexpress.item ORDER BY rating';
                    if ((bool) $_GET['rating']) {
                        $query .= ' DESC';
                    }
                    $result = mysql_query($query);
                    if (!$result) {
                        echo '-1';
                    } else {
                        while ($row = mysql_fetch_row($result)) {
                            ?>
                            <div class="item">
                                <div class="rating ratingoverview" data-rating="<?php echo $row[0]; ?>"></div>
                                <a href="item.php?isbn=<?php echo $row[2]; ?>&breadcrumb=<?php echo urlencode($breadcrumb) ?>"><?php echo $row[1]; ?></a>
                            </div>
                            <?php
                        }
                    }
                } else {
                    ?>
                    <div class="item">
                        <a href="rating.php?rating=1">Absteigend</a>
                    </div>
                    <div class="item">
                        <a href="rating.php?rating=0">Aufsteigend</a>
                    </div>
                    <?php
                }
                ?>
            </section>
        </div>
        <footer>
            Credits to Nico and Anja
        </footer>
    </body>
</html>
