<?php

return [
    'up' => "
        CREATE TABLE IF NOT EXISTS permissions (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name VARCHAR(50) UNIQUE,
            feature_id INTEGER UNIQUE NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

            FOREIGN KEY (feature_id) REFERENCES features(id) ON DELETE CASCADE
        )
    ",
    'down' => "DROP TABLE IF EXISTS users"
];