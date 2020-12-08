<?php
include_once 'head.php';


$dir_name = "uploads";
$data_dir = "data";
$image_file_path = $dir_name . "/";
$text_file_path = $data_dir . "/";
$image_file_name = array();
$thumb_file_name = array();
$image_text_file = array();
$table_body = "";

if(isset($_POST['save_text'])){
    print_r($_POST);
    $tf_name = pathinfo($_POST['save_file']);
    $text_file_name = $tf_name['filename'] . ".txt";
    $fp = fopen($text_file_path . $text_file_name, "r");
    $str_data = fgets($fp);
    fclose($fp);
    $s_data = explode(",", $str_data);
    $s_data[1] = $_POST['save_text'];
    $fp = fopen($text_file_path . $text_file_name, "w");
    fputs($fp, join(",", $s_data));
    fclose($fp);

    return;
}

if (isset($_POST['d_filename'])) {
    $del_f_name = $_POST['d_filename'];
    $pinfo = pathinfo($del_f_name);
    $del_f_thumb = $pinfo['filename'] . "_thumb." . $pinfo['extension'];
    unlink($image_file_path . $del_f_name);
    unlink($image_file_path . $del_f_thumb);
    $text_file = $pinfo['filename'] . ".txt";
    print $text_file;
    print $text_file_path . $text_file;
    unlink($text_file_path . $text_file);
    
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
        $image_text_file[$num] = $path_parts['filename'] . ".txt";
        $thumb_file_name[$num] = $path_parts['filename'] . "_thumb." .$path_parts['extension'];
        $num ++;
    }
}

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
$fp = fopen($text_file_path . $image_text_file[$i], "r");
$img_str = str_replace("/n", "", fgets($fp));
$text_data = explode(",", $img_str);
fclose($fp);
$main_div .= "<div class='col-2 mt-5'><div class='card h-100'>
<img src='" . $image_file_path . $thumb_file_name[$i] . "' class='w-100'>
<div class='card-body'>
<h5 class='card-title'>". $text_data[0]. "</h5>
  <p class='card-text'><textarea class='form-control comment' tag='" . $image_file_name[$i] . "' rows='3'>" . $text_data[1] . "</textarea></p>

</div>
<div class='card-footer bg-transparent border-success'>  <button type='button' class='btn btn-secondary btn-sm delimg' original_name='" . $text_data[0] . "' value='" . $image_file_name[$i] . "'>削除</button></div>
</div></div>";

}



?>

<?php print makeHeader("ページタイトル"); ?>
<style type="text/css">
#drop_area {
    width: 100%;
    height: 250px;
    border: dotted 1px orange;
}
</style>
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <h3 class="text-center">イメージポケット</h3>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-6 p-5">
                <div id="drop_area">
                    <p class="text-center mt-5">ここに画像をドロップ</p>
                </div>
            </div>
            <div class="col-6">
                <div>
                    <input id="up_width" type="hidden" name="width" value="300">
                    <input id="up_height" type="hidden" name="height" value="300">
                    <div class="form-group">
                        <input type="file" multiple class="form-control-file" id="upload_file" name="tfiles"
                            style="display: none">
                    </div>
                    <p class="mt-5">
                        <button class="btn btn-secondary" id="submit_btn" type="submit">ファイル参照アップロード</button>
                    </p>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <?php print $main_div; ?>
        </div>
    </div>
    <div id="delete_dialog" title="確認ダイアログ">
        <p>
            [<span id="img_title" class="text-danger "></span>]
            を本当に削除しますか？
        </p>
    </div>
    <?php print makeFooter("NPO-PC");?>
</body>
<script>
$("#delete_dialog").dialog({
    autoOpen: false,
    resizable: false,
    height: "auto",
    width: 400,
    modal: true,
    buttons: {
        削除する: function() {
            deleteImage(d_filename);
            $(this).dialog("close");
        },
        キャンセル: function() {
            $(this).dialog("close");
        },
    },
});
var up_file = "";

$(document).on('drop dragover', function(e) {
    e.stopPropagation();
    e.preventDefault();
});

$('#drop_area').on('dragover', function(e) {
    e.stopPropagation();
    e.preventDefault();
});

$('#drop_area').on('drop', function(e) {
    e.preventDefault();
    e.stopPropagation();
    up_file = e.originalEvent.dataTransfer.files;
    imageSend(up_file);
});


d_filename = "";
$('.delimg').on("click", function(e) {
    d_filename = $(this).attr("value");
    $('#img_title').html($(this).attr("original_name"));
    $('#delete_dialog').dialog("open");
});

$('.comment').on("keydown change", function(e) {
    // console.log($(this).val());
    // console.log($(this).attr("tag"));
    document.body.style.cursor = "wait";

    // Formdata オブジェクトを用意
    var fd = new FormData();

    fd.append("save_text", $(this).val());
    fd.append("save_file", $(this).attr("tag"));

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
        console.log(res);
    });


})

$('#upload_file').on("change", function(e) {
    up_file = e.originalEvent.target.files;
    // console.log(e);
    for (let i = 0; i < up_file.length; i++) {
        // console.log(up_file[i]);
    }
    imageSend(up_file);


})


$('#submit_btn').on('click', function(e) {
    $('#upload_file').trigger('click');
});

function imageSend(files) {


    document.body.style.cursor = "wait";
    // Formdata オブジェクトを用意
    var fd = new FormData();

    for (let i = 0; i < files.length; i++) {
        console.log(files[i]);
        fd.append("tfiles[]", files[i]);
    }

    $.ajax({
        url: "send_image_pocket.php",
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
}

function deleteImage(file_name) {
    document.body.style.cursor = "wait";

    // Formdata オブジェクトを用意
    var fd = new FormData();

    fd.append("d_filename", file_name);

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
        console.log(res);
    })
}
</script>

</html>