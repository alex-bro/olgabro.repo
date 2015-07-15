<div id="addAdminMenu">
    <?php if (isset($data['msg'])) echo $data['msg']; ?>
    <form enctype="multipart/form-data" action="" method="post">
        <table class="login">
            <tr>
                <th colspan="2">Загрузить портфолио</th>
            </tr>
            <tr>
                <td style="text-align: right">Название:</td>
                <td><input type="text" name="name"/></td>
            </tr>
            <tr>
                <td style="text-align: right">Тип:</td>
                <td><input type="text" name="type"/></td>
            </tr>
            <tr>
                <td style="text-align: right" >Миниатюра</td>
                <td><input type="file" name="portfolioSmall" multiple accept="image/png"/></td>
            </tr>
            <tr>
                <td style="text-align: right" >Портфолио</td>
                <td><input type="file" name="portfolioBig" multiple accept="image/jpeg"/></td>
            </tr>
            <tr>
                <td style="text-align: right" colspan="2"><input type="submit" value="Загрузить"
                                                                 name="btnsubmit" style="width: 160px; height: 30px"/>
                </td>
            </tr>
        </table>
    </form>
    <a href="<?php echo $data['menu']?>">В админку</a>
</div>
<div id="addAdminContent">
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
                    <a href="<?php echo $items['del']?>">del</a>
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