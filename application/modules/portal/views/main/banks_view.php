<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?php echo ucfirst($module_name);?>
    <small>Management</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><?php echo ucfirst($module_name);?></li>
    </ol>
</section>
<button class="btn btn-success btn-circle btn-lg fix-btn" id="addBtn"  data-toggle="tooltip" title="Add New">
    <span class="glyphicon glyphicon-plus"></span>
</button>
<!-- Main content -->
<section class="content">
<div class="box" id="main-list">
    <div class="box-header">
        <h3 class="box-title"><?php echo ucfirst($module_name);?> List</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="banksList" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Bank Name</th>
            <th>Bank Code</th>
            <th>Bank Location</th>
            <th>Beneficiary Name</th>
            <th>Status</th>
            <th>Date Created</th>
            <th>Created By</th>
            <th>Date Modified</th>
            <th>Modified By</th>
            <th>Actions</th> 
        </tr>
        </thead>
        <tbody>
        </tbody>
        </table>
    </div>
    <!-- /.box-body -->
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->
</div>

<div class="modal fade" id="banksModal" role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Add Banks</h3>
             <input type="hidden" id="action">
             <input type="hidden" id="banksID">
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="banksForm" data-toggle="validator">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Bank Name</label>

                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" placeholder="Bank Name" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="code" class="col-sm-2 control-label">Bank Code</label>

                                <div class="col-sm-10">
                                
                                <input type="text" class="form-control" id="code" placeholder="Bank Code" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="beneficiary_name" class="col-sm-2 control-label">Beneficiary Name</label>

                                <div class="col-sm-10">
                                
                                <input type="text" class="form-control" id="beneficiary_name" placeholder="Beneficiary Name" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="bank_details" class="col-sm-2 control-label">Bank Details</label>

                                <div class="col-sm-10">
                                
                                <textarea type="text" class="form-control" id="bank_details" placeholder="Bank Details" required></textarea>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="bank_address" class="col-sm-2 control-label">Bank Address</label>

                                <div class="col-sm-10">
                                
                                <textarea type="text" class="form-control" id="bank_address" placeholder="Bank Address" required></textarea>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputStatus" class="col-sm-2 control-label">Status</label>

                                <div class="col-sm-10">
                                <select class="form-control" id="inputStatus" placeholder="Content" style="resize:none" required>
                                    <option value="1">Enable</option>
                                    <option value="0">Disable</option>
                                </select>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div id="uploadBoxMain" class="col-md-12">
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveBanks">Save Banks</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="deleteBanksModal"  role="dialog"  data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Delete Bank</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteKey">
                <center><h4>Are you sure to delete <label id="deleteItem"></label></h4></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteBanks">Delete</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<script>

    var inputRoleConfig = {
        dropdownAutoWidth : true,
        width: 'auto',
        placeholder: "--- Select Item ---"
    };


    var main = function(){
        var table = $('#banksList').DataTable({
            "language": {                
                "infoFiltered": ""
            },  
            'autoWidth'   : true,
            "processing" : true,
            "serverSide" : true, 
            "ajax" : "<?php echo base_url()."portal/banks/get_banks_list";?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            ,"columnDefs": [
            { "visible": false,  "targets": [ 0 ] },
            { "width": "20%",  "targets": [ 1 ] }
        ], "order": [[ 5, 'desc' ]]
        });
        $("#addBtn").click(function(){
            $("#banksModal .modal-title").html("Add <?php echo ucfirst($module_name);?>");
            $("#action").val("add");
            $("#inputCoverImage").attr("required","required");
            $('#banksForm').validator();
            $("#banksModal").modal("show");
        });

        $("#saveBanks").click(function(){
            $("#banksForm").submit();
        });

        var image_correct = true;
        var image_error = "";
        $("#banksForm").validator().on('submit', function (e) {
           
            var btn = $("#saveBanks");
            var action = $("#action").val();
            btn.button("loading");
            if (e.isDefaultPrevented()) {
                btn.button("reset"); 
            } else {
                e.preventDefault();
                var name = $("#name").val();
                var code = $("#code").val();
                var status = $("#inputStatus").val();
                var banks_id = $("#banksID").val();
                var beneficiary_name = $("#beneficiary_name").val();
                var bank_details  = $("#bank_details").val();
                var bank_address  = $("#bank_address").val();
                if(name == "" || code == "")
                {
                    btn.button("reset"); 
                    return false;
                }

                var formData = new FormData();
                formData.append('id', banks_id);
                formData.append('name', name);
                formData.append('code', code);
                formData.append('beneficiary_name', beneficiary_name);
                formData.append('bank_details', bank_details);
                formData.append('address', bank_address);
                formData.append('status', status);
                // Attach file
                 //fromthis    
                 var url = "<?php echo base_url()."portal/banks/add_banks";?>";
                var message = "New banks successfully added";
                if(action == "edit")
                {
                    url =  "<?php echo base_url()."portal/banks/edit_banks";?>";
                    message = "Banks successfully updated";
                }


                $('#uploadBoxMain').html('<div class="progress"><div class="progress-bar progress-bar-aqua" id = "progressBarMain" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%"><span class="sr-only">20% Complete</span></div></div>');
                $.ajax({
                    data: formData,
                    type: "post",
                    processData: false,
                    contentType: false,
                    cache: false,
                    url: url ,
                    xhr: function(){
                        //upload Progress
                        var xhr = $.ajaxSettings.xhr();
                        if (xhr.upload) {
                            xhr.upload.addEventListener('progress', function(event) {
                                var percent = 0;
                                var position = event.loaded || event.position;
                                var total = event.total;
                                if (event.lengthComputable) {
                                    percent = Math.ceil(position / total * 100);
                                }
                                //update progressbar
                                
                                $('#progressBarMain').css('width',percent+'%').html(percent+'%');
                                                                
                            }, true);
                        }
                        return xhr;
                    },
                    mimeType:"multipart/form-data"
                }).done(function(data){ 
                    if(!data)
                    {
                        btn.button("reset");
                        toastr.error(data);
                    }
                    else
                    {
                         //alert("Data Save: " + data);
                         btn.button("reset");
                         if(action == "edit")
                         {
                             table.draw("page");
                         }
                         else
                         {
                             table.draw();
                         }
                         toastr.success(message);
                         $("#banksForm").validator('destroy');
                         $("#banksModal").modal("hide"); 
                         $('#uploadBoxMain').html('');          
                    }
                });
            }
               return false;
        });

        $("#deleteBanks").click(function(){
            var btn = $(this);
            var id = $("#deleteKey").val();
            var deleteItem = $("#deleteItem").html();
            var data = { "id" : id };
            btn.button("loading");

            $.ajax({
                        data: data,
                        type: "post",
                        url: "<?php echo base_url()."portal/banks/delete_banks";?>",
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw("page");
                            $("#deleteBanksModal").modal("hide");
                            toastr.error('Banks ' + deleteItem + ' successfully deleted');
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
        });

        $('#banksModal').on('hidden.bs.modal', function (e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
            $("#inputStatus").val('1').trigger('change');
            $('#inputCoverImage').val("");
            $('#coverImgPrev').attr("src","");
            $("#banksForm").validator('destroy');
        });

        $('#inputStatus').select2(inputRoleConfig);
        function resetForm($form) {
            $form.find('input:text, input:password, input:file, textarea').val('');
            $form.find('input:radio, input:checkbox')
                .removeAttr('checked').removeAttr('selected');
        }
      
    };
    function _edit(id)
    {
        $("#banksModal .modal-title").html("Edit <?php echo ucfirst($module_name);?>");
        $(".add").hide();    
        $('#banksForm').validator();    
        $("#action").val("edit");
        $("#inputCoverImage").removeAttr("required");
        var data = { "id" : id }
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."portal/banks/get_banks_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    $("#name").val(data.banks.name);
                    $("#code").val(data.banks.code);
                    $("#inputStatus").val(data.banks.status).trigger('change');
                    $("#banksID").val(data.banks.id);
                    $("#bank_details").val(data.banks.bank_details);
                    $("#bank_address").val(data.banks.address);
                    $("#beneficiary_name").val(data.banks.beneficiary_name);
                    $("#banksModal").modal("show");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    }
    function _delete(id,item)
    {
        $("#deleteBanksModal .modal-title").html("Delete Banks");
        $("#deleteItem").html(item);
        $("#deleteKey").val(id);
        $("#deleteBanksModal").modal("show");
    }
    
    function img_preview(img_src)
    {
        $("#imgPreview").attr("src","<?php echo base_url()."uploads/banks/"?>"+img_src);
        $("#imgPreviewModal").modal("show");
    }

    
    
    function set_image_loader(var_holder,file_holder)
    {
        $("#var_holder").val(var_holder);
        $("#file_holder").val(file_holder);
        $("#mediaGalleryModal").modal("show");
    }

    var new_table = $('#imageGalleryTable').DataTable({  
            "language": {                
                "infoFiltered": ""
            },
            "processing" : true,
            "serverSide" : true,
            "searching" : false,
            "pageLength": 10, "bLengthChange": false,
            "ajax" : "<?php echo base_url()."portal/media/get_media_list?module=banks";?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            ,"columnDefs": [
            { "visible": false,  "targets": [ 1 ] }
        ], "order": [[ 0, 'desc' ]]
        });

    $('#galleryFormUpload').ajaxForm( {
            dataType : 'json',
            beforeSubmit: function() {
                $("#startUpload").button("loading");
                $('#uploadBox').html('<div class="progress"><div class="progress-bar progress-bar-aqua" id = "progressBar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%"><span class="sr-only">20% Complete</span></div></div>');
            },
            uploadProgress: function ( event, position, total, percentComplete ) {
                if (percentComplete == 100) {
                    $('#progressBar').css('width',percentComplete+'%').html('Processing...');
                } else {
                    $('#progressBar').css('width',percentComplete+'%').html(percentComplete+'%');
                }
            },
            success: function(data){
                
                if(!data)
                {
                    $("#startUpload").button("reset");
                    toastr.error(data);
                }
                else
                {   
                    $("#startUpload").button("reset");
                    new_table.draw();
                    toastr.success("Upload Complete");
                    $('#uploadBox').html('<div id="progressOverlay"><div class="progress progress-striped"><div class="bar" id="progressBar" style="width: 0%;">0%</div></div></div>');       
                    $("#media_file").val('');     
                    $('#uploadBox').html("");
                }
            
            },
            error: function (request, status, error) {
                $("#startUpload").button("reset");
                toastr.error(request.responseText);
            }
    });

    $("#selectImage").click(function(){
        $("#"+$("#var_holder").val()).val($('input[name=selected_image]:checked').val());
        $("#"+$("#file_holder").val()).attr("src",$('input[name=selected_image]:checked').attr("data"));
        $("#mediaGalleryModal").modal("hide"); 
        new_table.draw();
    });

    function _delete_media(id,file_name)
    {
        $("#imgPreviewDel").attr("src",file_name);
        $("#deleteImage").val(id);
        $("#deleteImageModal").modal("show");
    }

    $("#deleteImageBtn").click(function(){
        var btn = $(this);
        var id = $("#deleteImage").val();
        var data = { "id" : id };
        btn.button("loading");

        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."portal/media/delete_media";?>",
                success: function(data){
                    //alert("Data Save: " + data);
                    btn.button("reset");
                    new_table.draw('page');
                    $("#deleteImageModal").modal("hide");
                    toastr.error('Image successfully deleted');
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    });

    $(document).ready(main);
</script>