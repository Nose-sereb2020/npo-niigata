<?php
include_once 'head.php';
include_once 'login_db_operation.php';


$error = "";
$id = "";
// print_r($_POST);
if (isset($_POST['l_id'])) {
    $id = htmlspecialchars($_POST['l_id']);
    $pass = htmlspecialchars($_POST['l_pass'],ENT_QUOTES);    
    if ($id != "" && $pass != "") {
        if(preg_match("/^[a-zA-Z0-9]+$/", $pass)){
            $passwd = makePassword($pass);
            // IDパスの一致確認
            $sql = "SELECT * FROM user_data WHERE user_id= :logid AND password = :logpass;";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':logid', $id, PDO::PARAM_STR);
            $stmt->bindParam(':logpass', $passwd, PDO::PARAM_STR);
            $stmt->execute();
            if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                session_start();
                $_SESSION['id'] = $row['id'];
                $_SESSION['login_id'] = $row['user_id'];
                $_SESSION['time'] = time();
                // $error = $_SESSION;
                header("Location: login_main.php");

            }else {
                $error = "ログインIDとパスワードを確認して下さい";
            }
        }else {
            $error = "パスワードが不正です";
        }
    }else {
        $error = "入力が不正です";
    }
}


?>

<?php print makeHeader("ログイン"); ?>

</head>

<body>
    <!-- <?php print $id; ?> -->
    <div class="container py-4">
        <div class="row">
            <div class="col-12 text-center">
                <h3>ログイン</h3>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-6 mx-auto border rounded-pill p-4 border-info">
                <form action="" method="post">
                    <div class="form-group row">
                        <label for="l_id" class="col-sm-3 col-form-label">ログインID</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="l_id" name="l_id" holder="6文字以上">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="l_pass" class="col-sm-3 col-form-label">パスワード</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="l_pass" name="l_pass">
                        </div>
                        <div class="col-sm-3">
                            <input type="button" class="btn btn-sm btn-outline-info form-control" id="p_show"
                                value="表示">
                        </div>
                    </div>
                    <p class="text-center">
                        <input type="submit" class="btn btn-sm btn-primary" name="save_btn" id="save_btn" value="ログイン">
                    </p>
                </form>
            </div>

        </div>
    </div>
    </div>
    <p id="error" class="text-danger text-center"><?php print $error;?></p>

    <?php print makeFooter("NPO-PC");?>

    <script>
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
    </script>
</body>

</html>