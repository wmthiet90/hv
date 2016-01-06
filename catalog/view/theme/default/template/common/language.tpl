<?php if (count($languages) > 1) { ?>
<div class="pull-left">
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="language">
  <ul class="list-unstyled">
      <?php foreach ($languages as $language) { ?>
        <?php if ($language['code'] != $code) { ?>
        <li>
          <a href="<?php echo $language['code']; ?>">
            <?php echo $language['name']; ?>
          </a>
        </li>
        <?php } ?>
      <?php } ?>
    </ul>
  <input type="hidden" name="code" value="" />
  <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
</form>
</div>
<?php } ?>
