<?php

/**
 * Core Framework - DevModel
 *
 * @license    MIT (https://mit-license.org/)
 * @author     Louis Ouellet <louis@laswitchtech.com>
 */

// Import additionnal class into the global namespace
use \LaswitchTech\Core\Abstracts\Model;

class DevModel extends Model {

    public function ucwords(string $table, string $column): array
    {
        // Initialize the Result
        $result = [];

        // Create the Query
        $Query = $this->Database->query()
            ->table($table)
            ->select('*')
            ->where($column, null, 'IS NOT NULL')
            ->where($column, '', '<>')
            ->where('id', 9999, '<>');

        // Retrieve the Results
        $result = $Query->fetch();

        // Loop through the Results
        foreach($result as $key => $record){

            // Check if the Record is Empty
            if($result[$key][$column]){

                // Update the Record
                $result[$key][$column] = ucwords(strtolower($record[$column]) ?? '');

                // Update the Record
                $Query = $this->Database->query()
                    ->table($table)
                    ->update([$column => $result[$key][$column]])
                    ->where('id', $record['id'])
                    ->execute();
            }
        }

        // Return the Results
        return $result;
    }

    public function read(string $table): array
    {
        // Initialize the Result
        $result = [];

        // Create the Query
        $Query = $this->Database->query()
            ->table($table)
            ->select('*')
            ->where('id', 9999, '<>');

        // Return the Results
        return $Query->fetch();
    }

    /**
     * Update a Record
     *
     * @param string $table
     * @param int $id
     * @param array $data
     * @return int
     */
    public function update(string $table, int $id, array $data): int
    {
        // Create the Query
        $Query = $this->Database->query()
            ->table($table)
            ->update($data)
            ->where('id', $id);

        // Execute the Query
        return $Query->execute();
    }
}
