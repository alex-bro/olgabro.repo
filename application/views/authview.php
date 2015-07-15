<?php
if (is_array($data)){
    foreach($data as $items){
        if(is_array($items)){
            foreach($items as $item){
                echo $item.'</br>';
            }
        } else echo $items.'</br>';
    }

} else{
    echo $data.'</br>';
}
?>
<form action="" method="post">
    <table class="login">
        <tr>
            <th colspan="2">Авторизация</th>
        </tr>
        <tr>
            <td style="text-align: right">Логин/E-mail:</td>
            <td><input type="text" name="login"/></td>
        </tr>
        <tr>
            <td style="text-align: right">Пароль:</td>
            <td><input type="password" name="password"/></td>
        </tr>
        <tr>
            <td style="text-align: right" colspan="2"><input type="submit" value="Войти"
                                                             name="btnsubmit" style="width: 160px; height: 30px"/>
            </td>
        </tr>
    </table>
</form>
