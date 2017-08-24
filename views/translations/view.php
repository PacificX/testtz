<h2><?php echo $title ?></h2> 

<?php foreach ($response as $translations_item): ?> 

<h3><?php echo $translations_item['id'] ?></h3> 
<div class="main"> 
<?php echo $translations_item['name'] ?> 
</div> 


<?php endforeach; ?>