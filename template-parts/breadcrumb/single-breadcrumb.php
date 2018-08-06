<?php
/**
 * Single Breadcrumb file
 */

if ( function_exists( 'bcn_display' ) ) :
?>

<div class="event-breadcrumb single">
    <div class="container">
        <div class="row">
            <div class="breadcrumb-content col-md-12">
                <div class="breadcrumb-wrapper">
                    <?php bcn_display(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
endif;