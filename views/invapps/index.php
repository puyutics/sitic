<?php

// VIEW - views/product/index.php
use kartik\tree\TreeView;
use kartik\tree\TreeViewInput;
use app\models\InvApps;
use \kartik\tree\Module;

?>
<p>
    <?php
    echo TreeViewInput::widget([
        // single query fetch to render the tree
        // use the Product model you have in the previous step
        'query' => InvApps::find()->addOrderBy('root, lft'),
        'headingOptions'=>['label'=>'Categorías'],
        'name' => 'kv-product', // input name
        'value' => '1,2,3',     // values selected (comma separated for multiple select)
        'asDropdown' => true,   // will render the tree input widget as a dropdown.
        'multiple' => true,     // set to false if you do not need multiple selection
        'fontAwesome' => true,  // render font awesome icons
        'rootOptions' => [
            'label'=>'<i class="fa fa-tree"></i>',  // custom root label
            'class'=>'text-success'
        ],
        //'options'=>['disabled' => true],
    ]);    ?>
</p>
<p>
    <?php
    echo TreeView::widget([
        // single query fetch to render the tree
        // use the Product model you have in the previous step
        'query' => InvApps::find()->addOrderBy('root, lft'),
        'headingOptions' => ['label' => 'Categorías'],
        'fontAwesome' => false,     // optional
        'isAdmin' => true,         // optional (toggle to enable admin mode)
        'displayValue' => 1,        // initial display value
        'softDelete' => true,       // defaults to true
        'cacheSettings' => [
            'enableCache' => false   // defaults to true
        ],


    ]);
    ?>
</p>