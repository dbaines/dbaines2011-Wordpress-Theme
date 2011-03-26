<h2>Latest Comments</h2>
<ul class="sub-latest-comments">
	<?php
	#http://www.wprecipes.com/how-to-list-most-recent-comments
      global $wpdb;
      $sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type,comment_author_url, SUBSTRING(comment_content,1,60) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT 7";
    
      $comments = $wpdb->get_results($sql);
      $output = $pre_HTML;
      foreach ($comments as $comment) {
#        $output .= "\n<li>".strip_tags($comment->comment_author) .":" . "<a href=\"" . get_permalink($comment->ID)."#comment-" . $comment->comment_ID . "\" title=\"on ".$comment->post_title . "\">" . strip_tags($comment->com_excerpt)."</a></li>";
		$output .= "\n<li>&quot;".strip_tags($comment->com_excerpt)."&quot;
		<small>by ".strip_tags($comment->comment_author) ." <br />On <a href=\"" . get_permalink($comment->ID)."#comment-" . $comment->comment_ID . "\" title=\"on ".$comment->post_title . "\">".$comment->post_title."</a></small>
		</li>";
      }
      $output .= $post_HTML;
      echo $output;
    ?>

</ul>