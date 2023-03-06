<?php
namespace Phppot;

class FuncImg
{
    
    private $ds;

    function __construct()
    {
        require_once __DIR__ . '/DataSource.php';
        $this->ds = new DataSource();
    }

    // List all images from Galeria that have the same `IdArtigo` as the ID in the link
    public function listImgs($Id)
    {
        $query = 'SELECT * FROM `Galeria` WHERE `IdArtigo` = ? ORDER BY `IdArtigo` ASC';
        $paramType = 'i';
        $paramValue = array($Id);
        $imgs = $this->ds->select($query, $paramType, $paramValue);
        return $imgs;
    }

    // Delete images from Galeria that have the same `IdArtigo` as the ID in the link
    public function delImg($del)
    {
        $query = 'DELETE FROM `Galeria` WHERE `IdArtigo` = ?';
        $paramType = 'i';
        $paramValue = array($del);
        $this->ds->execute($query, $paramType, $paramValue);
        header("Location: " . $_SERVER['PHP_SELF'] );
    }

    // Check if any images exist for the `IdArtigo`
    public function checkImgs($Id)
    {
        $query = 'SELECT * FROM `Galeria` WHERE `IdArtigo` = ?';
        $paramType = 'i';
        $paramValue = array($Id);
        $imgs = $this->ds->select($query, $paramType, $paramValue);
        if (empty($imgs)) {
            echo '<p class="form_error">Internal error: Imgs not exist </p>';
            print_r($imgs);
            return false;
        }
        return $imgs;
    }
    
    // Upload multiple images to the `img/` folder with a unique ID and the `IdArtigo` based on the ID in the link
   public function insertGaleria()
   {
       if (!isset($_FILES['form_user_imgs'])) {
           echo "No image selected for upload";
           return;
       }
     
       $upOne = dirname(__DIR__, 1);
       $uploadDir = $upOne . '/img/';
       $allowedTypes = ['image/jpeg', 'image/png'];
       $maxSize = 1024 * 1024; // 1 MB
       $IdArtigo = $_POST['idArtigo']; // initialize ID value
   
       foreach ($_FILES['form_user_imgs']['name'] as $key => $fileName) {
           $imgType = $_FILES['form_user_imgs']['type'][$key];
           $imgSize = $_FILES['form_user_imgs']['size'][$key];
           $imgName = basename($fileName);
           $imgPath = $uploadDir . uniqid() . '-' . $imgName;
   
           // Validate file type and size
           if (!in_array($imgType, $allowedTypes) || $imgSize > $maxSize) {
               echo "Error: invalid file type or size for " . $imgName . "<br>";
               continue;
           }
   
           // Move uploaded file to safe location
           if (move_uploaded_file($_FILES['form_user_imgs']['tmp_name'][$key], $imgPath)) {
               $query = "INSERT INTO Galeria (IdArtigo, Img) VALUES (?, ?)";
               $paramType = 'is';
               $paramValue = array(
                   $IdArtigo,
                   $imgPath,
               );
               $this->ds->insert($query, $paramType, $paramValue);
           } else {
               echo "Error uploading file " . $imgName . "<br>";
           }
       }
   
       echo "All files uploaded successfully";
       header("Location: galeria.php?ID=" . $IdArtigo); // use correct header redirect URL with ID value
       exit;
   }
   
   }
   
   
    
    

?>


               
