
<div style="float:left;padding-right:30px">
    <h3>Мои Файлы</h3>
    <table cellspacing="5" cellpadding="5">
        <tr>
            <td width="150"> <b>Файл</b>
            </td>
            <td>
                <b>Дата</b>
            </td>
        </tr>
        @filesDB@
    </table>
</div>
@php if($_SESSION['userNamePath'] == "*"){
echo '<div>
    <h3>Новый файл</h3>
    <form method="post" name="user_forma">
        <table cellspacing="5" cellpadding="5">
            <tr>
                <td align="right">

                </td>
                <td >
                    <b>@fileLog@</b><br>
                    <div class="input-group ">
                        <input type="text" name="nameFile" class="form-control" placeholder="test" required="">
                        <span class="input-group-addon" id="sizing-addon1">.html</span>
                    </div>

                </td>
            </tr>
            <tr>
                <td align="right">
                </td>
                <td ><br>
                    <input class="btn btn-primary" name="create" type="submit"  value="Создать файл">
                </td>
            </tr>
        </table>
    </form>
</div>
';
}  php@