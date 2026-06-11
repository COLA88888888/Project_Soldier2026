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
