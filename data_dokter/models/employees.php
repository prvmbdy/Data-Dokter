<?php
    class Employee{
        // Connection
        private $conn;
        // Table
        private $db_table = "dokter";
        // Columns
        public $id;
        public $name;
        public $email;
        public $age;
        public $designation;
        public $created;
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getEmployees(){
            $sqlQuery = "SELECT id, name, rumah_sakit, age, spesialis, created FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        // CREATE
        public function createEmployee(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        rumah_sakit = :rumah_sakit, 
                        age = :age, 
                        spesialis = :spesialis, 
                        created = :created";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->rumah_sakit=htmlspecialchars(strip_tags($this->rumah_sakit));
            $this->age=htmlspecialchars(strip_tags($this->age));
            $this->spesialis=htmlspecialchars(strip_tags($this->spesialis));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":rumah_sakit", $this->rumah_sakit);
            $stmt->bindParam(":age", $this->age);
            $stmt->bindParam(":spesialis", $this->spesialis);
            $stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // READ single
        public function getSingleEmployee(){
            $sqlQuery = "SELECT
                        id, 
                        name, 
                        rumah_sakit, 
                        age, 
                        spesialis, 
                        created
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->name = $dataRow['name'];
            $this->rumah_sakit = $dataRow['rumah_sakit'];
            $this->age = $dataRow['age'];
            $this->spesialis = $dataRow['spesialis'];
            $this->created = $dataRow['created'];
        }        
        // UPDATE
        public function updateEmployee(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        rumah_sakit = :rumah_sakit, 
                        age = :age, 
                        spesialis = :spesialis, 
                        created = :created
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->rumah_sakit=htmlspecialchars(strip_tags($this->rumah_sakit));
            $this->age=htmlspecialchars(strip_tags($this->age));
            $this->spesialis=htmlspecialchars(strip_tags($this->spesialis));
            $this->created=htmlspecialchars(strip_tags($this->created));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":rumah_sakit", $this->rumah_sakit);
            $stmt->bindParam(":age", $this->age);
            $stmt->bindParam(":spesialis", $this->spesialis);
            $stmt->bindParam(":created", $this->created);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // DELETE
        function deleteEmployee(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>