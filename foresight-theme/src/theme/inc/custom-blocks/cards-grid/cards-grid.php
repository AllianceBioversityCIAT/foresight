<?php
/**
 * Button block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$fields = acf_get_fields('group_card_grid');

foreach ($fields as $field) {

  if( $field['type'] == 'image' ){
    $field_name = $field['name'];
    $field_value = get_field($field_name);
    $grid[$field_name] = !empty($field_value['ID']) ? wp_get_attachment_image( $field_value['ID'], 'full', '', array( 'class' => 'w-full !h-full absolute top-0 left-0 z-0 object-cover object-top' ) ) : null;
  }else{
    $field_name = $field['name'];
    $grid[$field_name] = get_field($field_name) ?? null;
  } 
}

$classes = '';
if ( ! empty( $block['className'] ) ) {
    $classes = $block['className'];
}

?>
<div class="card-grid <?php echo $classes; ?>">

  <div class="group card-item lg:col-span-2 <?php echo empty($grid['image_one']) ? 'bg-purple' : '';?>">
    <?php echo $grid['image_one'];?>
    <div class="card-body"></div>
    <h4><a class="text-white hover:text-white line-clamp-3" href="<?php echo $grid['link_one']['url'] ?? '';?>"><?php echo !empty($grid['title_one'] ) ? $grid['title_one'] : 'Card One'; ?></a></h4>
    <div class="hidden z-[2] group-hover:block">
      <p class="!m-5 text-white text-[17px] line-clamp-2"><?php echo $grid['subtitle_one'] ?? ''; ?></p>
    </div>
  </div>

  <div class="group card-item <?php echo empty($grid['image_two']) ? 'bg-purple' : '';?>">  
    <?php echo $grid['image_two'];?>
    <div class="card-body"></div>
    <h4><a class="text-white hover:text-white line-clamp-4" href="<?php echo $grid['link_two']['url'] ?? '';?>"><?php echo !empty($grid['title_two'] ) ? $grid['title_two'] : 'Card Two'; ?></a></h4>
    <div class="hidden z-[2] group-hover:block">
      <p class="m-5 text-white text-[17px] line-clamp-4"><?php echo $grid['subtitle_two'] ?? ''; ?></p>
      <a href="<?php echo $grid['link_two']['url'] ?? '';?>" class="flex mt-8 btn-primary-small justify-center items-center">
        <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z"/></svg>
      </a>
    </div>
  </div>

  <div class="group card-item <?php echo empty($grid['image_three']) ? 'bg-purple' : '';?>">
    <?php echo $grid['image_three'] ?? '';?>
    <div class="card-body"></div>
    <h4><a class="text-white hover:text-white line-clamp-4" href="<?php echo $grid['link_three']['url'] ?? '';?>"><?php echo !empty($grid['title_three'] ) ? $grid['title_three'] : 'Card Three'; ?></a></h4>
    <div class="hidden z-[2] group-hover:block">
      <p class="m-5 text-white text-[17px] line-clamp-4"><?php echo $grid['subtitle_three'] ?? ''; ?></p>
      <a href="<?php echo $grid['link_three']['url'] ?? '';?>" class="flex mt-8 btn-primary-small justify-center items-center">
        <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z"/></svg>
      </a>
    </div>
  </div>

  <div class="group card-item <?php echo empty($grid['image_four']) ? 'bg-purple' : '';?>">  
    <?php echo $grid['image_four'] ?? '';?>
    <div class="card-body"></div>
    <h4><a class="text-white hover:text-white line-clamp-4" href="<?php echo $grid['link_four']['url'] ?? '';?>"><?php echo !empty($grid['title_four'] ) ? $grid['title_four'] : 'Card Four'; ?></a></h4>
    <div class="hidden z-[2] group-hover:block">
      <p class="m-5 text-white text-[17px] line-clamp-4"><?php echo $grid['subtitle_four'] ?? ''; ?></p>
      <a href="<?php echo $grid['link_four']['url'] ?? '';?>" class="flex mt-8 btn-primary-small justify-center items-center">
        <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z"/></svg>
      </a>
    </div>
  </div>

  <div class="group card-item <?php echo empty($grid['image_five']) ? 'bg-purple' : '';?>">
    <?php echo $grid['image_five'] ?? '';?>
    <div class="card-body"></div>
    <h4><a class="text-white hover:text-white line-clamp-4" href="<?php echo $grid['link_five']['url'] ?? '';?>"><?php echo !empty($grid['title_five'] ) ? $grid['title_five'] : 'Card Five'; ?></a></h4>
    <div class="hidden z-[2] group-hover:block">
      <p class="m-5 text-white text-[17px] line-clamp-4"><?php echo $grid['subtitle_five'] ?? ''; ?></p>
      <a href="<?php echo $grid['link_five']['url'] ?? '';?>" class="flex mt-8 btn-primary-small justify-center items-center">
        <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z"/></svg>
      </a>
    </div>
  </div>

  

</div>

