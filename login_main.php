<?php
include_once 'head.php';
include_once 'login_check.php';
// var_dump($_SESSION);

?>

<?php print makeHeader("ログインメニュー"); ?>

</head>

<body>
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
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <h3 class="text-center">作業メニュー</h3>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-3 mx-auto">
                <a href="login_test.php"><button class="btn btn-primary btn-block">ユーザー登録</button></a>
            </div>
        </div>
    </div>

    <body>
        <?php print makeFooter("NPO-PC");?>
    </body>

    </html>