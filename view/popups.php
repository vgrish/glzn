<div class="popup_overlay" onClick="popup_out();"></div>
	<div class="popup" id="thx">
		<div class="popup_close noselect"><span onClick="popup_out();">&nbsp;</span></div>
		<div class="popup_h1">Спасибо за оставленную заявку</div>
		<div class="popup_h2">Наш менеджер свяжется с вами в ближайшее время</div>
		<div class="btn" onClick="popup_out();">закрыть</div>
	</div>
    <div class="popup" id="thanks">
        <div class="popup_close noselect"><span onClick="popup_out();">&nbsp;</span></div>
        <div class="popup_h1">Спасибо за оставленный заказ</div>
        <div class="popup_h2">Наш менеджер свяжется с вами в ближайшее время</div>
        <div class="btn" onClick="popup_out();">закрыть</div>
    </div>
    <div class="popup" id="payment">
        <div id="pay"></div>
    </div>
	<div class="popup" id="callback">
		<div class="popup_close noselect"><span onClick="popup_out();">&nbsp;</span></div>
		<div class="popup_h1">Заказать обратный звонок</div>
		<div class="popup_h2">
			Оставьте заявку, и наш специалист свяжется<br>
			с вами, чтобы ответить на ваши вопросы.
		</div>
		<form>
			<?=ConfigSites::$desc_name?>
			<label class="name required">
				<input type="text" name="name" placeholder="Ваше имя">
			</label><br>
			<?=ConfigSites::$desc_phone?>
			<?=ConfigSites::phoneField(ConfigSites::$phoneFormat)?>
			<div data-name="callback" class="button noselect btn">Заказать звонок</div>
		</form>
	</div>
	<div class="popup" id="request">
		<div class="popup_close noselect"><span onClick="popup_out();">&nbsp;</span></div>
		<div class="popup_h1">Оставьте заявку</div>
		<div class="popup_h2">
			Оставьте заявку, и наш специалист свяжется<br>
			с вами в ближайшее время.
		</div>
		<form>
			<?=ConfigSites::$desc_name?>
			<label class="name required">
				<input type="text" name="name" placeholder="Ваше имя">
			</label><br>
			<?=ConfigSites::$desc_phone?>
			<?=ConfigSites::phoneField(ConfigSites::$phoneFormat)?>
			<?=ConfigSites::$desc_email?>
			<label class="email required">
				<input type="text" name="email" placeholder="Ваш E-mail">
			</label><br>
			<div data-name="request" class="button noselect btn filled dark">Заказать</div>
		</form>
	</div>
	<div class="popup" id="question">
		<div class="popup_close noselect"><span onClick="popup_out();">&nbsp;</span></div>
		<div class="popup_h1">Задать вопрос</div>
		<div class="popup_h2">
			Заполните форму,<br>
			и&nbsp;мы&nbsp;обязательно свяжемся с&nbsp;вами!
		</div>
		<form>
			<?=ConfigSites::$desc_name?>
			<label class="name required">
				<input type="text" name="name" placeholder="Ваше имя">
			</label><br>
			<?=ConfigSites::$desc_phone?>
			<?=ConfigSites::phoneField(ConfigSites::$phoneFormat)?>
			<?=ConfigSites::$desc_email?>
			<label class="email required">
				<input type="text" name="email" placeholder="Ваш E-mail">
			</label><br>
			<?=ConfigSites::$desc_ques?>
			<textarea class="ques" name="ques" placeholder="Ваш вопрос"></textarea><br>
			<div data-name="question" class="button noselect btn">Задать вопрос</div>
		</form>
	</div>

	<? $table_size = DB::select('settings_size'); ?>
	<div class="popup" id="size-table">
		<div class="popup_close noselect"><span>&nbsp;</span></div>
	    <div class="popup-body group">
	        <div class="mini-table">
	            <div class="popup-title">
	                Таблица соответствия размеров
	            </div>
	            <table class="mini-table-header" id="size-table-switcher">
	                <tbody>
	                	<tr>
	                	    <td class="active" data-table-id="table1">Для изделий из трикотажа</td>
	                	    <td data-table-id="table2">Для остальных изделий</td>
	                	</tr>
		            </tbody>
		        </table>
		        <table class="mini-table-body" id="table1">
		        	<thead>
		            	<tr>
		                	<td class="td-size"></td>
		                    <td>Обхват груди (см)</td>
		                    <td>Обхват талии (см)</td>
		                    <td>Обхват бедер (см)</td>
		                </tr>
					</thead>
					<tbody>
						<tr>
						    <td class="td-size">XS</td>
						    <td><?=$table_size[0]['s1']?></td>
						    <td><?=$table_size[1]['s1']?></td>
						    <td><?=$table_size[2]['s1']?></td>
						</tr>
						<tr>
						    <td class="td-size">S</td>
						    <td><?=$table_size[0]['s2']?></td>
						    <td><?=$table_size[1]['s2']?></td>
						    <td><?=$table_size[2]['s2']?></td>
						</tr>
						<tr>
						    <td class="td-size">M</td>
						    <td><?=$table_size[0]['s3']?></td>
						    <td><?=$table_size[1]['s3']?></td>
						    <td><?=$table_size[2]['s3']?></td>
						</tr>
	  					<tr>
		                	<td class="td-size">L</td>
		                	<td><?=$table_size[0]['s4']?></td>
		                	<td><?=$table_size[1]['s4']?></td>
		                	<td><?=$table_size[2]['s4']?></td>
		                </tr>
	                    <tr>
	                        <td class="td-size">XL</td>
		                    <td><?=$table_size[0]['s5']?></td>
		                    <td><?=$table_size[1]['s5']?></td>
		                    <td><?=$table_size[2]['s5']?></td>
		                </tr>
		            </tbody>
		        </table>
				<table class="mini-table-body" id="table2" style="display:none;">
		        <thead>
		            <tr>
		                <td class="td-size"></td>
		                <td>Обхват груди (см)</td>
		                <td>Обхват талии (см)</td>
		                <td>Обхват бедер (см)</td>
		            </tr>
		        </thead>
		        <tbody>
		        	<tr>
		        	    <td class="td-size">40</td>
		        	    <td><?=$table_size[3]['s1']?></td>
		        	    <td><?=$table_size[4]['s1']?></td>
		        	    <td><?=$table_size[5]['s1']?></td>
		        	</tr>
		            <tr>
		         		<td class="td-size">42</td>
		                <td><?=$table_size[3]['s2']?></td>
		                <td><?=$table_size[4]['s2']?></td>
		                <td><?=$table_size[5]['s2']?></td>
		            </tr>
                    <tr>
	                    <td class="td-size">44</td>
		                <td><?=$table_size[3]['s3']?></td>
		                <td><?=$table_size[4]['s3']?></td>
		                <td><?=$table_size[5]['s3']?></td>
		            </tr>
                    <tr>
	                    <td class="td-size">46</td>
	                    <td><?=$table_size[3]['s4']?></td>
	                    <td><?=$table_size[4]['s4']?></td>
	                    <td><?=$table_size[5]['s4']?></td>
	                </tr>
                    <tr>
		                <td class="td-size">48</td>
		                <td><?=$table_size[3]['s5']?></td>
		                <td><?=$table_size[4]['s5']?></td>
		                <td><?=$table_size[5]['s5']?></td>
		            </tr>
			    </tbody>
		    </table>
            <a href="javascript:void(0);" target="_blank" class="btn dark filled">Записаться на примерку в шоурум</a>
        </div>
        <div class="large-table">
	        <div class="popup-title">
	            Таблица соответствия размеров
	        </div>
	        <div class="table">
	            <div class="table-title">Для изделий из трикотажа (джерси)</div>
		            <table>
		                <thead>
		                    <tr>
		                        <td class="body-size"></td>
		                        <td>XS</td>
		                        <td>S</td>
		                        <td>M</td>
		                        <td>L</td>
		                        <td>XL</td>
		                    </tr>
		                </thead>
	                    <tbody>
		                    <tr>
		                        <td class="body-size">1. Обхват груди (см)</td>
		                        <td><?=$table_size[0]['s1']?></td>
		                        <td><?=$table_size[0]['s2']?></td>
		                        <td><?=$table_size[0]['s3']?></td>
		                        <td><?=$table_size[0]['s4']?></td>
		                        <td><?=$table_size[0]['s5']?></td>
		                    </tr>
		                    <tr>
		                        <td class="body-size">2. Обхват талии (см)</td>
		                        <td><?=$table_size[1]['s1']?></td>
		                        <td><?=$table_size[1]['s2']?></td>
		                        <td><?=$table_size[1]['s3']?></td>
		                        <td><?=$table_size[1]['s4']?></td>
		                        <td><?=$table_size[1]['s5']?></td>
		                    </tr>
		                    <tr>
		                        <td class="body-size">3. Обхват бедер (см)</td>
		                        <td><?=$table_size[2]['s1']?></td>
		                        <td><?=$table_size[2]['s2']?></td>
		                        <td><?=$table_size[2]['s3']?></td>
		                        <td><?=$table_size[2]['s4']?></td>
		                        <td><?=$table_size[2]['s5']?></td>
		                    </tr>
		                </tbody>
		            </table>
		        </div>
		        <div class="table last">
		            <div class="table-title">Для остальных изделий</div>
		       		<table>
		            	<thead>
		            	    <tr>
		                	    <td class="body-size"></td>
		                	    <td>40</td>
		                	    <td>42</td>
		                	    <td>44</td>
		                	    <td>46</td>
		                	    <td>48</td>
		                	</tr>
		                </thead>
		                <tbody>
		                	<tr>
		                	    <td class="body-size">1. Обхват груди (см)</td>
		                	    <td><?=$table_size[3]['s1']?></td>
		                	    <td><?=$table_size[3]['s2']?></td>
		                	    <td><?=$table_size[3]['s3']?></td>
		                	    <td><?=$table_size[3]['s4']?></td>
		                	    <td><?=$table_size[3]['s5']?></td>
		                	</tr>
		                	<tr>
		                	    <td class="body-size">2. Обхват талии (см)</td>
		                	    <td><?=$table_size[4]['s1']?></td>
		                	    <td><?=$table_size[4]['s2']?></td>
		                	    <td><?=$table_size[4]['s3']?></td>
		                	    <td><?=$table_size[4]['s4']?></td>
		                	    <td><?=$table_size[4]['s5']?></td>
		                	</tr>
			                <tr>
			                    <td class="body-size">3. Обхват бедер (см)</td>
			                    <td><?=$table_size[5]['s1']?></td>
			                    <td><?=$table_size[5]['s2']?></td>
			                    <td><?=$table_size[5]['s3']?></td>
			                    <td><?=$table_size[5]['s4']?></td>
			                    <td><?=$table_size[5]['s5']?></td>
			                </tr>
		                </tbody>
		            </table>
		        </div>
		        <a href="javascript:void(0);" target="_blank" class="btn dark filled">Записаться на примерку в шоурум</a>
		    </div>    
		    <div class="image">
		    	<img src="<?=ConfigSites::$prefix?>img/woman.jpg" alt="">
		    </div>
		</div>
	</div>
</div>

<div class="popup" id="addCart">
	<div class="head">Товар добавлен в корзину</div>
	<div class="btns">
		<div class="goOn" onclick="popup_out();">Продолжить</div>
		<a href="<?=ConfigSites::$prefix?>card" class="toBucket">В корзину</a>
	</div>
</div>
	
	<input type="hidden" name="prefix" class="prefix" value="<?=ConfigSites::$prefix?>">
	<input type="hidden" name="phone_format" class="phone_format" value="<?=ConfigSites::$phoneFormat?>">
	<input type="hidden" name="referer" value="<? echo $_SERVER['HTTP_REFERER'] ?>">
	<input type="hidden" name="ref_url" value="<? echo $_SERVER['QUERY_STRING'] ?>">
	<input type="hidden" class="formname" name="formname" value="">
	<input type="hidden" class="sitename" name="sitename" value="<?=ConfigSites::$sitename?>">
	<input type="hidden" class="emailsarr" name="emailsarr" value="<?=ConfigSites::$emailsArr?>">