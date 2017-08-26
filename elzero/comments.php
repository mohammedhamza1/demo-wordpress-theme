<?php 
    if(comments_open()){
  ?>
<h3 class="comments-count">
    <?php comments_number('0 Comments','1 Comment','% Comments'); ?>
</h3>

<?php
        //display comments
        echo '<ul class="comments-list list-unstyled">';
        $comments_arguments = array(
        'max_depth'      => '3',
        'avatar_size'    => '64'
        );
        
        wp_list_comments($comments_arguments);
        echo '</ul>';
        
        echo '<hr class="comments-seperator">';
        // comment form 
        $commentform_arguments = array(
        'fields' => array(
            'author'                => '<div class="form-group">
            <label>Your Name</label>
            <input id="author" name="author" type="text" class="form-control" placeholder="Enter Name" required="required"></div>',
            'email'                 => '<div class="form-group">
            <label>Your Email <small class="form-text text-muted">(Your email address will not be published)</small></label>
            <input id="email" name="email" type="text" class="form-control" placeholder="Enter Email" required="required"></div>',
            'url'                   => '<div class="form-group">
            <label>Your Website <small class="form-text text-muted">(Your website name will not be published)</small></label>
            <input id="url" name="url" type="text" class="form-control" placeholder="Enter Website"></div>'
            ),
        'comment_field'             => '  <div class="form-group">
           <textarea id="comment" name="comment" class="form-control" col="40" rows="8" required="required"></textarea> </div>',
        'comment_notes_before'      => '' ,
        'submit_button'             => '<button type="submit" class="btn btn-danger">Post a comment</button>'
        );
        
        comment_form($commentform_arguments);
    }else{
        ?>
    <h3 class="comments-off">
        <?php echo 'No comments to display'; ?>
    </h3>
    <?php
    }

?>
