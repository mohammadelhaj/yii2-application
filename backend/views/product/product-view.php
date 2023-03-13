  <?php

    use yii\helpers\Html;
    ?>
  <div class="col"></div>

  <div class="row" style="height: 300px;">
      <div class="col-2 "></div>
      <div class="col-4 ">
          <img class="img-thumbnail big-img" src="http://static.test/<?= $model->img1 ?>" alt="Product Image" width="250px" height="250px">


      </div>

      <div class="col-6 ">
          <div class="row">
              <div class="col-12">
                  <h3 class="text-left"> <?= $model->productName ?></h3>
                  <p class="text-left"><?= $model->price ?></p>
                  <p class="text-left"><?= $model->description ?></p>
                  <div class="text-left">
                      <?= Html::a('Edit', ['product/updateproduct', 'idProduct' => Yii::$app->request->get('idProduct')], [
                            'class' => 'btn btn-primary w-100',
                            'style' => 'margin-bottom: 10px;',

                        ]);
                        ?>

                      <?= Html::a('Delete', ['product/remove-product', 'product_id' => $model->idProd], [
                            'class' => 'btn btn-danger w-100',

                        ]);
                        ?>
                  </div>
              </div>
          </div>
      </div>
  </div>