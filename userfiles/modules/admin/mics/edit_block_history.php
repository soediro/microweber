<?
 only_admin_access();


$cont_id = false;
if(isset($params['post_id']) and intval($params['post_id']) != 0){
	$cont_id = intval($params['post_id']);
} else if(isset($params['page_id']) and intval($params['page_id']) != 0){
	$cont_id = intval($params['page_id']);
}
$url = url_string(true);

	$history_files = false;

	if($cont_id != false){

		$history_files = get_content_field('order_by=id desc&fields=id,created_on&is_draft=1&all=1&url='.$url);

		$last_saved = get_content_by_id($cont_id);
		//d($last_saved);
		$last_saved_date = $last_saved['updated_on'];
		//d($last_saved_date );
		$latest_drafs = get_content_field('order_by=id desc&fields=id&created_on=[mt]'.$last_saved_date.'&is_draft=1&all=1&url='.$url.'&rel_id='.$cont_id);
		// d($latest_drafs);
	}




?>
<?
if(isset($latest_drafs) and isarr($latest_drafs)){
	//d($latest_drafs);

	$latest_drafs_vals = array_values_recursive($latest_drafs);
	 if(!empty($latest_drafs_vals)) { ?>

        <script  type="text/javascript">


			mw.hasDraft = {

				draft:"<? print implode(',',$latest_drafs_vals); ?>"
			}


        </script>

	 <? }

}
?>
<? if(isarr($history_files)): ?>

<?

$latest_undo_vals = array();
foreach ($history_files as $value) {
	$latest_undo_vals[] =   $value['id'];
} ?>

    <script  type="text/javascript">


			mw.undoHistory = {

				<?  $i = 0 ; foreach ($history_files as $value) :  ?>
				<? print $i ?>:<? print intval($value['id']) ?>,
				<? $i++; endforeach; ?>
				active:0

			}


        </script>




<? // p($history_files); ?>
<small>Saved drafts from:</small>
<ul id="mw_history_files">
  <? 		foreach ($history_files as $item) : ?>
  <li rel="load-draft-<? print ($item['id']) ?>">
    <? //$mtime= filemtime($filename ); ?>
    <?

	//$content_of_file = file_get_contents($filename);	?>
    <a title="Click to Restore" href="javascript: mw.history.load('<? print ($item['id']) ?>')">


    <? print ago($item['created_on'], $granularity = 1); ?> </a> </li>
  <? 		endforeach; ?>
</ul>
<? endif; ?>