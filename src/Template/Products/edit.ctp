<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css'>
<script src='https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js'></script>
<script>
/********gallery popup*******************/
$( document ).ready(function() {
$('.without-caption').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: false,
		mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
		image: {
			verticalFit: true
		},
		zoom: {
			enabled: true,
			duration: 300 // don't foget to change the duration also in CSS
		}
	});

$('.with-caption').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: false,
		mainClass: 'mfp-with-zoom mfp-img-mobile',
		image: {
			verticalFit: true,
			titleSrc: function(item) {
				return item.el.attr('title') + ' &middot; <a class="image-source-link" href="'+item.el.attr('data-source')+'" target="_blank">image source</a>';
			}
		},
		zoom: {
			enabled: true
		}
	});
}); 
</script>

<style>
      
.image-link {
  cursor: -webkit-zoom-in;
  cursor: -moz-zoom-in;
  cursor: zoom-in;
}


/* This block of CSS adds opacity transition to background */
.mfp-with-zoom .mfp-container,
.mfp-with-zoom.mfp-bg {
	opacity: 0;
	-webkit-backface-visibility: hidden;
	-webkit-transition: all 0.3s ease-out; 
	-moz-transition: all 0.3s ease-out; 
	-o-transition: all 0.3s ease-out; 
	transition: all 0.3s ease-out;
}

.mfp-with-zoom.mfp-ready .mfp-container {
		opacity: 1;
}
.mfp-with-zoom.mfp-ready.mfp-bg {
		opacity: 0.8;
}

.mfp-with-zoom.mfp-removing .mfp-container, 
.mfp-with-zoom.mfp-removing.mfp-bg {
	opacity: 0;
}



/* padding-bottom and top for image */
.mfp-no-margins img.mfp-img {
	padding: 0;
}
/* position of shadow behind the image */
.mfp-no-margins .mfp-figure:after {
	top: 0;
	bottom: 0;
}
/* padding for main container */
.mfp-no-margins .mfp-container {
	padding: 0;
}



/* aligns caption to center */
.mfp-title {
  text-align: center;
  padding: 6px 0;
}
.image-source-link {
  color: #DDD;
}


body { -webkit-backface-visibility: hidden; padding: 10px 30px; 
  font-family: "Calibri", "Trebuchet MS", "Helvetica", sans-serif;
}
</style>
<div class="add_pro">
    <?= $this->Flash->render() ?> 
    <div class="add_hding">
        <h3>Edit Your Product</h3> 
    </div>
    <div class="container">
        <div class="row">
            <div class="covr_dels">
                <?= $this->Form->create($product, array('enctype' => 'multipart/form-data','class'=>'form-horizontal','id' => 'addproductform')) ?>
              
                    <div class="form-group">  
                        <label class="control-label col-sm-2" for="email">Title:</label> 
                        <div class="col-sm-10">
                            <?php echo $this->Form->control('name', ['class' => 'form-control','placeholder'=>'Enter title here' ,'label' => false]); ?>
                           
                        </div> 
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="category">Category:</label>     
                        <div class="col-sm-10">
                         <?php echo $this->Form->control('cat_id',['class' => 'vov_slct form-control','label'=>false]);?>     
                        </div>  
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Condition:</label>
                        <div class="col-sm-10">          
                            <select class="con_wth form-control" name="conditions" id="conditions">
                                <option value="New" <?php if($product['conditions']=='New'){ echo "selected"; } ?>>New</option>
                                <option value="Old" <?php if($product['conditions']=='Old'){ echo "selected"; } ?>>Old</option>
                            </select>
                        </div>
                    </div> 
                    
                      <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Image:</label> 
                        <div class="col-sm-10">            
                            <div class="upld_phts" id="selectedFiles">  
							 <button class="btn defult_btn">Upload a file</button>
                                 <input type="file" name="image" id="image" class="form-control">
                            
                            </div>
                            <div class="singleimage"> 
                        
                              
                               <div class="lrge_pic">
                                   <?php if($product['image']){ ?>  
                                        <img src="<?php echo $this->request->webroot."images/products/".$product['image']; ?>" id="realimage">
                                         <?php }else{ ?> 
                                        <img src="<?php echo $this->request->webroot."images/products/no-image.jpg"; ?>"> 
                                   <?php } ?>    
                                
                               
                               
                               </div>  
                       
                            </div> 
                        </div>
                    </div>
                      
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Gallery:</label> 
                        <div class="col-sm-10"> 
						
					
						         
                            <span class="up_add">Add upto 6 more photos</span>

                            <div class="upld_phts" id="selectedFiles">  
							 <button class="btn defult_btn">Upload a file</button>
                                 <input type="file" name="images[]" id="files" class="form-control" multiple>
                            
                            </div>
                            <div class="st_upld"> 
                              <?php foreach($product['galleries'] as $gallery){
                                  if(!empty($gallery['image'])){
                                  $img = $gallery['image'];
                                  }else{
                                   $img = 'no-image.jpg';    
                                  }
                                  
                                  ?>  
                               <div class="col-sm-2">
                                <div class="lrge_pic">  
                                 <a href="<?php echo $this->request->webroot ?>images/gallery/<?php echo $img; ?>" class="without-caption image-link"><img src="<?php echo $this->request->webroot ?>images/gallery/<?php echo $img; ?>"></a><span data-file='<?php echo $img; ?>' data-id="<?php echo $gallery['id'] ?>" class='remove_img' title='Click to remove' style='cursor:pointer;'><i class="fa fa-trash-o" aria-hidden="true"></i>
</span><br clear=\"left\"/>
                                </div> 
                               
                               </div>
                                <?php } ?>   
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Description:</label>
                        <div class="col-sm-10">
                         <?php echo $this->Form->control('description',['class' => 'form-control','rows'=>5,'label'=>false]);?>    
                        </div>     
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Price:</label>
                        <div class="col-sm-10"> 
                            <?php echo $this->Form->control('price',['class' => 'form-control price','label'=>false,'min'=>1]);?>   
                            <p id="changeamount"></p>
                        </div>  
                    </div>

                    <div class="form-group">
                         <label class="control-label col-sm-2" for="pwd">Check Currency:</label> 
                        <div class="col-sm-3"> 
                             <label class="control-label col-sm-2" for="pwd">From:</label> 
                        <select name="from_currency" class="valid form-control" id="from_currency">
                                    <option value="INR">Indian Rupee</option><option value="USD" selected="1">US Dollar</option><option value="AFA">Afghan Afghani</option><option value="ALL">Albanian Lek</option><option value="DZD">Algerian Dinar</option><option value="AOA">Angolan Kwanza</option><option value="ARS">Argentine Peso</option><option value="AMD">Armenian Dram</option><option value="AWG">Aruban Florin</option><option value="AUD">Australian Dollar</option><option value="AZN">Azerbaijani Manat</option><option value="BSD">Bahamian Dollar</option><option value="BHD">Bahraini Dinar</option><option value="BDT">Bangladeshi Taka</option><option value="BBD">Barbadian Dollar</option><option value="BYR">Belarusian Ruble</option><option value="BEF">Belgian Franc</option><option value="BZD">Belize Dollar</option><option value="BMD">Bermudan Dollar</option><option value="BTN">Bhutanese Ngultrum</option><option value="BTC">Bitcoin</option><option value="BOB">Bolivian Boliviano</option><option value="BAM">Bosnia-Herzegovina Convertible Mark</option><option value="BWP">Botswanan Pula</option><option value="BRL">Brazilian Real</option><option value="GBP">British Pound</option><option value="BND">Brunei Dollar</option><option value="BGN">Bulgarian Lev</option><option value="BIF">Burundian Franc</option><option value="KHR">Cambodian Riel</option><option value="CAD">Canadian Dollar</option><option value="CVE">Cape Verdean Escudo</option><option value="KYD">Cayman Islands Dollar</option><option value="XAF">Central African CFA Franc</option><option value="XPF">CFP Franc</option><option value="CLP">Chilean Peso</option><option value="CNY">Chinese Yuan</option><option value="COP">Colombian Peso</option><option value="KMF">Comorian Franc</option><option value="CDF">Congolese Franc</option><option value="CRC">Costa Rican Col�n</option><option value="HRK">Croatian Kuna</option><option value="CUC">Cuban Convertible Peso</option><option value="CZK">Czech Republic Koruna</option><option value="DKK">Danish Krone</option><option value="DJF">Djiboutian Franc</option><option value="DOP">Dominican Peso</option><option value="XCD">East Caribbean Dollar</option><option value="EGP">Egyptian Pound</option><option value="ERN">Eritrean Nakfa</option><option value="EEK">Estonian Kroon</option><option value="ETB">Ethiopian Birr</option><option value="EUR">Euro</option><option value="FKP">Falkland Islands Pound</option><option value="FJD">Fijian Dollar</option><option value="GMD">Gambian Dalasi</option><option value="GEL">Georgian Lari</option><option value="DEM">German Mark</option><option value="GHS">Ghanaian Cedi</option><option value="GIP">Gibraltar Pound</option><option value="GRD">Greek Drachma</option><option value="GTQ">Guatemalan Quetzal</option><option value="GNF">Guinean Franc</option><option value="GYD">Guyanaese Dollar</option><option value="HTG">Haitian Gourde</option><option value="HNL">Honduran Lempira</option><option value="HKD">Hong Kong Dollar</option><option value="HUF">Hungarian Forint</option><option value="ISK">Icelandic Kr�na</option><option value="IDR">Indonesian Rupiah</option><option value="IRR">Iranian Rial</option><option value="IQD">Iraqi Dinar</option><option value="ILS">Israeli New Sheqel</option><option value="ITL">Italian Lira</option><option value="JMD">Jamaican Dollar</option><option value="JPY">Japanese Yen</option><option value="JOD">Jordanian Dinar</option><option value="KZT">Kazakhstani Tenge</option><option value="KES">Kenyan Shilling</option><option value="KWD">Kuwaiti Dinar</option><option value="KGS">Kyrgystani Som</option><option value="LAK">Laotian Kip</option><option value="LVL">Latvian Lats</option><option value="LBP">Lebanese Pound</option><option value="LSL">Lesotho Loti</option><option value="LRD">Liberian Dollar</option><option value="LYD">Libyan Dinar</option><option value="LTL">Lithuanian Litas</option><option value="MOP">Macanese Pataca</option><option value="MKD">Macedonian Denar</option><option value="MGA">Malagasy Ariary</option><option value="MWK">Malawian Kwacha</option><option value="MYR">Malaysian Ringgit</option><option value="MVR">Maldivian Rufiyaa</option><option value="MRO">Mauritanian Ouguiya</option><option value="MUR">Mauritian Rupee</option><option value="MXN">Mexican Peso</option><option value="MDL">Moldovan Leu</option><option value="MNT">Mongolian Tugrik</option><option value="MAD">Moroccan Dirham</option><option value="MZM">Mozambican Metical</option><option value="MMK">Myanmar Kyat</option><option value="NAD">Namibian Dollar</option><option value="NPR">Nepalese Rupee</option><option value="ANG">Netherlands Antillean Guilder</option><option value="TWD">New Taiwan Dollar</option><option value="NZD">New Zealand Dollar</option><option value="NIO">Nicaraguan C�rdoba</option><option value="NGN">Nigerian Naira</option><option value="KPW">North Korean Won</option><option value="NOK">Norwegian Krone</option><option value="OMR">Omani Rial</option><option value="PKR">Pakistani Rupee</option><option value="PAB">Panamanian Balboa</option><option value="PGK">Papua New Guinean Kina</option><option value="PYG">Paraguayan Guarani</option><option value="PEN">Peruvian Nuevo Sol</option><option value="PHP">Philippine Peso</option><option value="PLN">Polish Zloty</option><option value="QAR">Qatari Rial</option><option value="RON">Romanian Leu</option><option value="RUB">Russian Ruble</option><option value="RWF">Rwandan Franc</option><option value="SVC">Salvadoran Col�n</option><option value="WST">Samoan Tala</option><option value="SAR">Saudi Riyal</option><option value="RSD">Serbian Dinar</option><option value="SCR">Seychellois Rupee</option><option value="SLL">Sierra Leonean Leone</option><option value="SGD">Singapore Dollar</option><option value="SKK">Slovak Koruna</option><option value="SBD">Solomon Islands Dollar</option><option value="SOS">Somali Shilling</option><option value="ZAR">South African Rand</option><option value="KRW">South Korean Won</option><option value="XDR">Special Drawing Rights</option><option value="LKR">Sri Lankan Rupee</option><option value="SHP">St. Helena Pound</option><option value="SDG">Sudanese Pound</option><option value="SRD">Surinamese Dollar</option><option value="SZL">Swazi Lilangeni</option><option value="SEK">Swedish Krona</option><option value="CHF">Swiss Franc</option><option value="SYP">Syrian Pound</option><option value="STD">S�o Tome Pr�ncipe Dobra</option><option value="TJS">Tajikistani Somoni</option><option value="TZS">Tanzanian Shilling</option><option value="THB">Thai Baht</option><option value="TOP">Tongan Pa?anga</option><option value="TTD">Trinidad Tobago Dollar</option><option value="TND">Tunisian Dinar</option><option value="TRY">Turkish Lira</option><option value="TMT">Turkmenistani Manat</option><option value="UGX">Ugandan Shilling</option><option value="UAH">Ukrainian Hryvnia</option><option value="AED">United Arab Emirates Dirham</option><option value="UYU">Uruguayan Peso</option><option value="UZS">Uzbekistani Som</option><option value="VUV">Vanuatu Vatu</option><option value="VEF">Venezuelan Bol�var</option><option value="VND">Vietnamese Dong</option><option value="XOF">West African CFA Franc</option><option value="YER">Yemeni Rial</option><option value="ZMK">Zambian Kwacha</option>
                        </select> 
                        </div>
                       <div class="col-sm-3"> 
                             <label class="control-label col-sm-2" for="pwd">To:</label> 
                        <select name="to_currency" class="valid form-control" id="to_currency">
				<option value="INR" selected="1">Indian Rupee</option><option value="USD">US Dollar</option><option value="AFA">Afghan Afghani</option><option value="ALL">Albanian Lek</option><option value="DZD">Algerian Dinar</option><option value="AOA">Angolan Kwanza</option><option value="ARS">Argentine Peso</option><option value="AMD">Armenian Dram</option><option value="AWG">Aruban Florin</option><option value="AUD">Australian Dollar</option><option value="AZN">Azerbaijani Manat</option><option value="BSD">Bahamian Dollar</option><option value="BHD">Bahraini Dinar</option><option value="BDT">Bangladeshi Taka</option><option value="BBD">Barbadian Dollar</option><option value="BYR">Belarusian Ruble</option><option value="BEF">Belgian Franc</option><option value="BZD">Belize Dollar</option><option value="BMD">Bermudan Dollar</option><option value="BTN">Bhutanese Ngultrum</option><option value="BTC">Bitcoin</option><option value="BOB">Bolivian Boliviano</option><option value="BAM">Bosnia Herzegovina Convertible Mark</option><option value="BWP">Botswanan Pula</option><option value="BRL">Brazilian Real</option><option value="GBP">British Pound</option><option value="BND">Brunei Dollar</option><option value="BGN">Bulgarian Lev</option><option value="BIF">Burundian Franc</option><option value="KHR">Cambodian Riel</option><option value="CAD">Canadian Dollar</option><option value="CVE">Cape Verdean Escudo</option><option value="KYD">Cayman Islands Dollar</option><option value="XAF">Central African CFA Franc</option><option value="XPF">CFP Franc</option><option value="CLP">Chilean Peso</option><option value="CNY">Chinese Yuan</option><option value="COP">Colombian Peso</option><option value="KMF">Comorian Franc</option><option value="CDF">Congolese Franc</option><option value="CRC">Costa Rican Col�n</option><option value="HRK">Croatian Kuna</option><option value="CUC">Cuban Convertible Peso</option><option value="CZK">Czech Republic Koruna</option><option value="DKK">Danish Krone</option><option value="DJF">Djiboutian Franc</option><option value="DOP">Dominican Peso</option><option value="XCD">East Caribbean Dollar</option><option value="EGP">Egyptian Pound</option><option value="ERN">Eritrean Nakfa</option><option value="EEK">Estonian Kroon</option><option value="ETB">Ethiopian Birr</option><option value="EUR">Euro</option><option value="FKP">Falkland Islands Pound</option><option value="FJD">Fijian Dollar</option><option value="GMD">Gambian Dalasi</option><option value="GEL">Georgian Lari</option><option value="DEM">German Mark</option><option value="GHS">Ghanaian Cedi</option><option value="GIP">Gibraltar Pound</option><option value="GRD">Greek Drachma</option><option value="GTQ">Guatemalan Quetzal</option><option value="GNF">Guinean Franc</option><option value="GYD">Guyanaese Dollar</option><option value="HTG">Haitian Gourde</option><option value="HNL">Honduran Lempira</option><option value="HKD">Hong Kong Dollar</option><option value="HUF">Hungarian Forint</option><option value="ISK">Icelandic Kr�na</option><option value="IDR">Indonesian Rupiah</option><option value="IRR">Iranian Rial</option><option value="IQD">Iraqi Dinar</option><option value="ILS">Israeli New Sheqel</option><option value="ITL">Italian Lira</option><option value="JMD">Jamaican Dollar</option><option value="JPY">Japanese Yen</option><option value="JOD">Jordanian Dinar</option><option value="KZT">Kazakhstani Tenge</option><option value="KES">Kenyan Shilling</option><option value="KWD">Kuwaiti Dinar</option><option value="KGS">Kyrgystani Som</option><option value="LAK">Laotian Kip</option><option value="LVL">Latvian Lats</option><option value="LBP">Lebanese Pound</option><option value="LSL">Lesotho Loti</option><option value="LRD">Liberian Dollar</option><option value="LYD">Libyan Dinar</option><option value="LTL">Lithuanian Litas</option><option value="MOP">Macanese Pataca</option><option value="MKD">Macedonian Denar</option><option value="MGA">Malagasy Ariary</option><option value="MWK">Malawian Kwacha</option><option value="MYR">Malaysian Ringgit</option><option value="MVR">Maldivian Rufiyaa</option><option value="MRO">Mauritanian Ouguiya</option><option value="MUR">Mauritian Rupee</option><option value="MXN">Mexican Peso</option><option value="MDL">Moldovan Leu</option><option value="MNT">Mongolian Tugrik</option><option value="MAD">Moroccan Dirham</option><option value="MZM">Mozambican Metical</option><option value="MMK">Myanmar Kyat</option><option value="NAD">Namibian Dollar</option><option value="NPR">Nepalese Rupee</option><option value="ANG">Netherlands Antillean Guilder</option><option value="TWD">New Taiwan Dollar</option><option value="NZD">New Zealand Dollar</option><option value="NIO">Nicaraguan C�rdoba</option><option value="NGN">Nigerian Naira</option><option value="KPW">North Korean Won</option><option value="NOK">Norwegian Krone</option><option value="OMR">Omani Rial</option><option value="PKR">Pakistani Rupee</option><option value="PAB">Panamanian Balboa</option><option value="PGK">Papua New Guinean Kina</option><option value="PYG">Paraguayan Guarani</option><option value="PEN">Peruvian Nuevo Sol</option><option value="PHP">Philippine Peso</option><option value="PLN">Polish Zloty</option><option value="QAR">Qatari Rial</option><option value="RON">Romanian Leu</option><option value="RUB">Russian Ruble</option><option value="RWF">Rwandan Franc</option><option value="SVC">Salvadoran Col�n</option><option value="WST">Samoan Tala</option><option value="SAR">Saudi Riyal</option><option value="RSD">Serbian Dinar</option><option value="SCR">Seychellois Rupee</option><option value="SLL">Sierra Leonean Leone</option><option value="SGD">Singapore Dollar</option><option value="SKK">Slovak Koruna</option><option value="SBD">Solomon Islands Dollar</option><option value="SOS">Somali Shilling</option><option value="ZAR">South African Rand</option><option value="KRW">South Korean Won</option><option value="XDR">Special Drawing Rights</option><option value="LKR">Sri Lankan Rupee</option><option value="SHP">St. Helena Pound</option><option value="SDG">Sudanese Pound</option><option value="SRD">Surinamese Dollar</option><option value="SZL">Swazi Lilangeni</option><option value="SEK">Swedish Krona</option><option value="CHF">Swiss Franc</option><option value="SYP">Syrian Pound</option><option value="STD">S�o Tome Pr�ncipe Dobra</option><option value="TJS">Tajikistani Somoni</option><option value="TZS">Tanzanian Shilling</option><option value="THB">Thai Baht</option><option value="TOP">Tongan Pa?anga</option><option value="TTD">Trinidad Tobago Dollar</option><option value="TND">Tunisian Dinar</option><option value="TRY">Turkish Lira</option><option value="TMT">Turkmenistani Manat</option><option value="UGX">Ugandan Shilling</option><option value="UAH">Ukrainian Hryvnia</option><option value="AED">United Arab Emirates Dirham</option><option value="UYU">Uruguayan Peso</option><option value="UZS">Uzbekistani Som</option><option value="VUV">Vanuatu Vatu</option><option value="VEF">Venezuelan Bol�var</option><option value="VND">Vietnamese Dong</option><option value="XOF">West African CFA Franc</option><option value="YER">Yemeni Rial</option><option value="ZMK">Zambian Kwacha</option>
			</select> 
                             
                        </div>
                        <div class="col-sm-3"> 
						<div class="sve_lf">
                         <button type="button" id="convert" class="btn defult_btn ">Convert</button>
						 </div>
                        </div> 
                    </div>    
					                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Quantity:</label> 
                        <div class="col-sm-10"> 
                            <?php echo $this->Form->control('quantity',['class' => 'form-control','label'=>false,'min'=>1]);?>    
                           
                        </div>  
                    </div>      
                     

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Shipping Details:</label>
                        <div class="col-sm-10">           
                            <?php echo $this->Form->control('delivery_details',['class' => 'form-control','rows'=>5,'label'=>false]);?> 
                        </div>
                    </div>

                    <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10"> 
                             <div class='success'></div> 
                                <div class='loadingmessage' style='display:none'>   
                                    <img src='<?php echo $this->request->webroot; ?>img/loading.gif'/>
                                </div>
								
                        </div>
                    </div>
					<div class="form-group">     
				
								<div class="col-sm-1 col-sm-offset-2">
                            <button type="submit" class="btn btn-success cntr_grn sve_lf">Save</button>
							</div>
							<div class="col-sm-3">
                            <button type="reset" class="btn btn-success cntr_grn sve_lf">Cancel</button>
							</div>
					
					</div>
               
                <?= $this->Form->end() ?>  


            </div>
        </div>
    </div>
</div>  

<script>
/***********Currency check*****************/  
   $('#convert').on('click',function(){
   var amount = jQuery('#price').val();
   var from_currency = jQuery('#from_currency').val();
   var to_currency = jQuery('#to_currency').val();
   if(amount ==''){
       alert('Enter Price')
   }else if(from_currency ==''){
       alert('Select from currency');
   }else if(to_currency ==''){
       alert('Select to currency');
   }else{
   jQuery.ajax({
        url: '<?php echo $this->request->webroot ;?>products/currencyconverter', 
        data:{amount: amount,to_currency:to_currency,from_currency:from_currency}, 
        type: 'POST',
       dataType: "json",
        success: function (res) {       
           $('#changeamount').html(res); 
        }
    }); 
    
    }  
    return false;  
  });    
/*************Currency check end******************************/
    

/**** Multiple image Preview ***/

var selDiv = "";
var storedFiles = [];
var storedFilessingle = [];
 
$(document).ready(function() {
    $("#files").on("change", handleFileSelect);
    $("#image").on("change", handleFileSelectsingle);

    selDiv = $(".st_upld");  
    selDivsingl = $(".singleimage");  
    $("#addproductform").on("submit", handleForm); 

    $("body").on("click", ".selFile", removeFile);
});

function handleFileSelectsingle(e){
    
    
        var files = e.target.files;

    var filesArr = Array.prototype.slice.call(files);

    filesArr.forEach(function(f) {          

        if(!f.type.match("image.*")) {
            return;
        }
        storedFilessingle.push(f);

        var reader = new FileReader();
        reader.onload = function (e) {
            $('#realimage').attr('src',e.target.result);    

        }
        reader.readAsDataURL(f); 
    });

    
}
function handleFileSelect(e) {
    var files = e.target.files;

    var filesArr = Array.prototype.slice.call(files);

    filesArr.forEach(function(f) {          

        if(!f.type.match("image.*")) {
            return;
        }
        storedFiles.push(f);

        var reader = new FileReader();
        reader.onload = function (e) {
            var html = "<div class='col-sm-2'><div class='lrge_pic'><img src=\"" + e.target.result + "\"><span data-file='"+f.name+"' class='selFile' title='Click to remove'  style='cursor:pointer;'><i class='fa fa-trash-o' aria-hidden='true'></i></span><br clear=\"left\"/></div></div>";
            selDiv.append(html);

        }
        reader.readAsDataURL(f); 
    });

} 
   
function handleForm(e) {
    e.preventDefault();
    var data = new FormData();
   
    var title = $("#name").val();  
    var summary = $("#description").val();

    if(title == ''){
        $("#name").after('<label class="error">Please Enter title</label>');
        return false;
    }else{    
        $("#name").next('label').hide();  
    }
   
    if(summary == ''){
        $("#description").after('<label class="error">Please Enter Description</label>');
        return false;
    }else{  
        $("#description").next('label').hide();  
    } 

    data.append('name', title);
    data.append('description', summary);
    data.append('cat_id', $("#cat-id").val());
    data.append('price', $("#price").val()); 
    data.append('quantity', $("#quantity").val());  
    data.append('conditions', $("#conditions").val());         
    data.append('delivery_details', $("#delivery-details").val());    
    for(var i=0, len=storedFiles.length; i<len; i++) {
        data.append('images[]', storedFiles[i]); 
    }
    if(storedFilessingle[0]== null){
    data.append('image', 1);     
    }else{
    data.append('image', storedFilessingle[0]); 
    }
         
    var xhr = new XMLHttpRequest();
    
 
    xhr.open('POST', '<?php echo $this->request->webroot ?>products/edit/<?php echo $product['id']; ?>', true);      

    $(".loadingmessage").show();          

    xhr.onload = function(e) {  
        if(this.status == 200) {  
            $(".loadingmessage").hide();
            $(".success").html('<div class="alert alert-success">Product saved successfully</div>');  
             setTimeout(function(){  window.location.reload(); }, 1000);    
        }  
    }
    xhr.send(data);
}

function removeFile(e) {
    var file = $(this).data("file");
    for(var i=0;i<storedFiles.length;i++) {
        if(storedFiles[i].name === file) {
            storedFiles.splice(i,1);  
            console.log(storedFiles);  
        }
    }
    $(this).parent().remove();
}

/**** Multiple image Preview (END) ***/ 


$(".remove_img").click(function(){
     var id = $(this).attr('data-id');  
     
        $.ajax({
      url: '<?php echo $this->request->webroot ?>products/gallerydelete',
      data: {id: id},
      method: 'post',
      dataType: 'json',
      success: function(response){
        if(response.status ===true){
            alert('Deleted')
           setTimeout(function(){  window.location.reload(); }, 1000);  
        }else{
            alert('Error in image deletion'); 
        }
      }
   });
    
});

</script>    

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/tinymce/4.1.6/tinymce.min.js"></script>
<script>
tinymce.init({
selector: 'textarea',
plugins: [
"code", "charmap", "link"
],
toolbar: [
"undo redo | styleselect | bold italic | link | alignleft aligncenter alignright | charmap code" | "media"
]
});


</script>   