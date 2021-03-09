<!DOCTYPE html>
<html>
<head>
    <title>CodeIgniter Image Upload</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div>
        <h3>Select an image from your computer and upload it to the cloud</h3>
        <?php
                if (isset($error)){
                    echo $error;
                }
            ?>
            <form method="post" action="<?=base_url('storeimage')?>" enctype="multipart/form-data">
                <input type="file" id="item_image" name="item_image" />
                <input type="submit" value="Upload Image" />
            </form>
    </div>
</body>
</html>