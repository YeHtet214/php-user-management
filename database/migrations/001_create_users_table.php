<?php

return [
    'up' => "
        CREATE TABLE IF NOT EXISTS admin_users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name VARCHAR(50) UNIQUE NOT NULL,
            username VARCHAR(50) UNIQUE NOT NULL,
            role_id INTEGER NOT NULL,
            phone VARCHAR(50), 
            email VARCHAR(100) UNIQUE NOT NULL,
            address VARCHAR(255), 
            password VARCHAR(255) NOT NULL,
            gender BOOLEAN,
            is_active BOOLEAN NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )
    ",
    'down' => "DROP TABLE IF EXISTS users"
];