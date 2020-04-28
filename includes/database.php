<?php
session_start();
require_once('db_connection.php');
require_once('room.php');
require_once('user.php');
Class Database {
    public $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }
	
	public function addRoom($data){ 
        $sql = 'INSERT INTO rooms (description, picture, price, postedBy)';
        $sql .= ' VALUES ("'. $data['description'] . '","' . $data['house-img'];
        $sql .= '","' . $data['price'] . '",' . $_SESSION['userID'] . ')';
        $result = mysqli_query($this->conn,$sql);

        if (!$result)
            echo "Error: " . $sql . "<br> Failed to add" . mysqli_error($this->conn);
	}
	
	public function getRoomInfo($id){
        $sql = 'SELECT * FROM rooms WHERE id = ' . $id;
        $result = mysqli_query($this->conn,$sql);
        if (!$result) {
            echo "Error: " . $sql . "<br> Failed to get Room " . mysqli_error($this->conn);
            return '';
        } else {
            $row = mysqli_fetch_assoc($result);
            $room = new Room($row['id'], $row['description'], $row['picture'], 
            $row['price'], $row['postedBy']);
            return $room;
        }
    }
    
    public function getUserInfo($id){
		$sql = 'SELECT * FROM users WHERE id = ' . $id;
        $result = mysqli_query($this->conn,$sql);
        if (!$result) {
            echo "Error: " . $sql . "<br> Failed to get User " . mysqli_error($this->conn);
            return '';
        } else {
            $row = mysqli_fetch_assoc($result);
            $user = new User($row['id'], $row['name'], $row['email'], $row['age'], $row['password'], $row['roomsForRent'], $row['sex'], $row['profilePicture'], $row['phoneNumber'], $row['flatmateExpectation'], $row['cleanliness'], $row['bedtime'], $row['food']);
            return $user;
        }
	}
	
	public function editRoomInfo($data,$id){
        $sql = 'UPDATE rooms SET description = "'.$data['description'].'", picture = "'.$data['house-img'].'", price = "'.$data['price'].'" WHERE id = '. $id;
        $result = mysqli_query($this->conn,$sql);
        if (!$result) {
            echo "Error: " . $sql . "<br> Failed to edit Room " . mysqli_error($this->conn);
            return '';
        }  
	}
	
	public function deleteRoom($id){
        $sql = 'DELETE FROM rooms WHERE id = ' . $id;
        $result = mysqli_query($this->conn,$sql);
        if (!$result) {
            echo "Error: " . $sql . "<br> Failed to get User" . mysqli_error($this->conn);
        }
    }
    
    public function getAllRoomIds(){
        $sql = 'SELECT id FROM rooms';
        $result = mysqli_query($this->conn,$sql);
        if (!$result) {
            echo "Error: " . $sql . "<br> Failed to get All Room Ids " . mysqli_error($this->conn);
            die();
        } else {
            $arr = array();
            while ($row = mysqli_fetch_array($result)){
                array_push($arr,$row['id']);
            }
            return $arr;
        }
    }
}

$database = new Database($conn);
?>