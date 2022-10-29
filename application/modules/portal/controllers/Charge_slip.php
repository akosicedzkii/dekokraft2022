<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Charge_slip extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();
        $this->load->model("portal/charge_slip_model");

        if ($this->session->userdata("USERID") == null) {
            echo "Sorry you are not logged in";
            die();
        }
    }
    public function print()
    {
      $id = $this->input->get("id");
        if($id==null)
        {
          echo "Please input id";
        }
        $this->db->where("id",$id);
        $data["charge_slip"]= $this->db->get("charge_slip")->row();
        $this->db->where("id",$data["charge_slip"]->client);
        $data["client"]= $this->db->get("customers")->row();
        $this->db->where("cs_id",$id);
        $data["cs_items"]= $this->db->query("select products.code, invoice_lines.quantity, product_variants.location, product_variants.description from cs_items  LEFT JOIN invoice_lines on cs_items.invoice_lines_id = invoice_lines.id LEFT JOIN product_variants on product_variants.id = invoice_lines.product_id LEFT JOIN products on products.id=product_variants.product_id  where cs_items.cs_id=$id")->result();
        $this->load->view("main/charge_slip_print_view",$data);
    }
    public function add_charge_slip()
    {
        if ($this->input->post("selected_items") == null) {
            echo "Please select an item!";
            die();
        }
        $cs_items = explode(",", $this->input->post("selected_items"));
        $cs_count = explode(",", $this->input->post("cs_count_values"));

        $counter = 1;
        foreach ($cs_items as $item) {
            $result = $this->charge_slip_model->validate_cs_item($item, $this->input->post("charge_slip_type"));
            if ($result !== false) {
                $results["warning"] = "Line # ". $counter ." already exist on other JO#:". $result->cs_id;
                echo json_encode($results);
                die();
            }

            $counter++;
        }
        $this->charge_slip_model->invoice_id = $this->input->post("invoice_id");
        $this->charge_slip_model->client = $this->input->post("client");
        $this->charge_slip_model->checked_by = $this->input->post("checked_by");
        $this->charge_slip_model->released_by = $this->input->post("released_by");
        $this->charge_slip_model->prepared_by = $this->input->post("prepared_by");
        $this->charge_slip_model->created_by = $this->input->post("created_by");
        $this->charge_slip_model->noted_by = $this->input->post("noted_by");
        $this->charge_slip_model->charge_slip_type = $this->input->post("charge_slip_type");
        $this->charge_slip_model->to = $this->input->post("to");
        $this->charge_slip_model->received_by = $this->input->post("received_by");

        $this->charge_slip_model->date_created = $this->input->post("date_created");
        $this->charge_slip_model->created_by =  $this->session->userdata("USERID");

        echo $this->charge_slip_model->insert_charge_slip($cs_items,$cs_count);
    }

    public function edit_charge_slip()
    {
        $charge_slip_id = $this->input->post("id");
        $this->charge_slip_model->id = $this->input->post("id");
        if ($this->input->post("selected_items") == null) {
            $results["warning"] ="Please select an item!";
            echo json_encode($results);
            die();
        }
        $cs_items = explode(",", $this->input->post("selected_items"));
        $cs_count = explode(",", $this->input->post("cs_count_values"));
        $counter = 1;
        foreach ($cs_items as $item) {
            $result = $this->charge_slip_model->validate_cs_item($item, $this->input->post("charge_slip_type"), $charge_slip_id);
            if ($result != null) {
                $results["warning"] = "Line # ". $counter ." already exist on other JO#:". $result->cs_id;
                echo json_encode($results);
                die();
            }
            $counter++;
        }
        $this->charge_slip_model->invoice_id = $this->input->post("invoice_id");
        $this->charge_slip_model->client = $this->input->post("client");
        $this->charge_slip_model->checked_by = $this->input->post("checked_by");
        $this->charge_slip_model->released_by = $this->input->post("released_by");
        $this->charge_slip_model->prepared_by = $this->input->post("prepared_by");
        $this->charge_slip_model->created_by = $this->input->post("created_by");
        $this->charge_slip_model->noted_by = $this->input->post("noted_by");
        $this->charge_slip_model->charge_slip_type = $this->input->post("charge_slip_type");
        $this->charge_slip_model->to = $this->input->post("to");
        $this->charge_slip_model->received_by = $this->input->post("received_by");

        $this->charge_slip_model->date_modified = $this->input->post("date_created");
        $this->charge_slip_model->modified_by =  $this->session->userdata("USERID");
        $this->charge_slip_model->id = $charge_slip_id;
        $this->db->where("cs_id", $charge_slip_id);
        $this->db->delete("cs_items");
        echo $this->charge_slip_model->update_charge_slip($cs_items,$cs_count);
    }

    public function delete_charge_slip()
    {
        $id = $this->input->post("id");
        $this->db->where("id", $id);
        $data_charge_slip = $this->db->get("charge_slip");
        $this->db->where("id", $id);
        $data["status"] = 3;
        echo $result = $this->db->delete("charge_slip");

        $this->db->where("cs_id", $id);
        $result = $this->db->delete("cs_items");
        $data = json_encode($data_charge_slip->row());
        $this->logs->log = "Deleted charge_slip - ID:". $data_charge_slip->row()->id  ;
        $this->logs->details = json_encode($data);
        $this->logs->module = "charge_slip";
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
    }
    public function complete_charge_slip()
    {
        $id = $this->input->post("id");
        $this->db->where("id", $id);
        $data_charge_slip = $this->db->get("charge_slip");
        $this->db->where("id", $id);
        $data["status"] = 1;
        echo $result = $this->db->update("charge_slip", $data);

        //$this->db->where("cs_id", $id);
        //$result = $this->db->delete("job_order_lines");
        $data = json_encode($data_charge_slip->row());
        $this->logs->log = "Completed charge slips - ID:". $data_charge_slip->row()->id  ;
        $this->logs->details = json_encode($data);
        $this->logs->module = "charge_slip";
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
    }
    public function get_charge_slip_data()
    {
        $id = $this->input->post("id");
        $this->db->where("id", $id);
        $result = $this->db->get("charge_slip");
        $charge_slip = $result->row();
        $return["charge_slip"] = $charge_slip;
        $return["charge_slip"]->date_created = date("Y-m-d", strtotime($charge_slip->date_created));
        $return["customer"] = $this->db->where("id", $charge_slip->client)->get("customers")->row();
        $return["invoices"] =  $this->db->where("id", $charge_slip->invoice_id)->get("invoices")->row();

        // $this->db->select("job_order_lines.id as cs_line_id,job_order_lines.cs_id,product_variants.color,invoice_lines.*,products.description,products.code,products.fob");
        //$this->db->join("job_order_lines"," job_order_lines.invoice_line_id=invoice_lines.id", 'left');
        $this->db->select("product_variants.color,invoice_lines.*,products.description,products.code,products.location");
        $this->db->join("product_variants", " product_variants.id=invoice_lines.product_id");
        $this->db->join("products", " products.id=product_variants.product_id");
        //$this->db->order_by("products.description","asc");
        $this->db->where("invoice_lines.invoice_id", $return["invoices"]->id);
        $return["invoice_lines"] = $this->db->get("invoice_lines")->result();
        $this->db->where("cs_id", $id);
        $this->db->where("charge_slip_type", $charge_slip->charge_slip_type);
        $this->db->where("cs_id", $charge_slip->id);
        $return["cs_items"] =  $this->db->order_by("invoice_lines_id")->get("cs_items")->result();

        echo json_encode($return);
    }

    public function get_charge_slip_selection()
    {
        $search = $this->input->get("term[term]");
        $this->db->like("name", $search);
        $this->db->where("status", 1);
        $this->db->select("name as text");
        $this->db->select("id as id");
        $this->db->limit(10);
        $filteredValues=$this->db->get("charge_slip")->result_array();

        echo json_encode(array(
            'items' => $filteredValues
        ));
    }

    public function get_invoice_list()
    {
        $invoice_id = $this->input->get("invoice_id");
        $this->db->select("product_variants.color,invoice_lines.*,products.description,products.code,products.fob");
        $this->db->join("product_variants", " product_variants.id=invoice_lines.product_id");
        $this->db->join("products", " products.id=product_variants.product_id");
        $this->db->where("invoice_id", $invoice_id);
        $result = $this->db->get("invoice_lines")->result();
        echo json_encode($result);
    }
    public function get_charge_slip_list()
    {
        $this->load->model("portal/data_table_model", "dt_model");
        $this->dt_model->select_columns = array("t1.id","t1.id","(select customer_name from customers where id=t1.client) as client","t1.invoice_id","t1.charge_slip_type","t1.checked_by","t1.released_by","t1.prepared_by","t1.noted_by","t1.received_by","t1.date_created","t2.username as created_by","t1.date_modified","t3.username as modified_by");
        $this->dt_model->where  = array("t1.id","t1.id","t1.client","t1.invoice_id","t1.charge_slip_type","t1.checked_by","t1.released_by","t1.prepared_by","t1.noted_by","t1.received_by","t1.date_created","t2.username","t1.date_modified","t3.username");
        $select_columns = array("id","id","client","invoice_id","charge_slip_type","checked_by","released_by","prepared_by","noted_by","received_by","date_created","created_by","date_modified","modified_by");
        $this->dt_model->table = "charge_slip AS t1 LEFT JOIN user_accounts AS t2 ON t2.id = t1.created_by LEFT JOIN user_accounts AS t3 ON t3.id = t1.modified_by ";
        $this->dt_model->index_column = "t1.id";
        //$this->dt_model->staticWhere = "t1.status != 3";
        $result = $this->dt_model->get_table_list();
        $output = $result["output"];
        $rResult = $result["rResult"];
        $aColumns = $result["aColumns"];
        foreach ($rResult->result_array() as $aRow) {
            $row = array();
            $btns="";
            foreach ($select_columns as $col) {
                if ($col == "username" || $col == "created_by" || $col == "modified_by") {
                    $row[] = $aRow[$col];
                } elseif ($col == "status") {
                    if ($aRow[$col] == "Pending") {
                        $btns = '<a href="#" onclick="_complete('.$aRow['id'].',\''.$aRow["id"].'\');return false;" class="glyphicon glyphicon-check text-green" data-toggle="tooltip" name="Complete Purchase Order"></a>
                                     <a href="#" onclick="_edit('.$aRow['id'].',\''.$aRow["job_type"].'\');return false;" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" name="Edit"></a>';
                        $row[] = '<center><small class="label bg-gray">'.$aRow[$col].'</small></center>';
                    } elseif ($aRow[$col] == "Completed") {
                        $row[] = '<center><small class="label bg-green">'.$aRow[$col].'</small></center>';
                    }
                } elseif ($col == "date_created") {
                    if ($aRow[$col] != null) {
                        $row[] = date("Y-m-d", strtotime($aRow[$col]));
                    } else {
                        $row[] = "None";
                    }
                } elseif ($col == "deadline") {
                    if ($aRow[$col] != null) {
                        $row[] = date("Y-m-d", strtotime($aRow[$col]));
                    } else {
                        $row[] = "None";
                    }
                }  else {
                    $row[] = $aRow[$col] ;
                }
            }
            // <a href="#" onclick="_print('.$aRow['id'].',\''.$aRow["id"].'\');return false;" class="glyphicon glyphicon-print text-orange" data-toggle="tooltip" name="Print"></a>
            $btns .= '
            <a href="'.base_url("portal/charge_slip/print?id=".$aRow['id']).'" target="_blank" class="glyphicon glyphicon-print text-orange" data-toggle="tooltip" name="Print"></a>
            <a href="#" onclick="_complete('.$aRow['id'].',\''.$aRow["id"].'\');return false;" class="glyphicon glyphicon-check text-green" data-toggle="tooltip" name="Complete Purchase Order"></a>
            <a href="#" onclick="_edit('.$aRow['id'].',\''.$aRow["charge_slip_type"].'\');return false;" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" name="Edit"></a>
            <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow["id"].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" name="Delete"></a>';
            array_push($row, $btns);
            $output['data'][] = $row;
        }
        echo json_encode($output);
    }
}
