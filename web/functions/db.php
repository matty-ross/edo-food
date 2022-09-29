<?php

require_once 'utility.php';

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
        $row = $q->fetch_assoc();
        $q->free_result();

        return intval($row['count']) !== 0;
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
        $row = $q->fetch_assoc();
        $q->free_result();

        return $row['admin'] === 'Y';
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
        if (is_valid_number($new_id))
        {
            $new_id = $this->db->real_escape_string($new_id);
            $query .= ", `people`.`id` = $new_id\n";
        }
        if (is_valid_string($full_name))
        {
            $full_name = $this->db->real_escape_string($full_name);
            $query .= ", `people`.`full_name` = TRIM('$full_name')\n";
        }
        if (is_valid_string($email))
        {
            $email = $this->db->real_escape_string($email);
            $query .= ", `people`.`email` = TRIM('$email')\n";
        }
        if (is_valid_string($password))
        {
            $password = $this->db->real_escape_string($password);
            $query .= ", `people`.`password` = TRIM('$password')\n";
        }
        if (is_valid_number($add_credit))
        {
            $add_credit = $this->db->real_escape_string($add_credit);
            $query .= ", `people`.`credit` = `people`.`credit` + $add_credit\n";
        }
        if (is_valid_bool($admin))
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
            `meals`.`amount` AS `amount`,
            `meals`.`meal_type` AS `meal_type`
        FROM `meals`
        ";
        if (is_valid_meal_type($meal_type))
        {
            $meal_type = $this->db->real_escape_string($meal_type);
            $query .= "WHERE `meals`.`meal_type` = TRIM('$meal_type')";
        }

        $meals = [];

        $q = $this->db->query($query);
        while ($row = $q->fetch_assoc())
        {
            $meal = $row;
            $meal['allergens'] = $this->get_meal_allergens($meal['id']);
            $meals[] = $meal;
        }
        $q->free_result();

        return $meals;
    }

    public function add_meal($name, $price, $amount, $meal_type, $allergens)
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

        if (!$this->db->query($query))
        {
            return false;
        }
        return $this->add_meal_allergens($this->db->insert_id, $allergens);
    }

    public function update_meal($id, $name, $price, $amount, $allergens)
    {
        $id = $this->db->real_escape_string($id);
        
        $query =
        "UPDATE `meals`
        SET
            `meals`.`last_edit` = CURRENT_TIMESTAMP()
        ";
        if (is_valid_string($name))
        {
            $name = $this->db->real_escape_string($name);
            $query .= ", `meals`.`name` = TRIM('$name')\n";
        }
        if (is_valid_number($price))
        {
            $price = $this->db->real_escape_string($price);
            $query .= ", `meals`.`price` = $price\n";
        }
        if (is_valid_number($amount))
        {
            $amount = $this->db->real_escape_string($amount);
            $query .= ", `meals`.`amount` = $amount\n";
        }
        $query .= "WHERE `meals`.`id` = $id;";

        if (
            !is_valid_numeric_array($allergens) ||
            !$this->db->query($query)
        )
        {
            return false;
        }
        return $this->update_meal_allergens($id, $allergens);
    }

    public function delete_meal($id)
    {
        $id = $this->db->real_escape_string($id);

        $query =
        "DELETE FROM `meals`
        WHERE `meals`.`id` = $id
        ;";

        if (!$this->delete_meal_allergens($id))
        {
            return false;
        }
        return $this->db->query($query);
    }

    public function get_allergens()
    {
        $query =
        "SELECT
            `allergens`.`id` AS `id`,
            `allergens`.`name` AS `name`
        FROM `allergens`
        ;";

        $allergens = [];

        $q = $this->db->query($query);
        while ($row = $q->fetch_assoc())
        {
            $allergens[] = $row;
        }
        $q->free_result();

        return $allergens;
    }

    private function get_meal_allergens($meal_id)
    {
        $meal_id = $this->db->real_escape_string($meal_id);

        $query =
        "SELECT
            `allergens`.`id` AS `id`,
            `allergens`.`name` AS `name`
        FROM `allergens`
            JOIN `meals_allergens` ON (`meals_allergens`.`allergen` = `allergens`.`id`)
        WHERE `meals_allergens`.`meal` = $meal_id
        ;";

        $allergens = [];

        $q = $this->db->query($query);
        while ($row = $q->fetch_assoc())
        {
            $allergens[] = $row;
        }
        $q->free_result();

        return $allergens;
    }

    public function add_allergen($name)
    {
        $name = $this->db->real_escape_string($name);
        
        $query =
        "INSERT INTO `allergens`
        (
            `allergens`.`name`
        )
        VALUES
        (
            TRIM('$name')
        )
        ;";

        return $this->db->query($query);
    }

    private function add_meal_allergens($meal_id, $allergens)
    {
        $meal_id = $this->db->real_escape_string($meal_id);

        $query =
        "INSERT INTO `meals_allergens`
        (
            `meals_allergens`.`meal`,
            `meals_allergens`.`allergen`
        )
        VALUES
        ";
        $values = [];
        foreach ($allergens as $allergen)
        {
            $allergen = $this->db->real_escape_string($allergen);
            $values[] = "($meal_id, $allergen)\n";
        }
        $query .= implode(',', $values);

        return $this->db->query($query);
    }

    public function update_allergen($id, $name)
    {
        $id = $this->db->real_escape_string($id);
        $name = $this->db->real_escape_string($name);

        $query =
        "UPDATE `allergens`
        SET `allergens`.`name` = TRIM('$name')
        WHERE `allergens`.`id` = $id
        ;";

        return $this->db->query($query);
    }

    private function update_meal_allergens($meal_id, $allergens)
    {
        if (!$this->delete_meal_allergens($meal_id))
        {
            return false;
        }
        return $this->add_meal_allergens($meal_id, $allergens);
    }

    public function delete_allergen($id)
    {
        $id = $this->db->real_escape_string($id);

        $query =
        "DELETE FROM `allergens`
        WHERE `allergens`.`id` = $id
        ;";

        return $this->db->query($query);
    }

    private function delete_meal_allergens($meal_id)
    {
        $meal_id = $this->db->real_escape_string($meal_id);

        $query =
        "DELETE FROM `meals_allergens`
        WHERE `meals_allergens`.`meal` = $meal_id
        ;";

        return $this->db->query($query);
    }

    public function get_menu_items($date = null, $meal_type = null)
    {
        $query =
        "SELECT
            `menu_items`.`id` AS `id`,
            `meals`.`id` AS `meal_id`,
            `meals`.`name` AS `meal_name`,
            `meals`.`price` AS `meal_price`,
            `meals`.`amount` AS `meal_amount`,
            `meals`.`meal_type` AS `meal_meal_type`,
            `menu_items`.`date` AS `date`
        FROM `meals`
            JOIN `menu_items` ON (`menu_items`.`meal` = `meals`.`id`)
        WHERE 1
        ";
        if (is_valid_date($date))
        {
            $date = $this->db->real_escape_string($date);
            $query .= "AND DATE(`menu_items`.`date`) = DATE('$date')\n";
        }
        if (is_valid_meal_type($meal_type))
        {
            $meal_type = $this->db->real_escape_string($meal_type);
            $query .= "AND `meals`.`meal_type` = TRIM('$meal_type')\n";
        }

        $menu_items = [];

        $q = $this->db->query($query);
        while ($row = $q->fetch_assoc())
        {
            $menu_item = $row;
            $menu_item['meal_allergens'] = $this->get_meal_allergens($menu_item['meal_id']);
            $menu_items[] = $menu_item;
        }
        $q->free_result();

        return $menu_items;
    }

    public function add_menu_item($meal_id, $date)
    {
        $meal_id = $this->db->real_escape_string($meal_id);
        $date = $this->db->real_escape_string($date);

        $query =
        "INSERT INTO `menu_items`
        (
            `menu_items`.`meal`,
            `menu_items`.`date`
        )
        VALUES
        (
            $meal_id,
            DATE('$date')
        )
        ;";

        return $this->db->query($query);
    }

    public function delete_menu_item($id)
    {
        $id = $this->db->real_escape_string($id);

        $query =
        "DELETE FROM `menu_items`
        WHERE `menu_items`.`id` = $id
        ;";

        return $this->db->query($query);
    }
}

?>