<?php
include_once 'head.php';
include_once 'login_check.php';
include_once 'login_db_operation.php';

if (isset($_POST['delete'])) {
    user_delete_data($_POST['delete']);
    print "データ削除";
    return;

}

if (isset($_POST['change'])) {
    $new_passwd = $_POST['change'];
    $c_id = $_POST['c_id'];
    $new_password = makePassword($new_passwd);
    user_change_data($c_id, $new_password);
    return;
}

$error = "";
$record_id = array();
$user_id = array();
$user_pass = array();
$save_date = array();
// print_r($_POST);
if (isset($_POST['l_id'])) {
    $u_id = $_POST['l_id'];
    $u_pass = $_POST['l_pass'];
    
    if (strlen($u_id) < 6) {
        $error = "ログインIDの文字数がたりません";
    }else {
        if (strlen($u_pass ) < 6) {
            $error = "パスワードの文字数がたりません";
        }else {
            if(preg_match("/^[a-zA-Z0-9]+$/", $u_pass)){
                $passwd = makePassword($u_pass);
                // print $passwd;
                $date = date("Y-m-d");
                // print $date;
                $spl = "SELECT id FROM user_data WHERE user_id='$u_id';";
                $rst = $pdo->query($spl);
                if ($row = $rst->fetch(PDO::FETCH_ASSOC)) {
                    $error = "入力されたIDは既に登録されています";
                }else{
                    $set_id = user_add_data($u_id,  $passwd,  $date);
                    if ($set_id > 0) {
                        $error = "ID{$set_id}に登録されました";
                    }else{
                        $error = "登録できませんでした";
                    }
                }
            }else {
                $error = "パスワードが不正です";
            }
        }
    }
}


$rst = user_getDataAll();

while($row = $rst->fetch(PDO::FETCH_ASSOC)){
    $record_id[] = $row['id'];
    $user_id[] = $row['user_id'];
    $user_pass[] = $row['password'];
    $save_date[] = $row['save_date'];
    // print_r($record_id);
    // print_r($user_id);
    // print_r($user_pass);
    // print_r($save_date);
}


$table = "<table class='table'>";
$table .="<tr><td>id</td><td>ログインID</td><td>パスワード</td><td>登録日</td><td>管理</td></tr>";


for ($i=0; $i < count($record_id); $i++) { 
    $table .="<tr>";
    $table .="<td>" . $record_id[$i] . "</td>";
    $r_id = $record_id[$i];
    $table .="<td id='user_$r_id'>" . $user_id[$i] . "</td>";
    $table .="<td>" . $user_pass[$i] . "</td>";
    $table .="<td>" . $save_date[$i] . "</td>";
    $table .="<td>";
    $table .="<button type='submit' class='btn btn-sm btn-outline-info henshu' value='$r_id'>編集</button>&nbsp;";
    $table .="<button type='submit' class='btn btn-sm btn-outline-danger sakujo' value='$r_id'>削除</button>";
    $table .="</td>";
    $table .="</tr>";
}

$table .= "</table>";


?>

<?php print makeHeader("ページタイトル"); ?>

</head>

<body>
    <div class="container py-4">
        <div class="row">
            <div class="col-12 text-center">
                <h3>ログイン新規登録・削除</h3>
            </div>
        </div>
    </div>
    <header>
        <div class="container">
            <div class="row mt-1">
                <div class="col-4"></div>
                <div class="col-6 pr-3">
                    <p class="text-right">ようこそ <?php print $login_user_id;?>さん</p>
                </div>
                <div class="col-2">
                    <form method="post">
                        <p>
                            <button class="btn btn-secondary btn-sm btn-outline-light" type="submit"
                                name="out">ログアウト</button>
                        </p>
                </div>
                </form>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <div class="col-6 mx-auto border rounded-pill p-4 border-info">
                <form action="" method="post">
                    <div class="form-group row">
                        <label for="l_id" class="col-sm-3 col-form-label">ログインID</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="l_id" name="l_id" placeholder="6文字以上">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="l_pass" class="col-sm-3 col-form-label">パスワード</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="l_pass" name="l_pass" placeholder="英数6文字以上">
                        </div>
                        <div class="col-sm-3">
                            <input type="button" class="btn btn-sm btn-outline-info form-control" id="p_show"
                                value="表示">
                        </div>
                    </div>
                    <p class="text-center">
                        <input type="submit" class="btn btn-sm btn-primary" value="登録">
                        <input type="reset" class="btn btn-sm btn-secondary" value="リセット">
                    </p>
                </form>
            </div>

        </div>
    </div>
    <hr>
    </div>
    <p id="error" class="text-danger text-center"><?php print $error;?></p>
    <div class="container">

        <div class="col-12 text-center py-4">
            <h3>登録リスト</h3>
        </div>
        <div class="col-12">
            <?php print $table;?>
        </div>
    </div>
    <?php print makeFooter("NPO-PC");?>
    <div id="h_dialog" title="パスワード変更">
        <p>ID <span id="change_id"></span> 番のデータのパスワードを変更</p>
        <p>ログインID : <span id="change_name"></span></p>
        <p><input type="text" id="new_pass" placeholder="6文字以上"></p>

    </div>
    <div id="d_dialog" title="削除の確認">
        <p>ID <span id="del_id"></span> 番のデータを削除しますか？</p>
    </div>
    <script>
    var set_id = 0;
    var delete_id = 0;

    $("#h_dialog").dialog({
        autoOpen: false,
        resizable: false,
        height: "auto",
        width: 400,
        modal: true,
        buttons: {
            更新する: function() {
                $(this).dialog("close");
                changePass(set_id)
            },
            キャンセル: function() {
                $(this).dialog("close");
            },
        },
    });
    $("#d_dialog").dialog({
        autoOpen: false,
        resizable: false,
        height: "auto",
        width: 400,
        modal: true,
        buttons: {
            削除する: function() {
                $(this).dialog("close");
                deleteData(delete_id);
            },
            キャンセル: function() {
                $(this).dialog("close");
            },
        },
    });
    $('#p_show').on('click', function(e) {
        var val = $(this).val();
        if (val == "表示") {
            $(this).val("隠す");
            $('#l_pass').attr("type", "text");
        } else {
            $(this).val("表示");
            $('#l_pass').attr("type", "password");
        }

    });

    $('.henshu').on('click', function(e) {
        // console.log("henshu");
        var h_id = $(this).attr('value');
        var user_name = $('#user_' + h_id).html();
        $('#change_name').html(user_name);
        // console.log(h_id);
        set_id = h_id;
        $('#change_id').html(h_id);
        $('#h_dialog').dialog("open");
    });

    $('.sakujo').on('click', function(e) {
        // console.log("sakujo");
        var d_id = $(this).attr('value');
        // console.log(d_id);
        delete_id = d_id;
        $('#del_id').html(d_id)
        $('#d_dialog').dialog("open");

    });

    function changePass(c_id) {
        console.log("set");
        console.log(c_id);
        var pass = $('#new_pass').val();
        if (pass.length < 6) {
            $('#error').html("変更できませんでした")
            return;
        } else {
            document.body.style.cursor = "wait";

            // Formdata オブジェクトを用意
            var fd = new FormData();

            fd.append("change", pass);
            fd.append("c_id", c_id);


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
                location.reload();
            });

        }

    }

    function deleteData(d_id) {
        console.log("delete");
        console.log(d_id);
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
            $("#error").html(res);
            location.reload();
        });
    }
    </script>
</body>

</html>