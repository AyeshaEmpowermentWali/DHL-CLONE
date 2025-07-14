<?php
include 'db.php';
$q = $_GET['q'];
$sql = "SELECT * FROM articles WHERE title LIKE '%$q%' OR content LIKE '%$q%'";
$result = $conn->query($sql);
?>

<html>
<head>
    <title>Search Results - News Website</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .article { border-bottom: 1px solid #ddd; padding: 10px 0; }
    </style>
</head>
<body>
    <h1>Search Results for "<?php echo $q; ?>"</h1>
    <?php while ($article = $result->fetch_assoc()) { ?>
        <div class="article">
            <h2><a href="article.php?id=<?php echo $article['id']; ?>"><?php echo $article['title']; ?></a></h2>
            <p><?php echo substr($article['content'], 0, 200); ?>...</p>
        </div>
    <?php } ?>
</body>
</html>
