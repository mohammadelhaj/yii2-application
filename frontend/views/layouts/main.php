<?php

/** @var \yii\web\View $this */
/** @var string $content */


use frontend\assets\AppAsset;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use common\models\Category;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100" style="background-color: #EEEEEE;">
    <?php $this->beginBody() ?>

    <!--<header>
        
    </header>-->
    <header>
        <nav class="navbar navbar-expand-md navbar-dark " style="background-color: black;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul id="w1" class="navbar-nav mb-2 mb-md-0 d-flex nav mx-auto">
                        <li class="nav-item">
                            <?= Html::a('Home', ['site/index'], [
                                'class' => 'nav-link active',

                            ]); ?>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="/my-orders/my-orders?user_id=<?= Yii::$app->user->id ?>">My orders</a></li>
                        <li class="nav-item"><a class="nav-link" href="/site/about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="/site/contact">Contact</a></li>
                        <?php
                        $form = ActiveForm::begin([
                            'action' => ['site/logout']
                        ]);
                        if (Yii::$app->user->isGuest) {

                        ?>
                            <li class="nav-item">

                                <?= Html::submitButton('Log in', [
                                    'class' => 'btn btn-primary border-0',
                                    'style' => 'background-color:black;'
                                ]); ?>
                            </li>
                        <?php } else {
                        ?>
                            <li class="nav-item">
                                <?= Html::submitButton('Log Out', [
                                    'class' => 'btn btn-primary border-0',
                                    'style' => 'background-color:black;'
                                ]); ?>
                            </li>
                        <?php }

                        ActiveForm::end();
                        ?>
                        <li class="nav-item dropdown">
                            <div class="dropdown">
                                <button class="btn btn-primary border-0" style="background-color:black; "type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Choose language
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="<?= Yii::$app->urlManager->createUrl(['site/set-language', 'lang' => 'en']) ?>">english</a></li>
                                    <li><a class="dropdown-item" href="<?= Yii::$app->urlManager->createUrl(['site/set-language', 'lang' => 'fr']) ?>">frensh</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </header>
    <section>
        <div class="container  bg-white" style="height: 200px;">
            <div class="row" style="height: 75%;">
                <h1 class="d-flex align-items-center justify-content-center">E-commerce</h1>
            </div>
            <div class="row border-top">
                <nav class="navbar navbar-expand-md navbar-dark">
                    <div class="container">
                        <div class="collapse navbar-collapse ">
                            <ul id="w1" class="navbar-nav mb-2 mb-md-0 d-flex nav mx-auto fw-bold">

                                <?php
                                $category = Category::find()->all();

                                foreach ($category as $category) :
                                ?>
                                    <li class="nav-item">
                                        <?= Html::a($category->categoryName, ['category/category', 'category_id' => $category->idCat], [
                                            'class' => 'nav-link active text-dark mx-3',

                                        ]); ?>
                                    </li>
                                <?php endforeach; ?>
                                <li class="nav-item">

                                    <a class="nav-link text-dark mx-3" href="/shopping-cart/shopping-cart?user_id=<?= Yii::$app->user->id ?>">
                                        <i class="fa fa-shopping-cart"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </section>

    <main role="main" class="flex-shrink-0" style="margin-top: 20px;">
        <div class="container bg-white">
            <?= $content ?>
        </div>
    </main>
    <!-- Footer -->
    <footer class="container text-center text-lg-start bg-white text-muted">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <!-- Left -->
            <div class="me-5 d-none d-lg-block">
                <span>Get connected with us on social networks:</span>
            </div>
            <!-- Left -->

            <!-- Right -->
            <div>
                <a href="" class="me-4 link-secondary">
                    <i class="fa fa-facebook-f"></i>
                </a>
                <a href="" class="me-4 link-secondary">
                    <i class="fa fa-twitter"></i>
                </a>
                <a href="" class="me-4 link-secondary">
                    <i class="fa fa-google"></i>
                </a>
                <a href="" class="me-4 link-secondary">
                    <i class="fa fa-instagram"></i>
                </a>
                <a href="" class="me-4 link-secondary">
                    <i class="fa fa-linkedin"></i>
                </a>
                <a href="" class="me-4 link-secondary">
                    <i class="fa fa-github"></i>
                </a>
            </div>
            <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fas fa-gem me-3 text-secondary"></i>Company name
                        </h6>
                        <p>
                            Here you can use rows and columns to organize your footer content. Lorem ipsum
                            dolor sit amet, consectetur adipisicing elit.
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Products
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">Angular</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">React</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Vue</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Laravel</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Useful links
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">Pricing</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Settings</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Orders</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Help</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                        <p><i class="fa fa-home me-3 text-secondary"></i> New York, NY 10012, US</p>
                        <p>
                            <i class="fa fa-envelope me-3 text-secondary"></i>
                            info@example.com
                        </p>
                        <p><i class="fa fa-phone me-3 text-secondary"></i> + 01 234 567 88</p>
                        <p><i class="fa fa-print me-3 text-secondary"></i> + 01 234 567 89</p>
                    </div>
                    <!-- Grid column -->
                </div>

            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.025);">
            © 2023 Copyright:
            <a class="text-reset fw-bold" href="frontend.test">frontend.test</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
