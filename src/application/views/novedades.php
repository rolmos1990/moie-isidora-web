        <div id="novedades">
            <?php foreach($novedades as $n){ ?>
            <div class="novedad" onclick="location.href='<?=base_url();?>site/novedades/<?=$n['id'];?>'">
                <div class="imagen"><img src="<?=base_catalog_url() . '/novedades/' . $n['id'] . '.jpg?' . mdate('%Y%m%d%H');?>"></div>
                    
                <div class="titulo"><?=$n['titulo'];?></div>
                <div class="vista_previa">
                    <h4><?=$n['titulo'];?></h4>
                    <p><?=$n['vista_previa'];?>...</p>
                    <div class="reacciones">
                        <?php foreach($n['reacciones'] as $r){ ?>
                        <span><img src="/img/<?=str_replace(' ','_',$r['reaccion']);?>.png"><?=$r['cantidad'];?></span>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <script>
            $('.novedad').on('mouseover',function(){
                $(this).children('.vista_previa').slideDown();
            });
            $('.novedad').on('mouseleave',function(){
                $(this).children('.vista_previa').slideUp();
            });
        </script>
