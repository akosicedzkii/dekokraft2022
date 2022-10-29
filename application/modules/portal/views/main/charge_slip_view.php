<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php $module_name = str_replace("_", " ", $module_name);echo ucfirst(str_replace("_", " ", $module_name));?>
      <small>Management</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><?php echo ucfirst($module_name);?></li>
    </ol>
  </section>
  <button class="btn btn-success btn-circle btn-lg fix-btn" id="addBtn" data-toggle="tooltip" title="Add New">
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
        <table id="charge_slipList" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Charge Slip #</th>
              <th>Client</th>
              <th>Invoice ID</th>
              <th>Charge Slip Type</th>
              <th>Checked By</th>
              <th>Released By</th>
              <th>Prepared By</th>
              <th>Noted By</th>
              <th>Received By</th>
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

<div class="modal fade" id="charge_slipModal" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>

        <h3 class="modal-title">Add</h3>
        <input type="hidden" id="action">
        <input type="hidden" id="charge_slipID">
      </div>
      <div class="modal-body">
        <div>
          <form class="form-horizontal" id="charge_slipForm" data-toggle="validator">
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="invoice_id" class="col-sm-4 control-label">Invoice #</label>

                    <div class="col-sm-4">
                      <select type="text" style="width:150px;" class="form-control" id="invoice_id"
                        placeholder="Invoice ID" required>
                        <option value="">Select Invoice #</option>
                      </select>
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="subcon" class="col-sm-4 control-label">Customer</label>

                    <div class="col-sm-4">

                      <select type="text" style="width:150px;" class="form-control" id="customer" placeholder="Customer"
                        required>
                        <option value="">Select Customer</option>
                      </select>
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="option" class="col-sm-4 control-label">Charge Slip Type</label>

                    <div class="col-sm-4">
                      <select class="form-control" id="charge_slip_type" placeholder="Charge Slip Type" style="resize:none;width:100px;"
                        required>

                        <option value="moulds">Moulds</option>
                        <option value="proto">Proto</option>
                      </select>
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>



                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="deadline" class="col-sm-4 control-label">To</label>

                      <div class="col-sm-4">
                        <input type="text" style="width:150px;" class="form-control" id="to" placeholder="To" required>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="deadline" class="col-sm-4 control-label">Checked By</label>

                      <div class="col-sm-4">
                        <input type="text" style="width:150px;" class="form-control" id="checked_by"
                          placeholder="Checked By" required>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="date_created" class="col-sm-4 control-label">Date Created</label>

                      <div class="col-sm-4">
                        <input type="date" style="width:150px;" class="form-control" id="date_created"
                          placeholder="Date Created" required>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="deadline" class="col-sm-4 control-label">Released By</label>

                      <div class="col-sm-4">
                        <input type="text" style="width:150px;" class="form-control" id="released_by" placeholder="Released By" required>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="deadline" class="col-sm-4 control-label">Prepared By</label>

                      <div class="col-sm-4">
                        <input type="text" style="width:150px;" class="form-control" id="prepared_by"
                          placeholder="Prepared By" required>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="date_created" class="col-sm-4 control-label">Noted By</label>

                      <div class="col-sm-4">
                        <input type="text" style="width:150px;" class="form-control" id="noted_by"
                          placeholder="Noted By" required>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="deadline" class="col-sm-4 control-label">Received By</label>

                      <div class="col-sm-4">
                        <input type="text" style="width:150px;" class="form-control" id="received_by" placeholder="Received By" required>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <div class="form-group">

                <div class="col-sm-12">
                  <table class="table responsive">
                    <thead>
                      <th>Select</th>
                      <th>Code</th>
                      <th>Quantity</th>
                      <th>Location</th>
                      <th>Product Name</th>
                    </thead>
                    <tbody id="table_body">
                    </tbody>
                  </table>
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
        <button type="button" class="btn btn-primary" id="saveJob_order">Save Charge Slip</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="deleteJob_orderModal" role="dialog" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>

        <h3 class="modal-title">Delete Charge Slip</h3>
      </div>
      <div class="modal-body">
        <input type="hidden" id="deleteKey">
        <center>
          <h4>Are you sure to delete <label id="deleteItem"></label></h4>
        </center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="deleteJob_order">Delete</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- /.modal -->
<div class="modal fade" id="completeJob_orderModal" role="dialog" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>

        <h3 class="modal-title">Complete Job Order</h3>
      </div>
      <div class="modal-body">
        <input type="hidden" id="completeKey">
        <center>
          <h4>Are you sure to complete JO#: <label id="completeItem"></label></h4>
        </center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="completeJob_order">Save</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
  var inputRoleConfig = {
    dropdownAutoWidth: true,
    width: 'auto',
    placeholder: "--- Select Item ---"
  };


  var main = function () {
    var table = $('#charge_slipList').DataTable({
      "language": {
        "infoFiltered": ""
      },
      'autoWidth': true,
      "processing": true,
      "serverSide": true,
      "ajax": "<?php echo base_url()."portal/charge_slip/get_charge_slip_list";?>",
      "initComplete": function (settings, json) {
        $('[data-toggle="tooltip"]').tooltip()
      },
      "columnDefs": [{
          "visible": false,
          "targets": [0]
        },
        {
          "width": "20%",
          "targets": [1]
        }
      ],
      "order": [
        [8, 'desc']
      ]
    });
    $("#addBtn").click(function () {
      $("#charge_slipModal .modal-title").html("Add <?php echo ucfirst($module_name);?>");
      $("#action").val("add");
      $("#inputCoverImage").attr("required", "required");
      $('#charge_slipForm').validator();
      $("#charge_slipModal").modal("show");
    });

    $("#saveJob_order").click(function () {
      $("#charge_slipForm").submit();
    });

    var image_correct = true;
    var image_error = "";
    $("#charge_slipForm").validator().on('submit', function (e) {
      var selected = [];
      var cs_count_values = [];
      $.each($("input[name='cs_item']:checked"), function (e) {
        selected.push($(this).val());
        //cs_count_values.push($(this).parent().parent().find('input[type=number]').val());
      });

      var btn = $("#saveJob_order");
      var action = $("#action").val();
      btn.button("loading");
      if (e.isDefaultPrevented()) {
        btn.button("reset");
      } else {
        e.preventDefault();

        var charge_slip_id = $("#charge_slipID").val();


        var formData = new FormData();
        formData.append('id', charge_slip_id);
        formData.append('invoice_id', $("#invoice_id").val());
        formData.append('client', $("#customer").val());
        formData.append('checked_by', $("#checked_by").val());
        formData.append('date_created', $("#date_created").val());
        formData.append('released_by', $("#released_by").val());
        formData.append('prepared_by', $("#prepared_by").val());
        formData.append('noted_by', $("#noted_by").val());
        formData.append('received_by', $("#received_by").val());
        formData.append('to', $("#to").val());
        formData.append('charge_slip_type', $("#charge_slip_type").val());
        
        formData.append('selected_items', selected)
        //formData.append('cs_count_values', cs_count_values)
        // Attach file
        //fromthis
        var url = "<?php echo base_url()."portal/charge_slip/add_charge_slip";?>";
        var message = "New charge slip successfully added";
        if (action == "edit") {
          url = "<?php echo base_url()."portal/charge_slip/edit_charge_slip";?>";
          message = "Charge slip successfully updated";
        }


        $('#uploadBoxMain').html(
          '<div class="progress"><div class="progress-bar progress-bar-aqua" id = "progressBarMain" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%"><span class="sr-only">20% Complete</span></div></div>'
          );
        $.ajax({
          data: formData,
          type: "post",
          processData: false,
          contentType: false,
          cache: false,
          url: url,
          xhr: function () {
            //upload Progress
            var xhr = $.ajaxSettings.xhr();
            if (xhr.upload) {
              xhr.upload.addEventListener('progress', function (event) {
                var percent = 0;
                var position = event.loaded || event.position;
                var total = event.total;
                if (event.lengthComputable) {
                  percent = Math.ceil(position/total * 100);
                }
                //update progressbar

                $('#progressBarMain').css('width', percent + '%').html(percent + '%');

              }, true);
            }
            return xhr;
          },
          mimeType: "multipart/form-data"
        }).done(function (data) {
          if (data != true) {
            $('#uploadBoxMain').html('');
            btn.button("reset");

            toastr.error(JSON.parse(data).warning);
          } else {
            //alert("Data Save: " + data);
            btn.button("reset");
            if (action == "edit") {
              table.draw("page");
            } else {
              table.draw();
            }
            toastr.success(message);
            $("#charge_slipForm").validator('destroy');
            $("#charge_slipModal").modal("hide");
            $('#uploadBoxMain').html('');
          }
        });
      }
      return false;
    });

    initialize_selects()
    $("#deleteJob_order").click(function () {
      var btn = $(this);
      var id = $("#deleteKey").val();
      var deleteItem = $("#deleteItem").html();
      var data = {
        "id": id
      };
      btn.button("loading");

      $.ajax({
        data: data,
        type: "post",
        url: "<?php echo base_url()."portal/charge_slip/delete_charge_slip";?>",
        success: function (data) {
          //alert("Data Save: " + data);
          btn.button("reset");
          table.draw("page");
          $("#deleteJob_orderModal").modal("hide");
          toastr.error('Job Order ' + deleteItem + ' successfully deleted');
        },
        error: function (request, status, error) {
          alert(request.responseText);
        }
      });
    });
    $("#completeJob_order").click(function () {
      var btn = $(this);
      var id = $("#completeKey").val();
      var completeItem = $("#completeItem").html();
      var data = {
        "id": id
      };
      btn.button("loading");

      $.ajax({
        data: data,
        type: "post",
        url: "<?php echo base_url()."portal/charge_slip/complete_charge_slip";?>",
        success: function (data) {
          //alert("Data Save: " + data);
          btn.button("reset");
          table.draw("page");
          $("#completeJob_orderModal").modal("hide");
          toastr.success('Job Order ' + completeItem + ' successfully completed');
        },
        error: function (request, status, error) {
          alert(request.responseText);
        }
      });
    });

    $("#date_created").val("<?php echo date("Y-m-d");?>");
    $('#charge_slipModal').on('hidden.bs.modal', function (e) {
      $(this)
        .find("input,textarea,select")
        .val('')
        .end()
        .find("input[type=checkbox], input[type=radio]")
        .prop("checked", "")
        .end();
      $("#charge_slip_type").val('spray').trigger('change');
      $("#invoice_id").val('').trigger('change');
      $("#customer").val('').trigger('change');
      $("#table_body").html("");
      $("#date_created").val("<?php echo date("Y-m-d");?>");
      $("#charge_slipForm").validator('destroy');
    });

    $('#inputStatus').select2(inputRoleConfig);
    $('#job_type').select2(inputRoleConfig);

    function resetForm($form) {
      $form.find('input:text, input:password, input:file, textarea').val('');
      $form.find('input:radio, input:checkbox')
        .removeAttr('checked').removeAttr('selected');
    }

  };

  function initialize_selects() {
    $("#invoice_id").select2({
      minimumInputLength: 1,
      ajax: {
        url: "<?php echo base_url()."portal/invoices/get_invoice_selection";?>",
        dataType: 'json',
        type: "GET",
        data: function (term) {
          return {
            term: term
          };
        },
        processResults: function (data) {
          return {
            results: data.items
          };
        }

      }
    });
    $("#customer").select2({
      minimumInputLength: 1,
      ajax: {
        url: "<?php echo base_url()."portal/customers/get_customers_selection";?>",
        dataType: 'json',
        type: "GET",
        data: function (term) {
          return {
            term: term
          };
        },
        processResults: function (data) {
          return {
            results: data.items
          };
        }

      }
    });
    $('#invoice_id').on('select2:select', function (e) {
      var data = $('#invoice_id').select2('data');
      //console.log(data);
      data = {
        "invoice_id": data[0].id
      }
      $.ajax({
        data: data,
        type: "get",
        url: "<?php echo base_url()."portal/invoices/get_invoice_list";?>",
        success: function (data) {
          $("#table_body").html("");
          if (!data) {
            return false;
          }
          data = JSON.parse(data);
          counters = 1;
          data.forEach(function (e) {
            //console.log(e["color"])
            $("#table_body").append("<tr><td>" + counters +
              ".&emsp;<input type=checkbox name='cs_item' value='" + e["id"] + "' /></td><td>" + e[
                "code"] + "</td><td>" + e["quantity"] + "</td><td>" + e["location"] +
              "</td><td>" + e["description"] +"<input class='form-control' type=number name='jo_count' value=" + e[
              "quantity"] + " min=1 max=" + e["jo_count"] + " /></td></tr>");
            counters++;
          });

        },
        error: function (request, status, error) {
          alert(request.responseText);
        }
      });
    });
  }

  function _edit(id) {
    $("#charge_slipModal .modal-title").html("Edit <?php echo ucfirst($module_name);?>");
    $(".add").hide();
    $('#charge_slipForm').validator();
    $("#action").val("edit");
    $("#inputCoverImage").removeAttr("required");
    var data = {
      "id": id,
      "charge_slip_type": $("#charge_slip_option").val()
    }
    $.ajax({
      data: data,
      type: "post",
      url: "<?php echo base_url()."portal/charge_slip/get_charge_slip_data";?>",
      success: function (data) {
        data = JSON.parse(data);
        //console.log(data);
        $("#table_body").html("");
        $("#invoice_id").append(new Option(data.invoices.id, data.invoices.id, true, true))
          .trigger('change');
        if (data.customer != null) {
          $("#customer").append(new Option(data.customer.customer_name, data.customer.id, true, true)).trigger('change');
        }

        $("#checked_by").val(data.charge_slip.checked_by);
        $("#charge_slipID").val(data.charge_slip.id);
        $("#date_created").val(data.charge_slip.date_created);
        $("#released_by").val(data.charge_slip.released_by);
        $("#prepared_by").val(data.charge_slip.prepared_by);
        $("#noted_by").val(data.charge_slip.noted_by);
        $("#received_by").val(data.charge_slip.received_by); 
        $("#to").val(data.charge_slip.to); 
        $("#charge_slip_type").val(data.charge_slip.charge_slip_type).trigger('change');

        data2 = data.invoice_lines;
        data3 = data.cs_items;
        counters = 1;
        data2.forEach(function (e) {
          selected = 0;
          data3.forEach(function (e2) {
            if (e["id"] == e2["invoice_lines_id"]) {
              counts = e2["jo_count"];
              if (e2["jo_count"] == 0) {
                counts = e["quantity"];
              }
              $("#table_body").append("<tr><td>" + counters +
                ".&emsp;<input checked type=checkbox name='cs_item' value='" + e["id"] +
                "' /></td><td>" + e["code"] + "</td><td>" + e["quantity"] + "</td><td>" + e[
                  "location"] +
                "</td><td>" + e["description"] +"</td></tr>");
              selected = 1;
              return false;
            }
          });
          if (selected == 0) {
            $("#table_body").append("<tr><td>" + counters +
              ".&emsp;<input type=checkbox name='cs_item' value='" + e["id"] + "' /></td><td>" + e[
                "code"] + "</td><td>" + e["quantity"] + "</td><td>" + e["location"] +
              "</td><td>" + e["description"] +"</td></tr>");
          }
          counters++;
        });
        $("#charge_slipModal").modal("show");
      },
      error: function (request, status, error) {
        alert(request.responseText);
      }
    });
  }

  function _delete(id, item) {
    $("#deleteJob_orderModal .modal-title").html("Delete Job_order");
    $("#deleteItem").html(item);
    $("#deleteKey").val(id);
    $("#deleteJob_orderModal").modal("show");
  }

  function _complete(id, item) {
    $("#completeJob_orderModal .modal-title").html("Complete Charge Slip");
    $("#completeItem").html(item);
    $("#completeKey").val(id);
    $("#completeJob_orderModal").modal("show");
  }


  $(document).ready(main);

</script>
