<?php

namespace app\models;

class User
{
    public function getAllUsers() {
        //in future this will come from the database

        $allUsers = [
            [
                'id' => '1',
                'name' => 'pinecone'
            ],
            [
                'id' => '2',
                'name' => 'nathan'
            ]
        ];

   /*     //filter by query string
        return array_filter($allUsers, function ($user) use ($name) {
            if ($user['name'] === $name) {
                return $user;
            };
        });

        return $filteredByName;
    }

    public function saveUsers() {
    */
        
    }
}


