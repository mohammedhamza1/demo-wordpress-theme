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
    <h3 class="author-hr">
        <?php the_author_meta('first_name')?> Posts
    </h3>
    <!-- get posts -->
    <!-- wp_query -->
    <?php
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;   
        $customequery_arguments = array(
        'author' => get_the_author_meta('id'),
        'posts_per_page' => 6,
        'paged' => $paged
    );
        $the_query = new WP_Query($customequery_arguments);
        // query_posts( $customequery_arguments );
    if($the_query->have_posts()){
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
                    <span class="post-comment">
                            <i class="fa fa-comment-o fa-fw"></i> <?php comments_popup_link('No Comments','1 Comment','% Comments',none,'Comments Off'); ?></span>
                    <div class="lead post-content">
                        <?php the_excerpt() ?>
                    </div>
                </div>
                <!--end col-->

                <div class="clearfix"></div>
            </div>
            <!-- end row -->
        </div>
        <?php
            
        }//end while
    }//end if
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
        wp_reset_postdata();
          ?>


</div>







<?php get_footer(); ?>
