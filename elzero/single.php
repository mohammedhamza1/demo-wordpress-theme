<?php get_header(); ?>

<div class="container post-page">


    <?php
if(have_posts()){
    while(have_posts()){
       the_post();
        ?>

        <div class="main-post single-post">
            <?php edit_post_link('Edit <i class="fa fa-pencil" aria-hidden="true"></i>'); ?>
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

            <?php if(has_post_thumbnail()){
                        the_post_thumbnail('',['class' => 'img-responsive img-thumbnail', 'title' => 'post image']);
                      } ?>

            <div class="lead post-content">
                <?php the_content() ?>
            </div>

            <hr>
            <p class="post-categories">
                <i class="fa fa-tags fa-fw"></i>
                <?php the_category(', '); ?>
            </p>
            <p class="post-tags">
                <?php if(has_tag()){
            the_tags();
            
                      }else{
            echo 'No tags to display';
        } ?>
            </p>

        </div>

        <!-- get the author information -->
        <hr class="comments-seperator">
        <div class="row">
            <div class="col-sm-2">
                <?php 
                // display avatar with some options 
                $avatar_arguments = array(
                'class' => 'img-responsive img-thumbnail center-block'
                );

                echo get_avatar(get_the_author_meta('id'),110,'','auther avatar',$avatar_arguments);
                ?>
                <!--display author page -->
                <button type="button" class="btn btn-danger center-block"><?php the_author_posts_link(); ?></button>

            </div>
            <!-- end col -->
            <div class="col-sm-10 author-info">
                <h4>
                    <?php the_author_meta('first_name') ?>
                    <?php the_author_meta('last_name') ?>
                </h4>
                <!--display number of posts -->
                <p class="auther-stats pull-right">
                    Posts Number: <span class="posts-count label label-danger"><?php echo count_user_posts(get_the_author_meta('id')) ?></span>
                </p>

                <?php
            //check if the author has description
            if(get_the_author_meta('description')){?>
                    <p>
                        <?php the_author_meta('description') ?>
                    </p>
                    <?php
            }else{
                echo '<span class="no-bio">No discription to this author</span>';
            }?>
            </div>
            <!-- end col -->
        </div>
        <!-- end row-->


        <?php

    }//end while
}//end if
  
            // pagination system
            echo '<div class="clearfix"></div>';
    
            echo '<hr class="comments-seperator">';
    
            echo '<div class="post-pagination single-pagination text-center">';
            if( get_previous_post_link() ){
                previous_post_link('%link','<i class="fa fa-chevron-left fa-lg"></i> %title');
            }else{
                echo '<span>prev</span>';
            }
            if( get_next_post_link() ){
                next_post_link('%link','%title <i class="fa fa-chevron-right fa-lg"></i>');
            }else{
                echo '<span>next</span>'; 
            }
            echo '</div>';
   ?>
            <hr class="comments-seperator">
            <?php 
                //display wordpress comments template
                comments_template();
              ?>
</div>


<?php get_footer(); ?>
