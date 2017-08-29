<?php get_header(); ?>

<div class="container">
    <div class="author-page">
        <div class="row">
            <div class="col-sm-3">
                <?php 
                // display avatar with some options 
                $avatar_arguments = array(
                'class' => 'img-responsive img-thumbnail center-block'
                );
                echo get_avatar(get_the_author_meta('id'),196,'','auther avatar',$avatar_arguments);
                ?>
            </div>
            <!-- end col -->
            <div class="col-sm-9">
                <h2 class="author-name">
                    <?php the_author_meta('first_name') ?>
                    <?php the_author_meta('last_name') ?>
                </h2>
                <div class="row stats">
                    <div class="col-sm-3">
                        <div class="author-stats">
                            Posts Number
                            <span class="label label-info"><?php echo count_user_posts(get_the_author_meta('id')) ?>
                            </span>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-sm-3">
                        <div class="author-stats">
                            comments count
                            <span class="label label-info">
                               <?php 
                                $commentscount_arguments = array(
                                 'user_id' => get_the_author_meta('id'),
                                 'count'   => true
                                   );
                            echo get_comments($commentscount_arguments);
                                ?></span>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-sm-3">
                        <div class="author-stats">
                            total posts view
                            <span class="label label-info">0</span>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-sm-3">
                        <div class="author-stats">
                            testing
                            <span class="label label-info">0</span>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
                <hr>
                <?php
            //check if the author has description
            if(get_the_author_meta('description')){?>
                    <p class="author-bio">
                        <?php the_author_meta('description') ?>
                    </p>
                    <?php
            }else{
                echo '<span class="no-bio">No discription to this author</span>';
            }?>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>

    <!-- get posts -->
    <?php
    
        // get latest posts 
        $post_per_page = 4;
        $custome_query_arguments = array(
        'author' => get_the_author_meta('id'),
        'posts_per_page' => $post_per_page
    );
        //wp_query 
        $the_query = new WP_Query($custome_query_arguments);
    
      //start loop
    if($the_query->have_posts()){
        
        //start count author posts
        if(count_user_posts(get_the_author_meta('id'))>=$post_per_page){
    ?>
        <h3 class="author-hr">
            <?php echo 'Latest '.$post_per_page. ' Posts of'?>
            <?php the_author_meta('first_name')?>
        </h3>

        <?php
        }else{
    ?>
            <h3 class="author-hr">
                <?php the_author_meta('first_name')?> Posts
            </h3>
            <?php 
        } //end count author posts
        
        while($the_query->have_posts()){
               $the_query->the_post();
            ?>
            <div class="author-posts">
                <div class="row">
                    <div class="col-sm-3">
                        <?php if(has_post_thumbnail()){
                            the_post_thumbnail('',['class' => 'img-responsive img-thumbnail post-img', 'title' => 'post image']);
                          } ?>
                    </div>
                    <!--end col-->
                    <div class="col-sm-9">
                        <h3 class="post-title">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                        <span class="post-date">
                            <i class="fa fa-calendar fa-fw"></i> <?php the_time('F j, Y'); ?></span>
                        <span class="post-time">
                        <i class="fa fa-clock-o fa-fw"></i> <?php the_time('g:i a'); ?></span>
                        <span class="post-comment">
                            <i class="fa fa-comment-o fa-fw"></i> <?php comments_popup_link('No Comments','1 Comment','% Comments',none,'Comments Off'); ?></span>
                        <div class="lead post-content">
                            <?php the_excerpt() ?>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!-- end row -->
            </div>
            <div class="clearfix"></div>

            <?php
            
        }//end while
    }//end if
        wp_reset_postdata(); //reset loop query
    
        // get latest comments 
        $comments_per_page = 6;
    
        $comments_arguments = array(
         'user_id' => get_the_author_meta('id'),
         'status'  => 'approve',
         'number' => $comments_per_page,
         'post_status' => 'publish',
         'post_type'   => 'post'
        );
    
        $comments = get_comments($comments_arguments);
    
            // check if Author has comments
            if($comments){
                
                //start count author comments
                if(get_comments($commentscount_arguments)>=$comments_per_page){?>

                <h3 class="author-hr">
                    <?php echo 'Latest '.$comments_per_page. ' Comments of'?>
                    <?php the_author_meta('first_name')?>
                </h3>

                <?php
                }else{?>

                    <h3 class="author-hr">
                        <?php the_author_meta('first_name')?> Latest comments
                    </h3>

                    <?php } 
                //end count author comments
                
                //start comments loop
                foreach ($comments as $comment){?>
                    <div class="author-comments">
                        <h3 class="comment-title">
                            <a href="<?php echo get_permalink($comment->comment_post_ID) ?>">
                                <?php echo get_the_title($comment->comment_post_ID) ?>
                            </a>
                        </h3>
                        <!-- end comment title -->
                        <span class="comment-date">
                     <i class="fa fa-calendar fa-fw"></i> <?php echo mysql2date('F j, Y',$comment->comment_date)   ?>
                    </span>
                        <!-- end comment date -->
                        <span class="comment-time">
                     <i class="fa fa-clock-o fa-fw"></i> <?php echo mysql2date('g:i a',$comment->comment_date)   ?>
                    </span>
                        <!-- end comment time -->
                        <div class="comment-content">
                            <?php echo $comment->comment_content ?>
                        </div>
                        <!-- end comment content -->
                    </div>
                    <!-- end author comments -->

                    <?php } // end foreach 
            
            }else{?>
                    <h3 class="author-hr">
                        No comments yet for
                        <?php the_author_meta('first_name')?>
                    </h3>
                    <?php  }//end if ?>

</div>
<!-- end container -->







<?php get_footer(); ?>
