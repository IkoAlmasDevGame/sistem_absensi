<?php require_once("../../../config/config.php"); ?>
<script src="<?=baseurl('dist/vendor/apexcharts/apexcharts.min.js')?>"></script>
<script src="<?=baseurl('dist/vendor/chart.js/chart.umd.js')?>"></script>
<script src="<?=baseurl('dist/vendor/echarts/echarts.min.js')?>"></script>
<script src="<?=baseurl('dist/vendor/quill/quill.js')?>"></script>
<script src="<?=baseurl('dist/vendor/simple-datatables/simple-datatables.js')?>"></script>
<script src="<?=baseurl('dist/vendor/tinymce/tinymce.min.js')?>"></script>
<script src="<?=baseurl('dist/vendor/php-email-form/validate.js')?>"></script>
<script src="<?=baseurl('dist/js/main.js')?>"></script>

<!-- Template Main JS File -->
<script crossorigin="anonymous" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>
<script crossorigin="anonymous" src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js">
</script>
<script crossorigin="anonymous" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script crossorigin="anonymous" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script crossorigin="anonymous" src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script lang="javascript" crossorigin="anonymous">
/* Settings DataTables */
new DataTable('#example1', {
        search: {
            return: false,
        },
    },
    $(document).ready(function() {
        $('#example1_filter').hide(true)
    }),
);

new DataTable('#example2', {
    search: {
        return: false,
    },
});

function previewImage(input) {
    const file = input.files[0];
    if (file) {
        const preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(file);
        preview.onload = function() {
            URL.revokeObjectURL(preview.src); // Free memory
        };
    }
}
</script>
</body>

</html>