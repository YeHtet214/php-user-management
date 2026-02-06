<?php

return [
    'up' => "
        CREATE TABLE IF NOT EXISTS role_permissions (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            role_id INTEGER,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

            FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
        )
    ",
    'down' => "DROP TABLE IF EXISTS users"
];