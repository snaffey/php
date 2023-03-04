<?php
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if an image file was uploaded
  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    // Get the uploaded file's temporary location
    $tmp_name = $_FILES['image']['tmp_name'];
    // Get the uploaded file's name
    $name = basename($_FILES['image']['name']);
    // Move the uploaded file to the img folder
    move_uploaded_file($tmp_name, './img/' . $name);
    // Update the database with the new image information
    $conn = new PDO('mysql:host=localhost;dbname=de', 'myUsername', 'myPassword');
    $stmt = $conn->prepare('INSERT INTO artigos (Img, AltImg, Nome, Descrição) VALUES (?, ?, ?, ?)');
    $stmt->execute(['./img/' . $name, $name, 'New Article', 'This is a new article with a new image']);
    // Redirect the user back to the homepage
    header('Location: index.php');
    exit();
  }
}
?>