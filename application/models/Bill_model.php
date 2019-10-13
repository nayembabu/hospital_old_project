<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bill_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }


    function getpaitentsforbill() {
        $this->db->order_by('id', 'DESC');
        $this->db->where('ok', 0);
        $query = $this->db->get('patient');
        return $query->result();
    }




    function getOut_patient() {
        $date = date('Y-m-d', strtotime("0 days"));
        $date_lef = strtotime($date);
        $this->db->order_by('id', 'DESC');
        $this->db->where('th_time >', $date_lef);
        $this->db->join('nurse', 'patient_out_ser.emp_id = nurse.emp_id');
        $query = $this->db->get('patient_out_ser');
        return $query->result();
    }

    function getAlloutP() {
        $query = $this->db->get('patient_out_ser');
        return $query->result();
    }


    function getptnforadvnc() {
        $this->db->where('dis_time', '');
        $query = $this->db->get('patient');
        return $query->result();
    }


    function insertadvncbill($fdata) {
        $this->db->insert('bill_advnc', $fdata);
    }


    function insertrcvbill($rdata) {
        $this->db->insert('bill_receive', $rdata);
    }

    function updateptninfo($pndata, $ptniidd) {
        $this->db->where('id', $ptniidd);
        $this->db->update('patient', $pndata);    
    }


    function getptnninfooo($ptnniid) {
        $this->db->where('id', $ptnniid);
        $this->db->join('doctor', 'patient.dr_id = doctor.dr_id', 'left');
        $this->db->join('nurse', 'patient.briddd = nurse.emp_id', 'left');
        $query = $this->db->get('patient');
        return $query->row();
    }


    function getadvncBill($id) {
        $this->db->where('ptnss_iid', $id);
        $query = $this->db->get('bill_advnc');
        return $query->result();
    }




    function getadvtk($ptnniid) {
        $instdate = date('Y-m-d', time());
        $this->db->where('p_iid', $ptnniid);
        $this->db->where('insert_date', $instdate);
        $this->db->join('bill_cat', 'bill_cat.c_num = bill_receive.bill_cat_id', 'left');
        $query = $this->db->get('bill_receive');
        return $query->row();
    }

    function getOutPatientBy_id($out_p_id) {
        $this->db->where('out_p_iid', $out_p_id);
        $this->db->join('nurse', 'nurse.emp_id = patient_out_ser.emp_id', 'left');
        $query = $this->db->get('patient_out_ser');
        return $query->row();
    }



    function getEmpUser() {
        $this->db->join('nurse', 'nurse.emp_id = users.emp_id');
        $query = $this->db->get('users');
        return $query->result();
    }

    function getrcvBillUsr($emp_id, $qu_date) {
        $this->db->where('emp_id', $emp_id);
        $this->db->where('insert_date', $qu_date);
        $query = $this->db->get('bill_receive');
        return $query->result();
    }


    function getrcvBillUs($emp_id, $qu_date) {
        $this->db->where('emp_id', $emp_id);
        $this->db->where('insert_date', $qu_date);
        $query = $this->db->get('bill_receive');
        return $query->result();
    }

    function getOut_patientiid() {
        $this->db->limit(1);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get("patient_out_ser");
        return $query->row();
    }



    function getoutptnsrc($qu_date, $emp_id){
        $this->db->where('emp_id', $emp_id);
        $this->db->where('add_date', $qu_date);
        $query = $this->db->get('patient_out_ser');
        return $query->result();        
    } 







    function bill_total_summar() {  
        $query = $this->db->get('indoor_bill');
        return $query->result();   
    }

    function bill_cumm_summar($qu_date) {
        $this->db->where('a_date', $qu_date);
        $query = $this->db->get('indoor_bill_cumms');
        return $query->result();        
    }

    function bill_recv_bill($qu_date) {
        $condtn = array('insert_date' => $qu_date);
        $this->db->where($condtn);
        $query = $this->db->get('bill_receive');
        return $query->result();           
    }


     function patientForStatemntss($qu_date, $lAst_Dates) {
        $this->db->where('brdate >=', $qu_date);
        $this->db->where('brdate <=', $lAst_Dates);
         $this->db->join('doctor', 'patient.dr_id = doctor.dr_id', 'left');   
         $this->db->join('nurse', 'patient.briddd = nurse.emp_id', 'left');    
         $query = $this->db->get('patient');
         return $query->result();
     }


    function bill_recv_bils($qu_date, $lAst_Dates) {
        $this->db->where('insert_date >=', $qu_date);
        $this->db->where('insert_date <=', $lAst_Dates);
        $query = $this->db->get('bill_receive');
        return $query->result();           
    }



    function bill_cumm_sums($qu_date, $lAst_Dates) {
        $this->db->where('a_date >=', $qu_date);
        $this->db->where('a_date <=', $lAst_Dates);
        $query = $this->db->get('indoor_bill_cumms');
        return $query->result();        
    }





    function bill_out_bills($qu_date, $lAst_Dates) {
        $condtn = array('insert_date >=' => $qu_date, 'insert_date <=' => $lAst_Dates, 'p_stas' => 'out_ser');
        $this->db->select_sum('bill_cat_taka');
        $this->db->where($condtn);
        $query = $this->db->get('bill_receive');
        return $query->row()->bill_cat_taka;
    }





    // function bill_outsr_bill($qu_date) {
    //     $condtn = array('insert_date' => $qu_date, 'p_stas' => 'out_ser');
    //     $this->db->where($condtn);
    //     $query = $this->db->get('bill_receive');
    //     return $query->result();           
    // }


    function getUsrEmp() {
        $this->db->join('nurse', 'nurse.emp_id = users.emp_id', 'left');
        $query = $this->db->get('users');
        return $query->result();           
    }



    function bill_outsr_bill($qu_date) {
        $condtn = array('insert_date' => $qu_date, 'p_stas' => 'out_ser');
        $this->db->select_sum('bill_cat_taka');
        $this->db->where($condtn);
        $query = $this->db->get('bill_receive');
        return $query->row()->bill_cat_taka;
    }

    function getoptstsntvew($monthss, $years, $optsn) {
        $arrydt = array(
            'MONTH(insert_date)'    => $monthss, 
            'YEAR(insert_date)'     => $years, 
            'p_stas'                => $optsn
        ); 
        $this->db->where($arrydt);
        $query = $this->db->get('bill_receive');
        return $query->result(); 
    }


    function getoptinblcum($monthss, $years) {
        $arrydt = array(
            'MONTH(a_date)'    => $monthss, 
            'YEAR(a_date)'     => $years
        ); 
        $this->db->where($arrydt);
        $query = $this->db->get('indoor_bill_cumms');
        return $query->result(); 
    }


    function getoptoutptn($monthss, $years) {
        $arrydt = array(
            'MONTH(add_date)'    => $monthss, 
            'YEAR(add_date)'     => $years
        ); 
        $this->db->where($arrydt);
        $query = $this->db->get('patient_out_ser');
        return $query->result(); 
    }








    function getPdRIIId($id) {
        $this->db->where('id', $id);
        $ddrIId = $this->db->get('patient')->row()->dr_id;
        $this->db->where('dr_id', $ddrIId);
        $query = $this->db->get('doctor');
        return $query->row();
    }



    function getPConssst($id) {
        $this->db->where('id', $id);
        $ddrIId = $this->db->get('patient')->row()->consultant_id;
        $this->db->where('dr_id', $ddrIId);
        $query = $this->db->get('doctor');
        return $query->row();
    }



    function getpConNddd($id) {
        $this->db->where('id', $id);
        $ddrIId = $this->db->get('patient')->row()->consul_sec_id;
        $this->db->where('dr_id', $ddrIId);
        $query = $this->db->get('doctor');
        return $query->row();
    }


    function getUserEmp() {
        $this->db->order_by('id', 'ASC');
        $this->db->join('nurse', 'nurse.emp_id = users.emp_id', 'left');
        $query = $this->db->get('users');
        return $query->result();
    }

    function getreceivBill() {
        $this->db->join('patient', 'patient.id = bill_receive.p_iid', 'left');
        $query = $this->db->get('bill_receive');
        return $query->result();
    }

    function getDrtctFeess($id) {
        $this->db->where('id', $id);
        $ddrIId = $this->db->get('patient')->row()->dr_id;
        $this->db->where('dr_id', $ddrIId);
        $query = $this->db->get('dr_fee');
        return $query->row();
    }



    function getconSTTtctFeess($id) {
        $this->db->where('id', $id);
        $ddrIId = $this->db->get('patient')->row()->consultant_id;
        $this->db->where('dr_id', $ddrIId);
        $query = $this->db->get('dr_fee');
        return $query->row();
    }



    function getconNDDtctFeess($id) {
        $this->db->where('id', $id);
        $ddrIId = $this->db->get('patient')->row()->consul_sec_id;
        $this->db->where('dr_id', $ddrIId);
        $query = $this->db->get('dr_fee');
        return $query->row();
    }


    function getpaitentsforbill_receive() {
        $date = date('Y-m-d', strtotime("-10 days"));
        $d_time = strtotime($date);
        $this->db->order_by('id', 'DESC');
        $this->db->where('dis_time !=', '');
        $this->db->where('dis_time >', $d_time);
        $query = $this->db->get('patient');
        return $query->result();
    }


    function getbill_cat() {
        $this->db->order_by('c_num', 'ASC');
        $this->db->where('status', 'ind');
        $query = $this->db->get('bill_cat');
        return $query->result();
    }


    function getBlCts() {
        $this->db->order_by('c_num', 'ASC');
        $query = $this->db->get('bill_cat');
        return $query->result();
    }



    function getDoctor() {
        $this->db->order_by('stus', 'active');
        $query = $this->db->get('doctor');
        return $query->result();
    }


    function getDoctorforout() {
        $query = $this->db->get('doctor');
        return $query->result();
    }



    function getBill_rates($p_id) {
        $this->db->order_by('c_num');
        $this->db->where('p_serial', $p_id);
        $this->db->join('bill_cat', 'bill_cat.c_num = indoor_bill.cat_serial');
        $query = $this->db->get('indoor_bill');
        return $query->result();
    }

    function getBill_cat_rat($cat_id) {
        $this->db->where('c_num', $cat_id);
        $query = $this->db->get('bill_cat');
        return $query->row();
    }

    function getBill_rate_r($p_id) {
        $this->db->order_by('c_num');
        $this->db->where('p_serial', $p_id);
        $this->db->where('bill_taka !=', '0');
        $this->db->join('bill_cat', 'bill_cat.c_num = indoor_bill.cat_serial');
        $query = $this->db->get('indoor_bill');
        return $query->result();
    }


    function getgroups() {
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get('groups');
        return $query->result();
    }

    function getPatientById($id) {
        $this->db->where('id', $id);
        $this->db->join('nurse', 'nurse.emp_id = patient.blcrtemp', 'left');
        $this->db->join('doctor', 'doctor.dr_id = patient.dr_id', 'left');
        $query = $this->db->get('patient');
        return $query->row();
    }


    function getPatientfor_rbp($id) {
        $this->db->where('id', $id);
        $this->db->join('nurse', 'nurse.emp_id = patient.briddd', 'left');
        $query = $this->db->get('patient');
        return $query->row();
    }




    function getusergroups() {
        $query = $this->db->get('users_groups');
        return $query->result();
    }


    function getBillCat() {
        $this->db->order_by('c_num');
        $this->db->where('status', 'ind');
        $query = $this->db->get('bill_cat');
        return $query->result();
    }


    function getBillById($id) {
        $this->db->where('p_serial', $id);
        $this->db->where('bill_taka !=', '0');
        $this->db->join('bill_cat', 'indoor_bill.cat_serial = bill_cat.c_num');
        $query = $this->db->get('indoor_bill');
        return $query->result();
    }


    function getRcBillById($id) {
        $this->db->where('p_iid', $id);
        $this->db->where('bill_cat_taka !=', 0);
        $this->db->join('bill_cat', 'bill_receive.bill_cat_id = bill_cat.c_num');
        $query = $this->db->get('bill_receive');
        return $query->result();
    }

    function getRcOutBillById($out_p_id) {
        $this->db->where('out_p_iid', $out_p_id);
        $this->db->where('bill_cat_taka !=', 0);
        $this->db->join('bill_cat', 'bill_receive.bill_cat_id = bill_cat.c_num');
        $query = $this->db->get('bill_receive');
        return $query->result();
    }





    function app_ins($data) {
        $this->db->insert('appointment', $data);        
    }


    function app_updt($p_id, $apData) {
        $this->db->where('a_p_iid', $p_id);
        $this->db->update('appointment', $apData);        
    }


   function getdr_name($dr_id) {
        $this->db->where('dr_id', $dr_id);
        $query = $this->db->get('doctor');
        return $query->row();
        }


   function get_dr_fee($dr_id) {
        $this->db->where('dr_id', $dr_id);
        $query = $this->db->get('dr_fee');
        return $query->row();
        }


    function getconststst_name($id) {
        $this->db->where('id', $id);
        $conIId = $this->db->get('patient')->row()->consultant_id;
        $this->db->where('dr_id', $conIId);
        $query = $this->db->get('doctor');
        return $query->row();
    }



    function getconndndnd_name($id) {
        $this->db->where('id', $id);
        $conIId = $this->db->get('patient')->row()->consul_sec_id;
        $this->db->where('dr_id', $conIId);
        $query = $this->db->get('doctor');
        return $query->row();
    }


   function getbed_taka($bed_no) {
        $this->db->where('b_num', $bed_no);
        $query = $this->db->get('bed');
        return $query->row();
        }


    function creat_bill_sum($id) {
            $this->db->select_sum('bill_taka');
            $this->db->where('p_serial', $id);
            $query = $this->db->get('indoor_bill');
            return $query->row()->bill_taka;
        }


    function receiv_bill_sum($id) {
            $this->db->select_sum('bill_cat_taka');
            $this->db->where('p_iid', $id);
            $query = $this->db->get('bill_receive');
            return $query->row()->bill_cat_taka;
        }


    function bill_cummis_sum($id) {
            $this->db->select_sum('nd_cummis_tk');
            $this->db->where('p_iid', $id);
            $query = $this->db->get('indoor_bill_cumms');
            return $query->row()->nd_cummis_tk;
        }


    function bill_total_sumOpt($optss, $qu_date) {
            $this->db->select_sum('bill_cat_taka');
            $this->db->where('p_stas', $optss);
            $this->db->where('insert_date', $qu_date);
            $query = $this->db->get('bill_receive');
            return $query->row()->bill_cat_taka;
    }

     function contb_opt($optss, $qu_date) {

         $this->db->where('brdate', $qu_date); 
         $this->db->where('p_stus', $optss);     
         $query = $this->db->get('patient');
         return $query->result();


         // $this->db->where('p_stas', $optss);
         // $this->db->where('insert_date', $qu_date);
         // $this->db->select('p_iid, COUNT(p_iid) as bill_receive');
         // $this->db->group_by('p_iid'); 
         // $query =  $this->db->get('bill_receive');
         // return $query->result();




         //    $this->db->group_by('p_iid'); 
         //    $this->db->where('p_stas', $optss);
         //    $this->db->where('insert_date', $qu_date);
         // return $this->db->count_all('bill_receive');          
     }




    function billForStatmnt($qu_date) {
            $this->db->select_sum('bill_cat_taka');
            $this->db->where('insert_date', $qu_date);
            $query = $this->db->get('bill_receive');
            return $query->row()->bill_cat_taka;
    }



     function patientForStatemnt($qu_date) {
         $this->db->where('brdate', $qu_date);
         $this->db->join('doctor', 'patient.dr_id = doctor.dr_id', 'left');   
         $this->db->join('nurse', 'patient.briddd = nurse.emp_id', 'left');    
         $query = $this->db->get('patient');
         return $query->result();
     }

     function getptninfoo($qu_date, $emp_id) {
         $this->db->where('brdate', $qu_date);
         $this->db->where('briddd', $emp_id);
         $this->db->join('doctor', 'patient.dr_id = doctor.dr_id', 'left');   
         $query = $this->db->get('patient');
         return $query->result();
     }


     function patientForConssst($qu_date) {
         $this->db->where('brdate', $qu_date);
         $this->db->join('doctor', 'patient.consultant_id = doctor.dr_id', 'left');
         $query = $this->db->get('patient');
         return $query->result();
     }

     function getcmsBlUr($emp_id, $qu_date) {
         $this->db->where('a_date', $qu_date);
         $this->db->where('emp_id', $emp_id);  
         $query = $this->db->get('indoor_bill_cumms');
         return $query->result();

     }




    function cr_b_sum() {        
        $query = $this->db->get('indoor_bill');
        return $query->result();
    }

    function b_coms() {
        $query = $this->db->get('indoor_bill_cumms');
        return $query->result();
    }

    function b_recv($qu_date) {
         $this->db->where('insert_date', $qu_date); 
        $query = $this->db->get('bill_receive');
        return $query->result();        
    }

    function out_patient($qu_date) {
         $this->db->where('add_date', $qu_date);   
         $this->db->join('nurse', 'patient_out_ser.emp_id = nurse.emp_id', 'left');    
         $query = $this->db->get('patient_out_ser');
         return $query->result();
    }


   function getAppTkById($id) {
        $this->db->where('a_p_iid', $id);
        $this->db->join('doctor', 'doctor.dr_id = appointment.dr_id');
        $query = $this->db->get('appointment');
        return $query->result();
        }



   function getcon_name($cons) {
        $this->db->where('dr_id', $cons);
        $query = $this->db->get('doctor');
        return $query->row();
        }

    function getemp() {
        $this->db->order_by('eid', 'ASC');
        $this->db->where('status', 'active');
        $query = $this->db->get('nurse');
        return $query->result();
        }

    function insertuser($data) {
        $this->db->insert('users', $data);
    }


    function insert_receive_bill($data) {
        $this->db->insert_batch('bill_receive', $data);
    }

//Edit receive Bill Model
    function update_receive_bill($p_id, $data) {
        $this->db->where('p_iid', $p_id);
        $this->db->update_batch('bill_receive', $data, 'bill_cat_id');
    }
//Edit Receive Bill Model

    function insert_out_p($out_data) {
        $this->db->insert('patient_out_ser', $out_data);        
    }


    function insertusergroup($data) {
        $this->db->insert('users_groups', $data);
    }

   function insert_bill($data) {
        $this->db->insert_batch('indoor_bill', $data); 
    }

   function update_bill_rate($p_serial, $data) {
        $this->db->where('p_serial', $p_serial);
        $this->db->update_batch('indoor_bill', $data, 'cat_serial');
    }

    function insert_bill_cumms($c_data) {        
        $this->db->insert_batch('indoor_bill_cumms', $c_data);
    }


    function update_bill_cumms($p_id, $c_data) {        
        $this->db->where('p_iid', $p_id);
        $this->db->update_batch('indoor_bill_cumms', $c_data, $p_id);
    }





    function insert_rrcv_bill($data) {
        $this->db->insert('bill_receive', $data);
    }

    function insert_bl_cums($c_data) {        
        $this->db->insert('indoor_bill_cumms', $c_data);
    }






    function getBillCummsById($id) {
        $this->db->where('p_iid', $id);
        $this->db->where('nd_cummis_tk !=', 0);
        $query = $this->db->get('indoor_bill_cumms');
        return $query->result();        
    }



    function getOutBillCummsById($out_p_id) {
        $this->db->where('out_p_iid', $out_p_id);
        $this->db->where('nd_cummis_tk !=', 0);
        $query = $this->db->get('indoor_bill_cumms');
        return $query->result();        
    }





    function update_bill($p_serial, $i_data) {
        $this->db->where('id', $p_serial);
        $this->db->update('patient', $i_data);
    }



    function updateuserpass($emp_id, $data) {
        $this->db->where('emp_id', $emp_id);
        $this->db->update('users', $data);
    }


    function p_end($p_id, $data) {
        $this->db->where('id', $p_id);
        $this->db->update('patient', $data);
    }







    function getusergroupbyid($id) {
        $this->db->where('emp_id', $id);
        $query = $this->db->get('users');
        return $query->row();
    }





    function getPatientByI($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('patient');
        return $query->row();
    }
    

    function getconnam($id) {
        $this->db->where('id', $id);
        $this->db->join('doctor', 'doctor.dr_id = patient.consultant_id');
        $query = $this->db->get('patient');
        return $query->row();
    }



    function getconnndnam($id) {
        $this->db->where('id', $id);
        $this->db->join('doctor', 'doctor.dr_id = patient.consul_sec_id');
        $query = $this->db->get('patient');
        return $query->row();
    }


    function getuserssbyid($empid) {
        $this->db->where('emp_id', $empid);
        $query = $this->db->get('users');
        return $query->row();
    }




    function delete($id) {
        $this->db->where('emp_id', $id);
        $this->db->delete('users');
    }










//End Bracket
}
