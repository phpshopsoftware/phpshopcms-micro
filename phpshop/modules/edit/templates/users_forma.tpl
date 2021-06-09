<p>
<form method="post" name="user_forma">
    <table cellspacing="5">
        <tr>
            <td align="right">	Ћогин:
            </td>
            <td>
                <input type="text" name="login"  size="15" value="@userName@">
            </td>
        </tr>
        <tr>
            <td align="right">	ѕароль:
            </td>
            <td>
                <input  type="password" name="password" size="15" value="@userPassword@">
            </td>
        </tr>
        <tr>
            <td align="right">
            </td>
            <td >
                <input  type="submit" name="send" value="¬ход">
            </td>
        </tr>
    </table>
    <input type="hidden" value="1" name="enter_user">
</form>
