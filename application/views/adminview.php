<div id="adminMenu">
<?php
if (is_array($data['menu'])){
    foreach($data['menu'] as $item){
        echo $item.'</br>';
    }
}
?>
</div>

<div id="adminContent">
    <?php
        if (is_array($data['portfolio'])){
            foreach($data['portfolio'] as $items){
    ?>
                <div class="portfolio">
                    <a href="<?php echo $items['link']?>.jpg">
                        <div class="portfolioImg">
                            <img src="<?php echo $items['link']?>.png"
                                 alt="<?php echo $items['type']?> <?php echo $items['name']?>">
                        </div>
                        <div class="portfolioText">
                            <div class="portfolioType">
                                <?php echo $items['type']?>
                            </div>
                            <div class="portfolioName">
                                <?php echo $items['name']?>
                            </div>

                        </div>
                    </a>
                    <div class="portfolioAdmin">
                        <a href="<?php echo $items['del']?>">del </a>
                        <a href="<?php echo $items['up']?>">up </a>
                        <a href="<?php echo $items['down']?>">down </a>
                        <a href="<?php echo $items['edit']?>">edit </a>
                    </div>
                </div>
    <?php
            }
        }
    ?>
</div>