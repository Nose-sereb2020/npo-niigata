<?php
include_once 'head.php';

?>

<?php print makeHeader("ページタイトル"); ?>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto">
                <form method="post" action="send_image_pocket.php" enctype="multipart/form-data">
                    <input type="hidden" name="width" value="300" id=>
                    <input type="hidden" name="height" value="300">
                    <div class="form-group">
                        <label for="upload_file">画像アップロード</label>
                        <input type="file" class="form-control-file" id="upload_file" name="tfiles[]"
                            multiple='multiple'>
                    </div>
                    <button class="btn btn-primary" type="submit">送信</button>
                </form>
            </div>
        </div>
    </div>
    <?php print makeFooter("NPO-PC");?>
</body>

</html>