<div class="panel panel-default category-treeview">
<div class="panel-heading"><?php echo $heading_title; ?></div>
<ul class="list-group">
<?php foreach ($categories as $category) { ?>
  <?php if ($category['category_id'] == $category_id) { ?>
	  <li class="category-li category-active">
		<a href="<?php echo $category['href']; ?>" class="list-group-item active"><?php echo $category['name']; ?></a>
		<?php if ($category['children']) { ?>
		<ul>
		  <?php foreach ($category['children'] as $child) { ?>
		  <?php if ($child['category_id'] == $child_id) { ?>
			  <li><a href="<?php echo $child['href']; ?>" class="list-group-item current-child-item active"><?php echo $child['name']; ?></a></li>
		  <?php } else { ?>
			  <li><a href="<?php echo $child['href']; ?>" class="list-group-item current-child-item"><?php echo $child['name']; ?></a></li>
		  <?php } ?>
		  <?php } ?>
	  </ul>
	  <?php } ?>
	  </li>

  <?php } else { ?>
	  <li class="category-li">
		<a href="<?php echo $category['href']; ?>" class="list-group-item"><?php echo $category['name']; ?></a>
		<!-- Display all category - child items list -->
	  	<?php if ($category['children']) { ?>
		<ul>
			<?php foreach ($category['children'] as $child) { ?>
				<li><a href="<?php echo $child['href']; ?>" class="list-group-item child-item"><?php echo $child['name']; ?></a></li>
			<?php } ?>
		</ul>
		<?php } ?>
	  </li>
  <?php } ?>
<?php } ?>
</ul>
</div>