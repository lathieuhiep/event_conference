<?php
/**
 * Breadcrumb file
 */

if ( function_exists( 'bcn_display' ) ) :
?>

<div class="event-breadcrumb">
    <div class="container">
        <div class="breadcrumb-wrapper">
            <div class="breadcrumb-wrapper-content">
                <?php bcn_display(); ?>
            </div>
        </div>
    </div>
</div>

<?php
endif;