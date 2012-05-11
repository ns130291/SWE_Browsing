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
                echo ' &gt; Erscheinungsjahr';
                $breadcrumb = ' &gt; <a href="alphabetical.php">Erscheinungsjahr</a>';
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
                <h2>Erscheinungsjahr</h2>
                <?php
                $link = mysql_connect('localhost:3306', 'root');
                if (!$link) {
                    echo 'no link';
                }
                mysql_set_charset('utf8');
                $query = 'SELECT DISTINCT `year` FROM bookexpress.item';
                $query .= ' ORDER BY year';
                $result = mysql_query($query);
                if (!$result) {
                    echo '-1';
                } else {
                    while ($row = mysql_fetch_row($result)) {
                        ?>
                        <div class="bigchar"><?php echo $row[0]; ?></div>
                        <?php
                        $query = 'SELECT title, isbn FROM bookexpress.item WHERE year="' . $row[0] . '"';
                        $query .= ' ORDER BY title';
                        $result2 = mysql_query($query);
                        if (!$result2) {
                            echo '-1';
                        } else {
                            while ($row2 = mysql_fetch_row($result2)) {
                                ?>
                                <div>
                                    <a href="item.php?isbn=<?php echo $row2[1]; ?>&breadcrumb=<?php echo urlencode($breadcrumb) ?>"><?php echo $row2[0]; ?></a>
                                </div>
                                <?php
                            }
                        }
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
