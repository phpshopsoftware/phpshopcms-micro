			<div class="art-post">
              <div class="art-post-body">
                <div class="art-post-inner">
                  <div class="art-postcontent">
                    <!-- article-content -->
                    <span class="breadcrumbs pathway"><a class="pathway" href="/">Главная</a> <img alt="" src="images/arrow.png"> <a class="pathway" href="/gbook/">Отзывы</a> <img alt="" src="images/arrow.png"> Форма отзыва</span>
                    <!-- /article-content -->
                  </div>
                  <div class="cleared"></div>
                </div>
                <div class="cleared"></div>
              </div>
            </div>
            <div class="art-post">
              <div class="art-post-body">
                <div class="art-post-inner">
                  <h2 class="art-postheader"><img src="images/postheadericon.png" alt="postheadericon" width="30" height="23" /> Форма отзыва</h2>
                  <div class="art-postmetadataheader">
                    <div class="art-postheadericons art-metadata-icons"> </div>
                  </div>
                  <div class="art-postcontent">
                    <!-- article-content -->
					<form method="post" name="forma_gbook">
                      <table cellpadding="5" cellspacing="1" border="0" class="standart">
                        <tr>
                          <td align="right"> Имя </td>
                          <td><input type="text" name="name_new" maxlength="45" style="width:300px; height:18px; font-family:tahoma; font-size:11px ; color:#4F4F4F ">
                            <img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0"> </td>
                        </tr>
                        <tr >
                          <td align="right"> E-mail </td>
                          <td><input  class=s type="text" name="mail_new" maxlength="30" style="width:300px; height:18px; font-family:tahoma; font-size:11px ; color:#4F4F4F ">
                          </td>
                        </tr>
                        <tr>
                          <td align="right"> Тема сообщения </td>
                          <td><textarea style="width:300px; height:50px; font-family:tahoma; font-size:11px ; color:#4F4F4F " name="tema_new" maxlength="60"></textarea>
                            <img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0"> </td>
                        </tr>
                        <tr>
                          <td align="right"> Отзыв </td>
                          <td valign="top"><textarea style="width:300px; height:150px; font-family:tahoma; font-size:11px ; color:#4F4F4F " name="otsiv_new" maxlength="100" ></textarea>
                            <img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0"> </td>
                        </tr>
                        <tr>
                          <td colspan="2" align="center"><DIV class="gbook_otvet"><IMG height=16 alt="" hspace=5 src="images/shop/comment.gif" width=16 align=absMiddle border=0>Данные, отмеченные <B>флажками</B> обязательны для заполнения. Отзыв будет размещен только после проверки модератором.<br>
                              <font color="#FF0000"><strong>@Error@</strong></font> </DIV>
                            <p><br>
                            </p>
                            <table>
                              <tr>
                                <td><img src="phpshop/captcha2.php" alt="" border="0"></td>
                              </tr>
                              <tr>
                                <td><strong>*</strong> Введите только буквы и цифры  @capColor@ цвета<br>
                                  <input type="text" name="key" size="20"></td>
                              </tr>
                            </table>
                            <p><br>
                            </p>
                            <table align="center">
                              <tr>
                                <td><img src="images/shop/brick_error.gif" alt="" width="16" height="16" border="0"> <a href="javascript:forma_gbook.reset();" class="standart"><u class=style1>Очистить форму</u></a></td>
                                <td width="20"></td>
                                <td><img src="images/shop/brick_go.gif" alt="" width="16" height="16" border="0"> <a href="javascript:Fchek();" class="standart"><u class=style1>Добавить отзыв</u></a></td>
                              </tr>
                            </table>
                            <input type="hidden" name="send_gb" value="ok" >
                          </td>
                        </tr>
                      </table>
                    </form>
                    <span class="article_separator">&nbsp;</span>
                    <!-- /article-content -->
                  </div>
                  <div class="cleared"></div>
                </div>
                <div class="cleared"></div>
              </div>
            </div>
