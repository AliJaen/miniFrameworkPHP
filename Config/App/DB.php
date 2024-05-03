<?php

class DB extends DatabaseConnection {
    /**
     * List data from the DB
     */
    public static function listEqual($table, $params = [], $limit = null) {
        $cols_values = "";
        $limits = "";

        if (!empty($params)) {
            $cols_values .= "WHERE";
            foreach($params as $key => $value) {
                $cols_values .= " {$key} = :{$key} AND";
            }
            // Drop the last `AND`
            $cols_values = substr($cols_values, 0, -3);
        }

        if ($limit !== null) {
            $limits = " LIMIT {$limit}";
        }

        $stmt = "SELECT * FROM {$table} {$cols_values}{$limits}";

        if (!$rows = parent::query($stmt, $params)) {
            return false;
        }

        return $limit === 1 ? $rows[0] : $rows;
    }

    /**
     * List data from `n` tables form the DB
     */
    public static function multiJoin($parent, $foreigns, $params = [], $limit = null) {
        $cols_values = "";
        $limits = "";
        $joins = "";

        // Prepare the condition WHERE if exist params
        if (!empty($params)) {
            $cols_values .= "WHERE";
            foreach($params as $key => $value) {
                $cols_values .= " {$key} = :{$key} AND";
            }
            // Drop the last `AND`
            $cols_values = substr($cols_values, 0, -4);
        }

        // Prepare the clause LIMIT if limit exist
        if ($limit !== null) {
            $limits = " LIMIT {$limit}";
        }

        // Build the clause JOIN
        foreach ($foreigns as $table => $val) {
            $joins .= "LEFT JOIN {$table}
            ON {$parent}.{$val[0]} = {$table}.{$val[1]} ";
        }

        // Build the list of colums to SELECT, just the FOREIGN KEY
        $selected_columns = "{$parent}.*";
        foreach ($foreigns as $table => $val) {
            $selected_columns .= ", {$table}.{$val[2]} AS {$val[2]}";
        }

        // Build the final Query
        $stmt = "SELECT {$selected_columns} FROM {$parent}
                    {$joins}
                    {$cols_values}{$limits}";

        if (!$rows = parent::query($stmt, $params)) {
            return false;
        }

        return $limit === 1 ? $rows[0] : $rows;
    }
    
    /**
     * List data from 2 tables form the DB
     */
    public static function join($table1, $table2, $val1, $val2, $params = [], $limit = null) {
        $cols_values = "";
        $limits = "";

        if (!empty($params)) {
            $cols_values .= "WHERE";
            foreach($params as $key => $value) {
                $cols_values .= " {$key} = :{$key} AND";
            }
            // Drop the last `AND`
            $cols_values = substr($cols_values, 0, -3);
        }

        if ($limit !== null) {
            $limits = " LIMIT {$limit}";
        }

        $stmt = "SELECT * FROM {$table1}
                    INNER JOIN {$table2}
                    ON {$table1}.{$val1} = {$table2}.{$val2}
                    {$cols_values}{$limits}";

        if (!$rows = parent::query($stmt, $params)) {
            return false;
        }

        return $limit === 1 ? $rows[0] : $rows;
    }

    public static function insert($table, $params) {
        $cols = "";
        $placeholders = "";
        foreach ($params as $key => $value) {
            $cols .= "{$key} ,";
            $placeholders .= ":{$key} ,";
        }
        $cols = substr($cols, 0, -1);
        $placeholders = substr($placeholders, 0, -1);

        $stmt = "INSERT INTO {$table} ({$cols}) VALUES ({$placeholders})";

        if ($id = parent::query($stmt, $params)) {
            return $id;
        } else {
            return false;
        }
    }
    
    public static function update($table, $params = [], $id = []) {
        $cols = "";
        $placeholders = "";
        foreach ($params as $key => $value) {
            $placeholders .= "{$key} = :{$key} ,";
        }
        $placeholders = substr($placeholders, 0, -1);
        
        if (count($id) > 1) {
            foreach ($id as $key => $value) {
                $cols .= " {$key} = :{$key} AND";
            }
            $cols = substr($cols, 0, -3);
        } else {
            foreach ($id as $key => $value) {
                $cols .= " {$key} = :{$key}";
            }
        }

        $stmt = "UPDATE {$table} SET {$placeholders} WHERE {$cols}";

        if (!parent::query($stmt, array_merge($params, $id))) {
            return false;
        } else {
            return true;
        }
    }

    public static function delete($table, $params = [], $limit = 1) {
        $cols_values = "";
        $limits = "";
        if (!empty($params)) {
            $cols_values .= "WHERE";
            foreach ($params as $key => $value) {
                $cols_values .= " {$key} = :{$key} AND";
            }
            $cols_values = substr($cols_values, 0, -3);
        }

        if ($limit !== null) {
            $limits = " LIMIT {$limit}";
        }

        $stmt = "DELETE FROM $table {$cols_values}{$limits}";

        if (!$row = parent::query($stmt, $params)) {
            return false;
        }

        return $row;
    }

    public static function validateData(String $value) {
        // Drop the spaces at begin & end
        $value = trim($value);
        // Validate the html special chars to prevent HTML inyection
        $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        return $value;
    }

    public static function cryptPass(String $password) {
        $pass_crypt = password_hash($password, PASSWORD_DEFAULT);
        return $pass_crypt;
    }
}