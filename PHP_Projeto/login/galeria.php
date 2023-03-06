<?php
session_start();

if (!isset($_SESSION["username"])) {
    session_unset();
    session_write_close();
    header("Location: ../index.php");
    exit;
}

$username = $_SESSION["username"];
$Id = $_SESSION["Id"];

session_write_close();

$upOne = dirname(__DIR__, 1);
require_once $upOne . '/lib/callsImgs.php';

?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link href="assets/css/home.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="menu">
        <a href="admin.php">Admin</a>
    </div>
    <form action="" method="post">
        <table class="form-table" enctype="multipart/form-data">
            <tr>
                <td>Images:</td>
                <td>
                <input type="file" name="form_user_imgs[]" multiple>
                </td>
            </tr>
            <tr>
            <td colspan="2">
                <input type="hidden" name="save" value="<?php echo htmlspecialchars($IdArtigo); ?>">
                <input type="submit" value="Save">
            </td>
        </tr>   
        </table>
    </form>

    <?php $Img = $imgs_list ?>

    <table>
        <thead>
            <tr>
                <th>IdArtigo</th>
                <th>Img</th>
                <th>Edição</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($Img as $id): ?>
                <tr>
                    <td><?php echo htmlspecialchars($id['IdArtigo']) ?></td>
                    <td>
                        <img src="<?php echo htmlspecialchars(IMG_DIR . $id['Img']); ?>">
                    </td>
                    <td>
                        <a href="<?php echo htmlspecialchars(HOME_URI); ?>?del=<?php echo htmlspecialchars($id['IdArtigo']); ?>" onclick="return confirm('Are you sure you want to delete this user?')">Del</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>        
    </body>
</html>