<?php

if(!isset($items) || empty($items)){
    return false;
}

$item_limit=0;
$filter_collapse=true;

if (isset($collapse)){
    $filter_collapse=$collapse;
}
/*
$filter_id='license';
$filter_name='license';
$filter_total=100;
$filter_use_code=false;


*/

//items format
/*
items=array(
    0=>array(
        'id'=>1,
        'code'=>'code',
        'title'=>'title'
    )
)
*/

//to toggle clear button
$items_checked=false;

?>

<div id="filter-by-<?php echo $filter_id;?>" class="sidebar-filter wb-ihsn-sidebar-filter filter-box filter-by-<?php echo $filter_id;?>">
    
    <!-- Card Header / Toggle -->
    <h6 class="togglable"> 
        <div 
        class="wb-filter-title <?php echo $filter_collapse ? 'collapsed' :'';?>" 
        data-toggle="collapse" 
        href="#facet-<?php echo $filter_id;?>" role="button" aria-expanded="false" aria-controls="facet-<?php echo $filter_id;?>">
            <i class="fa fa-filter pr-2"></i>
            <span class="text-capitalize"><?php echo isset($title) ? t($title) : t('filter_by_'.$filter_id);?></span>
            <span class="float-right" >
            <i class="icon-toggle icon-collapsed float-right fa fa-chevron-down"></i>
            <i class="icon-toggle icon-expanded float-right fa fa-chevron-up"></i>
            </span>
        </div>

        <div class="wb-filter-subtitle clear-button-container clear-disabled" >
            <span><span class="selected-items"></span> <?php echo t('selected');?> <?php /*/<span class="total-items"></span> */?> </span>
            <a class="btn btn-link btn-sm rounded clear lnk-filter-reset">Clear</a>
        </div>
    </h6> 
    
    
    
    <?php if(isset($filter_total) && $filter_total>0):?> 
    <div class="sidebar-filter-index selected-items-count" data-toggle="tooltip" data-placement="top" title="Tooltip for Help"><?php echo $filter_total;?></div>
    <?php endif;?>

    <div id="facet-<?php echo $filter_id;?>" class="sidebar-filter-entries <?php echo $filter_collapse ? 'collapse' :'';?> <?php echo $filter_id;?>-container items-container">        
        <?php if (count($items)>30):?>
        <div class="wb-card-header">       
            <div class="wb-search-control input-group input-group-sm mb-3">
                <input type="text" class="form-control facet-filter-values" placeholder="Filter...">
                <div class="input-group-append">
                    <button class="btn btn-link facet-filter-values-clear" type="button" style="display:none;">
                        <i class="fas fa-times"></i>
                        <!-- <i class="far fa-times-circle"></i> -->
                    </button>
                </div>
            </div>
        </div> 
        <?php endif;?>
        <div class="items-container <?php //echo (count($repositories)>10) ? 'scrollable' : ''; ?>">
            <?php if($items):?>
                <?php $k=0;foreach($items as $item_key=>$item):$k++; ?>
                    <div class="form-check item-<?php echo $filter_id;?> <?php echo $k;?> item inactive">
                        <label class="form-check-label" for="<?php echo $filter_id;?>-<?php echo form_prep($item_key); ?>" <?php echo form_prep($item_key); ?>>
                            <input class="form-check-input chk chk-<?php echo $filter_id;?>" type="checkbox" name="<?php echo $filter_id;?>[]"
                                   value="<?php echo form_prep($item_key); ?>"
                                   data-title="<?php echo form_prep($item['title']);?>"
                                   id="<?php echo $filter_id;?>-<?php echo form_prep($item_key); ?>"
                                <?php if(isset($search_options->{$filter_id}) && is_array($search_options->{$filter_id}) && in_array($item_key,$search_options->{$filter_id})): $items_checked=true;?>
                                    checked="checked"
                                <?php endif;?>>
                                
                                <?php if (isset($item['translated_title'])):?>
                                    <?php echo $item['translated_title']; ?>
                                <?php else:?>
                                    <?php echo $item['title'];?>
                                <?php endif;?>
                                 
                                <?php if(isset($item['found'])):?>
                                    <span class="count">(<?php echo $item['found']; ?>)</span>
                                <?php endif;?>
                        </label>
                    </div>
                <?php endforeach;?>
            <?php endif;?>
        </div>
        
    </div>          
</div>
