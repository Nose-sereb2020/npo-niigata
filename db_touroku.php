<?php
include_once 'head.php';
include_once 'db_operation.php';
// データ登録
if(isset($_POST['u_name'])){
  // print_r($_POST);
  $name = $_POST['u_name'];
  $yubin = $_POST['u_post'];
  $jusho1 = $_POST['u_address1'];
  $jusho2 = $_POST['u_address2'];
  $tel = $_POST['u_tel'];
  $mail = $_POST['u_mail'];
  $biko = $_POST['u_biko'];  
  $save_id = add_data($name, $yubin,  $jusho1,  $jusho2,  $tel,  $mail,  $biko);
  
  if($save_id > 0){
    print "ID $save_id に登録しました";
  }else{
    print "登録できませんでした";
  }
  return;
}
// データ削除
if (isset($_POST['delete'])) {
  print "delete";
  $del_id = $_POST['delete'];
  delete_data($del_id);
  return;
}

$table = "<table class='table'>
<tr>
  <td>id</td>
  <td>名前</td>
  <td>郵便番号</td>
  <td>住所1</td>
  <td>住所2</td>
  <td>電話番号</td>
  <td>メールアドレス</td>
  <td>管理</td>
</tr>";


// 登録データ読み込み
$rst = getDataAll();
while ($row = $rst->fetch(PDO::FETCH_ASSOC)) {
  // print_r($row);
  $table .= "<tr>";
  $table .= "<td>".$row['id']."</td>";
  $d_id = $row['id'];
  $table .= "<td>".$row['name']."</td>";
  $table .= "<td>".$row['yubin']."</td>";
  $table .= "<td>".$row['jusho1']."</td>";
  $table .= "<td>".$row['jusho2']."</td>";
  $table .= "<td>".$row['tel']."</td>";
  $table .= "<td>".$row['mail']."</td>";
  $table .= "<td>";
  // onclickの引数は数値だけ
  $table .= "<button type='button' class='btn btn-secondary btn-sm' onclick='modify($d_id)'>編集</button>&nbsp;";
  $table .= "<button type='button' class='btn btn-danger btn-sm' onclick='del($d_id)'>削除</button>";
  $table .= "</td>";
  $table .= "</tr>";
}
$table .= "</table>"
?>

<?php print makeHeader("新規登録"); ?>


</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center p-3">
                <h3>新規登録</h3>
            </div>
            <div class="col-6 mx-auto py-5 border rounded">
                <div class="form-group row">
                    <label for="u_name" class="col-sm-3 col-form-label">名前</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="u_name" name="u_name" />
                    </div>
                </div>

                <form class="h-adr">
                    <span class="p-country-name" style="display: none">Japan</span>
                    <div class="form-group row">
                        <label for="u_post" class="col-sm-3 col-form-label">〒番号</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control p-postal-code" id="u_post" name="u_post" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="u_address1" class="col-sm-3 col-form-label">住所1</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control p-region p-locality" id="u_address1"
                                name="u_address1" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="u_address2" class="col-sm-3 col-form-label">住所2</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control p-street-address" id="u_address2"
                                name="u_address2" />
                        </div>
                    </div>
                </form>

                <div class="form-group row">
                    <label for="u_tel" class="col-sm-3 col-form-label">電話番号</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="u_tel" name="u_tel" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="u_mail" class="col-sm-3 col-form-label">メールアドレス</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="u_mail" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="c_mail" class="col-sm-3 col-form-label">メールアドレス(確認)</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="c_mail" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="u_biko" class="col-sm-3 col-form-label">備考</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="u_biko" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row py-3">
            <div class="col-12 text-center">
                <button type="button" id="reg_btn" name="reg" class="btn btn-primary">
                    登録
                </button>
                <button type="button" id="reset_btn" name="reset" class="btn btn-secondary">
                    リセット
                </button>
            </div>
            <div class="col-12 text-center py-3">
                <p class="text-danger" id="error">&nbsp;</p>
            </div>
        </div>
    </div>
    <hr />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h3>登録リスト</h3>
            </div>
            <div class="col-12">
                <?php print $table; ?>
            </div>
        </div>
    </div>

    <?php print makeFooter("NPO-PC");?>
    <div id="dialog" title="確認ダイアログ">
        <p>
            <span class="ui-icon ui-icon-alert" style="float: left; margin: 12px 12px 20px 0"></span><span
                id="change_id"></span>を削除しますか？
        </p>
    </div>

    <script>
    // 共通変数宣言
    var delete_id;

    // 削除確認ダイアログ
    $("#dialog").dialog({
        autoOpen: false,
        resizable: false,
        height: "auto",
        width: 400,
        modal: true,
        buttons: {
            削除する: function() {
                $(this).dialog("close");
                deleteFile(delete_id);
            },
            キャンセル: function() {
                $(this).dialog("close");
            },
        },
    });
    //登録ボタン
    $("#reg_btn").on("click", function(e) {
        console.log("登録が押されました");
        var error = $("#error");
        var u_name = $("#u_name").val();
        if (u_name == "") {
            error.html("名前が未入力です");
            return;
        } else {
            error.html("&nbsp;");
        }

        var u_post = $("#u_post").val();
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
            u_post = u_post.replace("-", "");
            u_post = u_post.replace("ー", "");
            console.log(u_post);

            if (u_post.length != 7) {
                error.html("郵便番号が不正です");
                return;
            }
            error.html("&nbsp;");
        }

        var u_address1 = $("#u_address1").val();
        if (u_address1 == "") {
            error.html("住所1が未入力です");
            return;
        } else {
            error.html("&nbsp;");
        }

        var u_address2 = $("#u_address2").val();
        if (u_address2 == "") {
            error.html("住所2が未入力です");
            return;
        } else {
            error.html("&nbsp;");
        }

        var u_tel = $("#u_tel").val();
        if (u_tel == "") {
            error.html("電話番号が未入力です");
            return;
        } else {
            error.html("&nbsp;");
        }

        var u_mail = $("#u_mail").val();
        if (u_mail == "") {
            error.html("メールアドレスが未入力です");
            return;
        } else {
            var c_mail = $("#c_mail").val();
            if (u_mail != c_mail) {
                error.html("入力されたメールアドレスが違います");
                return;
            } else error.html("&nbsp;");
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
        fd.append("u_biko", $("#u_biko").val());

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
            $("#error").html(res);
        });
    });

    // リセットボタン
    $("#reset_btn").on("click", function(e) {
        console.log("リセットが押されました");
        $("#u_name").val("");
        $("#u_post").val("");
        $("#u_address1").val("");
        $("#u_address2").val("");
        $("#u_tel").val("");
        $("#u_mail").val("");
        $("#u_biko").val("");
    });

    // 編集関数
    function modify(d_num) {
        console.log("編集" + d_num);
        location.replace("db_henshu.php?did=" + d_num);
    }

    // 削除確認関数
    function del(d_num) {
        console.log("削除" + d_num);
        delete_id = d_num;
        $("#change_id").html(d_num);
        $("#dialog").dialog("open");
    }

    function deleteFile(d_id) {
        document.body.style.cursor = "wait";

        // Formdata オブジェクトを用意
        var fd = new FormData();

        fd.append("delete", d_id);

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
            // $("#error").html(res);
            location.reload();
        });
    }
    </script>
</body>

</html>