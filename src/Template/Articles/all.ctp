

<!------------recent-section-------------->
	<div class="recent_section">
<div class="slidr_heading">
   <h4> Articles</h4>
   <span class="sub_artcle">  <?= $this->Flash->render() ?>  </span> 
   	</div>
	<div class="container">
    	<div class="row">
                 <?php
                 if(!empty($articles)){  
              
                foreach($articles as $article){  
              ?>  
        	<div class="col-sm-12">
            	<div class="detail_recnt">
                        <h4>
                            <a href="<?php echo $this->request->webroot; ?>articles/edit/<?php  echo $article['id'];?>"><?php if(isset($article['title'])){ echo $article['title']; } ?></a> <?php if($userdata['id'] == $article['user_id']){ ?>
                            <a href="<?php echo $this->request->webroot; ?>articles/edit/<?php  echo $article['id'];?>"><i class="fa fa-pencil" aria-hidden="true"></i> </a>
                        <?= $this->Form->postLink('<span class="fa fa-trash-o"></span><span class="sr-only">' . __('Delete') . '</span>', ['action' => 'delete', $article->id], ['escape' => false,'confirm' => __('Are you sure you want to delete # {0}?', $article->id),'class' => ''])  ?>
                        <?php } ?>     
                        </h4>  
                        
                                 <?php  
                                        $string = strip_tags($article['description']);
                                        if (strlen($string) > 250) {    
                                            $stringCut = substr($string, 0, 250);
                                            $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="'.$this->request->webroot.'articles/view/'.$article['id'].'" class="read_lst">Read More</a>'; 
                                        }
                                        ?>
                  <?php if(isset($string)){ echo $string; } ?>      
                	</div>
            	</div>
              <?php } }else{  
                  echo '<div class="col-sm-12"><div class="blankimg"><img src="'.$this->request->webroot.'/img/no-article.png" class="img-responsive"></div></div>';
                  
                  echo '<div class="col-sm-4 col-sm-offset-5"><div class="noarticlebtn"><a class="btn btn-info" href="'.$this->request->webroot.'articles/add">Click here to add article</a></div></div>';
               }  ?>   
            
        	</div>
    	</div>
	</div>    
