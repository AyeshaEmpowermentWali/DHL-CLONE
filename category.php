<?php
include 'db.php';
$cat_id = $_GET['cat'];

// Fetch category name
$sql_category = "SELECT name FROM categories WHERE id = $cat_id";
$result_category = $conn->query($sql_category);
$category = $result_category->fetch_assoc();
$category_name = $category['name'];

// Fetch articles
$sql_articles = "SELECT * FROM articles WHERE category_id = $cat_id ORDER BY publish_date DESC";
$result_articles = $conn->query($sql_articles);
?>

<html>
<head>
    <title><?php echo $category_name; ?> - News Website</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .article { border-bottom: 1px solid #ddd; padding: 10px 0; display: flex; }
        .article img { max-width: 200px; margin-right: 10px; }
        @media (max-width: 600px) {
            .article { flex-direction: column; }
            .article img { max-width: 100%; }
        }
    </style>
</head>
<body>
    <h1><?php echo $category_name; ?></h1>
    <?php while ($article = $result_articles->fetch_assoc()) { ?>
        <div class="article">
            <img src="<?php echo $article['image_url']; ?>" alt="Article Image">
            <div>
                <h2><a href="article.php?id=<?php echo $article['id']; ?>"><?php echo $article['title']; ?></a></h2>
                <p><?php echo substr($article['content'], 0, 200); ?>...</p>
            </div>
        </div>
    <?php } ?>
</body>
</html
