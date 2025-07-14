<?php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $article_id = $_POST['article_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];
    $date = date('Y-m-d H:i:s');

    $sql = "INSERT INTO comments (article_id, name, email, comment, date) VALUES ($article_id, '$name', '$email', '$comment', '$date')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location = 'article.php?id=$article_id';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
