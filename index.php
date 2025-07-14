<?php
include 'db.php';

// Fetch all categories
$sql_categories = "SELECT * FROM categories";
$result_categories = $conn->query($sql_categories);

// Fetch latest article for featured section
$sql_featured = "SELECT * FROM articles ORDER BY publish_date DESC LIMIT 1";
$result_featured = $conn->query($sql_featured);
$featured_article = $result_featured->fetch_assoc();
?>

<html>
<head>
    <title>News Website</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; }
        .header { background-color: #c00; color: white; padding: 20px; text-align: center; }
        .menu { list-style-type: none; margin: 0; padding: 0; background-color: #333; overflow: hidden; }
        .menu li { float: left; }
        .menu li a { display: block; color: white; padding: 14px 16px; text-decoration: none; }
        .menu li a:hover { background-color: #555; }
        .featured { margin: 20px; padding: 20px; background-color: #f9f9f9; }
        .categories { margin: 20px; }
        .article { border-bottom: 1px solid #ddd; padding: 10px 0; display: flex; }
        .article img { max-width: 100px; margin-right: 10px; }
        .search-form { margin: 10px; }
        @media (max-width: 600px) {
            .menu li { float: none; }
            .article { flex-direction: column; }
            .article img { max-width: 100%; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>News Website</h1>
    </div>
    <ul class="menu">
        <?php while ($category = $result_categories->fetch_assoc()) { ?>
            <li><a href="category.php?cat=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></li>
        <?php } ?>
    </ul>
    <form action="search.php" method="get" class="search-form">
        <input type="text" name="q" placeholder="Search...">
        <input type="submit" value="Search">
    </form>
    <div class="featured">
        <h2><?php echo $featured_article['title']; ?></h2>
        <img src="<?php echo $featured_article['image_url']; ?>" width="300" alt="Featured Image">
        <p><?php echo substr($featured_article['content'], 0, 200); ?>...</p>
        <a href="article.php?id=<?php echo $featured_article['id']; ?>">Read more</a>
    </div>
    <div class="categories">
        <?php
        $result_categories = $conn->query($sql_categories);
        while ($category = $result_categories->fetch_assoc()) {
            echo "<h3>" . $category['name'] . "</h3>";
            $sql_articles = "SELECT * FROM articles WHERE category_id = " . $category['id'] . " ORDER BY publish_date DESC LIMIT 3";
            $result_articles = $conn->query($sql_articles);
            while ($article = $result_articles->fetch_assoc()) {
                echo "<div class='article'>";
                if ($article['image_url']) {
                    echo "<img src='" . $article['image_url'] . "' alt='Article Image'>";
                }
                echo "<div>";
                echo "<h4><a href='article.php?id=" . $article['id'] . "'>" . $article['title'] . "</a></h4>";
                echo "<p>" . substr($article['content'], 0, 100) . "...</p>";
                echo "</div></div>";
            }
        }
        ?>
    </div>
</body>
</html>
