        <div id="productos">
            <?php foreach($productos as $p){ ?><!--
            --><div class="producto" href="<?=base_url();?>site/producto/<?=$p->codigo;?>">
                <?php if($categoria->id !== '19'){ ?>
                <?php
                $d = intval($p->descuento);
                if($d == 25 || $d == 35){ ?>
                <!--<div class="promo"><img src="/img/promo<?=$d;?>.png"></div>-->
                <?php } ?>
                <?php } ?>
                <div class="ver_mas"><span>VER TALLAS</span></div>
                <div class="producto_imagen">
                    <?php if(isset($p->productImages["1"])){ ?>
                    <img src="<?=base_product_catalog_url() . $p->productImages["1"]['medium'];?>" width="238" height="357">
                    <?php
                    } if(isset($p->productImages["2"])){ ?>
                    <img src="<?=base_product_catalog_url() . $p->productImages["2"]['medium'];?>" width="238" height="357">
                    <?php } ?>
                </div>
                <div class="producto_datos">
                    <div class="producto_codigo"><?=$p->tipo;?>: <span><?=str_replace("_","",$p->codigo);?></span></div><div class="pesos">Pesos <img src="<?=base_url();?>img/bandera.png"></div>
                    <div class="producto_precio"><span>
                            <?php if($d > 0){ echo '<cite>' . $p->precio . '</cite>' . '(-' . $d . '%)'; }?>
                        </span><b><?=$p->precio_descuento;?></b></div>
                </div>
            </div><!--
            --><?php } ?>
        </div>
        <?php if($ver){ ?>
            <script>
                $.colorbox({href:'<?=base_url() . 'site/producto/' . $ver;?>',fixed:'true'});
            </script>
        <?php } ?>
        <script>
            $('.producto').colorbox({rel:'producto',fixed:'true'});
        </script>
