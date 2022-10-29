<?php

class Charge_slip_model extends CI_Model {
    
        public $id;
        public $invoice_id;
        public $client;
        public $checked_by;
        public $released_by;
        public $prepared_by;
        public $date_created;
        public $created_by;
        public $modified_by;
        public $date_modified;
        public $noted_by;
        public $charge_slip_type;
        public $received_by;
        public $to;
        #public $cs_id;

        public function insert_charge_slip($arr_jo,$jo_count)
        {
                echo $result = $this->db->insert('charge_slip', $this);
                //echo $this->db->last_query();
                $insertId = $this->db->insert_id();
                $data["id"] = $insertId;
                $data = json_encode($data);
                $this->insert_cs_item($arr_jo, $insertId);
                $this->logs->log = "Created charge slip - ID:". $insertId  ;
                $this->logs->details = json_encode($data);
                $this->logs->module = "charge_slip";
                $this->logs->created_by = $this->session->userdata("USERID");
                $this->logs->insert_log();
        }
        public function validate_cs_item($invoice_line_id,$cs_type,$cs_id=null)
        {
            $this->db->where("invoice_line_id",$invoice_line_id);
            $this->db->where("charge_slip_type",$cs_type);
            if($cs_id!=null)
            {
                $this->db->where("cs_id !=",$cs_id);
            }
            return $this->db->get("cs_items"); 
        }

        public function insert_cs_item($arr_jo,$cs_id,$cs_count=null)
        {
            $counter = 0;
            
            foreach($arr_jo as $item)
            {
                $data["charge_slip_type"] = $this->charge_slip_type;
                $data["cs_id"] = $cs_id;
                $data["invoice_lines_id"] = $item;
                //$data["jo_count"] = $cs_count[$counter];
                $this->db->insert("cs_items",$data);
                $counter++;
            }
        }
        public function update_charge_slip($cs_items,$cs_count)
        {
            //unset($this->date_created);
            unset($this->created_by);
            unset($this->date_created);
            $this->db->where("id",$this->id);
            echo $result = $this->db->update('charge_slip', $this);
            
            $this->insert_cs_item($cs_items, $this->id,$cs_count);
            
            $data["id"] = $this->id;
            $data = json_encode($data);
            $this->logs->log = "Updated charge slip - ID:". $this->id ;
            $this->logs->details = json_encode($data);
            $this->logs->module = "charge_slip";

            $this->logs->created_by = $this->session->userdata("USERID");
            $this->logs->insert_log();

        }

}

?>
