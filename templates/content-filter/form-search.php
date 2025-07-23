<?php

//Extract Shortcode
extract($atts);
wp_enqueue_script( 'jquery-ui-datepicker' );
wp_enqueue_style( 'jquery-ui', '//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css' );
$suggestionsArr = explode(',',$suggestions);
$suggestionTop = array();
foreach ($suggestionsArr as $key => $val) {
  if($val == '') continue;
  $suggestionTop[] = $val;
}
$filters = !empty($filters) ? explode(',',$filters) : '';
$types = !empty($types) ? explode(',',$types) : '';
$topics = !empty($topics) ? explode(',',$topics) : '';
$is_date_filter = false;
$rand_id = rand(1000,99999);
$keys = "";
foreach ($suggestionsArr as $key => $val) {
  $keys .= trim($val);
  $keys .= (($key + 1) < count($suggestionsArr)) ? ',':'';
}

//Types
if(isset($_GET['type']) && $_GET['type'] != ''){
  $types = explode(',',$_GET['type']);
}

//Topic
if(isset($_GET['topic']) && $_GET['topic'] != ''){
  $topics = explode(',',$_GET['topic']);
}

//start date
$start_date = '';
if(isset($_GET['start_date']) && $_GET['start_date'] != ''){
  $start_date = $_GET['start_date'];
}

//end date
$end_date = '';
if(isset($_GET['end_date']) && $_GET['end_date'] != ''){
  $end_date = $_GET['end_date'];
}else{
  $end_date = date('m-Y',time());
}

?>
<div id="content_filter_<?php echo $rand_id; ?> "
  class="ica-content-filter"
  data-ajax="<?php echo $ajax; ?>"
  data-keys="<?php echo esc_attr($keys) ?>"
  data-post="<?php echo $post_type; ?>"
  data-numberposts="<?php echo $numberposts; ?>"
  data-orderby="<?php echo $orderby; ?>"
  data-order="<?php echo $order; ?>"
  data-pagination="<?php echo $pagination ?>"
  data-showcontent="<?php echo $showcontent; ?>"
  data-template="<?php echo $template; ?>"
  data-sortby="<?php echo $sortby; ?>"
  data-cat_faq="<?php echo $cats_faq; ?>"
  data-ex_cat_faq="<?php echo $ex_cats_faq; ?>"
  data-post2="<?php echo $post_type2?>"
  data-files2 ="<?php echo $showfilter2 ?>"
  data-numberposts2 ="<?php echo $numberposts2 ?>"
  data-template2 ="<?php echo $template2 ?>"
  data-orderby2 ="<?php echo $orderby2 ?>"
  data-order2 ="<?php echo $order2 ?>"
  data-select_team ="<?php echo $select_team; ?>">
    <div class="wrrap-content-filter">
      <div class="form-content-filter">
         <input type="text" class="typeahead" name="key" value="<?php echo isset($_GET['key']) ? stripslashes($_GET['key']) : ''; ?>" placeholder="<?php echo $atts['placeholder']; ?>" autocomplete="off" required>
         <button class="btn-removeall" data-ajax="<?php echo $ajax; ?>" required="false"><i class="fa fa-times"></i></button>
         <button type="submit" data-ajax="<?php echo $ajax; ?>" <?php echo (!$ajax) ? 'data-redirect="'.$action.'"' : ''; ?>><i class="fa fa-search"></i></button>
      </div>
      <div class="log-error"></div>
      <div class="template-filter-form">
          <div class="__filter-suggestion">
            <?php if(!empty($suggestionTop)): ?>
              <div class="load-suggestion">
                <?php echo __('Suggestions:','bearsthemes-addons') ?>
                <div class="list-suggestions">
                  <?php foreach ($suggestionTop as $key => $suggestion): ?>
                    <span class="btn-suggestion" data-value="<?php echo $suggestion; ?>"><?php echo $suggestion; ?></span><?php echo (($key+1) < count($suggestionTop)) ? ',' : ''; ?>
                  <?php endforeach; ?>
                </div>
              </div>
            <?php endif; ?>
            <?php if(!empty($filters)): ?>
              <div class="btn-filter <?php echo ($default_filter) ? '__is-actived' : ''; ?>">
                <i class="fa fa-caret-right" aria-hidden="true"></i>
                <?php echo __('Filters','bearsthemes-addons') ?>
              </div>
            <?php endif; ?>
          </div>
          <?php if(!empty($filters)): ?>
            <div class="__filter-options <?php echo ($default_filter) ? '__is-actived' : ''; ?>">
              <div class="wrap-options">
                <?php foreach ($filters as $key => $filter): ?>
                  <?php if($filter != 'date'){
                            $taxonomy = get_taxonomy($filter);
                            $terms = get_terms( array(
                              'taxonomy' => $filter,
                              'hide_empty' => false,
                            ) );
                    if(!empty($terms)):
                      $checkdata = ($filter == 'ins-type') ? $types : $topics;
                      ?>
                      <div class="ica-item-filter" data-filter="<?php echo $filter ?>">
                          <div class="name-filter">
                            <?php echo __('Filter by','bearsthemes-addons'); ?> <?php echo $taxonomy->label; ?>
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                          </div>
                          <div class="select-filter">
                              <span class="btn-select-all"><?php echo __('Select all','bearsthemes-addons') ?></span>
                              <?php foreach ($terms as $key => $term) {
                                  $count_posts = $term->count ?? 0;
                                  ?>
                                  <label class="checkbox-container"><?php echo $term->name; ?> (<?php echo $count_posts; ?>)
                                    <input type="checkbox"
                                           name="<?php echo $taxonomy->name ?>"
                                           value="<?php echo $term->slug ?>"
                                           <?php echo (in_array($term->slug, (array)$checkdata)) ? 'checked' : ''; ?>
                                           >
                                    <span class="checkmark"></span>
                                  </label>
                                  <?php
                              } ?>
                              <span class="btn-deselect-all"><?php echo __('Deselect all','bearsthemes-addons') ?></span>
                          </div>
                      </div>
                      <?php
                    endif;
                  } ?>
                  <?php $is_date_filter = ($filter == 'date') ? true : false; ?>
                  <?php endforeach; ?>
                  <?php if($is_date_filter){
                    $years = date('Y',current_time( 'timestamp', 1 ));
                    ?>
                    <div class="ica-item-filter select-date-range" data-filter="date">
                      <div class="__date-options">
                        <span class="__label"><?php echo __('Select date range','bearsthemes-addons') ?></span>
                        <div class="__select-options">
                          <div class="select-date-start">
                            <input placeholder="Select start date" value="<?php echo $start_date; ?>" autocomplete="off" type="text" name="date-range-start" class="datepicker date-range-start" id="date-range-start">
                          </div>
                          <div class="select-date-end">
                            <input placeholder="Select end date" value="<?php echo $end_date; ?>" type="text" autocomplete="off" name="date-range-end" class="datepicker date-range-end" id="date-range-end">
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
              </div>
              <div class="bt-actions">
                <button class="btn-clearall" data-filter data-ajax="<?php echo $ajax; ?>"><i class="fa fa-times" aria-hidden="true"></i> <?php echo __('Clear filters','bearsthemes-addons'); ?></button>
                <button class="btn-applyfilter" data-filter data-ajax="<?php echo $ajax; ?>" <?php echo (!$ajax) ? 'data-redirect="'.$action.'"' : ''; ?>><?php echo __('Apply filters','bearsthemes-addons'); ?></button>
              </div>
            </div>
          <?php endif; ?>
      </div>
    </div>
    <?php if ($ajax == true): ?>
      <div class="content-filter-results"></div>
      <?php if ($showfilter2 == 'yes'): ?>
          <div class="content-filter-results2"></div>
      <?php endif; ?>
    <?php endif; ?>
</div>
<?php
