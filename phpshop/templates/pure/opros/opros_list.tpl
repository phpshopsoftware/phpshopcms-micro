            <div class="art-block">
              <div class="art-block-body">
                <div class="art-blockheader">
                  <div class="l"></div>
                  <div class="r"></div>
                  <div class="t"> Голосование</div>
                </div>
                <div class="art-blockcontent">
                  <div class="art-blockcontent-tl"></div>
                  <div class="art-blockcontent-tr"></div>
                  <div class="art-blockcontent-bl"></div>
                  <div class="art-blockcontent-br"></div>
                  <div class="art-blockcontent-tc"></div>
                  <div class="art-blockcontent-bc"></div>
                  <div class="art-blockcontent-cl"></div>
                  <div class="art-blockcontent-cr"></div>
                  <div class="art-blockcontent-cc"></div>
                  <div class="art-blockcontent-body">
                    <!-- block-content -->
                    <form action="/opros/" method="post">
                      <table width="95%" border="0" cellspacing="0" cellpadding="1" align="center" class="poll">
                        <thead>
                          <tr>
                            <td style="font-weight: bold;"> @oprosName@ </td>
                          </tr>
                        </thead>
                        <tr>
                          <td align="center"><table class="pollstableborder" cellspacing="0" cellpadding="0" border="0">
@oprosContent@
                            </table></td>
                        </tr>
                        <tr>
                          <td><div align="center"> <span class="art-button-wrapper"><span class="l"> </span><span class="r"> </span>
                              <input type="submit" name="task_button" class="button art-button" value="Ок" />
                              </span> &nbsp; <span class="art-button-wrapper"><span class="l"> </span><span class="r"> </span>
                              <input type="button" name="option" class="button art-button" value="Результаты" onclick="document.location.href='/opros/'" />
                              </span> </div></td>
                        </tr>
                      </table>
                    </form>
                    <!-- /block-content -->
                    <div class="cleared"></div>
                  </div>
                </div>
                <div class="cleared"></div>
              </div>
            </div>
