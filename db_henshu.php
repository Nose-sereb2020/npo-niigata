<?php
include_once 'head.php';
include_once 'db_operation.php';


if (isset($_GET['did'])) {
    $data_id = $_GET['did'];
}else {
    // header:phpでジャンプさせる関数
    header("Location: db_touroku.php");

}
// データ更新

if(isset($_POST['u_name'])){
//   print_r($_POST);
  $name = $_POST['u_name'];
  $yubin = $_POST['u_post'];
  $jusho1 = $_POST['u_address1'];
  $jusho2 = $_POST['u_address2'];
  $tel = $_POST['u_tel'];
  $mail = $_POST['u_mail'];
  $biko = $_POST['u_biko'];  
  change_data($data_id, $name, $yubin,  $jusho1,  $jusho2,  $tel,  $mail,  $biko);

  return;
  
}


// 個別データ読み込み
$rst = getDataId($data_id);
if($row = $rst->fetch(PDO::FETCH_ASSOC)) {
  // print_r($row);
  $d_name = $row['name'];
  $d_post = $row['yubin'];
  $d_address1 = $row['jusho1'];
  $d_address2 = $row['jusho2'];
  $d_tel = $row['tel'];
  $d_mail = $row['mail'];
  $d_biko = $row['biko'];
}else {
    header("Location: db_touroku.php");
}
?>

<?php print makeHeader("データ更新"); ?>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center p-3">
                <h3>データ更新</h3>
            </div>
            <div class="col-6 mx-auto py-5 border rounded">
                <div class="form-group row">
                    <label for="u_id" class="col-sm-3 col-form-label">ID</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="u_id" name="u_id" readonly
                            value='<?php print $data_id;?>'>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="u_name" class="col-sm-3 col-form-label">名前</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="u_name" name="u_name"
                            value='<?php print $d_name;?>'>
                    </div>
                </div>

                <form class="h-adr">
                    <span class="p-country-name" style="display: none">Japan</span>
                    <div class="form-group row">
                        <label for="u_post" class="col-sm-3 col-form-label">〒番号</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control p-postal-code" id="u_post" name="u_post"
                                value='<?php print $d_post;?>'>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="u_address1" class="col-sm-3 col-form-label">住所1</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control p-region p-locality" id="u_address1"
                                name="u_address1" value='<?php print $d_address1;?>'>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="u_address2" class="col-sm-3 col-form-label">住所2</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control p-street-address" id="u_address2" name="u_address2"
                                value='<?php print $d_address2;?>'>
                        </div>
                    </div>
                </form>


                <div class="form-group row">
                    <label for="u_tel" class="col-sm-3 col-form-label">電話番号</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="u_tel" name="u_tel" value='<?php print $d_tel;?>'>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="u_mail" class="col-sm-3 col-form-label">メールアドレス</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="u_mail" value='<?php print $d_mail;?>'>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="u_biko" class="col-sm-3 col-form-label">備考</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="u_biko" rows="3"><?php print $d_biko;?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row py-3">
            <div class="col-12 text-center">
                <button type="button" id="reg_btn" name="reg" class="btn btn-primary">更新</button>
                <button type="button" id="reset_btn" name="reset" class="btn btn-info">リセット</button>
                <button type="button" id="cancel_btn" name="cancel" class="btn btn-secondary">キャンセル</button>

            </div>
            <div class="col-12 text-center py-3">
                <p class="text-danger" id="error">&nbsp;</p>
            </div>
        </div>
    </div>
    <hr>

    <script>
    //登録ボタン
    $('#reg_btn').on('click', function(e) {
        console.log("登録が押されました");
        var error = $('#error');
        var u_name = $('#u_name').val();
        if (u_name == "") {
            error.html("名前が未入力です");
            return;
        } else {
            error.html("&nbsp;");
        }

        var u_post = $('#u_post').val();
        if (u_post == "") {
            error.html("郵便番号が未入力です");
            return;
        } else {
            // 全角を半角に変換
            u_post = u_post.replace(/[Ａ-Ｚａ-ｚ０-９]/g, function(s) {
                return String.fromCharCode(s.charCodeAt(0) - 65248);
            });
            console.log(u_post);

            // ハイフンを除去
            u_post = u_post.replace('-', "");
            u_post = u_post.replace('ー', "");
            console.log(u_post);

            if (u_post.length != 7) {
                error.html("郵便番号が不正です")
                return;
            }
            error.html("&nbsp;");
        }


        var u_address1 = $('#u_address1').val();
        if (u_address1 == "") {
            error.html("住所1が未入力です");
            return;
        } else {
            error.html("&nbsp;");
        }

        var u_address2 = $('#u_address2').val();
        if (u_address2 == "") {
            error.html("住所2が未入力です");
            return;
        } else {
            error.html("&nbsp;");
        }

        var u_tel = $('#u_tel').val();
        if (u_tel == "") {
            error.html("電話番号が未入力です");
            return;
        } else {
            error.html("&nbsp;");
        }

        var u_mail = $('#u_mail').val();
        if (u_mail == "") {
            error.html("メールアドレスが未入力です");
            return;
        }

        document.body.style.cursor = "wait";

        // Formdata オブジェクトを用意
        var fd = new FormData();

        fd.append("u_name", u_name);
        fd.append("u_post", u_post);
        fd.append("u_address1", u_address1);
        fd.append("u_address2", u_address2);
        fd.append("u_tel", u_tel);
        fd.append("u_mail", u_mail);
        fd.append("u_biko", $('#u_biko').val());

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
            beforeSend: function(xhr) {

            },
        }).done(function(res) {
            document.body.style.cursor = "auto";
            // $("#error").html(res);
            location.replace('db_touroku.php');

        });
    });

    // キャンセルボタン
    $('#cancel_btn').on('click', function(e) {
        location.replace('db_touroku.php');
    });

    // リセットボタン
    $('#reset_btn').on('click', function(e) {
        console.log("リセットが押されました");
        $('#u_name').val("");
        $('#u_post').val("");
        $('#u_address1').val("");
        $('#u_address2').val("");
        $('#u_tel').val("");
        $('#u_mail').val("");
        $('#u_biko').val("");
    });
    // 保存ボタン
    </script>
</body>

</html>