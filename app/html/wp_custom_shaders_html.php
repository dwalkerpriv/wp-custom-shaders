<?php
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) { die; } ?>
<div id=<?php echo PLUGIN_ID_NAME . "_app"?>>
    <div class=<?php echo PLUGIN_SLUG_NAME . "-container"?>>
        <canvas id=<?php echo PLUGIN_SLUG_NAME . "-canvas";?>></canvas>
    </div>
</div>
<?php