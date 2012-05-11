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
                if (isset($_GET['popular'])) {
                    $breadcrumb = ' &gt; <a href="popularity.php">Beliebtheit</a>';
                    echo ' &gt; <a href="popularity.php">Beliebtheit</a>';
                    if ((bool) $_GET['popular']) {
                        $breadcrumb .= ' &gt; <a href="popularity.php?popular=1">Beliebteste</a>';
                        echo ' &gt; Beliebteste';
                    } else {
                        $breadcrumb .= ' &gt; <a href="popularity.php?popular=0">Unbeliebteste</a>';
                        echo ' &gt; Unbeliebteste';
                    }
                } else {
                    echo ' &gt; Beliebtheit';
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
                <h2>Beliebtheit</h2>
                <?php
                if (isset($_GET['popular'])) {
                    $link = mysql_connect('localhost:3306', 'root');
                    if (!$link) {
                        echo 'no link';
                    }
                    mysql_set_charset('utf8');
                    $query = 'SELECT title, isbn FROM bookexpress.item ORDER BY popularity';
                    if ((bool) $_GET['popular']) {
                        $query .= ' DESC';
                    }
                    $result = mysql_query($query);
                    if (!$result) {
                        echo '-1';
                    } else {
                        while ($row = mysql_fetch_row($result)) {
                            ?>
                            <div class="item">
                                <a href="item.php?isbn=<?php echo $row[1]; ?>&breadcrumb=<?php echo urlencode($breadcrumb) ?>"><?php echo $row[0]; ?></a>
                            </div>
                            <?php
                        }
                    }
                } else {
                    ?>
                    <div class="item">
                        <a href="popularity.php?popular=1">Beliebteste Medien</a>
                    </div>
                    <div class="item">
                        <a href="popularity.php?popular=0">Unbeliebteste Medien</a>
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
