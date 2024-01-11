<?php
/*
CREATE TABLE `reward`(
    `RewardID` varchar(6) NOT NULL,
    `RewardName` varchar(45) NOT NULL,
    `RewardPoints` int(11) NOT NULL,
    PRIMARY KEY (`RewardID`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
*/

class Reward{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function addReward($data){
        $this->db->query('INSERT INTO Reward (RewardID, RewardName, RewardPoints) VALUES(:rewardId, :rewardName, :rewardPoints)');

        //Bind values
        $this->db->bind(':rewardId', $data['rewardId']);
        $this->db->bind(':rewardName', $data['rewardName']);
        $this->db->bind(':rewardPoints', $data['rewardPoints']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllRewards(){
        $this->db->query('SELECT * FROM Reward ORDER BY RewardPoints ASC');

        $results = $this->db->resultSet();

        return $results;
    }

    public function deleteReward($rewardId){
        $this->db->query('DELETE FROM Reward WHERE RewardID = :rewardId');

        //Bind values
        $this->db->bind(':rewardId', $rewardId);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getMaxRewardId() {
        $this->db->query('SELECT MAX(RewardID) AS maxRewardId FROM Reward');

        $row = $this->db->single();

        if ($row) {
            return $row->maxRewardId;
        } else {
            return false;
        }
    }
}
?>