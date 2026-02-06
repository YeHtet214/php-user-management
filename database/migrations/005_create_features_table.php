<?php

return [
    'up' => "
        CREATE TABLE IF NOT EXISTS features (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name VARCHAR(50) UNIQUE,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        )
    ",
    'down' => "DROP TABLE IF EXISTS users"
];