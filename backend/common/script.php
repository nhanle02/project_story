<?php if($script == 1) {?>
    <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="./assets/vendor/jquery/jquery.js"></script>
<?php }?>

<?php if($script == 2) {?>
    <script src="<?php assets('project_story/assets/vendor/jquery/jquery.js');?>"></script>
    <script src="<?php assets('project_story/assets/vendor/bootstrap/js/bootstrap.bundle.min.js');?>" crossorigin="anonymous"></script>
    <script src="<?php assets('project_story/assets/backend/js/scripts.js');?>"></script>
    <script src="<?php assets('project_story/assets/vendor/jquery/Chart.min.js');?>" crossorigin="anonymous"></script>
    <script src="<?php assets('project_story/assets/backend/js/chart-area-demo.js');?>"></script>
    <script src="<?php assets('project_story/assets/backend/js/chart-bar-demo.js');?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="<?php assets('project_story/assets/backend/js/datatables-simple-demo.js');?>"></script>
    <script>
        $(function() {
            $('.item').click(function() {
                $('.box').fadeToggle(1);
            });
            
            $('.layout1').click(function() {
                $('.layout-nav1').fadeToggle(1);
            });
            
            $('.layout4').click(function() {
                $('.layout-nav4').fadeToggle(1);
            });
            $('.layout5').click(function() {
                $('.layout-nav5').fadeToggle(1);
            });
        });
    </script>
<?php }?>