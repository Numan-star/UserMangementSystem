<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <title>Ajax Crud</title>
</head>

<body>
    <div class="bg-danger border">
        <h1 class="p-1 pl-5 text-white">Ajax Crud Application</h1>
    </div>

    <div class="container my-4  d-flex justify-content-between">
        <h2>Car Model</h2>
        <a href="javascript:void(0);" onclick="showModal();">
            <button class="btn btn-lg btn-primary">Create</button>
        </a>
    </div>

    <div class="container mt-5">
        <table class="table table-striped" id="carModelList">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Color</th>
                    <th scope="col">Transmission</th>
                    <th scope="col">Price</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($rows)) {
                    // $i = 1;
                    foreach ($rows as $row) {
                        // $data['i'] = $i;
                        $data['row'] = $row;
                        $this->load->view("car_model/car_row.php", $data);
                    }
                } else {
                ?>
                    <tr>
                        <td colspan="8" class="text-center">No Records exist in the Database</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">Create</h5>
                </div>
                <div id="response">

                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="ajaxResponseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
                </div>
                <div id="ajaxResponse">
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                </div>
                <div id="ajaxResponse">
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">No</button>
                        <button type="button" onclick="deleteNow();" class="btn btn-sm btn-danger" data-dismiss="modal">Yes</button>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>


    <script type="text/javascript">
        function showModal() {
            $("#createModal").modal("show");
            $("#createModal #title").html("Create");

            $.ajax({
                url: '<?php echo base_url() . 'CarModel/showCreateForm' ?>',
                type: 'POST',
                data: {},
                dataType: 'json',
                success: function(response) {
                    $("#response").html(response['html']);
                }
            })
        }

        $("body").on("submit", "#createCarModel", function(e) {
            e.preventDefault();

            $.ajax({

                url: '<?php echo base_url() . 'CarModel/saveModel' ?>',
                type: 'POST',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {

                    if (response['status'] == 0) {
                        if (response['name'] != "") {
                            $(".nameError").html(response["name"]).addClass('invalid-feedback d-block');
                            $('#name').addClass('is-invalid');
                        } else {
                            $(".nameError").html("").removeClass('invalid-feedback d-block');
                            $('#name').removeClass('is-invalid');
                        }

                        if (response['color'] != "") {
                            $(".colorError").html(response["color"]).addClass('invalid-feedback d-block');
                            $('#color').addClass('is-invalid');
                        } else {
                            $(".colorError").html("").removeClass('invalid-feedback d-block');
                            $('#color').removeClass('is-invalid');
                        }

                        if (response['price'] != "") {
                            $(".priceError").html(response["price"]).addClass('invalid-feedback d-block');
                            $('#price').addClass('is-invalid');
                        } else {
                            $(".priceError").html("").removeClass('invalid-feedback d-block');
                            $('#price').removeClass('is-invalid');
                        }
                    } else {
                        $("#createModal").modal("hide");
                        $("#ajaxResponseModal .modal-body").html(response['message']);
                        $("#ajaxResponseModal").modal("show");

                        $('.nameError').html("").removeClass('invalid-feedback d-block');
                        $('#name').removeClass('is-invalid');

                        $('.colorError').html("").removeClass('invalid-feedback d-block');
                        $('#color').removeClass('is-invalid');

                        $('.priceError').html("").removeClass('invalid-feedback d-block');
                        $('#price').removeClass('is-invalid');

                        $("#carModelList").append(response["row"]);
                    }
                }
            });
        });

        function showEditForm(id) {
            $("#createModal .modal-title").html('Edit');
            $.ajax({

                url: '<?php echo base_url() . 'CarModel/getCarModel/' ?>' + id,
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    $("#createModal #response").html(response['html']);
                    $("#createModal").modal('show');
                }
            });
        }

        $("body").on("submit", "#editCarModel", function(e) {
            e.preventDefault();

            $.ajax({

                url: '<?php echo base_url() . 'CarModel/updateModel' ?>',
                type: 'POST',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response['status'] == 0) {
                        if (response['name'] != "") {
                            $(".nameError").html(response["name"]).addClass('invalid-feedback d-block');
                            $('#name').addClass('is-invalid');
                        } else {
                            $(".nameError").html("").removeClass('invalid-feedback d-block');
                            $('#name').removeClass('is-invalid');
                        }

                        if (response['color'] != "") {
                            $(".colorError").html(response["color"]).addClass('invalid-feedback d-block');
                            $('#color').addClass('is-invalid');
                        } else {
                            $(".colorError").html("").removeClass('invalid-feedback d-block');
                            $('#color').removeClass('is-invalid');
                        }

                        if (response['price'] != "") {
                            $(".priceError").html(response["price"]).addClass('invalid-feedback d-block');
                            $('#price').addClass('is-invalid');
                        } else {
                            $(".priceError").html("").removeClass('invalid-feedback d-block');
                            $('#price').removeClass('is-invalid');
                        }
                    } else {
                        $("#createModal").modal("hide");
                        $("#ajaxResponseModal .modal-body").html(response['message']);
                        $("#ajaxResponseModal").modal("show");

                        $('.nameError').html("").removeClass('invalid-feedback d-block');
                        $('#name').removeClass('is-invalid');

                        $('.colorError').html("").removeClass('invalid-feedback d-block');
                        $('#color').removeClass('is-invalid');

                        $('.priceError').html("").removeClass('invalid-feedback d-block');
                        $('#price').removeClass('is-invalid');

                        var id = response['row']['id'];
                        $("#row-" + id + " .modelName").html(response['row']['name']);
                        $("#row-" + id + " .modelColor").html(response['row']['color']);
                        $("#row-" + id + " .modelTransmission").html(response['row']['transmission']);
                        $("#row-" + id + " .modelPrice").html(response['row']['price']);
                    }
                }
            });
        });

        function confirmDeleteModel(id) {
            $("#deleteModal").modal("show");
            $("#deleteModal .modal-body").html("Are you sure you want to deleted # " + id + "?");
            $("#deleteModal").data("id", id);
        }

        function deleteNow() {
            var id = $('#deleteModal').data('id');
            $.ajax({

                url: '<?php echo base_url() . 'CarModel/deleteModel/' ?>' + id,
                type: 'POST',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response['status'] == 1) {
                        $("#deleteModal").modal("hide");
                        $("#ajaxResponseModal .modal-body").html(response['msg']);
                        $("#ajaxResponseModal").modal('show');
                    } else {
                        $("#deleteModal").modal("hide");
                        $("#ajaxResponseModal .modal-body").html(response['msg']);
                        $("#ajaxResponseModal").modal('show');
                    }
                }
            });
        }
    </script>
</body>

</html>