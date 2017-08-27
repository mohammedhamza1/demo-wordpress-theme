<?php get_header(); ?>

<div class="container home-page">
    <div class="row">

        <?php
if(have_posts()){
    while(have_posts()){
        the_post();
        ?>
            <div class="col-sm-6">
                <div class="main-post">
                    <h3 class="post-title">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h3>
                    <span class="post-auther">
                        <i class="fa fa-user fa-fw"></i> <?php the_author_posts_link(); ?></span>
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
                        <?php //the_content('continue reading'); ?>
                        <?php the_excerpt() ?>
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
            </div>


            <?php

    }//end while
}//end if
        
     /* 
     
        // pagination system
        echo '<div class="clearfix"></div>';
        echo '<div class="post-pagination text-center">';
        if( get_previous_posts_link() ){
            previous_posts_link('<i class="fa fa-chevron-left fa-lg"></i> Prev');
        }else{
            echo '<span>prev</span>';
        }
        if( get_next_posts_link() ){
            next_posts_link('Next <i class="fa fa-chevron-right fa-lg"></i>');
        }else{
            echo '<span>next</span>'; 
        }
        echo '</div>';
        
     */
   
       echo numbering_pagination();

?>

    </div>

</div>

<?php //get_footer(); ?>
