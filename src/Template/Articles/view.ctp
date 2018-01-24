	
<!-- 	-----------------------section---------------------- -->
	<div class="articledetails">
	<div class="container">
		
	<div class="row">
	
	<div class="col-sm-12">
<div class="dtl-txt">
	<h4>Article Details</h4></div>
	</div>
	<div class="col-sm-12">
	<div class="row">
	<div class="col-sm-8">
        <div class="art-txt"><h5><?php if(isset($articles['title'])){ echo $articles['title']; }?></h5>
	<h6>By <span><?php if(isset($articles['author'])){ echo $articles['author']; }?></span>  Submitted On <?php if(isset($articles['created'])){ echo $articles['created']; }?></h6></div>
	</div>  
        </div>  
        <?php if(isset($articles['description'])){ echo $articles['description']; }?>  
	  
            <!--div class="keyword"><span>Keywords: </span><?php if(isset($articles['keyword'])){ echo $articles['keyword']; }?></div--><br/>  
            <div class="outboundlink">
                <a target="_blank" href="<?php if(isset($articles['outboundlink'])){ echo $articles['outboundlink']; }?>" class="btn btn-success scss_grn"><?php if(isset($articles['linkingtext'])){ echo $articles['linkingtext']; }?> </a>
                <a target="_blank" href="<?php if(isset($articles['outboundlink2'])){ echo $articles['outboundlink2']; }?>" class="btn btn-success scss_grn"><?php if(isset($articles['linkingtext2'])){ echo $articles['linkingtext2']; }?> </a> 
            </div><br/>  
             
          
	</div>        
	
	</div>
	</div>
	</div>  