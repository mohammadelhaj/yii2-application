<?php

/** @var yii\web\View $this */

use common\models\Category;

$this->title = 'E-commerce';
?>
<?php

echo Yii::t('app', 'Welcome to our site!');

$category = Category::findOne(3);

?>


<div class="container  d-flex align-items-center overflow-hidden">
    <div class="row mt-4">
        <div class="col d-flex align-items-center">
            <div>
                <h2 class="text-uppercase ">better prices</h2>
                <p class="text-break">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed imperdiet diam vitae mauris hendrerit laoreet.
                    Suspendisse vehicula enim lectus, elementum consequat nunc condimentum in. Vivamus mattis lacinia metus. Morbi porta sit
                    amet nisl sit amet aliquam. Nullam tempor imperdiet turpis, ut cursus nulla dignissim non.
                    Nam et lacinia nisl. Aliquam ex ante, suscipit sollicitudin felis nec, laoreet tristique felis.
                    Pellentesque a
                </p>
            </div>
        </div>


        <div class="col">
            <img src="/images/svg/onlinepayment.svg" alt="payment" width="400px" height="400px" />
        </div>


    </div>

</div>
<div class="container-fluid he">
    <div class="text-center">
        <h1>
            categories
        </h1>
    </div>
    <div class="container h-100">
        <div class="row" style="height: 10%;">

        </div>
        <div class="row" style="height: 85%;">
            <div class="col-md-4 text-center">
                <div class="">
                    <i class="fa fa-laptop" style="font-size:120px;color: black;"></i>
                </div>
                <div class="">
                    <h4>Electrics</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Minimfsdg a maxime quam architecto quo inventore harum ex magni, dicta impedit.

                    </p>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="">

                    <i class="fa fa-car" style="font-size:120px;color: black;"></i>
                </div>
                <div class="">
                    <h4>Cars</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.

                    </p>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="">
                    <i class="fa fa-lock" style="font-size:120px;color: black;"></i>
                </div>
                <div class="">
                    <h4>Secure</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>