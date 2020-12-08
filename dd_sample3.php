<?php
include_once 'head.php';


$dir_name ="uploads";
$image_file_path = $dir_name . "/";
$image_file_name = array();
$thumb_file_name = array();
$table_body = "";

if (isset($_POST['d_filename'])) {
    $del_f_name = $_POST['d_filename'];
    $pinfo = pathinfo($del_f_name);
    $del_f_thumb = $pinfo['filename'] . "_thumb." . $pinfo['extension'];
    unlink($image_file_path . $del_f_name);
    unlink($image_file_path . $del_f_thumb);
    
    return;
}

// ディレクトリ一覧取得
$file_list = glob($image_file_path . "*.*");
$num = 0;
foreach ($file_list as $list ) {
    // print $list . "<br>";
    $path_parts = pathinfo($list);
    // print_r($path_parts);
    // print "<br>";
    if (!strpos($path_parts['basename'], "_thumb")) {
        // print $path_parts['basename'] . "<br>";
        $image_file_name[$num] = $path_parts['basename'];
        $thumb_file_name[$num] = $path_parts['filename'] . "_thumb." .$path_parts['extension'];
        $num ++;
    }
}

// var_dump($image_file_name);
// var_dump($thumb_file_name);


$table_body .= "<table class='table'> ";
$table_body .= "<tr><th>サムネイル</th><th>ファイル名<th>操作</th></tr> ";
for ($i=0; $i < count($image_file_name); $i++) { 

    $table_body .= "<tr>";
    $table_body .= "<td><img src='" . $image_file_path . $thumb_file_name[$i] . "'  width='120'></td>";
    $table_body .= "<td>" . $image_file_name[$i] . "</td>";
    $table_body .= "<td><button type='button' class='btn btn-secondary btn-sm delimg'  value='" . $image_file_name[$i] . "'>削除</button></td>";
    $table_body .= "</tr>";


}
$table_body .= "</table> ";


//divの組み立て
// $main_div = "";
// for ($i=0; $i < count($image_file_name); $i++) { 
// $main_div .= "<div class='col-3 h-100'>";
// $main_div .= "<p><img src='" . $image_file_path . $thumb_file_name[$i] . "' class='w-100'></p>";
// $main_div .= "<p>" . $image_file_name[$i] . "</p>";
// $main_div .= "<p class='text-center'><button type='button' class='btn btn-secondary btn-sm delimg'  value='" . $image_file_name[$i] . "'>削除</button></p>";
// $main_div .= "</div>";

// }

$main_div = "";
for ($i=0; $i < count($image_file_name); $i++) { 
$main_div .= "<div class='col-3 mt-5'><div class='card h-100'>
<img src='" . $image_file_path . $thumb_file_name[$i] . "' class='w-100'>
<div class='card-body'>
  <p class='card-text'>$image_file_name[$i]</p>

</div>
<div class='card-footer bg-transparent border-success'>  <button type='button' class='btn btn-secondary btn-sm delimg text-center'  value='" . $image_file_name[$i] . "'>削除</button></div>
</div></div>";

}



?>

<?php print makeHeader("ページタイトル"); ?>

</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <h3 class="text-center">アップロードリスト</h3>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-6 mx-auto">
                <div>
                    <input id="up_width" type="hidden" name="width" value="300">
                    <input id="up_height" type="hidden" name="height" value="300">
                    <div class="form-group">
                        <label for="upload_file">画像アップロード</label>
                        <input type="file" class="form-control-file" id="upload_file" name="tfiles">
                    </div>
                    <button class="btn btn-primary" id="submit_btn" type="submit">送信</button>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-7 mx-auto">
                <?php print $table_body; ?>
            </div>
        </div>
        <div class="row mt-5">
            <?php print $main_div; ?>
        </div>
    </div>

    <?php print makeFooter("NPO-PC");?>
</body>
<script>
$('.delimg').on("click", function(e) {
    var d_filename = $(this).val();
    console.log(d_filename);
    document.body.style.cursor = "wait";

    // Formdata オブジェクトを用意
    var fd = new FormData();

    fd.append("d_filename", d_filename);

    $.ajax({
        url: "",
        type: "POST",
        data: fd,
        mode: "multiple",
        processData: false,
        contentType: false,
        timeout: 10000,
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            err =
                XMLHttpRequest.status +
                "\n" +
                XMLHttpRequest.statusText;
            alert(err);
            document.body.style.cursor = "auto";
        },
        beforeSend: function(xhr) {},
    }).done(function(res) {
        document.body.style.cursor = "auto";
        location.reload();
    });
});

var up_file = "";
$('#upload_file').on("change", function(e) {
    up_file = e.originalEvent.target.files[0];
    console.log(up_file.name);



})

$('#submit_btn').on("click", function(e) {
    if (up_file == "") return;
    var up_width = $('#up_width').attr("value");
    var up_height = $('#up_height').attr("value");


    document.body.style.cursor = "wait";
    // Formdata オブジェクトを用意
    var fd = new FormData();

    fd.append("tfiles", up_file);
    fd.append("width", up_width);
    fd.append("height", up_height);
    console.log(up_file);
    console.log(up_width);
    console.log(up_height);



    $.ajax({
        url: "send_image1.php",
        type: "POST",
        data: fd,
        mode: "multiple",
        processData: false,
        contentType: false,
        timeout: 10000,
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            err =
                XMLHttpRequest.status +
                "\n" +
                XMLHttpRequest.statusText;
            alert(err);
            document.body.style.cursor = "auto";
        },
        beforeSend: function(xhr) {},
    }).done(function(res) {
        document.body.style.cursor = "auto";
        location.reload();
    });
})
</script>

</html>