<div class="panel panel-default store-list">
  <div class="panel-heading"><?php echo $heading_title; ?></div>
  <div class="store-tags">
  <p><?php echo $text_store; ?></p>
  <?php foreach ($stores as $store) { ?>
  <?php if ($store['store_id'] == $store_id) { ?>
  <a href="<?php echo $store['url']; ?>" title="<?php echo $store['name']; ?>" class="active-store"><i class="fa fa-check-circle"></i><?php echo $store['name']; ?></a>
  <?php } else { ?>
  <a href="<?php echo $store['url']; ?>" title="<?php echo $store['name']; ?>"><?php echo $store['name']; ?></a>
  <?php } ?>
  <?php } ?>
  </div>
</div>
