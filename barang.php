<?php
    include('connect.php');
    class barang{
        public $kdb = "";
        public $nb = "";
        public $hb = 0;
        public $qb = 0;
        private $conn;
        public function __construct() {
            global $conn;
            $this->conn = $conn;
        }
        function set_kdb($var) {
            $this->kdb = $var;
          }
        function set_nb($var) {
            $this->nb = $var;
          }
        function set_hb($var) {
            $this->hb = $var;
          }
        function set_qb($var) {
            $this->qb = $var;
          }
        function get_kdb() {
            return $this->kdb;
          }
        function get_nb() {
            return $this->nb;
          }
        function get_hb() {
            return $this->hb;
          }
        function get_qb() {
            return $this->qb;
          }
        function checkSQL(){
            $conn = $this->conn;
            $query = "SELECT * FROM isi";
            $res = sqlsrv_query($conn,$query,array(),array( "Scrollable" => 'static' ));
            if(sqlsrv_num_rows($res) > 0){
                while($row = sqlsrv_fetch_array($res,SQLSRV_FETCH_ASSOC)){
                    echo "---------------------------------------------------------------------------------------------<br>";
                    echo $row["kode_barang"]." | ".$row["nama_barang"]." | ".$row["harga_barang"]." | ".$row["kuantiti_barang"]."<br>";
                }
            }else{
                echo "<script>alert(\"Query Failed\")</script>";
                die(print_r(sqlsrv_errors(), true));
            }
        }
        function checkSQL2($kdb){
            $conn = $this->conn;
            $query = "SELECT * FROM isi WHERE kode_barang = '".$kdb."'";
            $res = sqlsrv_query($conn,$query,array(),array( "Scrollable" => 'static' ));
            if(sqlsrv_num_rows($res) > 0){
                while($row = sqlsrv_fetch_array($res,SQLSRV_FETCH_ASSOC)){
                    echo "---------------------------------------------------------------------------------------------<br>";
                    echo $row["kode_barang"]." | ".$row["nama_barang"]." | ".$row["harga_barang"]." | ".$row["kuantiti_barang"]."<br>";
                }
            }else{
                echo "<script>alert(\"Query Failed\")</script>";
                die(print_r(sqlsrv_errors(), true));
            }
        }
        function intoSQL(){
            $kdb = $this->kdb;
            $nb = $this->nb;
            $hb = $this->hb;
            $qb = $this->qb;
            $conn = $this->conn;
            $query = "INSERT INTO isi VALUES (?, ?, ?, ?)";
            $params = array($kdb, $nb, $hb, $qb);
            $res = sqlsrv_query($conn,$query, $params);
            if ($res != false) {
                echo "<script>alert(\"Value Inserted\")</script>";
            } else {
                echo "<script>alert(\"Insertion Failed\")</script>";
                die(print_r(sqlsrv_errors(), true));
            }
        }
        function removeSQL($kdb){
            $conn = $this->conn;
            $query = "DELETE FROM isi WHERE kode_barang = '".$kdb."'";
            $res = sqlsrv_query($conn,$query);
            if ($res != false) {
                echo "<script>alert(\"Value Deleted\")</script>";
            } else {
                echo "<script>alert(\"Delete Failed\")</script>";
                die(print_r(sqlsrv_errors(), true));
            }
        }
        function updateSQL($kdb, $nb, $hb, $qb){
            $conn = $this->conn;
            $query = "UPDATE isi SET kode_barang = ?, nama_barang = ?, harga_barang = ?, kuantiti_barang = ? WHERE kode_barang = ?";
            $params = array($kdb, $nb, $hb, $qb, $kdb);
            $res = sqlsrv_query($conn,$query,$params);
            if ($res != false) {
                echo "<script>alert(\"Row Updated\")</script>";
            } else {
                echo "<script>alert(\"Update Failed\")</script>";
                die(print_r(sqlsrv_errors(), true));
            }
        }
    }
?>