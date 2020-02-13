<?php echo $header; ?>
<div id="module-ttblog-details" class="container blog-blog">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?> blog-detail"><?php echo $content_top; ?>
      <h1><?php echo $heading_title; ?></h1>
	  <div class="blog-post">
      <?php if ($blogs['image']) { ?>
	  		<div class="blog_image_holder">
	  			<img itemprop="image" src="<?php echo $blogs['image']; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" class="imageFeatured" />
	  		</div>
	  <?php } ?>
	  
	  <div class="blog-detail-content">
	  	<div class="page-item-title"><h1><?php echo $heading_title; ?></h1></div>
		<div class="blog-tool">
			<span class="date-time"><?php echo $date; ?></span>
			<?php /* ?><div class="comment"> <i class="fa fa-comments-o"></i> <?php echo $blogs['total_comments']; ?></div> <?php */ ?>
		</div>
		<div class="article-desc"> <p><?php echo $description; ?></p> </div>
	  </div>
	  </div>

      <?php if ($success) { ?>
      <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?><button type="button" class="close" data-dismiss="alert">&times;</button></div>
      <?php } ?>
	
	  <div class="blog-extra">
      <?php if ($blog_comments) { ?>
		<div id="article_comments">
	      <h3 class="title_block"><span class="ttblock-heading"><?php echo $text_your_comments; ?></span></h3>
		  <div class="comments-block">
		  <div id="comments">
		    <?php foreach ($blog_comments as $blog_comment) { ?>
		  	<ul class="comment-list">
		  <li class="panel panel-default">
			<div class="comment-content">
			  <div class="blog-tool">
			 	<img class="avatar" alt="Avatar" src=" http://192.168.0.11/OPC040/image/catalog/demo/banners/images/avatar/avatar-author-default.jpg"/>
				<div class="name"><?php echo $blog_comment['author']; ?></div>
				<div class="created"><span class="commentTime"><?php echo $blog_comment['date_added']; ?></span></div>
				<p><?php echo $blog_comment['comment']; ?></p>
			  </div>
			</div>
		  </li>
		  </ul>
		  <?php } ?>
		  </div>
		  </div>
		</div>
		<?php } ?>

		<?php if ($allow_comments) { ?>
		<div id="respond" class="ttblogcomments">
		  <h4 id="reply-title" class="comment-reply-title"><?php echo $button_comment_add; ?></h4>
		  <div id="add-comment">
			<?php if ($login_required && !$is_logged) { ?>
				<div class="login-required alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $text_login_required; ?></div>
			<?php } else { ?>
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
			  <div class="form-group required">
				<label class="col-sm-2 control-label" for="input-author">
				<?php echo $entry_author; ?>
				</label>
				<div class="col-sm-10">
				  <input type="text" name="author" value="<?php echo $author; ?>" id="input-author" placeholder="<?php echo $entry_author; ?>" class="form-control" />
				  <?php if ($error_author) { ?>
				  <div class="text-danger"><?php echo $error_author; ?></div>
				  <?php } ?>
				</div>
			  </div>
			  <?php if ($is_logged) { ?>
			  	<input type="hidden" name="email" value="<?php echo $email; ?>" id="input-email" />
			  <?php } else { ?>
			  <div class="form-group required">
				<label class="col-sm-2 control-label" for="input-email"><?php echo $entry_email; ?></label>
				<div class="col-sm-10">
				  <input type="text" name="email" value="<?php echo $email; ?>" id="input-email" placeholder="<?php echo $entry_email; ?>" class="form-control" />
				  <?php if ($error_email) { ?>
				  <div class="text-danger"><?php echo $error_email; ?></div>
				  <?php } ?>
				</div>
			  </div>
			  <?php } ?>
			  
			  <div class="form-group required">
				<label class="col-sm-2 control-label" for="input-comment"><?php echo $entry_comment; ?></label>
				<div class="col-sm-10">
				  <textarea name="comment" rows="10" id="input-comment" class="form-control" /><?php echo $comment; ?></textarea>
				  <?php if ($error_comment) { ?>
				  <div class="text-danger"><?php echo $error_comment; ?></div>
				  <?php } ?>
				</div>
			  </div>
			  <?php echo $captcha; ?>	
			  <input type="hidden" name="auto_approve" value="<?php echo $auto_approve; ?>" />
			  <div class="buttons"><div class="pull-right"><input class="btn btn-primary" type="submit" value="<?php echo $button_submit; ?>" /></div></div>
			</form>
			<?php } ?>
		  </div>
		  </div>
		<?php } ?>
		</div>

    <?php echo $content_bottom; ?></div>
  <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>