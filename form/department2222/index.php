<?php include('../../controllers/head.php'); ?> 
<?php include('../../controllers/menu_left.php'); ?>

<div class="content-wrapper">
<div class="content-header">
<div class="container-fluid">

<div class="row">
<div class="col-sm-6">
    <div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">ຟອມບັນທຶກກົມກອງ</h3>
    </div>
    <form id="formUser" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="d_name">ກົມກອງ</label>
                <input type="hidden" id="d_id" name="d_id">
                <input type="text" class="form-control" name="d_name" id="d_name" placeholder="ກະລຸນາປ້ອນຊື່ກົມກອງ">
            </div>
        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary"><i class="ion-android-add"></i> ບັນທຶກ</button>
            <button type="reset" class="btn btn-danger"><i class="ion-android-refresh"></i> ຍົກເລີກ</button>
        </div>
    </form>
    </div>
</div>

<div class="col-sm-6">

    <div id="userTable"></div>
    



</div>

</div>
</div>
</div>

<?php include('../../controllers/footer.php'); ?>

<script>
function loadUsers() {
    $.get('fetch.php', function(data) {
        $('#userTable').html(data);
        
        // เรียก DataTable หลังโหลด HTML เสร็จ
        $('#example1').DataTable({
            responsive: true,
            language: {
                search: "ຄົ້ນຫາ:",
                lengthMenu: "ສະແດງ _MENU_ ແຖວ",
                info: "ສະແດງ _START_ ເຖິງ _END_ ຈາກ _TOTAL_ ແຖວ",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "ຖັດໄປ",
                    previous: "ກ່ອນໜ້າ"
                }
            }
        });
    });
}


loadUsers();

$('#formUser').on('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'insert.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
            Swal.fire({
                icon: response.status || 'success',
                title: 'แจ้งเตือน',
                text: response.message || 'บันทึกข้อมูลเรียบร้อย',
                timer: 2000,
                showConfirmButton: false
            });
            $('#formUser')[0].reset();
            $('#d_id').val('');
            loadUsers();
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: 'ไม่สามารถบันทึกข้อมูลได้',
            });
        }
    });
});

function editUser(d_id) {
    $.ajax({
        url: 'fetch.php',
        type: 'GET',
        data: { d_id: d_id },
        dataType: 'json',
        success: function(department) {
            $('#d_id').val(department.d_id);
            $('#d_name').val(department.d_name);
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: 'โหลดข้อมูลไม่สำเร็จ'
            });
        }
    });
}

function deleteUser(d_id) {
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่?',
        text: "คุณต้องการลบข้อมูลนี้ใช่หรือไม่",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'ใช่, ลบเลย!',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post('delete.php', { d_id: d_id }, function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'ลบสำเร็จ',
                    text: response,
                    timer: 2000,
                    showConfirmButton: false
                });
                loadUsers();
            }).fail(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: 'ไม่สามารถลบข้อมูลได้'
                });
            });
        }
    });
}
</script>
