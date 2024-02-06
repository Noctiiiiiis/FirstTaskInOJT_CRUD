<?php
session_start();
include('inc/header.php');
 
?>

<style>
    .custom-bg{
    background-color: teal;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
</style>
<!-- insert modal -->
<div class="modal fade" id="insertdata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="insertdataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h1 class="modal-title fs-5" id="insertdataLabel">Insert Data into Database</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="code.php" method="POST">
                <div class="modal-body">

                    <div class="form-group mb-3">
                        <label for="">Name</label> <br>
                        <input type="text" class="contorl-form" name="name" placeholder="enter name">
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Email Address</label> <br>
                        <input type="email" class="contorl-form" name="email" placeholder="enter email">
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Phone Number</label> <br>
                        <input type="number" class="contorl-form" name="phone" placeholder="enter number">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="save_data" class="btn btn-primary">Save Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- insert modal -->


<!-- View Modal -->
<div class="modal fade" id="viewusermodal" tabindex="-1" aria-labelledby="viewusermodalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark text-light">
        <h1 class="modal-title fs-5" id="viewusermodalLabel">User Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="view_user_data">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- View modal -->

<!-- edit modal -->
<div class="modal fade" id="editdata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editdataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h1 class="modal-title fs-5" id="editdataLabel">Edit Data in Database</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="code.php" method="POST">
                <div class="modal-body">

                    <div class="form-group mb-3">
                        
                        <input type="hidden" class="contorl-form" id='user_id' name="id">
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Name</label> <br>
                        <input type="text" class="contorl-form" id='name' name="name" placeholder="enter name">
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Email Address</label> <br>
                        <input type="email" class="contorl-form" id='email' name="email" placeholder="enter email">
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Phone Number</label> <br>
                        <input type="number" class="contorl-form" id='phone' name="phone" placeholder="enter number">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="update_data" class="btn btn-primary">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- edit modal -->



<!-- Main Interface -->

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <?php
            if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                
            ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>SUCCESS!</strong>  <?php echo $_SESSION['status']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php

                unset($_SESSION['status']);
            }
            ?>


            <div class="card">
                <div class="card-header">
                    <h4 class="text-center"> PHP CRUD</h4>
                    
                </div>
                <div class="card-body">
                <table class="table table-striped table-bordered table-danger">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">View</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $connection = mysqli_connect("localhost","root","","crud");

                        $fetch_query = "SELECT * FROM test";
                        $fetch_query_run = mysqli_query($connection,$fetch_query);

                        if(mysqli_num_rows($fetch_query_run)>0) {
                            While($row = mysqli_fetch_array($fetch_query_run)){
                                // echo $row['id'];
                                ?>
                                <tr>
                                    <td class="user_id"><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['phone']; ?></td>
                                    <td>
                                        <a href="#" class="btn btn-info btn-sm view_data"> View Data</a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-success btn-sm edit_data"> Edit</a>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-danger btn-sm delete_btn"> Delete data</a>
                                    </td>
                                    
                                </tr>
                                <?php
                            }
                        }

                        else
                        {
                            ?>
                                <tr colspan="4"> No Record Found</tr>
                            <?php
                        }
                        ?>

                    </tbody>
                </table>

                </div>
            </div>
            <div class="card">
                <button type="button" class="btn custom-bg" data-bs-toggle="modal" data-bs-target="#insertdata">
                        INSERT DATA
                    </button>
            </div>
        </div>
    </div>
</div>




<?php include('inc/footer.php'); ?>

<script>
// view data
$(document).ready(function(){

    $('.view_data').click(function (e) {
        e.preventDefault();

        var user_id = $(this).closest('tr').find('.user_id').text();
        // console.log(user_id);

        $.ajax({
            method: "POST",
            url: "code.php",
            data: {
                'click_view_btn': true,
                'user_id':user_id,
            },

            success:function(response){
                // console.log(response);

                $('.view_user_data').html(response);
                $('#viewusermodal').modal('show');

            }
        })
    });

});

//==========================================================
// edit data

$(document).ready(function(){

$('.edit_data').click(function (e) {
    e.preventDefault();

    var user_id = $(this).closest('tr').find('.user_id').text();
    console.log(user_id);

    $.ajax({
        method: "POST",
        url: "code.php",
        data: {
            'click_edit_btn': true,
            'user_id':user_id,
        },

        success: function (response) {
            $.each(response, function (key, value) {
                // console.log(value['name']);

                $('#user_id').val(value['id']);
                $('#name').val(value['name']);
                $('#email').val(value['email']);
                $('#phone').val(value['phone']);

            });
            
            $('#editdata').modal('show');

        }
    })
});

});
//===============================================================
//delete data

$(document).ready(function(){
    $('.delete_btn').click(function(e){
        e.preventDefault();
        
        // The next line is missing the assignment of user_id
        // $(this).closest('tr').find('.user_id').text();

        // You need to assign the value to user_id
        var user_id = $(this).closest('tr').find('.user_id').text();
        console.log(user_id);

        $.ajax({
            method: "POST",
            url: "code.php",
            data: {
                'click_delete_btn': true,
                'user_id': user_id,
            },
            success:function(response){
                console.log(response)
                window.location.reload();
            }
        })
    })
})



</script>