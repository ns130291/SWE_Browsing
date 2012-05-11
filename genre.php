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
    </head><?php ?>
    <body>
        <div id="header">BookExpress</div>
        <div id="main">
            <div id="breadcrumb">
                <a href="index.php">Home</a>
                <?php
                if (isset($_GET['category']) && !isset($_GET['genre'])) {
                    echo ' &gt; <a href="category.php">Kategorie</a> &gt; ' . $_GET['category'];
                } else {
                    if (isset($_GET['genre']) && isset($_GET['category'])) {
                        if ($_GET['genre'] == "NULL") {
                            $breadcrumb = ' &gt; <a href="category.php">Kategorie</a> &gt; <a href="genre.php?category=' . $_GET['category'] . '">' . $_GET['category'] . '</a> &gt; <a href="genre.php?genre=NULL&category=' . $_GET['category'] . '">ohne Genre</a>';
                            echo ' &gt; <a href="category.php">Kategorie</a> &gt; <a href="genre.php?category=' . $_GET['category'] . '">' . $_GET['category'] . '</a> &gt; ohne Genre';
                        } else {
                            $breadcrumb = ' &gt; <a href="category.php">Kategorie</a> &gt; <a href="genre.php?category=' . $_GET['category'] . '">' . $_GET['category'] . '</a> &gt; <a href="genre.php?genre=' . $_GET['genre'] . '&category=' . $_GET['category'] . '">' . $_GET['genre'] . '</a>';
                            echo ' &gt; <a href="category.php">Kategorie</a> &gt; <a href="genre.php?category=' . $_GET['category'] . '">' . $_GET['category'] . '</a> &gt; ' . $_GET['genre'];
                        }
                    } else {
                        if (isset($_GET['genre'])) {
                            if ($_GET['genre'] == "NULL") {
                                $breadcrumb = ' &gt; <a href="genre.php">Genre</a> &gt; <a href="genre.php?genre=NULL">ohne Genre</a>';
                                echo ' &gt; <a href="genre.php">Genre</a> &gt; ohne Genre';
                            } else {
                                $breadcrumb = ' &gt; <a href="genre.php">Genre</a> &gt; <a href="genre.php?genre=' . $_GET['genre'] . '">' . $_GET['genre'] . '</a>';
                                echo ' &gt; <a href="genre.php">Genre</a> &gt; ' . $_GET['genre'];
                            }
                        } else {
                            echo ' &gt; Genre';
                        }
                    }
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
                <!--<h2>Alphabetisch</h2>-->
                <?php
                if (isset($_GET['genre'])) {
                    echo '<h2>' . $_GET['genre'] . '</h2>';
                    $link = mysql_connect('localhost:3306', 'root');
                    if (!$link) {
                        echo 'no link';
                    }
                    mysql_set_charset('utf8');
                    if ($_GET['genre'] == "NULL") {
                        $query = 'SELECT title, isbn FROM bookexpress.item WHERE genre IS NULL';
                    } else {
                        $query = 'SELECT title, isbn FROM bookexpress.item WHERE genre="' . $_GET['genre'] . '"';
                    }
                    if (isset($_GET['category'])) {
                        $query .= ' AND category="' . $_GET['category'] . '"';
                    }
                    $result = mysql_query($query);
                    if (!$result) {
                        echo '-1';
                    } else {
                        while ($row = mysql_fetch_array($result)) {
                            ?>
                            <div class="item">
                                <a href="item.php?isbn=<?php echo $row[1]; ?>&breadcrumb=<?php echo urlencode($breadcrumb) ?>"><?php echo $row[0]; ?></a>
                            </div>
                            <?php
                        }
                    }
                    ?>

                    <?php
                } else {
                    ?>
                    <h2>Genres
                        <?php
                        if (isset($_GET['category'])) {
                            echo ' in Kategorie ' . $_GET['category'];
                        }
                        ?>
                    </h2>
                    <?php
                    if (isset($_GET['category'])) {
                        ?>
                        <div class="item">
                            <a href="alphabetical.php?category=<?php echo $_GET['category']; ?>">alle</a>
                        </div>
                        <?php
                    }
                    $link = mysql_connect('localhost:3306', 'root');
                    if (!$link) {
                        echo 'no link';
                    }
                    mysql_set_charset('utf8');
                    if (isset($_GET['category'])) {
                        $result = mysql_query('SELECT DISTINCT genre FROM bookexpress.item WHERE category="' . $_GET['category'] . '"');
                        $result2 = mysql_query('SELECT DISTINCT genre FROM bookexpress.item WHERE genre IS NULL AND category="' . $_GET['category'] . '"');
                    } else {
                        $result = mysql_query('SELECT DISTINCT genre FROM bookexpress.item');
                        $result2 = mysql_query('SELECT DISTINCT genre FROM bookexpress.item WHERE genre IS NULL');
                    }
                    if (!$result2) {
                        echo '-1';
                    } else {
                        $row = mysql_fetch_array($result2);
                        if ($row) {
                            ?>
                            <div class="item">
                                <a href="genre.php?genre=NULL<?php
                if (isset($_GET['category'])) {
                    echo '&category=' . $_GET['category'];
                }
                            ?>">ohne Genre</a>
                            </div>
                            <?php
                        }
                    }
                    if (!$result) {
                        echo '-1';
                    } else {
                        while ($row = mysql_fetch_array($result)) {
                            ?>
                            <div class="item">
                                <a href="genre.php?genre=<?php
                echo $row[0];
                if (isset($_GET['category'])) {
                    echo '&category=' . $_GET['category'];
                }
                            ?>"><?php echo $row[0]; ?></a>
                            </div>
                            <?php
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
