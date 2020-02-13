<?php echo $header; ?>
<div class="container product-category">
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
	  <!-- Category Description START -->
      <h1 class="category-name"><?php echo $heading_title; ?></h1>
      <?php if ($thumb || $description) { ?>
	  <div class="category-description">
		<div class="row">
        <?php if ($thumb) { ?>
        <div class="col-sm-12 category-image"><img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" class="img-thumbnail" /></div>
        <?php } ?>
        <?php if ($description) { ?>
        <div class="col-sm-12 category-content"><?php echo $description; ?></div>
        <?php } ?>
      </div>
      </div>
      <?php } ?>
	  <!-- Category Description END -->

	  <!-- Category listing START -->
      <?php if ($categories) { ?>
	  <div class="category-list">
		<h3><?php echo $text_refine; ?></h3>

		<?php // if (count($categories) <= 5) { ?>
			  <div class="row">
				<div class="col-sm-12">
				  <ul>
					<?php foreach ($categories as $category) { ?>
					<li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
					<?php } ?>
				  </ul>
				</div>
			  </div>
		  <?php // } else { ?>
		  <!--
			  <div class="row">
				<?php foreach (array_chunk($categories, ceil(count($categories) / 4)) as $categories) { ?>
				<div class="col-sm-12">
				  <ul>
					<?php foreach ($categories as $category) { ?>
					<li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
					<?php } ?>
				  </ul>
				</div>
				<?php } ?>
			  </div>
		  -->
		  <?php // } ?>

	  </div>
      <?php } ?>
	  <!-- Category listing END -->

      <?php if ($products) { ?>

	  <!-- Category filter START -->
      <p class="category-compare"><a href="<?php echo $compare; ?>" id="compare-total"><?php echo $text_compare; ?></a></p>
	  <div class="category-filter">
			<!-- Grid-List Buttons -->
			<div class="col-md-2 filter-grid-list">
			  <div class="btn-group">
				<button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="<?php echo $button_grid; ?>"><i class="fa fa-th"></i></button>
				<button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="<?php echo $button_list; ?>"><i class="fa fa-th-list"></i></button>
			  </div>
			</div>
			<!-- Show Products Selection -->
			<div class="filter-show">
				<div class="col-md-4 text-right filter-text">
				  <label class="control-label" for="input-limit"><?php echo $text_limit; ?></label>
				</div>
				<div class="col-md-8 text-right filter-selection">
				  <select id="input-limit" class="form-control" onchange="location = this.value;">
					<?php foreach ($limits as $limits) { ?>
					<?php if ($limits['value'] == $limit) { ?>
					<option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
					<?php } else { ?>
					<option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
					<?php } ?>
					<?php } ?>
				  </select>
				</div>
			</div>
			<!-- Sort By Selection -->
			<div class="filter-sort-by">
				<div class="col-md-3 text-right filter-text">
				  <label class="control-label" for="input-sort"><?php echo $text_sort; ?></label>
				</div>
				<div class="col-md-9 text-right filter-selection">
				  <select id="input-sort" class="form-control" onchange="location = this.value;">
					<?php foreach ($sorts as $sorts) { ?>
					<?php if ($sorts['value'] == $sort . '-' . $order) { ?>
					<option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
					<?php } else { ?>
					<option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
					<?php } ?>
					<?php } ?>
				  </select>
				</div>
			</div>
	  </div>
	  <!-- Category filter END -->

	  <!-- Category products START -->
	  <div class="category-products">
		<div class="row">
        <?php foreach ($products as $product) { ?>
        <div class="product-layout product-list col-xs-12">
          <div class="product-thumb">
            <div class="image">
	<?php if ($product['thumb_swap']) { ?>
				<a href="<?php echo $product['href']; ?>">
					<img class="image_thumb" src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" />
					<img class="image_thumb_swap" src="<?php echo $product['thumb_swap']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" />
				</a>

			<?php } else { ?>

				<a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a>
			<?php } ?>
	
			<?php if ($product['special']) { ?>
					<div class="sale-icon">Sale</div>
				<?php } ?>
			</div>
           <div class="thumb-description">
      <div class="caption">
        <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
		   <?php if ($product['rating']) { ?>
	  <div class="rating">
	    <?php } else { ?>
	    <div class="rating no-rating">
		 <?php } ?>
		  <?php for ($i = 1; $i <= 5; $i++) { ?>
          <?php if ($product['rating'] < $i) { ?>
          <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
          <?php } else { ?>
          <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
          <?php } ?>
          <?php } ?>
        </div>
        <p class="description"><?php echo $product['description']; ?></p>
        </div>
	  <div class="button-wrapper">
	  <?php if ($product['price']) { ?>
        <div class="price">
          <?php if (!$product['special']) { ?>
          <?php echo $product['price']; ?>
          <?php } else { ?>
		  <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
          <?php } ?>
          <?php if ($product['tax']) { ?>
		  <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
          <?php } ?>
        </div>
        <?php } ?>
      <div class="button-group">
        <button class="btn-cart" type="button" title="<?php echo $button_cart; ?>" onclick="cart.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $button_cart; ?></span>
		</button>
        <button class="btn-wishlist" type="button" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
        <button class="btn-compare" type="button" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
      </div>
	  </div>
	  </div>
          </div>
        </div>
        <?php } ?>
      </div>
	  </div>
	  <!-- Category products END -->

	  <!-- Category pagination START -->
	  <div class="category-pagination">
        <div class="col-xs-6 text-left"><?php echo $results; ?></div>
        <div class="col-xs-6 text-right"><?php echo $pagination; ?></div>
	  </div>
	  <!-- Category pagination END -->

      <?php } ?>

      <?php if (!$categories && !$products) { ?>
      <p class="text-empty"><?php echo $text_empty; ?></p>
      <div class="buttons">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
      </div>
      <?php } ?>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
