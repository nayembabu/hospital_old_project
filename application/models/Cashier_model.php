<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cashier_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }





//Get Catagory

    //Income Category for Monthly Income Expense
    function getcatwr() {
        $this->db->where('stus', 'regular');
        $this->db->order_by('list', 'ASC');
        $query = $this->db->get('income_category');
        return $query->result();
    }

    //Expense Category for Monthly Income Expense
    function getexcatwr() {
        $this->db->where('stus', 'regular');
        $this->db->order_by('list', 'ASC');
        $query = $this->db->get('expense_category');
        return $query->result();
    }

    // Income Category for all     
    function getcat() {
        $this->db->order_by('list', 'ASC');
        $query = $this->db->get('income_category');
        return $query->result();
    }
    
    // Expense Category for all
    function getexcat() {
        $this->db->order_by('list', 'ASC');
        $query = $this->db->get('expense_category');
        return $query->result();
    }

    //Insert Income Category
    function insertincompart($data) {
        $this->db->insert('income_category', $data);
    }


    //Insert Expense Category
    function insertexppart($data) {
        $this->db->insert('expense_category', $data);
    }




// Daily Income Model

    //Get Previousday Income
    function getincome() {
        $das = date('Y-m-d', strtotime("-1 days"));
        $this->db->where('date', $das);
        $this->db->join('income_category', 'income_category.id = income.cat_id')->order_by('list', 'ASC');
        $query = $this->db->get('income');
        return $query->result();
    }

    //Get Target Date Income   
    function getincomedaily($target) {
        $this->db->where('date', $target);
        $this->db->join('income_category', 'income_category.id = income.cat_id', 'left')->order_by('idi', 'ASC');
        $query = $this->db->get('income');
        return $query->result();
    }

    //Get Income By Id
    function getIncomeByIdex($id) {
        $this->db->where('idi', $id);
        $query = $this->db->get('income');
        return $query->row();
    }

    //Insert Income
    function insertincom($data) {
        $this->db->insert('income', $data);
    }

    //Update Income
    function Updateincome($id, $data) {
        $this->db->where('idi', $id);
        $this->db->update('income', $data);
    }

    //Delete Income By ID
    function delete($id) {
        $this->db->where('idi', $id);
        $this->db->delete('income');
    }









// Daily Expense Model

    //Get Previous Days Expense
    function getexpenyes() {
        $target = date('Y-m-d', strtotime("-1 days"));
        $this->db->where('date', $target);
        $this->db->join('expense_category', 'expense_category.id = expense.cat_id')->order_by('list', 'ASC');
        $query = $this->db->get('expense');
        return $query->result();
    }

    //Get Target Day Expense
    function getexpendaily($target) {
        $this->db->where('date', $target);
        $this->db->join('expense_category', 'expense_category.id = expense.cat_id', 'left')->order_by('ide', 'ASC');
        $query = $this->db->get('expense');
        return $query->result();
    }


    //Get Expense By ID
    function getExpenByIdex($id) {
        $this->db->where('ide', $id);
        $query = $this->db->get('expense');
        return $query->row();
    }

    //Expense Category for All
    function getexp() {
        $this->db->order_by('list', 'ASC');
        $query = $this->db->get('expense_category');
        return $query->result();
    }

    //Insert Expense
    function insertexpen($data) {
        $this->db->insert('expense', $data);
    }

    //Update Expense
    function Updateexpen($id, $data) {
        $this->db->where('ide', $id);
        $this->db->update('expense', $data);
    }

    //Delete Expense By ID 
    function deleteexpen($id) {
        $this->db->where('ide', $id);
        $this->db->delete('expense');
    }

    //Delete Income Category
    function deleteincomepart($id) {
        $this->db->where('id', $id);
        $this->db->delete('income_category');
    }

    
    //Delete Expense Category
    function deleteexpenpart($id) {
        $this->db->where('id', $id);
        $this->db->delete('expense_category');
    }




// Bank Account 
    //Insert Bank Account
    function insertbankacc($data) {
        $this->db->insert('bank_account', $data);
    }

    //Get Bank Account
    function bankacc() {
        $this->db->where('stus', 'running');
        $query = $this->db->get('bank_account');
        return $query->result();
    }







// Bank Deposit 

    //Insert Bank Deposite
    function insertbankd($data) {
        $this->db->insert('bank_deposit', $data);
    }

    //Get Todays Bank Deposite
    function bankdep() {
        $tims =  time();
        $das = date('Y-m-d', $tims);
        $this->db->where('date', $das);
        $query = $this->db->get('bank_deposit');
        return $query->result();
    }

    //Get Bank Deposite By ID
    function getBankdByIdex($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('bank_deposit');
        return $query->row();
    }

    //Delete Bank Deposite
    function deletebankd($id) {
        $this->db->where('id', $id);
        $this->db->delete('bank_deposit');
    }

    //Bank Deposite By Target 
    function bankdepdate($target) {
        $this->db->where('date', $target);
        $query = $this->db->get('bank_deposit');
        return $query->result();
    }








// Bank Withdraw 

    //Insert Bank Withdraw
    function insertbankw($data) {
        $this->db->insert('bank_withdraw', $data);
    }

    //Get Todays Bank Withdraw
    function bankwith() {
        $tims =  time();
        $das = date('Y-m-d', $tims);
        $this->db->where('date', $das);
        $query = $this->db->get('bank_withdraw');
        return $query->result();
    }

    //Get Bank Withdraw By ID
    function getBankwByIdex($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('bank_withdraw');
        return $query->row();
    }

    //Delete Bank Withdraw 
    function deletebankw($id) {
        $this->db->where('id', $id);
        $this->db->delete('bank_withdraw');
    }

    //Bank Withdraw By Target Date 
    function bankwithdate($target) {
        $this->db->where('date', $target);
        $query = $this->db->get('bank_withdraw');
        return $query->result();
    }







// Update Bank Statement

    //Update Bank Deposite
    function updbdpmodel($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('bank_deposit', $data);
    }

    //Update Bank Withdraw
    function updbwdmodel($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('bank_withdraw', $data);
    }







//Monthly Statement Model

    //Get Income Monthly
    function getincomemonthly($month, $year) {
        $this->db->where('MONTH(date)', $month)->where('YEAR(date)', $year);
        $query = $this->db->get('income');
        return $query->result();
    }

    //Get Expense Monthly
    function getexpenmonthly($month, $year) {
        $this->db->where('MONTH(date)', $month)->where('YEAR(date)', $year);
        $query = $this->db->get('expense');
        return $query->result();
    }







//Ladger Page Model By ID

    //Get Category wise Income Ledger Monthly
    function getincomeladger($ciid, $month, $year) {
        $array = array('cat_id' => $ciid, 'MONTH(date)' => $month, 'YEAR(date)' => $year);
        $this->db->where($array);
        $this->db->order_by('date', 'ASC');
        $query = $this->db->get('income');
        return $query->result();
    }

    //Get Category wise Expense Ledger Monthly
    function getexpladger($ciid, $month, $year) {
        $array = array('cat_id' => $ciid, 'MONTH(date)' => $month, 'YEAR(date)' => $year);
        $this->db->where($array);
        $this->db->order_by('date', 'ASC');
        $query = $this->db->get('expense');
        return $query->result();
    }






//Monthly Bank Statement

    //Get Monthly Bank Deposite
    function monbankdep($month, $year) {
        $array = array('MONTH(date)' => $month, 'YEAR(date)' => $year);
        $this->db->where($array);
        $this->db->order_by('date', 'ASC');
        $query = $this->db->get('bank_deposit');
        return $query->result();
    }

    //Get Monthly Bank Withdraw
    function monbanked($month, $year) {
        $array = array('MONTH(date)' => $month, 'YEAR(date)' => $year);
        $this->db->where($array);
        $this->db->order_by('date', 'ASC');
        $query = $this->db->get('bank_withdraw');
        return $query->result();
    }







//Total Cash-in-Hand

    //income Sum
    function tidatewise($stdate, $target) {
        $this->db->select_sum('amount');
        $this->db->where('date >=', $stdate);
        $this->db->where('date <=', $target);
        $query = $this->db->get('income');
        return $query->row()->amount;
    }


    //Bank Withdraw Sum
    function tbwdatewise($stdate, $target) {
        $this->db->select_sum('amount');
        $this->db->where('date >=', $stdate);
        $this->db->where('date <=', $target);
        $query = $this->db->get('bank_withdraw');
        return $query->row()->amount;
    }


    //expense Sum
    function tedatewise($stdate, $target) {
        $this->db->select_sum('amount');
        $this->db->where('date >=', $stdate);
        $this->db->where('date <=', $target);
        $query = $this->db->get('expense');
        return $query->row()->amount;
    }


    //Bank Deposite Sum
    function tbddatewise($stdate, $target) {
        $this->db->select_sum('amount');
        $this->db->where('date >=', $stdate);
        $this->db->where('date <=', $target);
        $query = $this->db->get('bank_deposit');
        return $query->row()->amount;
    }










//Total Cash-in-Hand for Trial

    //income Sum
    function trtidatewise($target, $ltdate) {
        $this->db->select_sum('amount');
        $this->db->where('date >=', $target);
        $this->db->where('date <=', $ltdate);
        $query = $this->db->get('income');
        return $query->row()->amount;
    }


    //Bank Withdraw Sum
    function trtbwdatewise($target, $ltdate) {
        $this->db->select_sum('amount');
        $this->db->where('date >=', $target);
        $this->db->where('date <=', $ltdate);
        $query = $this->db->get('bank_withdraw');
        return $query->row()->amount;
    }


    //expense Sum
    function trtedatewise($target, $ltdate) {
        $this->db->select_sum('amount');
        $this->db->where('date >=', $target);
        $this->db->where('date <=', $ltdate);
        $query = $this->db->get('expense');
        return $query->row()->amount;
    }


    //Bank Deposite Sum
    function trtbddatewise($target, $ltdate) {
        $this->db->select_sum('amount');
        $this->db->where('date >=', $target);
        $this->db->where('date <=', $ltdate);
        $query = $this->db->get('bank_deposit');
        return $query->row()->amount;
    }















// Trial Balance Model


    //Bank Account
    function getbankaccn() {
        $query = $this->db->get('bank_account');
        return $query->result();
    }




    //income Sum
    function tidatewisetr($stdate, $ltdate) {
        $this->db->select_sum('amount');
        $this->db->where('date >=', $stdate);
        $this->db->where('date <=', $ltdate);
        $query = $this->db->get('income');
        return $query->row()->amount;
    }


    //Bank Withdraw Sum
    function tbwdatewisetr($stdate, $ltdate) {
        $this->db->select_sum('amount');
        $this->db->where('date >=', $stdate);
        $this->db->where('date <=', $ltdate);
        $query = $this->db->get('bank_withdraw');
        return $query->row()->amount;
    }


    //expense Sum
    function tedatewisetr($stdate, $ltdate) {
        $this->db->select_sum('amount');
        $this->db->where('date >=', $stdate);
        $this->db->where('date <=', $ltdate);
        $query = $this->db->get('expense');
        return $query->row()->amount;
    }


    //Bank Deposite Sum
    function tbddatewisetr($stdate, $ltdate) {
        $this->db->select_sum('amount');
        $this->db->where('date >=', $stdate);
        $this->db->where('date <=', $ltdate);
        $query = $this->db->get('bank_deposit');
        return $query->row()->amount;
    }



//This Month Income expense And Bank Deposite Withdraw

    //income Sum Monthly
    function thisincome($month, $year) {
        $this->db->select_sum('amount');
        $array = array('MONTH(date)' => $month, 'YEAR(date)' => $year);
        $this->db->where($array);
        $query = $this->db->get('income');
        return $query->row()->amount;
    }


    //Bank Withdraw Sum Monthly 
    function thisbankwdr($month, $year) {
        $this->db->select_sum('amount');
        $array = array('MONTH(date)' => $month, 'YEAR(date)' => $year);
        $this->db->where($array);
        $query = $this->db->get('bank_withdraw');
        return $query->row()->amount;
    }


    //expense Sum Monthly
    function thisexpense($month, $year) {
        $this->db->select_sum('amount');
        $array = array('MONTH(date)' => $month, 'YEAR(date)' => $year);
        $this->db->where($array);
        $query = $this->db->get('expense');
        return $query->row()->amount;
    }
 

    //Bank Deposite Sum Monthly
    function thisbankdeposite($month, $year) {
        $this->db->select_sum('amount');
        $array = array('MONTH(date)' => $month, 'YEAR(date)' => $year);
        $this->db->where($array);
        $query = $this->db->get('bank_deposit');
        return $query->row()->amount;
    }



//End Bracket
}
