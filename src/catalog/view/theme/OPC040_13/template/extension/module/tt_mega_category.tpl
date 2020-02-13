<div class="main-category-list left-main-menu">
<div class="TT-panel-heading"><?php echo $heading_title; ?></div>
<div class="menu-category">
<ul class="dropmenu">
  <?php foreach ($categories as $category) { ?>
  <?php if(count($category['children'])> 0){ ?>
  <li class="TT-Sub-List dropdown">
	<a href="<?php echo $category['href']; ?>" class="TT-Category-List"><?php echo $category['name'];?></a>
	<span class="active_menu"></span>	 					
  <?php }
   else { ?>
  <li>
	<a href="<?php echo $category['href']; ?>"><?php echo $category['name'];?></a> 	
  <?php } ?>
	<?php for ($i = 0; $i < count($category['children']); $i++) {
	
			//echo "i=".count($category['children']);
	 ?>
	<div class="dropdown-menu">
	<div class="dropdown-inner">

		<?php if($category['column']<=1) { ?>
		 <ul class="list-unstyled childs_1 single-dropdown-menu">
		<?php } else {?>
		 <ul class="list-unstyled childs_1 mega-dropdown-menu columns-<?php echo $category['column']; ?>" style="width: <?php echo 160*$category['column'].'px;'; ?>">
		<?php } ?>
		 	 <?php $j = $i + ceil(count($category['children']) / $category['column']); ?>
			 <?php for (; $i < count($category['children']); $i++) { ?>
          <?php if (isset($category['children'][$i])) { ?>

					<?php if($category['column']<=1) { ?>
						<li class="dropdown" style="width: 100%;">
					<?php } else {
								$cols=$category['column'];
								//echo $cols;
								if($cols % 3 == 0){ ?>
								<li class="dropdown" style="width: <?php echo 100/$category['column'].'%;'; ?>">
																		
								<?php } //if over..
			
					
					 ?>
						<li class="dropdown first" style="width: <?php echo 100/$category['column'].'%;'; ?>">
					<?php } ?>

					<?php if(count($category['children'][$i]['children_level2'])>0){ ?>
						<a href="<?php echo $category['children'][$i]['href']; ?>" class="single-dropdown"><?php echo $category['children'][$i]['name'];?></a> 									
					<?php } else { ?>				
						<a href="<?php echo $category['children'][$i]['href']; ?>"><?php echo $category['children'][$i]['name']; ?></a>					
					<?php } ?>
					
					<?php if ($category['children'][$i]['children_level2']) { ?>
					<?php /*?><div class="SubCatMenu" id="id_menu_<?php echo $category['children'][$i]['id']; ?>"><?php */?>
					
					<div class="dropdown-menu">
					<div class="dropdown-inner">
					<ul class="list-unstyled childs_2">
					<?php for ($wi = 0; $wi < count($category['children'][$i]['children_level2']); $wi++) { ?>
						<li><a href="<?php echo $category['children'][$i]['children_level2'][$wi]['href']; ?>">
						<?php echo $category['children'][$i]['children_level2'][$wi]['name']; ?></a>
						</li>
					 <?php } ?>
					</ul>
					</div>
					</div>
					<?php /*?>
					</div>
					<?php */?>
				  <?php } ?>		  
				</li>		
	      <?php } ?>
          <?php } ?>
		 </ul>
		 </div>
		 </div>
	<?php } ?>
  </li>
  <?php } ?>
 </ul>
</div>
</div>