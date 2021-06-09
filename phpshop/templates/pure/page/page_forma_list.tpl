<p align="left">
<form method="post" name="forma_gbook" onsubmit="Fchek2()">
  <table cellPadding="3" align="center" border="0">
    <tbody>
      <tr>
        <td vAlign="top"><div align="left"><strong>*</strong> Ваше имя:</div></td>
        <td><div align=left>
            <input size="52" name="nameP">
          </div></td>
      </tr>
      <tr>
        <td vAlign="top"><div align="left"><strong>*</strong> Тема:</div></td>
        <td><div align="left">
            <input size="52" name="subject">
          </div></td>
      </tr>
      <tr>
        <td vAlign="top"><div  align="left"><strong>*</strong> Ваш e-mail:</div></td>
        <td><div align="left">
            <input size="52" name="mail">
          </div></td>
      </tr>
      <tr>
        <td vAlign="top"><div align="left">Телефон:</div></td>
        <td><div align="left">
            <input size="52" name="tel">
          </div></td>
      </tr>
      <tr>
        <td vAlign="top"><strong>*</strong> Сообщение:
          </div></td>
        <td><div align="left">
            <textarea name="message" rows="8" cols="40"></textarea>
          </div>
          <div class="gbook_otvet">Данные, отмеченные <b>*</b> обязательны для заполнения.<br>
            <font color="#FF0000"><strong>@Error@</strong></font> </div>
          <p><br></p>
          <table>
            <tr>
              <td><img src="phpshop/captcha2.php" alt="" border="0"></td>
            </tr>
            <tr>
              <td><strong>*</strong> Введите только буквы и цифры  @capColor@ цвета<br>
                <input type="text" name="key" size="20"></td>
            </tr>
          </table>
          <p><br></p></td>
      </tr>
      <tr>
        <td></td>
        <td><div align="right">
            <input style="FONT-SIZE: 90%" type=reset value=" Очистить ">
            <input type=button value="Отправить сообщение"  onclick="Fchek2()">
            <input type="Hidden" name="send_f" value="ok">
          </div></td>
      </tr>
    </tbody>
  </table>
</FORM>
</p>
