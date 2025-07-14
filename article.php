<?php
include 'db.php';
$article_id = $_GET['id'];

// Fetch article
$sql_article = "SELECT * FROM articles WHERE id = $article_id";
$result_article = $conn->query($sql_article);
$article = $result_article->fetch_assoc();

// Fetch comments
$sql_comments = "SELECT * FROM comments WHERE article_id = $article_id ORDER BY date ASC";
$result_comments = $conn->query($sql_comments);
?>

<html>
<head>
    <title><?php echo $article['title']; ?> - News Website</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .article img { max-width: 600px; }
        .comment { border: 1px solid #ddd; padding: 10px; margin: 10px 0; }
        form { margin-top: 20px; }
        textarea { width: 100%; height: 100px; }
        @media (max-width: 600px) {
            .article img { max-width: 100%; }
        }
    </style>
</head>
<body>
    <h1><?php echo $article['title']; ?></h1>
    <img src="<?php echo $article['image_url']; ?>" alt="Article Image">
    <p><?php echo $article['content']; ?></p>
    <p>Author: <?php echo $article['author']; ?></p>
    <p>Published on: <?php echo $article['publish_date']; ?></p>

    <h2>Comments</h2>
    <?php while ($comment = $result_comments->fetch_assoc()) { ?>
        <div class="comment">
            <p><strong><?php echo $comment['name']; ?></strong> (<?php echo $comment['email']; ?>) on <?php echo $comment['date']; ?></p>
            <p><?php echo $comment['comment']; ?></p>
        </div>
    <?php } ?>

    <form action="add_comment.php" method="post">
        <input type="hidden" name="article_id" value="<?php echo $article_id; ?>">
        <label>Name: <input type="text" name="name"></label><br>
        <label>Email: <input type="email" name="email"></label><br>
        <label>Comment: <textarea name="comment"></textarea></label><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
