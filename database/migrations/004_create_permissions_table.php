<?php

return [
    'up' => "
        CREATE TABLE IF NOT EXISTS permissions (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name VARCHAR(50) CHECK(name IN ('view', 'create', 'update', 'delete')) UNIQUE,
            feature_id INTEGER,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

            FOREIGN KEY (feature_id) REFERENCES features(id) ON DELETE CASCADE
        )
    ",
    'down' => "DROP TABLE IF EXISTS permissions"
];