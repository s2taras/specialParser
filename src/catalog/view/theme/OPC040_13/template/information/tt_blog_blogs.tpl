<?php echo $header; ?>
<div class="container">
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
	<div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
	  <h1><?php echo $text_blogs; ?></h1>
	  <?php if ($blogs) { ?>
	  <?php foreach ($blogs as $blog) { ?>
	  <div class="panel-default blog-page cat-blog-content" id="module-ttblog-category">
		<h4 class="blog-cat-title"><?php echo $blog['name']; ?></h4>
		<div id="ttblogcat">
		<?php if ($blog['blog_data']) { ?>
			<?php foreach ($blog['blog_data'] as $topic) { ?>
			<div class="blog-item col-xs-12 col-sm-12">
			  <div class="ttblogpost">
				  <?php if ($topic['image']) { ?>
				  <div class="article-content col-sm-5">
					<a itemprop="url" href="<?php echo $topic['href']; ?>" title="<?php echo $heading_title; ?>" class="imageFeaturedLink">
						<img itemprop="image" alt="<?php echo $heading_title; ?>" src="<?php echo $topic['image']; ?>" class="imageFeatured" />
						<div class="blog-hover"></div>
					</a>
					<span class="bloglinks">
						<a class="icon zoom" data-lightbox="example-set" href="<?php echo $topic['image']; ?>" title="Click to view Full Image" >
						<i class="fa fa-search"></i></a> 
					</span>
				  </div>
				  <?php } ?>
				  <div class="out-content-blog col-sm-7">
					<div class="article-header">
					  <h4 class="blog-title"><a href="<?php echo $topic['href']; ?>"><?php echo $topic['title']; ?></a></h4>
					  <div class="blog-tool">
					  <span class="date-time"><?php echo $topic['date_added']; ?></span>
					  <span class="comment"> <i class="fa fa-comment-o"></i> <a title="<?php echo $topic['total_comments'] . ' ' . $entry_comment; ?>" href="<?php echo $topic['href']; ?>"><?php echo $topic['total_comments']; ?> <?php echo $entry_comment; ?></a> </span>
					  </div>
					</div>
					<div class="sdsarticle-des"><div itemprop="description" class="clearfix"><div class="blog-desc"><?php echo $topic['description']; ?></div></div></div>
					<div class="sdsreadMore"><span class="more"><a title="<?php echo $topic['href']; ?>" href="<?php echo $topic['href']; ?>" class="r_more"><?php echo $text_read_more; ?></a></span></div>
				  </div>
			  </div>
			</div>
			<?php } ?>
			<?php } else { ?>
				<div class="no-post-found col-xs-12 col-sm-12"><?php echo $text_no_blogs; ?></div>
			<?php } ?>

        <?php } ?>
      <?php } else { ?>
      <div class="no-blog-found col-xs-12 col-sm-12"><?php echo $text_no_blogs; ?></div>
      <?php } ?>
    <?php echo $content_bottom; ?></div>
  <?php echo $column_right; ?>
  </div>
  </div>
</div>
<?php echo $footer; ?>