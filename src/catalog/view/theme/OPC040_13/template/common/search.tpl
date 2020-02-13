<div id="header-search" class="input-group">
  <input type="text" name="search" value="<?php echo $search; ?>" placeholder="<?php echo $text_search; ?>" class="form-control input-lg" />
  <select name="category_id" class="form-control innner-search">
	<option value="0"><?php echo $text_category; ?></option>
	<?php foreach ($categories as $category_1) { ?>
		<?php if ($category_1['category_id'] == $category_id) { ?>
			<option value="<?php echo $category_1['category_id']; ?>" selected="selected"><?php echo $category_1['name']; ?></option>
		<?php } else { ?>
			<option value="<?php echo $category_1['category_id']; ?>"><?php echo $category_1['name']; ?></option>
		<?php } ?>
		<?php foreach ($category_1['children'] as $category_2) { ?>
			<?php if ($category_2['category_id'] == $category_id) { ?>
				<option value="<?php echo $category_2['category_id']; ?>" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_2['name']; ?></option>
			<?php } else { ?>
				<option value="<?php echo $category_2['category_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_2['name']; ?></option>
			<?php } ?>
			<?php foreach ($category_2['children'] as $category_3) { ?>
				<?php if ($category_3['category_id'] == $category_id) { ?>
					<option value="<?php echo $category_3['category_id']; ?>" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_3['name']; ?></option>
				<?php } else { ?>
					<option value="<?php echo $category_3['category_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_3['name']; ?></option>
				<?php } ?>
			<?php } ?>
		<?php } ?>
	<?php } ?>
  </select>
  <span class="input-group-btn">
    <button type="button" class="btn btn-default btn-lg header-search-btn"><i class="fa fa-search"></i>
	<?php echo $text_search;?>
	</button>
  </span>
</div>



<script type="text/javascript">
$('#header-search button.header-search-btn').bind('click', function() {
	url = 'index.php?route=product/search';
	
	var search = $('#header-search input[name=\'search\']').prop('value');

	if (search) {
		url += '&search=' + encodeURIComponent(search);
	}

	var category_id = $('#header-search select[name=\'category_id\']').prop('value');

	if (category_id > 0) {
		url += '&category_id=' + encodeURIComponent(category_id);
	}
	
		url += '&sub_category=true';
		url += '&description=true';

//alert (url);
	location = url;
});

$('#header-search input[name=\'search\']').bind('keydown', function(e) {
	if (e.keyCode == 13) {
		$('#header-search button.header-search-btn').trigger('click');
	}
});

</script>