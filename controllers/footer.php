<footer class="main-footer">
    <strong>ຫ້ອງການກົມໃຫຍ່ການເມືອງ</strong>

    <div class="float-right d-none d-sm-inline-block">

    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery (loaded once in head.php) -->
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.js"></script>
<!-- DataTables & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Select2 -->
<script src="../../select2/select2.min.js"></script>
<style>
  .table-responsive {
    min-height: 300px !important;
  }
</style>
</body>
</html>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": false,
      "scrollX": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["colvis"],
      "language": {
        "decimal": "",
        "emptyTable": "ບໍ່ມີຂໍ້ມູນ",
        "info": "ສະແດງ _START_ ຫາ _END_ ຈາກ _TOTAL_ ແຖວ",
        "infoEmpty": "ສະແດງ 0 ຫາ 0 ຈາກ 0 ແຖວ",
        "infoFiltered": "(ຄັດຈາກ _MAX_ ແຖວທັງໝົດ)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "ສະແດງ _MENU_ ແຖວ",
        "loadingRecords": "ກຳລັງໂຫຼດ...",
        "processing": "ກຳລັງປະມວນຜົນ...",
        "search": "ຄົ້ນຫາ:",
        "zeroRecords": "ບໍ່ພົບຂໍ້ມູນທີ່ຄົ້ນຫາ",
        "paginate": {
          "first": "ໜ້າທຳອິດ",
          "last": "ໜ້າສຸດທ້າຍ",
          "next": "ຖັດໄປ",
          "previous": "ກັບຄືນ"
        },
        "aria": {
          "sortAscending": ": ກົດເພື່ອຈັດລຽງໂຕໃນທິດທາງຂຶ້ນ",
          "sortDescending": ": ກົດເພື່ອຈັດລຽງໂຕໃນທິດທາງລົງ"
        }
      }
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    // Fix dropdown cut off in responsive tables by detaching and appending to body
    $(document).on('show.bs.dropdown', '.table-responsive .btn-group, .table-responsive .dropdown', function (e) {
      var $btnGroup = $(this);
      var $menu = $btnGroup.find('.dropdown-menu');
      
      // Store original parent
      $menu.data('original-parent', $btnGroup);
      
      var buttonHeight = $btnGroup.outerHeight();
      var menuHeight = $menu.outerHeight();
      if (menuHeight === 0) {
        $menu.css({
          position: 'absolute',
          visibility: 'hidden',
          display: 'block'
        });
        menuHeight = $menu.outerHeight();
        $menu.css({
          position: '',
          visibility: '',
          display: ''
        });
      }
      
      var offset = $btnGroup.offset();
      var windowHeight = $(window).height();
      var scrollTop = $(window).scrollTop();
      
      // Calculate space below button relative to window viewport
      var spaceBelow = windowHeight - (offset.top - scrollTop + buttonHeight);
      
      var top;
      var left = offset.left;
      
      // Check if it's right-aligned
      if ($menu.hasClass('dropdown-menu-right')) {
        left = left + $btnGroup.outerWidth() - $menu.outerWidth();
      }
      
      // Determine placement: up or down
      if (spaceBelow < menuHeight + 10 && (offset.top - scrollTop) > menuHeight + 10) {
        // Open upwards (dropup)
        top = offset.top - menuHeight;
        $btnGroup.addClass('dropup');
      } else {
        // Open downwards (dropdown)
        top = offset.top + buttonHeight;
        $btnGroup.removeClass('dropup');
      }
      
      // Detach and append to body
      $menu.detach().appendTo('body').css({
        position: 'absolute',
        top: top + 'px',
        left: left + 'px',
        right: 'auto',
        bottom: 'auto',
        display: 'block'
      });
    });

    $(document).on('hidden.bs.dropdown', '.table-responsive .btn-group, .table-responsive .dropdown', function () {
      var $btnGroup = $(this);
      var $menu = $('body').children('.dropdown-menu').filter(function() {
        return $(this).data('original-parent') && $(this).data('original-parent')[0] === $btnGroup[0];
      });
      
      if ($menu.length > 0) {
        $menu.detach().appendTo($btnGroup).css({
          position: '',
          top: '',
          left: '',
          right: '',
          bottom: '',
          display: ''
        });
      }
      $btnGroup.removeClass('dropup');
    });
  });
</script>



<script>
$(function(){
$('.delete').on ('click',function(e){
e.preventDefault();
const href=$(this).attr('href')
Swal.fire({
title: 'ຍິນດີຕ້ອນຮັບ',
text: "ທ່ານຕ້ອງການລົບ ຫຼື ບໍ່",
icon:'error',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonColor: 'ok',
}).then((result)=>{
if(result.value){
document.location.href = href;
};
});
});
});
</script>

<script>
$(function(){
$('.edit').on ('click',function(e){ //ເວລາເຮົາກົດປຸ່ມແກ້ໄຂ ແລ້ວໃຫ້ມັນທ້ວງຂື້ນມາວ່າ: ທ່ານ ຕ້ອງການແກ້ໄຂ ຫຼື ບໍ່?
e.preventDefault();
const href=$(this).attr('href');
Swal.fire({
title: 'ຍີນດີຕ້ອນຮັບ',
text: "ທ່ານຕ້ອງການແກ້ໄຂຂໍ້ມູນ ຫຼື ບໍ່?",
icon: 'info',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonColor: 'OK',
}).then((result)=>{
if(result.value){
document.location.href = href;
};
});
});
});
</script>

<script>
$(function(){
$('.logout').on ('click',function(e){ //ເວລາເຮົາກົດປຸ່ມແກ້ໄຂ ແລ້ວໃຫ້ມັນທ້ວງຂື້ນມາວ່າ: ທ່ານ ຕ້ອງການແກ້ໄຂ ຫຼື ບໍ່?
e.preventDefault();
const href=$(this).attr('href');
Swal.fire({
title: 'ອອກຈາກລະບົບ',
text: "ທ່ານຕ້ອງການອອກຈາກລະບົບ ຫຼື ບໍ່?",
icon: 'info',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonColor: 'OK',
}).then((result)=>{
if(result.value){
document.location.href = href;
};
});
});
});
</script>
