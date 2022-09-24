<?php

class Database
{
    private $db = null;

    public function __construct()
    {
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'edo_food';
        
        $this->db = new mysqli($host, $user, $password, $database);
        $this->db->set_charset('utf8mb4');
    }

    public function __destruct()
    {
        $this->db->close();
    }

    public function get_user_id($email, $password)
    {
        $email = $this->db->real_escape_string($email);
        $password = $this->db->real_escape_string($password);

        $query =
        "SELECT
            `people`.`id` AS `user-id`
        FROM `people`
        WHERE
            TRIM(`people`.`email`) = TRIM('$email') AND
            TRIM(`people`.`password`) = TRIM('$password')
        ;";

        $q = $this->db->query($query);
        $row = $q->fetch_assoc();
        $q->free_result();

        return $row['user-id'] ?? null;
    }

    public function is_valid_user_id($user_id)
    {
        $user_id = $this->db->real_escape_string($user_id);

        $query =
        "SELECT
            COUNT(*) AS `count`
        FROM `people`
        WHERE
            `people`.`id` = $user_id
        ;";

        $q = $this->db->query($query);
        $count = $q->fetch_assoc()['count'];
        $q->free_result();

        return intval($count) !== 0;
    }

    public function is_user_admin($user_id)
    {
        $user_id = $this->db->real_escape_string($user_id);

        $query =
        "SELECT
            `people`.`admin` AS `admin`
        FROM `people`
        WHERE
            `people`.`id` = $user_id
        ;";

        $q = $this->db->query($query);
        $admin = $q->fetch_assoc()['admin'];
        $q->free_result();

        return $admin === 'Y';
    }

    public function get_people()
    {
        $query =
        "SELECT
            `people`.`id` AS `id`,
            `people`.`full_name` AS `full_name`,
            `people`.`email` AS `email`,
            `people`.`credit` AS `credit`,
            `people`.`admin` AS `admin`
        FROM `people`
        ;";

        $people = [];

        $q = $this->db->query($query);
        while ($row = $q->fetch_assoc())
        {
            $people[] = $row;
        }
        $q->free_result();

        return $people;
    }

    public function add_person($id, $full_name, $email, $password, $credit, $admin)
    {
        $id = $this->db->real_escape_string($id);
        $full_name = $this->db->real_escape_string($full_name);
        $email = $this->db->real_escape_string($email);
        $password = $this->db->real_escape_string($password);
        $credit = $this->db->real_escape_string($credit);
        $admin = $admin ? 'Y' : 'N';

        $query =
        "INSERT INTO `people`
        (
            `people`.`id`,
            `people`.`full_name`,
            `people`.`email`,
            `people`.`password`,
            `people`.`credit`,
            `people`.`admin`
        )
        VALUES
        (
            $id,
            TRIM('$full_name'),
            TRIM('$email'),
            TRIM('$password'),
            $credit,
            TRIM('$admin')
        )
        ;";

        return $this->db->query($query);
    }

    public function update_person($id, $new_id, $full_name, $email, $password, $add_credit, $admin)
    {
        $id = $this->db->real_escape_string($id);
        
        $query =
        "UPDATE `people`
        SET
            `people`.`last_edit` = CURRENT_TIMESTAMP()
        ";
        if (!in_array($new_id, [null, ''], true))
        {
            $new_id = $this->db->real_escape_string($new_id);
            $query .= ", `people`.`id` = $new_id\n";
        }
        if (!in_array($full_name, [null, ''], true))
        {
            $full_name = $this->db->real_escape_string($full_name);
            $query .= ", `people`.`full_name` = TRIM('$full_name')\n";
        }
        if (!in_array($email, [null, ''], true))
        {
            $email = $this->db->real_escape_string($email);
            $query .= ", `people`.`email` = TRIM('$email')\n";
        }
        if (!in_array($password, [null, ''], true))
        {
            $password = $this->db->real_escape_string($password);
            $query .= ", `people`.`password` = TRIM('$password')\n";
        }
        if (!in_array($add_credit, [null, ''], true))
        {
            $add_credit = $this->db->real_escape_string($add_credit);
            $query .= ", `people`.`credit` = `people`.`credit` + $add_credit\n";
        }
        if (in_array($admin, [true, false], true))
        {
            $admin = $admin ? 'Y' : 'N';
            $query .= ", `people`.`admin` = TRIM('$admin')\n";
        }
        $query .= "WHERE `people`.`id` = $id;";

        return $this->db->query($query);
    }

    public function delete_person($id)
    {
        $id = $this->db->real_escape_string($id);

        $query =
        "DELETE FROM `people`
        WHERE `people`.`id` = $id
        ;";

        return $this->db->query($query);
    }

    public function get_meals($meal_type = null)
    {
        $query =
        "SELECT
            `meals`.`id` AS `id`,
            `meals`.`name` AS `name`,
            `meals`.`price` AS `price`,
            `meals`.`amount` AS `amount`
        FROM `meals`
        ";
        if (!in_array($meal_type, [null, ''], true))
        {
            $query .= "WHERE `meals`.`meal_type` = TRIM('$meal_type')";
        }

        $meals = [];

        $q = $this->db->query($query);
        while ($row = $q->fetch_assoc())
        {
            $meals[] = $row;
        }
        $q->free_result();

        return $meals;
    }

    public function add_meal($name, $price, $amount, $meal_type)
    {
        $name = $this->db->real_escape_string($name);
        $price = $this->db->real_escape_string($price);
        $amount = $this->db->real_escape_string($amount);
        $meal_type = $this->db->real_escape_string($meal_type);

        $query =
        "INSERT INTO `meals`
        (
            `meals`.`name`,
            `meals`.`price`,
            `meals`.`amount`,
            `meals`.`meal_type`
        )
        VALUES
        (
            TRIM('$name'),
            $price,
            $amount,
            TRIM('$meal_type')
        )
        ;";

        return $this->db->query($query);
    }

    public function update_meal($id, $name, $price, $amount)
    {
        $id = $this->db->real_escape_string($id);
        
        $query =
        "UPDATE `meals`
        SET
            `meals`.`last_edit` = CURRENT_TIMESTAMP()
        ";
        if (!in_array($name, [null, ''], true))
        {
            $name = $this->db->real_escape_string($name);
            $query .= ", `meals`.`name` = TRIM('$name')\n";
        }
        if (!in_array($price, [null, ''], true))
        {
            $price = $this->db->real_escape_string($price);
            $query .= ", `meals`.`price` = $price\n";
        }
        if (!in_array($amount, [null, ''], true))
        {
            $amount = $this->db->real_escape_string($amount);
            $query .= ", `meals`.`amount` = $amount\n";
        }
        $query .= "WHERE `meals`.`id` = $id;";

        return $this->db->query($query);
    }

    public function delete_meal($id)
    {
        $id = $this->db->real_escape_string($id);

        $query =
        "DELETE FROM `meals`
        WHERE `meals`.`id` = $id
        ;";

        return $this->db->query($query);
    }
}

?>